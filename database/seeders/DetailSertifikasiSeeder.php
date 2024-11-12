<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DetailSertifikasiSeeder extends Seeder
{
    public function run()
    {
        DB::table('t_detail_sertifikasi')->insert([
            [
                'id_user' => 8, // Adjust as needed to match your user IDs
                'id_sertifikasi' => 1, // Adjust as needed to match your sertifikasi IDs
                'status' => 'Pending',
                'image' => null, // Example file name, adjust as needed
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 9,
                'id_sertifikasi' => 2,
                'status' => 'Approved',
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 10,
                'id_sertifikasi' => 3,
                'status' => 'Rejected',
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 11,
                'id_sertifikasi' => 4,
                'status' => 'Approved',
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 12,
                'id_sertifikasi' => 5,
                'status' => 'Pending',
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 13,
                'id_sertifikasi' => 6,
                'status' => 'Approved',
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 14,
                'id_sertifikasi' => 7,
                'status' => 'Rejected',
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
