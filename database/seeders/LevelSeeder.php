<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'id_level' => 1, 
                'kode' => 'ADM', 
                'nama' => 'Admi'
            ],
            [
                'id_level' => 2, 
                'kode' => 'PMN', 
                'nama' => 'Pimpinan'
            ],
            [
                'id_level' => 3, 
                'kode' => 'DSN', 
                'nama' => 'Dosen'
            ],
        ];
        DB::table('m_level')->insert($data);
    }
}
