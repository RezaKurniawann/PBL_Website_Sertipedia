<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelatihanMataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dummy data for pelatihan_matakuliah, where one pelatihan can involve multiple matakuliah
        $pelatihan_matakuliah = [
            // Pelatihan 1
            [
                'id_pelatihan' => 1, // Pelatihan 'Pelatihan Java Programming'
                'id_matakuliah' => 1, // Mata Kuliah 'Pemrograman Java'
            ],
            [
                'id_pelatihan' => 1, // Pelatihan 'Pelatihan Java Programming'
                'id_matakuliah' => 2, // Mata Kuliah 'Pemrograman Web'
            ],
            [
                'id_pelatihan' => 1, // Pelatihan 'Pelatihan Java Programming'
                'id_matakuliah' => 3, // Mata Kuliah 'Algoritma dan Pemrograman'
            ],

            // Pelatihan 2
            [
                'id_pelatihan' => 2, // Pelatihan 'Pelatihan Web Development Basics'
                'id_matakuliah' => 4, // Mata Kuliah 'Desain Web Responsif'
            ],
            [
                'id_pelatihan' => 2, // Pelatihan 'Pelatihan Web Development Basics'
                'id_matakuliah' => 5, // Mata Kuliah 'Pengembangan Web Frontend'
            ],

            // Pelatihan 3
            [
                'id_pelatihan' => 3, // Pelatihan 'Pelatihan Data Science Fundamentals'
                'id_matakuliah' => 6, // Mata Kuliah 'Dasar-dasar Data Science'
            ],
            [
                'id_pelatihan' => 3, // Pelatihan 'Pelatihan Data Science Fundamentals'
                'id_matakuliah' => 7, // Mata Kuliah 'Statistika untuk Data Science'
            ],

            // Pelatihan 4
            [
                'id_pelatihan' => 4, // Pelatihan 'Pelatihan Cloud Computing'
                'id_matakuliah' => 8, // Mata Kuliah 'Cloud Computing dan Infrastruktur'
            ],

            // Pelatihan 5
            [
                'id_pelatihan' => 5, // Pelatihan 'Pelatihan Machine Learning'
                'id_matakuliah' => 9, // Mata Kuliah 'Machine Learning dan AI'
            ],
            [
                'id_pelatihan' => 5, // Pelatihan 'Pelatihan Machine Learning'
                'id_matakuliah' => 10, // Mata Kuliah 'Algoritma Pembelajaran Mesin'
            ],

            // Pelatihan 6
            [
                'id_pelatihan' => 6, // Pelatihan 'Pelatihan Cybersecurity'
                'id_matakuliah' => 11, // Mata Kuliah 'Keamanan Jaringan'
            ],
            [
                'id_pelatihan' => 6, // Pelatihan 'Pelatihan Cybersecurity'
                'id_matakuliah' => 12, // Mata Kuliah 'Keamanan Sistem Informasi'
            ],

            // Pelatihan 7
            [
                'id_pelatihan' => 7, // Pelatihan 'Pelatihan Big Data'
                'id_matakuliah' => 13, // Mata Kuliah 'Big Data dan Teknologi'
            ],
            [
                'id_pelatihan' => 7, // Pelatihan 'Pelatihan Big Data'
                'id_matakuliah' => 14, // Mata Kuliah 'Pengolahan Data Besar'
            ],

            // Pelatihan 8
            [
                'id_pelatihan' => 8, // Pelatihan 'Pelatihan UI/UX Design'
                'id_matakuliah' => 15, // Mata Kuliah 'Desain Antarmuka Pengguna'
            ],
            [
                'id_pelatihan' => 8, // Pelatihan 'Pelatihan UI/UX Design'
                'id_matakuliah' => 16, // Mata Kuliah 'Pengalaman Pengguna (User Experience)'
            ],

            // Pelatihan 9
            [
                'id_pelatihan' => 9, // Pelatihan 'Pelatihan Teknologi Blockchain'
                'id_matakuliah' => 17, // Mata Kuliah 'Teknologi Blockchain dan Aplikasinya'
            ],
            [
                'id_pelatihan' => 9, // Pelatihan 'Pelatihan Teknologi Blockchain'
                'id_matakuliah' => 18, // Mata Kuliah 'Keamanan dan Kriptografi Blockchain'
            ],

            // Pelatihan 10
            [
                'id_pelatihan' => 10, // Pelatihan 'Pelatihan Internet of Things (IoT)'
                'id_matakuliah' => 19, // Mata Kuliah 'Pengenalan Internet of Things'
            ],
            [
                'id_pelatihan' => 10, // Pelatihan 'Pelatihan Internet of Things (IoT)'
                'id_matakuliah' => 20, // Mata Kuliah 'Aplikasi IoT dalam Dunia Industri'
            ],
        ];

        // Insert dummy data into t_pelatihan_matakuliah table
        DB::table('t_pelatihan_matakuliah')->insert($pelatihan_matakuliah);
    }
}
