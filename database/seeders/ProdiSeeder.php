<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_prodi' => 1, 
                'nama' => 'Teknik Informatika'
            ],
            [
                'id_prodi' => 2, 
                'nama' => 'Sistem Informasi Bisnis'
            ],
            [
                'id_prodi' => 3, 
                'nama' => 'Fullstack Development'
            ],
        ];
        DB::table('t_prodi')->insert($data);
    }
}
