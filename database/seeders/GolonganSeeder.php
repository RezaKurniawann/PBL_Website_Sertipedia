<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $golongans = [
            'IIIA',
            'IIIB',
            'IIIC',
            'IVA',
            'IVB',
            'IVC',
            'IVD',
            'IVE',
        ];

        foreach ($golongans as $golongan) {
            DB::table('m_golongan')->insert([
                'nama' => $golongan,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
