<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KompetensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dummy data for kompetensi
        $kompetensi = [
            // Kompetensi for Teknik Informatika (id_prodi = 1)
            [
                'id_prodi' => 1, 
                'nama' => 'Pemrograman Dasar',
            ],
            [
                'id_prodi' => 1, 
                'nama' => 'Basis Data',
            ],
            [
                'id_prodi' => 1, 
                'nama' => 'Pengembangan Aplikasi Web',
            ],
            [
                'id_prodi' => 1, 
                'nama' => 'Jaringan Komputer',
            ],
            [
                'id_prodi' => 1, 
                'nama' => 'Keamanan Jaringan',
            ],
            [
                'id_prodi' => 1, 
                'nama' => 'Algoritma dan Struktur Data',
            ],
            [
                'id_prodi' => 1, 
                'nama' => 'Sistem Operasi',
            ],
            [
                'id_prodi' => 1, 
                'nama' => 'Kecerdasan Buatan',
            ],
            [
                'id_prodi' => 1, 
                'nama' => 'Machine Learning',
            ],
            [
                'id_prodi' => 1, 
                'nama' => 'Pengujian Perangkat Lunak',
            ],
            
            // Kompetensi for Sistem Informasi Bisnis (id_prodi = 2)
            [
                'id_prodi' => 2, 
                'nama' => 'Analisis Sistem Informasi',
            ],
            [
                'id_prodi' => 2, 
                'nama' => 'Manajemen Proyek TI',
            ],
            [
                'id_prodi' => 2, 
                'nama' => 'E-Commerce',
            ],
            [
                'id_prodi' => 2, 
                'nama' => 'Sistem Informasi Akuntansi',
            ],
            [
                'id_prodi' => 2, 
                'nama' => 'Keamanan Sistem Informasi',
            ],
            [
                'id_prodi' => 2, 
                'nama' => 'Manajemen Basis Data',
            ],
            [
                'id_prodi' => 2, 
                'nama' => 'Analisis Data Bisnis',
            ],
            [
                'id_prodi' => 2, 
                'nama' => 'Pengembangan Aplikasi Bisnis',
            ],
            [
                'id_prodi' => 2, 
                'nama' => 'Business Intelligence',
            ],
            [
                'id_prodi' => 2, 
                'nama' => 'Sistem Pendukung Keputusan',
            ],
            
            // Kompetensi for Fullstack Development (id_prodi = 3)
            [
                'id_prodi' => 3, 
                'nama' => 'Frontend Development',
            ],
            [
                'id_prodi' => 3, 
                'nama' => 'Backend Development',
            ],
            [
                'id_prodi' => 3, 
                'nama' => 'Pemrograman Mobile',
            ],
            [
                'id_prodi' => 3, 
                'nama' => 'Pengembangan Aplikasi Web',
            ],
            [
                'id_prodi' => 3, 
                'nama' => 'Desain User Interface (UI)',
            ],
            [
                'id_prodi' => 3, 
                'nama' => 'Pengembangan API',
            ]
        ];

        // Insert dummy data into m_kompetensi table
        DB::table('m_kompetensi')->insert($kompetensi);
    }
}

