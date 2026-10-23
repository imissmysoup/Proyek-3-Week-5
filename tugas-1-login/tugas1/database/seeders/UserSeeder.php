<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        $admin = new User([
            'username' => 'admin',
            'nama_lengkap' => 'Administrator Toko',
            'password' => 'admin123',
        ]);
        // Jika menggunakan proyek toko-online dengan primary key id_user string, tambahkan:
        // $admin->id_user = 'USR-ADMIN'; $admin->email = 'admin@toko.com';
        $admin->role = 'admin';
        $admin->save();

        // 2. Akun Customer (Budi)
        $budi = new User([
            'username' => 'budi',
            'nama_lengkap' => 'Budi Daya',
            'password' => 'rahasia123',
        ]);
        $budi->role = 'customer';
        $budi->save();

        // 3. Akun Staff (Siti)
        $siti = new User([
            'username' => 'siti',
            'nama_lengkap' => 'Siti Staff Gudang',
            'password' => 'rahasia123',
        ]);
        $siti->role = 'staff';
        $siti->save();
    }
}