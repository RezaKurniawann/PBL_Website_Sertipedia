<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PelatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dummy data for pelatihan
        $pelatihan = [
            [
                'id_vendor' => 2, // ID for Vendor
                'id_periode' => 1, // ID for Periode
                'nama' => 'Pelatihan Java Programming',
                'kuota' => 30,
                'lokasi' => 'Jakarta',
                'biaya' => 500000.00,
                'level_pelatihan' => 'Intermediate',
                'tanggal_awal' => '2023-01-10',
                'tanggal_akhir' => '2023-01-20',
                'waktu_pelatihan' => Carbon::parse('2023-01-10')->diffInDays(Carbon::parse('2023-01-20')),
            ],
            [

                'id_vendor' => 3,
                'id_periode' => 2,
                'nama' => 'Pelatihan Web Development Basics',
                'kuota' => 25,
                'lokasi' => 'Surabaya',
                'biaya' => 300000.00,
                'level_pelatihan' => 'Beginner',
                'tanggal_awal' => '2023-02-15',
                'tanggal_akhir' => '2023-02-22',
                'waktu_pelatihan' => Carbon::parse('2023-02-15')->diffInDays(Carbon::parse('2023-02-22')),
            ],
            [

                'id_vendor' => 5,
                'id_periode' => 3,
                'nama' => 'Pelatihan Data Science Fundamentals',
                'kuota' => 20,
                'lokasi' => 'Bandung',
                'biaya' => 600000.00,
                'level_pelatihan' => 'Advanced',
                'tanggal_awal' => '2023-03-10',
                'tanggal_akhir' => '2023-03-15',
                'waktu_pelatihan' => Carbon::parse('2023-03-10')->diffInDays(Carbon::parse('2023-03-15')),
            ],
            [
                'id_vendor' => 7,
                'id_periode' => 4,
                'nama' => 'Pelatihan Cloud Computing Solutions',
                'kuota' => 35,
                'lokasi' => 'Medan',
                'biaya' => 700000.00,
                'level_pelatihan' => 'Expert',
                'tanggal_awal' => '2023-04-05',
                'tanggal_akhir' => '2023-04-12',
                'waktu_pelatihan' => Carbon::parse('2023-04-05')->diffInDays(Carbon::parse('2023-04-12')),
            ],
            [
                'id_vendor' => 9,
                'id_periode' => 5,
                'nama' => 'Pelatihan Cybersecurity Basics',
                'kuota' => 40,
                'lokasi' => 'Yogyakarta',
                'biaya' => 400000.00,
                'level_pelatihan' => 'Intermediate',
                'tanggal_awal' => '2023-05-10',
                'tanggal_akhir' => '2023-05-17',
                'waktu_pelatihan' => Carbon::parse('2023-05-10')->diffInDays(Carbon::parse('2023-05-17')),
            ],
            [

                'id_vendor' => 11,
                'id_periode' => 6,
                'nama' => 'Pelatihan Full Stack Web Development',
                'kuota' => 30,
                'lokasi' => 'Bali',
                'biaya' => 800000.00,
                'level_pelatihan' => 'Advanced',
                'tanggal_awal' => '2023-06-25',
                'tanggal_akhir' => '2023-06-30',
                'waktu_pelatihan' => Carbon::parse('2023-06-25')->diffInDays(Carbon::parse('2023-06-30')),
            ],
            [
                'id_vendor' => 13,
                'id_periode' => 7,
                'nama' => 'Pelatihan AI and Machine Learning',
                'kuota' => 50,
                'lokasi' => 'Solo',
                'biaya' => 1000000.00,
                'level_pelatihan' => 'Expert',
                'tanggal_awal' => '2023-07-15',
                'tanggal_akhir' => '2023-07-20',
                'waktu_pelatihan' => Carbon::parse('2023-07-15')->diffInDays(Carbon::parse('2023-07-20')),
            ],
            [
                'id_vendor' => 15,
                'id_periode' => 8,
                'nama' => 'Pelatihan Big Data and Analytics',
                'kuota' => 40,
                'lokasi' => 'Jakarta',
                'biaya' => 1200000.00,
                'level_pelatihan' => 'Intermediate',
                'tanggal_awal' => '2023-08-10',
                'tanggal_akhir' => '2023-08-15',
                'waktu_pelatihan' => Carbon::parse('2023-08-10')->diffInDays(Carbon::parse('2023-08-15')),
            ],
            [
                'id_vendor' => 17,
                'id_periode' => 9,
                'nama' => 'Pelatihan Mobile App Development',
                'kuota' => 30,
                'lokasi' => 'Surabaya',
                'biaya' => 500000.00,
                'level_pelatihan' => 'Beginner',
                'tanggal_awal' => '2023-09-10',
                'tanggal_akhir' => '2023-09-15',
                'waktu_pelatihan' => Carbon::parse('2023-09-10')->diffInDays(Carbon::parse('2023-09-15')),
            ],
            [
                'id_vendor' => 3,
                'id_periode' => 10,
                'nama' => 'Pelatihan DevOps Practices',
                'kuota' => 45,
                'lokasi' => 'Bandung',
                'biaya' => 950000.00,
                'level_pelatihan' => 'Advanced',
                'tanggal_awal' => '2023-10-01',
                'tanggal_akhir' => '2023-10-05',
                'waktu_pelatihan' => Carbon::parse('2023-10-01')->diffInDays(Carbon::parse('2023-10-05')),
            ],
        ];

        // Insert dummy data into m_pelatihan table
        DB::table('m_pelatihan')->insert($pelatihan);
    }
}
