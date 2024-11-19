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
                'email' => 'pimpinan_ti@example.com',
                'no_telp' => '081234567001',
                'username' => 1002,
                'password' => Hash::make('password123'),
                'image' => null,
            ],
            [
                'id_level' => 2, // Pimpinan
                'id_prodi' => 2,
                'nama' => 'Pimpinan SIB',
                'email' => 'pimpinan_sib@example.com',
                'no_telp' => '081234567002',
                'username' => 1003,
                'password' => Hash::make('password123'),
                'image' => null,
            ],
            [
                'id_level' => 2, // Pimpinan
                'id_prodi' => 3,
                'nama' => 'Pimpinan FD',
                'email' => 'pimpinan_fd@example.com',
                'no_telp' => '081234567003',
                'username' => 1004,
                'password' => Hash::make('password123'),
                'image' => null,
            ],

            // Dosen data
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 1,
                'nama' => 'Dosen 1',
                'email' => 'dosen1@example.com',
                'no_telp' => '081234567004',
                'username' => 2001,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 1,
                'nama' => 'Dosen 2',
                'email' => 'dosen2@example.com',
                'no_telp' => '081234567005',
                'username' => 2002,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 2,
                'nama' => 'Dosen 3',
                'email' => 'dosen3@example.com',
                'no_telp' => '081234567006',
                'username' => 2003,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 2,
                'nama' => 'Dosen 4',
                'email' => 'dosen4@example.com',
                'no_telp' => '081234567007',
                'username' => 2004,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 3,
                'nama' => 'Dosen 5',
                'email' => 'dosen5@example.com',
                'no_telp' => '081234567008',
                'username' => 2005,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 3,
                'nama' => 'Dosen 6',
                'email' => 'dosen6@example.com',
                'no_telp' => '081234567009',
                'username' => 2006,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 1,
                'nama' => 'Dosen 7',
                'email' => 'dosen7@example.com',
                'no_telp' => '081234567010',
                'username' => 2007,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 2,
                'nama' => 'Dosen 8',
                'email' => 'dosen8@example.com',
                'no_telp' => '081234567011',
                'username' => 2008,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 3,
                'nama' => 'Dosen 9',
                'email' => 'dosen9@example.com',
                'no_telp' => '081234567012',
                'username' => 2009,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 1,
                'nama' => 'Dosen 10',
                'email' => 'dosen10@example.com',
                'no_telp' => '081234567013',
                'username' => 2010,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
        ];

        // Insert dummy data into m_user table
        DB::table('m_user')->insert($data);
    }
}

