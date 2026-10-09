<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['id_barang' => 'BRG-001', 'nama_barang' => 'Laptop Asus ROG', 'deskripsi' => 'Laptop gaming kencang.', 'harga' => 15000000, 'stok' => 5],
            ['id_barang' => 'BRG-002', 'nama_barang' => 'Mouse Logitech', 'deskripsi' => 'Mouse wireless mantap.', 'harga' => 150000, 'stok' => 20],
            ['id_barang' => 'BRG-003', 'nama_barang' => 'Keyboard Mechanical', 'deskripsi' => 'Keyboard RGB red switch.', 'harga' => 450000, 'stok' => 15],
            ['id_barang' => 'BRG-004', 'nama_barang' => 'Monitor Samsung 24"', 'deskripsi' => 'Monitor IPS 75Hz.', 'harga' => 1200000, 'stok' => 8],
            ['id_barang' => 'BRG-005', 'nama_barang' => 'Headset HyperX', 'deskripsi' => 'Headset gaming surround.', 'harga' => 750000, 'stok' => 10],
            ['id_barang' => 'BRG-006', 'nama_barang' => 'Flashdisk SanDisk 64GB', 'deskripsi' => 'Flashdisk USB 3.0.', 'harga' => 85000, 'stok' => 0], // Stok 0 untuk tes fitur
            ['id_barang' => 'BRG-007', 'nama_barang' => 'Hardisk Eksternal 1TB', 'deskripsi' => 'Hardisk tahan banting.', 'harga' => 800000, 'stok' => 12],
            ['id_barang' => 'BRG-008', 'nama_barang' => 'Webcam Logitech C920', 'deskripsi' => 'Webcam 1080p.', 'harga' => 950000, 'stok' => 6],
            ['id_barang' => 'BRG-009', 'nama_barang' => 'Mousepad Rexus', 'deskripsi' => 'Mousepad ukuran XL.', 'harga' => 50000, 'stok' => 30],
            ['id_barang' => 'BRG-010', 'nama_barang' => 'Kabel HDMI 2 Meter', 'deskripsi' => 'Kabel HDMI braided.', 'harga' => 35000, 'stok' => 25],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}