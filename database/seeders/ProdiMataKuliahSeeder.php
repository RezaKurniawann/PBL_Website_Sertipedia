<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiMataKuliahSeeder extends Seeder
{
  
    public function run(): void
    {
        // Defining data for Prodi and Matakuliah relationships
        $data = [
            // Matakuliah 1 (e.g., "Pemrograman Dasar")
            ['id_prodi' => 1, 'id_matakuliah' => 1],
            ['id_prodi' => 2, 'id_matakuliah' => 1],
            ['id_prodi' => 3, 'id_matakuliah' => 1],

            // Matakuliah 2 (e.g., "Algoritma dan Struktur Data")
            ['id_prodi' => 1, 'id_matakuliah' => 2],
            ['id_prodi' => 2, 'id_matakuliah' => 2],

            // Matakuliah 3 (e.g., "Basis Data")
            ['id_prodi' => 1, 'id_matakuliah' => 3],
            ['id_prodi' => 2, 'id_matakuliah' => 3],
            ['id_prodi' => 3, 'id_matakuliah' => 3],

            // Matakuliah 4 (e.g., "Rekayasa Perangkat Lunak")
            ['id_prodi' => 1, 'id_matakuliah' => 4],
            ['id_prodi' => 2, 'id_matakuliah' => 4],

            // Matakuliah 5 (e.g., "Jaringan Komputer")
            ['id_prodi' => 1, 'id_matakuliah' => 5],
            ['id_prodi' => 3, 'id_matakuliah' => 5],

            // Matakuliah 6 (e.g., "Sistem Operasi")
            ['id_prodi' => 1, 'id_matakuliah' => 6],
            ['id_prodi' => 2, 'id_matakuliah' => 6],

            // Matakuliah 7 (e.g., "Keamanan Jaringan")
            ['id_prodi' => 2, 'id_matakuliah' => 7],
            ['id_prodi' => 3, 'id_matakuliah' => 7],

            // Matakuliah 8 (e.g., "Pengembangan Aplikasi Mobile")
            ['id_prodi' => 1, 'id_matakuliah' => 8],
            ['id_prodi' => 3, 'id_matakuliah' => 8],

            // Matakuliah 9 (e.g., "Kecerdasan Buatan")
            ['id_prodi' => 1, 'id_matakuliah' => 9],
            ['id_prodi' => 2, 'id_matakuliah' => 9],

            // Matakuliah 10 (e.g., "Rekayasa Perangkat Lunak Lanjut")
            ['id_prodi' => 1, 'id_matakuliah' => 10],
            ['id_prodi' => 2, 'id_matakuliah' => 10],

            // Matakuliah 11 (e.g., "Basis Data Lanjut")
            ['id_prodi' => 1, 'id_matakuliah' => 11],
            ['id_prodi' => 3, 'id_matakuliah' => 11],

            // Matakuliah 12 (e.g., "Desain Interaksi")
            ['id_prodi' => 2, 'id_matakuliah' => 12],
            ['id_prodi' => 3, 'id_matakuliah' => 12],

            // Matakuliah 13 (e.g., "Manajemen Proyek TI")
            ['id_prodi' => 1, 'id_matakuliah' => 13],
            ['id_prodi' => 2, 'id_matakuliah' => 13],

            // Matakuliah 14 (e.g., "Cloud Computing")
            ['id_prodi' => 2, 'id_matakuliah' => 14],
            ['id_prodi' => 3, 'id_matakuliah' => 14],

            // Matakuliah 15 (e.g., "Data Mining")
            ['id_prodi' => 1, 'id_matakuliah' => 15],
            ['id_prodi' => 3, 'id_matakuliah' => 15],

            // Matakuliah 16 (e.g., "Pengolahan Citra Digital")
            ['id_prodi' => 1, 'id_matakuliah' => 16],
            ['id_prodi' => 2, 'id_matakuliah' => 16],

            // Matakuliah 17 (e.g., "Pemrograman Web Lanjut")
            ['id_prodi' => 1, 'id_matakuliah' => 17],
            ['id_prodi' => 2, 'id_matakuliah' => 17],
            ['id_prodi' => 3, 'id_matakuliah' => 17],

            // Matakuliah 18 (e.g., "Teknologi Blockchain")
            ['id_prodi' => 2, 'id_matakuliah' => 18],
            ['id_prodi' => 3, 'id_matakuliah' => 18],

            // Matakuliah 19 (e.g., "Internet of Things")
            ['id_prodi' => 1, 'id_matakuliah' => 19],
            ['id_prodi' => 2, 'id_matakuliah' => 19],

            // Matakuliah 20 (e.g., "Artificial Intelligence")
            ['id_prodi' => 1, 'id_matakuliah' => 20],
            ['id_prodi' => 2, 'id_matakuliah' => 20]
        ];

        // Inserting the data into the 't_prodi_matakuliah' table
        DB::table('t_prodi_matakuliah')->insert($data);
    }
}
