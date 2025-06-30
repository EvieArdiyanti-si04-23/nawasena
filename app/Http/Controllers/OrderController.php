<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    // Menyimpan pesanan baru
    public function store(Request $request)
    {
        $request->validate([
            'menu_id'  => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $menu = Menu::findOrFail($request->menu_id);

        // Simpan order utama
        $order = Order::create([
            'user_id' => auth()->id(),
            'status'  => 'pending',
        ]);

        // Simpan detail pesanan (OrderDetail)
        OrderDetail::create([
            'order_id' => $order->id,
            'menu_id'  => $menu->id,
            'jumlah'   => $request->quantity,
            'harga'    => $menu->harga,
            'subtotal' => $menu->harga * $request->quantity,
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil ditambahkan!');
    }

    // Menampilkan riwayat pesanan pengguna
    public function riwayat()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('details.menu')
            ->latest()
            ->get();

        return view('pelanggan.riwayat', compact('orders'));
    }
}
