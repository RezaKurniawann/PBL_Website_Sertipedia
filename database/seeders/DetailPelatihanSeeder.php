<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DetailPelatihanSeeder extends Seeder
{
    public function run(): void
    {
        // DB::table('t_detail_pelatihan')->insert([
        //     [
        //         'id_user' => 6, // Adjust user IDs based on existing data
        //         'id_pelatihan' => 1, // Adjust training ID
        //         'status' => 'Completed',
        //         'image' => null, // Example image filename
        //         'surat_tugas' => null,
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ],
        //     [
        //         'id_user' => 7,
        //         'id_pelatihan' => 2,
        //         'status' => 'Completed',
        //         'image' => null,
        //         'surat_tugas' => null,
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ],
        //     [
        //         'id_user' => 8,
        //         'id_pelatihan' => 3,
        //         'status' => 'Completed',
        //         'image' => null,
        //         'surat_tugas' => null,
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ],
        //     [
        //         'id_user' => 9,
        //         'id_pelatihan' => 4,
        //         'status' => 'Completed',
        //         'image' => null,
        //         'surat_tugas' => null,
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ],
        // ]);
    }
}
