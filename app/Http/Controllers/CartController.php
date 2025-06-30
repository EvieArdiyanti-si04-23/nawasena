<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;

class CartController extends Controller
{
    // Menampilkan halaman keranjang
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('pelanggan.keranjang', compact('cart'));
    }

    // Menambahkan item ke keranjang
    public function add(Request $request)
    {
        $menu = Menu::findOrFail($request->menu_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$menu->id])) {
            // Jika item sudah ada, tambahkan jumlah
            $cart[$menu->id]['quantity'] += $request->quantity;
        } else {
            // Jika belum ada, tambahkan item baru
            $cart[$menu->id] = [
                'nama_menu' => $menu->nama_menu,
                'harga'     => $menu->harga,
                'gambar'    => $menu->gambar,
                'quantity'  => $request->quantity,
                'catatan'   => $request->catatan,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Menu ditambahkan ke keranjang!');
    }

    // Menghapus item dari keranjang
    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$request->menu_id])) {
            unset($cart[$request->menu_id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Item dihapus dari keranjang.');
    }

    // Proses checkout dan simpan ke database
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        // Hitung total keseluruhan
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['quantity'];
        }

        // Simpan order utama
        $order = Order::create([
            'user_id'     => auth()->id(),
            'total_harga' => $total,
        ]);

        foreach ($cart as $menuId => $item) {
            $menu = Menu::findOrFail($menuId);
            $menu->stok -= $item['quantity'];
            $menu->save();
        }

        // Simpan detail setiap item
        foreach ($cart as $menuId => $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'menu_id'  => $menuId,
                'harga'    => $item['harga'],
                'jumlah'   => $item['quantity'],
                'subtotal' => $item['harga'] * $item['quantity'],
                'catatan'  => $item['catatan'] ?? null,
            ]);
        }

        // Hapus keranjang dari session
        session()->forget('cart');

        return redirect()->route('pelanggan.dashboard')->with('success', 'Pesanan berhasil diproses!');
    }
}
