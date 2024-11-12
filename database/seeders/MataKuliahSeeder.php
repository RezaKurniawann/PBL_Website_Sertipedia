<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kode' => 'MK001', 'nama' => 'Algoritma dan Struktur Data'],
            ['kode' => 'MK002', 'nama' => 'Pemrograman Web'],
            ['kode' => 'MK003', 'nama' => 'Basis Data'],
            ['kode' => 'MK004', 'nama' => 'Jaringan Komputer'],
            ['kode' => 'MK005', 'nama' => 'Sistem Operasi'],
            ['kode' => 'MK006', 'nama' => 'Matematika Diskrit'],
            ['kode' => 'MK007', 'nama' => 'Kecerdasan Buatan'],
            ['kode' => 'MK008', 'nama' => 'Pemrograman Berorientasi Objek'],
            ['kode' => 'MK009', 'nama' => 'Pengembangan Aplikasi Mobile'],
            ['kode' => 'MK010', 'nama' => 'Sistem Basis Data Terdistribusi'],
            ['kode' => 'MK011', 'nama' => 'Analisis dan Desain Sistem'],
            ['kode' => 'MK012', 'nama' => 'Manajemen Proyek TI'],
            ['kode' => 'MK013', 'nama' => 'Keamanan Informasi'],
            ['kode' => 'MK014', 'nama' => 'Pengolahan Citra Digital'],
            ['kode' => 'MK015', 'nama' => 'Komputasi Awan'],
            ['kode' => 'MK016', 'nama' => 'Pembelajaran Mesin'],
            ['kode' => 'MK017', 'nama' => 'Desain dan Analisis Algoritma'],
            ['kode' => 'MK018', 'nama' => 'Pengantar Internet of Things'],
            ['kode' => 'MK019', 'nama' => 'Pemrograman Game'],
            ['kode' => 'MK020', 'nama' => 'Sistem Pendukung Keputusan'],
        ];

        DB::table('m_matakuliah')->insert($data);
    }
}
