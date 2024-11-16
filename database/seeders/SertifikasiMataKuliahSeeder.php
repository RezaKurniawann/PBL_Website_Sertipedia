<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SertifikasiMataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        // Data yang menghubungkan sertifikasi dengan mata kuliah
        $sertifikasiMatakuliah = [
            // Sertifikasi Java Developer
            [
                'id_sertifikasi' => 1, // Sertifikasi Java Developer
                'id_matakuliah' => 4,  // Basis Data
            ],
            [
                'id_sertifikasi' => 1, // Sertifikasi Java Developer
                'id_matakuliah' => 7,  // Matematika Diskrit
            ],
            // Sertifikasi Web Development
            [
                'id_sertifikasi' => 2, // Sertifikasi Web Development
                'id_matakuliah' => 8,  // Pemrograman Web
            ],
            [
                'id_sertifikasi' => 2, // Sertifikasi Web Development
                'id_matakuliah' => 5,  // Jaringan Komputer
            ],
            // Sertifikasi Data Science
            [
                'id_sertifikasi' => 3, // Sertifikasi Data Science
                'id_matakuliah' => 3,  // Struktur Data
            ],
            [
                'id_sertifikasi' => 3, // Sertifikasi Data Science
                'id_matakuliah' => 4,  // Basis Data
            ],
            // Sertifikasi Cloud Computing
            [
                'id_sertifikasi' => 4, // Sertifikasi Cloud Computing
                'id_matakuliah' => 5,  // Jaringan Komputer
            ],
            [
                'id_sertifikasi' => 4, // Sertifikasi Cloud Computing
                'id_matakuliah' => 6,  // Sistem Operasi
            ],
            // Sertifikasi Cybersecurity
            [
                'id_sertifikasi' => 5, // Sertifikasi Cybersecurity
                'id_matakuliah' => 5,  // Jaringan Komputer
            ],
            [
                'id_sertifikasi' => 5, // Sertifikasi Cybersecurity
                'id_matakuliah' => 6,  // Sistem Operasi
            ],
            // Sertifikasi Full Stack Developer
            [
                'id_sertifikasi' => 6, // Sertifikasi Full Stack Developer
                'id_matakuliah' => 8,  // Pemrograman Web
            ],
            [
                'id_sertifikasi' => 6, // Sertifikasi Full Stack Developer
                'id_matakuliah' => 7,  // Matematika Diskrit
            ],
            // Sertifikasi AI Expert
            [
                'id_sertifikasi' => 7, // Sertifikasi AI Expert
                'id_matakuliah' => 4,  // Basis Data
            ],
            [
                'id_sertifikasi' => 7, // Sertifikasi AI Expert
                'id_matakuliah' => 3,  // Struktur Data
            ],
            // Sertifikasi Big Data
            [
                'id_sertifikasi' => 8, // Sertifikasi Big Data
                'id_matakuliah' => 4,  // Basis Data
            ],
            [
                'id_sertifikasi' => 8, // Sertifikasi Big Data
                'id_matakuliah' => 6,  // Sistem Operasi
            ],
            // Sertifikasi Mobile Development
            [
                'id_sertifikasi' => 9, // Sertifikasi Mobile Development
                'id_matakuliah' => 8,  // Pemrograman Web
            ],
            [
                'id_sertifikasi' => 9, // Sertifikasi Mobile Development
                'id_matakuliah' => 1,  // Pemrograman Dasar
            ],
            // Sertifikasi DevOps Engineer
            [
                'id_sertifikasi' => 10, // Sertifikasi DevOps Engineer
                'id_matakuliah' => 4,  // Basis Data
            ],
            [
                'id_sertifikasi' => 10, // Sertifikasi DevOps Engineer
                'id_matakuliah' => 6,  // Sistem Operasi
            ],
        ];

        // Insert data ke dalam tabel t_sertifikasi_matakuliah
        DB::table('t_sertifikasi_matakuliah')->insert($sertifikasiMatakuliah);
    }
}
