<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_level' => 2, // Pimpinan
                'id_prodi' => 1,
                'nama' => 'Pimpinan TI',
                'username' => 1002,
                'password' => Hash::make('password123'),
                'image' => null,
            ],
            [
                'id_level' => 2, // Pimpinan
                'id_prodi' => 2,
                'nama' => 'Pimpinan SIB',
                'username' => 1003,
                'password' => Hash::make('password123'),
                'image' => null,
            ],
            [
                'id_level' => 2, // Pimpinan
                'id_prodi' => 3,
                'nama' => 'Pimpinan FD',
                'username' => 1004,
                'password' => Hash::make('password123'),
                'image' => null,
            ],

            [
                'id_level' => 3, // Dosen
                'id_prodi' => 1,
                'nama' => 'Dosen 1',
                'username' => 2001,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 1,
                'nama' => 'Dosen 2',
                'username' => 2002,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 2,
                'nama' => 'Dosen 3',
                'username' => 2003,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 2,
                'nama' => 'Dosen 4',
                'username' => 2004,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 3,
                'nama' => 'Dosen 5',
                'username' => 2005,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 3,
                'nama' => 'Dosen 6',
                'username' => 2006,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 1,
                'nama' => 'Dosen 7',
                'username' => 2007,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 2,
                'nama' => 'Dosen 8',
                'username' => 2008,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 3,
                'nama' => 'Dosen 9',
                'username' => 2009,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 1,
                'nama' => 'Dosen 10',
                'username' => 2010,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
        ];

        // Insert dummy data into m_user table
        DB::table('m_user')->insert($data);
    }
}
