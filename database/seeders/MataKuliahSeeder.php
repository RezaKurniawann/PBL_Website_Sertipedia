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
            ['nama' => 'Pemrograman Dasar'],
            ['nama' => 'Algoritma dan Pemrograman'],
            ['nama' => 'Struktur Data'],
            ['nama' => 'Basis Data'],
            ['nama' => 'Jaringan Komputer'],
            ['nama' => 'Sistem Operasi'],
            ['nama' => 'Matematika Diskrit'],
            ['nama' => 'Pemrograman Web'],
            ['nama' => 'Keamanan Komputer'],
            ['nama' => 'Rekayasa Perangkat Lunak'],
            ['nama' => 'Sistem Informasi Manajemen'],
            ['nama' => 'Analisis dan Desain Sistem'],
            ['nama' => 'Manajemen Proyek TI'],
            ['nama' => 'Kewirausahaan'],
            ['nama' => 'Pemrograman Aplikasi Mobile'],
            ['nama' => 'Pengembangan Aplikasi Frontend'],
            ['nama' => 'Pengembangan Aplikasi Backend'],
            ['nama' => 'Desain UI/UX'],
            ['nama' => 'Cloud Computing'],
            ['nama' => 'DevOps'],
        ];

        DB::table('m_matakuliah')->insert($data);
    }
}
