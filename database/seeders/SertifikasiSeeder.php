<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SertifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dummy data for sertifikasi
        $sertifikasi = [
            [
                'id_vendor' => 1, // ID for Vendor
                'id_periode' => 1, // ID for Periode
                'nama' => 'Sertifikasi Java Developer',
                'jenis_sertifikasi' => 'Profesi', // Changed to Profesi
                'tanggal_awal' => '2023-01-15',
                'tanggal_akhir' => '2025-01-15',
                'masa_berlaku' => Carbon::parse('2023-01-15')->diffInMonths(Carbon::parse('2025-01-15')), // Calculates the difference in months
                'biaya' => 1500.00, // Example biaya (cost)
            ],
            [
                'id_vendor' => 4,
                'id_periode' => 2,
                'nama' => 'Sertifikasi Web Development',
                'jenis_sertifikasi' => 'Keahlian', // Changed to Keahlian
                'tanggal_awal' => '2023-02-10',
                'tanggal_akhir' => '2024-02-10',
                'masa_berlaku' => Carbon::parse('2023-02-10')->diffInMonths(Carbon::parse('2024-02-10')),
                'biaya' => 1200.00,
            ],
            [
                'id_vendor' => 6,
                'id_periode' => 3,
                'nama' => 'Sertifikasi Data Science',
                'jenis_sertifikasi' => 'Profesi', // Changed to Profesi
                'tanggal_awal' => '2023-03-05',
                'tanggal_akhir' => '2026-03-05',
                'masa_berlaku' => Carbon::parse('2023-03-05')->diffInMonths(Carbon::parse('2026-03-05')),
                'biaya' => 2000.00,
            ],
            [
                'id_vendor' => 8,
                'id_periode' => 4,
                'nama' => 'Sertifikasi Cloud Computing',
                'jenis_sertifikasi' => 'Keahlian', // Changed to Keahlian
                'tanggal_awal' => '2023-04-20',
                'tanggal_akhir' => '2025-04-20',
                'masa_berlaku' => Carbon::parse('2023-04-20')->diffInMonths(Carbon::parse('2025-04-20')),
                'biaya' => 2500.00,
            ],
            [
                'id_vendor' => 10,
                'id_periode' => 5,
                'nama' => 'Sertifikasi Cybersecurity',
                'jenis_sertifikasi' => 'Keahlian', // Changed to Keahlian
                'tanggal_awal' => '2023-05-25',
                'tanggal_akhir' => '2024-05-25',
                'masa_berlaku' => Carbon::parse('2023-05-25')->diffInMonths(Carbon::parse('2024-05-25')),
                'biaya' => 1800.00,
            ],
            [
                'id_vendor' => 12,
                'id_periode' => 6,
                'nama' => 'Sertifikasi Full Stack Developer',
                'jenis_sertifikasi' => 'Profesi', // Changed to Profesi
                'tanggal_awal' => '2023-06-30',
                'tanggal_akhir' => '2025-06-30',
                'masa_berlaku' => Carbon::parse('2023-06-30')->diffInMonths(Carbon::parse('2025-06-30')),
                'biaya' => 2200.00,
            ],
            [
                'id_vendor' => 14,
                'id_periode' => 7,
                'nama' => 'Sertifikasi AI Expert',
                'jenis_sertifikasi' => 'Profesi', // Changed to Profesi
                'tanggal_awal' => '2023-07-10',
                'tanggal_akhir' => '2026-07-10',
                'masa_berlaku' => Carbon::parse('2023-07-10')->diffInMonths(Carbon::parse('2026-07-10')),
                'biaya' => 3000.00,
            ],
            [
                'id_vendor' => 16,
                'id_periode' => 8,
                'nama' => 'Sertifikasi Big Data',
                'jenis_sertifikasi' => 'Keahlian', // Changed to Keahlian
                'tanggal_awal' => '2023-08-15',
                'tanggal_akhir' => '2026-08-15',
                'masa_berlaku' => Carbon::parse('2023-08-15')->diffInMonths(Carbon::parse('2026-08-15')),
                'biaya' => 2700.00,
            ],
            [
                'id_vendor' => 18,
                'id_periode' => 9,
                'nama' => 'Sertifikasi Mobile Development',
                'jenis_sertifikasi' => 'Keahlian', // Changed to Keahlian
                'tanggal_awal' => '2023-09-20',
                'tanggal_akhir' => '2025-09-20',
                'masa_berlaku' => Carbon::parse('2023-09-20')->diffInMonths(Carbon::parse('2025-09-20')),
                'biaya' => 1600.00,
            ],
            [
                'id_vendor' => 20,
                'id_periode' => 10,
                'nama' => 'Sertifikasi DevOps Engineer',
                'jenis_sertifikasi' => 'Profesi', // Changed to Profesi
                'tanggal_awal' => '2023-10-05',
                'tanggal_akhir' => '2026-10-05',
                'masa_berlaku' => Carbon::parse('2023-10-05')->diffInMonths(Carbon::parse('2026-10-05')),
                'biaya' => 2800.00,
            ],
        ];

        // Insert dummy data into m_sertifikasi table
        DB::table('m_sertifikasi')->insert($sertifikasi);
    }
}



