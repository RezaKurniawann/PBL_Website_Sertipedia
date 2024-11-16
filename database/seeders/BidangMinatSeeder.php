<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidangMinatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Artificial Intelligence'],
            ['nama' => 'Machine Learning'],
            ['nama' => 'Data Science'],
            ['nama' => 'Cybersecurity'],
            ['nama' => 'Cloud Computing'],
            ['nama' => 'Internet of Things'],
            ['nama' => 'Blockchain'],
            ['nama' => 'Software Engineering'],
            ['nama' => 'Mobile Development'],
            ['nama' => 'Web Development'],
            ['nama' => 'Game Development'],
            ['nama' => 'Computer Vision'],
            ['nama' => 'Natural Language Processing'],
            ['nama' => 'Human-Computer Interaction'],
            ['nama' => 'Big Data Analytics'],
            ['nama' => 'Digital Marketing'],
            ['nama' => 'Network Administration'],
            ['nama' => 'Robotics'],
            ['nama' => 'Embedded Systems'],
            ['nama' => 'Augmented Reality'],
        ];
        
        DB::table('m_bidangminat')->insert($data);
    }
}
