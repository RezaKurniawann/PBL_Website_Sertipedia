<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserMataKuliahSeeder extends Seeder
{

    public function run(): void
    {
        $data = [
            ['id_user' => 1, 'id_matakuliah' => 1], // Pemrograman Dasar
            ['id_user' => 1, 'id_matakuliah' => 2], // Algoritma dan Pemrograman

            ['id_user' => 2, 'id_matakuliah' => 3], // Struktur Data
            ['id_user' => 2, 'id_matakuliah' => 4], // Basis Data

            ['id_user' => 3, 'id_matakuliah' => 5], // Jaringan Komputer
            ['id_user' => 3, 'id_matakuliah' => 6], // Sistem Operasi

            ['id_user' => 4, 'id_matakuliah' => 7], // Matematika Diskrit
            ['id_user' => 4, 'id_matakuliah' => 8], // Pemrograman Web

            ['id_user' => 5, 'id_matakuliah' => 9], // Keamanan Komputer
            ['id_user' => 5, 'id_matakuliah' => 10], // Rekayasa Perangkat Lunak

            ['id_user' => 6, 'id_matakuliah' => 11], // Sistem Informasi Manajemen
            ['id_user' => 6, 'id_matakuliah' => 12], // Analisis dan Desain Sistem

            ['id_user' => 7, 'id_matakuliah' => 13], // Manajemen Proyek TI
            ['id_user' => 7, 'id_matakuliah' => 14], // Kewirausahaan

            ['id_user' => 8, 'id_matakuliah' => 15], // Pemrograman Aplikasi Mobile
            ['id_user' => 8, 'id_matakuliah' => 16], // Pengembangan Aplikasi Frontend

            ['id_user' => 9, 'id_matakuliah' => 17], // Pengembangan Aplikasi Backend
            ['id_user' => 9, 'id_matakuliah' => 18], // Desain UI/UX

            ['id_user' => 10, 'id_matakuliah' => 1], // Pemrograman Dasar
            ['id_user' => 10, 'id_matakuliah' => 3], // Struktur Data

            ['id_user' => 11, 'id_matakuliah' => 9], // Keamanan Komputer
            ['id_user' => 11, 'id_matakuliah' => 4], // Basis Data

            ['id_user' => 12, 'id_matakuliah' => 6], // Sistem Operasi
            ['id_user' => 12, 'id_matakuliah' => 15], // Pemrograman Aplikasi Mobile

            ['id_user' => 13, 'id_matakuliah' => 10], // Rekayasa Perangkat Lunak
            ['id_user' => 13, 'id_matakuliah' => 19], // Cloud Computing
        ];

        // Insert data into t_user_matakuliah table
        DB::table('t_user_matakuliah')->insert($data);
    }
}
