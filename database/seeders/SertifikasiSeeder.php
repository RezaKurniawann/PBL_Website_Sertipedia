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
                'id_matakuliah' => 1, // ID for Matakuliah (replace with existing IDs)
                'id_bidangminat' => 1, // ID for Bidang Minat
                'id_vendor' => 1, // ID for Vendor
                'id_periode' => 1, // ID for Periode
                'nama' => 'Sertifikasi Java Developer',
                'no_sertifikasi' => 'JD12345',
                'jenis_sertifikasi' => 'Profesi', // Changed to Profesi
                'tanggal_awal' => '2023-01-15',
                'tanggal_akhir' => '2025-01-15',
                'masa_berlaku' => Carbon::parse('2023-01-15')->diffInMonths(Carbon::parse('2025-01-15')), // Calculates the difference in months
                'biaya' => 1500.00, // Example biaya (cost)
            ],
            [
                'id_matakuliah' => 2,
                'id_bidangminat' => 2,
                'id_vendor' => 4,
                'id_periode' => 2,
                'nama' => 'Sertifikasi Web Development',
                'no_sertifikasi' => 'WD23456',
                'jenis_sertifikasi' => 'Keahlian', // Changed to Keahlian
                'tanggal_awal' => '2023-02-10',
                'tanggal_akhir' => '2024-02-10',
                'masa_berlaku' => Carbon::parse('2023-02-10')->diffInMonths(Carbon::parse('2024-02-10')),
                'biaya' => 1200.00,
            ],
            [
                'id_matakuliah' => 3,
                'id_bidangminat' => 1,
                'id_vendor' => 6,
                'id_periode' => 3,
                'nama' => 'Sertifikasi Data Science',
                'no_sertifikasi' => 'DS34567',
                'jenis_sertifikasi' => 'Profesi', // Changed to Profesi
                'tanggal_awal' => '2023-03-05',
                'tanggal_akhir' => '2026-03-05',
                'masa_berlaku' => Carbon::parse('2023-03-05')->diffInMonths(Carbon::parse('2026-03-05')),
                'biaya' => 2000.00,
            ],
            [
                'id_matakuliah' => 4,
                'id_bidangminat' => 3,
                'id_vendor' => 8,
                'id_periode' => 4,
                'nama' => 'Sertifikasi Cloud Computing',
                'no_sertifikasi' => 'CC45678',
                'jenis_sertifikasi' => 'Keahlian', // Changed to Keahlian
                'tanggal_awal' => '2023-04-20',
                'tanggal_akhir' => '2025-04-20',
                'masa_berlaku' => Carbon::parse('2023-04-20')->diffInMonths(Carbon::parse('2025-04-20')),
                'biaya' => 2500.00,
            ],
            [
                'id_matakuliah' => 5,
                'id_bidangminat' => 2,
                'id_vendor' => 10,
                'id_periode' => 5,
                'nama' => 'Sertifikasi Cybersecurity',
                'no_sertifikasi' => 'CS56789',
                'jenis_sertifikasi' => 'Keahlian', // Changed to Keahlian
                'tanggal_awal' => '2023-05-25',
                'tanggal_akhir' => '2024-05-25',
                'masa_berlaku' => Carbon::parse('2023-05-25')->diffInMonths(Carbon::parse('2024-05-25')),
                'biaya' => 1800.00,
            ],
            [
                'id_matakuliah' => 6,
                'id_bidangminat' => 1,
                'id_vendor' => 12,
                'id_periode' => 6,
                'nama' => 'Sertifikasi Full Stack Developer',
                'no_sertifikasi' => 'FS67890',
                'jenis_sertifikasi' => 'Profesi', // Changed to Profesi
                'tanggal_awal' => '2023-06-30',
                'tanggal_akhir' => '2025-06-30',
                'masa_berlaku' => Carbon::parse('2023-06-30')->diffInMonths(Carbon::parse('2025-06-30')),
                'biaya' => 2200.00,
            ],
            [
                'id_matakuliah' => 7,
                'id_bidangminat' => 3,
                'id_vendor' => 14,
                'id_periode' => 7,
                'nama' => 'Sertifikasi AI Expert',
                'no_sertifikasi' => 'AI78901',
                'jenis_sertifikasi' => 'Profesi', // Changed to Profesi
                'tanggal_awal' => '2023-07-10',
                'tanggal_akhir' => '2026-07-10',
                'masa_berlaku' => Carbon::parse('2023-07-10')->diffInMonths(Carbon::parse('2026-07-10')),
                'biaya' => 3000.00,
            ],
            [
                'id_matakuliah' => 8,
                'id_bidangminat' => 2,
                'id_vendor' => 16,
                'id_periode' => 8,
                'nama' => 'Sertifikasi Big Data',
                'no_sertifikasi' => 'BD89012',
                'jenis_sertifikasi' => 'Keahlian', // Changed to Keahlian
                'tanggal_awal' => '2023-08-15',
                'tanggal_akhir' => '2026-08-15',
                'masa_berlaku' => Carbon::parse('2023-08-15')->diffInMonths(Carbon::parse('2026-08-15')),
                'biaya' => 2700.00,
            ],
            [
                'id_matakuliah' => 9,
                'id_bidangminat' => 1,
                'id_vendor' => 18,
                'id_periode' => 9,
                'nama' => 'Sertifikasi Mobile Development',
                'no_sertifikasi' => 'MD90123',
                'jenis_sertifikasi' => 'Keahlian', // Changed to Keahlian
                'tanggal_awal' => '2023-09-20',
                'tanggal_akhir' => '2025-09-20',
                'masa_berlaku' => Carbon::parse('2023-09-20')->diffInMonths(Carbon::parse('2025-09-20')),
                'biaya' => 1600.00,
            ],
            [
                'id_matakuliah' => 10,
                'id_bidangminat' => 3,
                'id_vendor' => 20,
                'id_periode' => 10,
                'nama' => 'Sertifikasi DevOps Engineer',
                'no_sertifikasi' => 'DE01234',
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



