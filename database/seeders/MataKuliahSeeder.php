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
            ['id_prodi' => 1, 'kode' => 'MK001', 'nama' => 'Algoritma dan Struktur Data'],
            ['id_prodi' => 2,'kode' => 'MK002', 'nama' => 'Pemrograman Web'],
            ['id_prodi' => 3,'kode' => 'MK003', 'nama' => 'Basis Data'],
            ['id_prodi' => 1,'kode' => 'MK004', 'nama' => 'Jaringan Komputer'],
            ['id_prodi' => 2,'kode' => 'MK005', 'nama' => 'Sistem Operasi'],
            ['id_prodi' => 3,'kode' => 'MK006', 'nama' => 'Matematika Diskrit'],
            ['id_prodi' => 1,'kode' => 'MK007', 'nama' => 'Kecerdasan Buatan'],
            ['id_prodi' => 2,'kode' => 'MK008', 'nama' => 'Pemrograman Berorientasi Objek'],
            ['id_prodi' => 3,'kode' => 'MK009', 'nama' => 'Pengembangan Aplikasi Mobile'],
            ['id_prodi' => 1,'kode' => 'MK010', 'nama' => 'Sistem Basis Data Terdistribusi'],
            ['id_prodi' => 2,'kode' => 'MK011', 'nama' => 'Analisis dan Desain Sistem'],
            ['id_prodi' => 3,'kode' => 'MK012', 'nama' => 'Manajemen Proyek TI'],
            ['id_prodi' => 1,'kode' => 'MK013', 'nama' => 'Keamanan Informasi'],
            ['id_prodi' => 2,'kode' => 'MK014', 'nama' => 'Pengolahan Citra Digital'],
            ['id_prodi' => 3,'kode' => 'MK015', 'nama' => 'Komputasi Awan'],
            ['id_prodi' => 1,'kode' => 'MK016', 'nama' => 'Pembelajaran Mesin'],
            ['id_prodi' => 2,'kode' => 'MK017', 'nama' => 'Desain dan Analisis Algoritma'],
            ['id_prodi' => 3,'kode' => 'MK018', 'nama' => 'Pengantar Internet of Things'],
            ['id_prodi' => 1,'kode' => 'MK019', 'nama' => 'Pemrograman Game'],
            ['id_prodi' => 2,'kode' => 'MK020', 'nama' => 'Sistem Pendukung Keputusan'],
        ];

        DB::table('m_matakuliah')->insert($data);
    }
}
