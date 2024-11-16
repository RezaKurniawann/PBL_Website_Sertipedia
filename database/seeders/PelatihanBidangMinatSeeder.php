<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelatihanBidangMinatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data pelatihan dan bidang minat yang sesuai
        $data = [
            // Pelatihan 1
            ['id_pelatihan' => 1, 'id_bidangminat' => 1], // Pelatihan Java Programming - Artificial Intelligence
            ['id_pelatihan' => 1, 'id_bidangminat' => 2], // Pelatihan Java Programming - Machine Learning
            
            // Pelatihan 2
            ['id_pelatihan' => 2, 'id_bidangminat' => 9], // Pelatihan Web Development Basics - Web Development
            ['id_pelatihan' => 2, 'id_bidangminat' => 10], // Pelatihan Web Development Basics - Mobile Development
            
            // Pelatihan 3
            ['id_pelatihan' => 3, 'id_bidangminat' => 3], // Pelatihan Data Science Fundamentals - Data Science
            ['id_pelatihan' => 3, 'id_bidangminat' => 5], // Pelatihan Data Science Fundamentals - Cloud Computing
            
            // Pelatihan 4
            ['id_pelatihan' => 4, 'id_bidangminat' => 4], // Pelatihan Cloud Computing Solutions - Cybersecurity
            ['id_pelatihan' => 4, 'id_bidangminat' => 5], // Pelatihan Cloud Computing Solutions - Cloud Computing
            
            // Pelatihan 5
            ['id_pelatihan' => 5, 'id_bidangminat' => 4], // Pelatihan Cybersecurity Basics - Cybersecurity
            ['id_pelatihan' => 5, 'id_bidangminat' => 3], // Pelatihan Cybersecurity Basics - Data Science
            
            // Pelatihan 6
            ['id_pelatihan' => 6, 'id_bidangminat' => 8], // Pelatihan Full Stack Web Development - Software Engineering
            ['id_pelatihan' => 6, 'id_bidangminat' => 9], // Pelatihan Full Stack Web Development - Web Development
            
            // Pelatihan 7
            ['id_pelatihan' => 7, 'id_bidangminat' => 1], // Pelatihan AI and Machine Learning - Artificial Intelligence
            ['id_pelatihan' => 7, 'id_bidangminat' => 2], // Pelatihan AI and Machine Learning - Machine Learning
            
            // Pelatihan 8
            ['id_pelatihan' => 8, 'id_bidangminat' => 3], // Pelatihan Big Data and Analytics - Data Science
            ['id_pelatihan' => 8, 'id_bidangminat' => 5], // Pelatihan Big Data and Analytics - Cloud Computing
            
            // Pelatihan 9
            ['id_pelatihan' => 9, 'id_bidangminat' => 9], // Pelatihan Mobile App Development - Mobile Development
            ['id_pelatihan' => 9, 'id_bidangminat' => 10], // Pelatihan Mobile App Development - Web Development
            
            // Pelatihan 10
            ['id_pelatihan' => 10, 'id_bidangminat' => 8], // Pelatihan DevOps Practices - Software Engineering
            ['id_pelatihan' => 10, 'id_bidangminat' => 5], // Pelatihan DevOps Practices - Cloud Computing
        ];

        // Insert data ke dalam tabel t_pelatihan_bidangminat
        DB::table('t_pelatihan_bidangminat')->insert($data);
    }
}
