<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DetailSertifikasiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
           
        ];
        
        DB::table('t_detail_setifikasi')->insert($data);
    }
}
