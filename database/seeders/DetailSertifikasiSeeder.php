<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DetailSertifikasiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('t_detail_sertifikasi')->insert([
            [
                'id_user' => 2, // Adjust as needed to match your user IDs
                'id_sertifikasi' => 1, // Adjust as needed to match your sertifikasi IDs
                'status' => 'Completed',
                'no_sertifikasi' => null,
                'image' => null, // Example file name, adjust as needed
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 3,
                'id_sertifikasi' => 2,
                'status' => 'Completed',
                'no_sertifikasi' => null,
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 4,
                'id_sertifikasi' => 3,
                'status' => 'Completed',
                'no_sertifikasi' => null,
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 5,
                'id_sertifikasi' => 4,
                'status' => 'Completed',
                'no_sertifikasi' => null,
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
