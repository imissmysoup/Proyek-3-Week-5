<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        Barang::insert([
            ['nama' => 'Buku Tulis', 'harga' => 5000, 'stok' => 100],
            ['nama' => 'Pulpen', 'harga' => 3000, 'stok' => 50],
            ['nama' => 'Penggaris', 'harga' => 4000, 'stok' => 30],
            ['nama' => 'Pensil 2B', 'harga' => 2500, 'stok' => 80],
            ['nama' => 'Penghapus', 'harga' => 1500, 'stok' => 40],
        ]);
    }
}