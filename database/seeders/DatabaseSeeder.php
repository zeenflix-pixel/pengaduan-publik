<?php

namespace Database\Seeders;

use App\Models\{Kategori, User};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin
        User::create([
            'identifier' => 'admin',
            'name'       => 'Administrator',
            'email'      => 'admin@pengaduan.local',
            'password'   => Hash::make('admin123'),
            'role'       => 'admin',
        ]);

        // Kategori pengaduan default
        $kategori = [
            ['id_kategori' => 'INF', 'nama_kategori' => 'Infrastruktur', 'deskripsi' => 'Jalan rusak, jembatan, fasilitas umum'],
            ['id_kategori' => 'PEL', 'nama_kategori' => 'Pelayanan Publik', 'deskripsi' => 'Keluhan layanan pemerintah'],
            ['id_kategori' => 'LIN', 'nama_kategori' => 'Lingkungan', 'deskripsi' => 'Sampah, pencemaran, bencana'],
            ['id_kategori' => 'KES', 'nama_kategori' => 'Kesehatan', 'deskripsi' => 'Fasilitas kesehatan'],
            ['id_kategori' => 'PND', 'nama_kategori' => 'Pendidikan', 'deskripsi' => 'Sekolah dan fasilitas belajar'],
        ];

        foreach ($kategori as $k) {
            Kategori::create($k);
        }
    }
}
