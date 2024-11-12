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
            ['kode' => 'BM01', 'nama' => 'Artificial Intelligence'],
            ['kode' => 'BM02', 'nama' => 'Machine Learning'],
            ['kode' => 'BM03', 'nama' => 'Data Science'],
            ['kode' => 'BM04', 'nama' => 'Cybersecurity'],
            ['kode' => 'BM05', 'nama' => 'Cloud Computing'],
            ['kode' => 'BM06', 'nama' => 'Internet of Things'],
            ['kode' => 'BM07', 'nama' => 'Blockchain'],
            ['kode' => 'BM08', 'nama' => 'Software Engineering'],
            ['kode' => 'BM09', 'nama' => 'Mobile Development'],
            ['kode' => 'BM10', 'nama' => 'Web Development'],
            ['kode' => 'BM11', 'nama' => 'Game Development'],
            ['kode' => 'BM12', 'nama' => 'Computer Vision'],
            ['kode' => 'BM13', 'nama' => 'Natural Language Processing'],
            ['kode' => 'BM14', 'nama' => 'Human-Computer Interaction'],
            ['kode' => 'BM15', 'nama' => 'Big Data Analytics'],
            ['kode' => 'BM16', 'nama' => 'Digital Marketing'],
            ['kode' => 'BM17', 'nama' => 'Network Administration'],
            ['kode' => 'BM18', 'nama' => 'Robotics'],
            ['kode' => 'BM19', 'nama' => 'Embedded Systems'],
            ['kode' => 'BM20', 'nama' => 'Augmented Reality'],
        ];

        DB::table('m_bidangminat')->insert($data);
    }
}
