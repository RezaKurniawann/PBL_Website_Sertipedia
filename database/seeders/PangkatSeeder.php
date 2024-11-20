<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PangkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pangkats = [
            'Penata Muda',
            'Penata Muda Tk.1',
            'Penata',
            'Penata Tk.1',
            'Pembina',
            'Pembina Tk.1',
            'Pembina Utama',
        ];

        foreach ($pangkats as $pangkat) {
            DB::table('m_pangkat')->insert([
                'nama' => $pangkat,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
