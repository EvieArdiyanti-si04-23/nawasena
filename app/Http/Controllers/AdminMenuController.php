<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'kategori' => 'required',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = $request->only('nama_menu', 'deskripsi', 'harga', 'kategori');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('menu', 'public');
        }

        Menu::create($data);
        return redirect()->route('admin.menu')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menu.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'nama_menu' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'kategori' => 'required',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = $request->only('nama_menu', 'deskripsi', 'harga', 'kategori', 'stok');

        if ($request->hasFile('gambar')) {
            if ($menu->gambar) {
                Storage::disk('public')->delete($menu->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('menu', 'public');
        }

        $menu->update($data);
        return redirect()->route('admin.menu')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        if ($menu->gambar) {
            Storage::disk('public')->delete($menu->gambar);
        }
        $menu->delete();

        return redirect()->route('admin.menu')->with('success', 'Menu berhasil dihapus.');
    }
}
