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
            // Accepted
            [
                'id_user' => 1,
                'id_sertifikasi' => 1,
                'status' => 'Accepted',
                'no_sertifikasi' => null,
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 2,
                'id_sertifikasi' => 2,
                'status' => 'Accepted',
                'no_sertifikasi' => null,
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 3,
                'id_sertifikasi' => 3,
                'status' => 'Accepted',
                'no_sertifikasi' => null,
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 4,
                'id_sertifikasi' => 4,
                'status' => 'Accepted',
                'no_sertifikasi' => null,
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 5,
                'id_sertifikasi' => 5,
                'status' => 'Accepted',
                'no_sertifikasi' => null,
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Requested
            [
                'id_user' => 6,
                'id_sertifikasi' => 6,
                'status' => 'Requested',
                'no_sertifikasi' => null,
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 7,
                'id_sertifikasi' => 7,
                'status' => 'Requested',
                'no_sertifikasi' => null,
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 8,
                'id_sertifikasi' => 8,
                'status' => 'Requested',
                'no_sertifikasi' => null,
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 9,
                'id_sertifikasi' => 9,
                'status' => 'Requested',
                'no_sertifikasi' => null,
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 10,
                'id_sertifikasi' => 10,
                'status' => 'Requested',
                'no_sertifikasi' => null,
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Rejected
            [
                'id_user' => 11,
                'id_sertifikasi' => 5,
                'status' => 'Rejected',
                'no_sertifikasi' => null,
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 12,
                'id_sertifikasi' => 1,
                'status' => 'Rejected',
                'no_sertifikasi' => null,
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 13,
                'id_sertifikasi' => 2,
                'status' => 'Rejected',
                'no_sertifikasi' => null,
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 11,
                'id_sertifikasi' => 3,
                'status' => 'Rejected',
                'no_sertifikasi' => null,
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 1,
                'id_sertifikasi' => 4,
                'status' => 'Rejected',
                'no_sertifikasi' => null,
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // On Going
            [
                'id_user' => 4,
                'id_sertifikasi' => 5,
                'status' => 'On Going',
                'no_sertifikasi' => null,
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 6,
                'id_sertifikasi' => 6,
                'status' => 'On Going',
                'no_sertifikasi' => null,
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 8,
                'id_sertifikasi' => 7,
                'status' => 'On Going',
                'no_sertifikasi' => null,
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 3,
                'id_sertifikasi' => 8,
                'status' => 'On Going',
                'no_sertifikasi' => null,
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 2,
                'id_sertifikasi' => 9,
                'status' => 'On Going',
                'no_sertifikasi' => null,
                'image' => null,
                'surat_tugas' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
