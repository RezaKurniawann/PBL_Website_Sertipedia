<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_level' => 1,
                'nama' => 'Admin',
                'username' => '1001',  
                'password' => Hash::make('admin1'),
                'image' => null,
            ],
        ];

        // Insert dummy data into m_user table
        DB::table('admin')->insert($data);
    }
}