<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DetailPelatihanSeeder extends Seeder
{
    public function run()
    {
        DB::table('t_detail_pelatihan')->insert([
            [
                'id_user' => 15, // Adjust user IDs based on existing data
                'id_pelatihan' => 1, // Adjust training ID
                'status' => 'Completed',
                'image' => null, // Example image filename
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 16,
                'id_pelatihan' => 2,
                'status' => 'In Progress',
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 17,
                'id_pelatihan' => 3,
                'status' => 'Completed',
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 18,
                'id_pelatihan' => 4,
                'status' => 'Completed',
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 19,
                'id_pelatihan' => 5,
                'status' => 'Pending',
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 20,
                'id_pelatihan' => 6,
                'status' => 'In Progress',
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
