<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SertifikasiBidangMinatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data sertifikasi dan bidang minat yang berhubungan
        $data = [
            // Sertifikasi 1
            [
                'id_sertifikasi' => 1, // ID Sertifikasi Pelatihan Java Programming
                'id_bidangminat' => 1,  // Artificial Intelligence
            ],
            [
                'id_sertifikasi' => 1,
                'id_bidangminat' => 2,  // Machine Learning
            ],
            [
                'id_sertifikasi' => 2, // ID Sertifikasi Web Development Basics
                'id_bidangminat' => 10, // Web Development
            ],
            [
                'id_sertifikasi' => 3, // ID Sertifikasi Data Science Fundamentals
                'id_bidangminat' => 3,  // Data Science
            ],
            [
                'id_sertifikasi' => 4, // ID Sertifikasi Cloud Computing Solutions
                'id_bidangminat' => 5,  // Cloud Computing
            ],
            [
                'id_sertifikasi' => 5, // ID Sertifikasi Cybersecurity Basics
                'id_bidangminat' => 4,  // Cybersecurity
            ],
            [
                'id_sertifikasi' => 6, // ID Sertifikasi Full Stack Web Development
                'id_bidangminat' => 10, // Web Development
            ],
            [
                'id_sertifikasi' => 7, // ID Sertifikasi AI and Machine Learning
                'id_bidangminat' => 1,  // Artificial Intelligence
            ],
            [
                'id_sertifikasi' => 8, // ID Sertifikasi Big Data and Analytics
                'id_bidangminat' => 3,  // Data Science
            ],
            [
                'id_sertifikasi' => 9, // ID Sertifikasi Mobile App Development
                'id_bidangminat' => 9,  // Mobile Development
            ],
            [
                'id_sertifikasi' => 10, // ID Sertifikasi DevOps Practices
                'id_bidangminat' => 7,  // Software Engineering
            ],
        ];

        // Insert data ke tabel t_sertifikasi_bidangminat
        DB::table('t_sertifikasi_bidangminat')->insert($data);
    }
}
