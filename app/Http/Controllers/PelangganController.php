<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class PelangganController extends Controller
{
    public function index()
    {
        // Ambil menu berdasarkan kategori
        $makanan = Menu::where('kategori', 'makanan')->get();
        $minuman = Menu::where('kategori', 'minuman')->get();

        return view('pelanggan.dashboard', compact('makanan', 'minuman'));
    }

}
