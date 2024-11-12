<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        for ($year = 2015; $year <= 2030; $year++) {
            $data[] = [
                'tahun' => $year,
            ];
        }

        DB::table('m_periode')->insert($data);
    }
}
