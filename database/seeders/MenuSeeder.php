<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'nama_menu' => 'Cireng',
                'deskripsi' => 'Cireng isi ayam dan bakso. Bumbu: Asin, Pedas, Balado, Chili Oil.',
                'harga' => 2000,
                'gambar' => 'cireng.jpg',
                'kategori' => 'makanan'
            ],
            [
                'nama_menu' => 'Cireng Kuah', 
                'deskripsi' => 'Cireng kuah dengan isian ayam dan bakso. Mulai dari level 0 - 3.', 
                'harga' => 8000, 
                'gambar' => 'cirengkuah.jpg', 
                'kategori' => 'makanan'
            ],
            [
                'nama_menu' => 'Gorengan Mix', 
                'deskripsi' => 'Gorengan Mix (Otak-otak, Basreng, Sosis). Bumbu: Asin, Pedas, Balado.', 
                'harga' => 5000, 
                'gambar' => 'gorengan.jpg' ,
                'kategori' => 'makanan'
            ],
            [
                'nama_menu' => 'Pop Ice + Ice Cream', 
                'deskripsi' => 'Varian rasa pop ice: Coklat, Strawberry, Vanilla Blue, Taro. Varian rasa ice cream: Coklat, Vanilla, Strawberry.', 
                'harga' => 15000, 
                'gambar' => 'PopIceCream.jpg',
                'kategori' => 'minuman' 
            ],
            [
                'nama_menu' => 'Pop Ice', 
                'deskripsi' => 'Varian rasa pop ice: Coklat, Strawberry, Vanilla Blue, Taro.', 
                'harga' => 5000, 
                'gambar' => 'popice.jpg',
                'kategori' => 'minuman'
            ],
            [
                'nama_menu' => 'Kopi Good Day',
                'deskripsi' => 'Kopi instan dengan rasa pilihan (Cold / Hot).',
                'harga' => 7000,
                'gambar' => 'kopi.jpg',
                'kategori' => 'minuman'
            ]
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
