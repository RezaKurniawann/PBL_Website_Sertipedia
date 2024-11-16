<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserBidangMinatSeeder extends Seeder
{
 
    public function run()
    {
        $data = [
            ['id_user' => 1, 'id_bidangminat' => 1], // Artificial Intelligence
            ['id_user' => 1, 'id_bidangminat' => 5], // Cloud Computing

            ['id_user' => 2, 'id_bidangminat' => 4], // Cybersecurity
            ['id_user' => 2, 'id_bidangminat' => 6], // Internet of Things

            // User 4 (Pimpinan FD)
            ['id_user' => 3, 'id_bidangminat' => 9], // Mobile Development
            ['id_user' => 3, 'id_bidangminat' => 12], // Human-Computer Interaction

            // User 5 (Dosen 1)
            ['id_user' => 4, 'id_bidangminat' => 1], // Artificial Intelligence
            ['id_user' => 4, 'id_bidangminat' => 7], // Blockchain

            // User 6 (Dosen 2)
            ['id_user' => 5, 'id_bidangminat' => 3], // Data Science
            ['id_user' => 5, 'id_bidangminat' => 2], // Machine Learning

            // User 7 (Dosen 3)
            ['id_user' => 6, 'id_bidangminat' => 10], // Game Development
            ['id_user' => 6, 'id_bidangminat' => 13], // Big Data Analytics

            // User 8 (Dosen 4)
            ['id_user' => 7, 'id_bidangminat' => 8], // Software Engineering
            ['id_user' => 7, 'id_bidangminat' => 11], // Web Development

            // User 9 (Dosen 5)
            ['id_user' => 8, 'id_bidangminat' => 18], // Robotics
            ['id_user' => 8, 'id_bidangminat' => 17], // Network Administration

            // User 10 (Dosen 6)
            ['id_user' => 9, 'id_bidangminat' => 14], // Natural Language Processing
            ['id_user' => 9, 'id_bidangminat' => 16], // Digital Marketing

            // User 11 (Dosen 7)
            ['id_user' => 10, 'id_bidangminat' => 15], // Embedded Systems
            ['id_user' => 10, 'id_bidangminat' => 19], // Augmented Reality

            // User 12 (Dosen 8)
            ['id_user' => 11, 'id_bidangminat' => 4], // Cybersecurity
            ['id_user' => 11, 'id_bidangminat' => 6], // Internet of Things

            // User 13 (Dosen 9)
            ['id_user' => 12, 'id_bidangminat' => 2], // Machine Learning
            ['id_user' => 12, 'id_bidangminat' => 3], // Data Science

            // User 14 (Dosen 10)
            ['id_user' => 13, 'id_bidangminat' => 8], // Software Engineering
            ['id_user' => 13, 'id_bidangminat' => 11], // Web Development
        ];

        // Insert data into t_user_bidangminat table
        DB::table('t_user_bidangminat')->insert($data);
    }
}
