<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'PT. Sertifikasi Indonesia',
                'alamat' => 'Jl. Sudirman No.1',
                'kota' => 'Jakarta',
                'telepon' => '02112345678',
                'alamatWeb' => 'https://sertifikasi-indonesia.com',
                'kategori' => 'Sertifikasi'
            ],
            [
                'nama' => 'Pelatihan Teknologi Bandung',
                'alamat' => 'Jl. Dago No.15',
                'kota' => 'Bandung',
                'telepon' => '02287654321',
                'alamatWeb' => 'https://pelatihan-teknologi.com',
                'kategori' => 'Pelatihan'
            ],
            [
                'nama' => 'CV. Pelatihan Informatika',
                'alamat' => 'Jl. Merdeka No.10',
                'kota' => 'Surabaya',
                'telepon' => '0311234567',
                'alamatWeb' => 'https://informatika-pelatihan.com',
                'kategori' => 'Pelatihan'
            ],
            [
                'nama' => 'Global Sertifikasi',
                'alamat' => 'Jl. Thamrin No.3',
                'kota' => 'Jakarta',
                'telepon' => '02198765432',
                'alamatWeb' => 'https://global-sertifikasi.com',
                'kategori' => 'Sertifikasi'
            ],
            [
                'nama' => 'PT. Pelatihan Bisnis',
                'alamat' => 'Jl. Soekarno Hatta No.20',
                'kota' => 'Malang',
                'telepon' => '0341123456',
                'alamatWeb' => 'https://pelatihan-bisnis.com',
                'kategori' => 'Pelatihan'
            ],
            [
                'nama' => 'Sertifikasi Global Asia',
                'alamat' => 'Jl. Asia Afrika No.25',
                'kota' => 'Bandung',
                'telepon' => '0228765432',
                'alamatWeb' => 'https://sertifikasi-global-asia.com',
                'kategori' => 'Sertifikasi'
            ],
            [
                'nama' => 'Pelatihan Digital Indonesia',
                'alamat' => 'Jl. Kartini No.12',
                'kota' => 'Semarang',
                'telepon' => '02411223344',
                'alamatWeb' => 'https://digital-pelatihan.com',
                'kategori' => 'Pelatihan'
            ],
            [
                'nama' => 'CV. Sertifikasi Profesional',
                'alamat' => 'Jl. Gatot Subroto No.5',
                'kota' => 'Medan',
                'telepon' => '0611234567',
                'alamatWeb' => 'https://sertifikasi-profesional.com',
                'kategori' => 'Sertifikasi'
            ],
            [
                'nama' => 'Pelatihan Keterampilan Utama',
                'alamat' => 'Jl. Jendral Sudirman No.6',
                'kota' => 'Yogyakarta',
                'telepon' => '02741234567',
                'alamatWeb' => 'https://pelatihan-keterampilan.com',
                'kategori' => 'Pelatihan'
            ],
            [
                'nama' => 'PT. Sertifikasi Terbaik',
                'alamat' => 'Jl. Mangga Dua No.30',
                'kota' => 'Jakarta',
                'telepon' => '02133445566',
                'alamatWeb' => 'https://sertifikasi-terbaik.com',
                'kategori' => 'Sertifikasi'
            ],
            [
                'nama' => 'Pelatihan Kerja Nasional',
                'alamat' => 'Jl. Diponegoro No.45',
                'kota' => 'Surabaya',
                'telepon' => '03133445566',
                'alamatWeb' => 'https://pelatihan-kerja.com',
                'kategori' => 'Pelatihan'
            ],
            [
                'nama' => 'Sertifikasi Indonesia Maju',
                'alamat' => 'Jl. Medan Merdeka No.12',
                'kota' => 'Jakarta',
                'telepon' => '02166778899',
                'alamatWeb' => 'https://sertifikasi-indonesia-maju.com',
                'kategori' => 'Sertifikasi'
            ],
            [
                'nama' => 'Pelatihan IT Pro',
                'alamat' => 'Jl. Ahmad Yani No.2',
                'kota' => 'Bandung',
                'telepon' => '02255667788',
                'alamatWeb' => 'https://pelatihan-itpro.com',
                'kategori' => 'Pelatihan'
            ],
            [
                'nama' => 'CV. Sertifikasi Teknologi',
                'alamat' => 'Jl. Basuki Rahmat No.14',
                'kota' => 'Malang',
                'telepon' => '03411223344',
                'alamatWeb' => 'https://sertifikasi-teknologi.com',
                'kategori' => 'Sertifikasi'
            ],
            [
                'nama' => 'Pelatihan Softskill Nusantara',
                'alamat' => 'Jl. Pahlawan No.9',
                'kota' => 'Surabaya',
                'telepon' => '03144556677',
                'alamatWeb' => 'https://softskill-pelatihan.com',
                'kategori' => 'Pelatihan'
            ],
            [
                'nama' => 'PT. Sertifikasi Internasional',
                'alamat' => 'Jl. Senopati No.8',
                'kota' => 'Jakarta',
                'telepon' => '02177889900',
                'alamatWeb' => 'https://sertifikasi-internasional.com',
                'kategori' => 'Sertifikasi'
            ],
            [
                'nama' => 'Pelatihan Bisnis Indonesia',
                'alamat' => 'Jl. Rajawali No.18',
                'kota' => 'Semarang',
                'telepon' => '02466778899',
                'alamatWeb' => 'https://pelatihan-bisnis.co.id',
                'kategori' => 'Pelatihan'
            ],
            [
                'nama' => 'Sertifikasi Profesional Nasional',
                'alamat' => 'Jl. Imam Bonjol No.20',
                'kota' => 'Medan',
                'telepon' => '06133445566',
                'alamatWeb' => 'https://sertifikasi-nasional.com',
                'kategori' => 'Sertifikasi'
            ],
            [
                'nama' => 'Pelatihan Kreatif Nasional',
                'alamat' => 'Jl. Merapi No.6',
                'kota' => 'Yogyakarta',
                'telepon' => '02748889900',
                'alamatWeb' => 'https://pelatihan-kreatif.com',
                'kategori' => 'Pelatihan'
            ],
            [
                'nama' => 'CV. Sertifikasi Unggul',
                'alamat' => 'Jl. Nusantara No.50',
                'kota' => 'Bandung',
                'telepon' => '02299887766',
                'alamatWeb' => 'https://sertifikasi-unggul.com',
                'kategori' => 'Sertifikasi'
            ],
        ];

        DB::table('m_vendor')->insert($data);
    }
}
