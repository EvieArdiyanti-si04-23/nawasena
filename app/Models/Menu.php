<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika tidak sesuai konvensi Laravel)
    // protected $table = 'menus';

    // Kolom yang boleh diisi secara mass-assignment
    protected $fillable = [
        'nama_menu',
        'deskripsi',
        'harga',
        'gambar',
        'kategori',
        'stok'
    ];
}
