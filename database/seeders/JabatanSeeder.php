<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jabatans = [
            'Tenaga Pengajar',
            'Asisten Ahli',
            'Lektor',
            'Lektor Kepala',
            'Guru Besar',
        ];

        foreach ($jabatans as $jabatan) {
            DB::table('m_jabatan')->insert([
                'nama' => $jabatan,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
