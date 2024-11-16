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
        $data = [
            ['id_kompetensi' => 1, 'id_prodi' => 1, 'nama' => 'Pemrograman Web', 'deskripsi' => 'Belajar dasar-dasar HTML, CSS, dan JavaScript.'],
            ['id_kompetensi' => 2, 'id_prodi' => 1, 'nama' => 'Jaringan Komputer', 'deskripsi' => 'Pengantar topologi jaringan dan konfigurasi dasar.'],
            ['id_kompetensi' => 3, 'id_prodi' => 1, 'nama' => 'Keamanan Siber', 'deskripsi' => 'Memahami konsep dasar keamanan informasi.'],
            ['id_kompetensi' => 4, 'id_prodi' => 1, 'nama' => 'Algoritma dan Pemrograman', 'deskripsi' => 'Fokus pada algoritma dan struktur data.'],
            ['id_kompetensi' => 5, 'id_prodi' => 1, 'nama' => 'Pengembangan Mobile', 'deskripsi' => 'Belajar membangun aplikasi mobile dengan framework modern.'],
            
            ['id_kompetensi' => 6, 'id_prodi' => 2, 'nama' => 'Sistem Informasi Bisnis', 'deskripsi' => 'Penerapan sistem informasi dalam proses bisnis.'],
            ['id_kompetensi' => 7, 'id_prodi' => 2, 'nama' => 'Manajemen Proyek TI', 'deskripsi' => 'Mengelola proyek teknologi informasi.'],
            ['id_kompetensi' => 8, 'id_prodi' => 2, 'nama' => 'Sistem ERP', 'deskripsi' => 'Pengantar pada sistem ERP untuk bisnis.'],
            ['id_kompetensi' => 9, 'id_prodi' => 2, 'nama' => 'Analisis Data Bisnis', 'deskripsi' => 'Menggunakan data untuk pengambilan keputusan bisnis.'],
            ['id_kompetensi' => 10, 'id_prodi' => 2, 'nama' => 'E-Commerce', 'deskripsi' => 'Membangun dan mengelola toko online.'],

            ['id_kompetensi' => 11, 'id_prodi' => 3, 'nama' => 'Frontend Development', 'deskripsi' => 'Membuat antarmuka pengguna yang interaktif dan responsif.'],
            ['id_kompetensi' => 12, 'id_prodi' => 3, 'nama' => 'Backend Development', 'deskripsi' => 'Pengembangan server dan API dengan teknologi modern.'],
            ['id_kompetensi' => 13, 'id_prodi' => 3, 'nama' => 'Pengembangan Fullstack', 'deskripsi' => 'Gabungan pengembangan frontend dan backend.'],
            ['id_kompetensi' => 14, 'id_prodi' => 3, 'nama' => 'DevOps', 'deskripsi' => 'Integrasi antara pengembangan dan operasi untuk siklus pengembangan cepat.'],
            ['id_kompetensi' => 15, 'id_prodi' => 3, 'nama' => 'Database Management', 'deskripsi' => 'Penyimpanan dan pengelolaan data dalam aplikasi.'],

            ['id_kompetensi' => 16, 'id_prodi' => 1, 'nama' => 'Pemrograman Python', 'deskripsi' => 'Belajar Python untuk pengembangan perangkat lunak.'],
            ['id_kompetensi' => 17, 'id_prodi' => 2, 'nama' => 'Pengelolaan Rantai Pasok', 'deskripsi' => 'Optimasi rantai pasok dengan teknologi informasi.'],
            ['id_kompetensi' => 18, 'id_prodi' => 3, 'nama' => 'Cloud Computing', 'deskripsi' => 'Mempelajari konsep dan penerapan cloud computing.'],
            ['id_kompetensi' => 19, 'id_prodi' => 1, 'nama' => 'Machine Learning', 'deskripsi' => 'Dasar-dasar pembelajaran mesin dengan Python.'],
            ['id_kompetensi' => 20, 'id_prodi' => 3, 'nama' => 'Pemrograman Node.js', 'deskripsi' => 'Belajar backend dengan JavaScript menggunakan Node.js.'],
        ];

        // Insert dummy data into m_kompetensi table
        DB::table('m_kompetensi')->insert($data);
    }
}

