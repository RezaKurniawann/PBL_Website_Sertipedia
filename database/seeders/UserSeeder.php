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
        // Dummy data
        $data = [
            // Admin users (3)
            [
                'id_level' => 1, // Admin
                'id_prodi' => 1, // Teknik Informatika
                'nama' => 'Admin User 1',
                'username' => '1001',  // Unique NIDN as username
                'password' => Hash::make('adminpassword1'),
                'image' => null,
            ],
            [
                'id_level' => 1, // Admin
                'id_prodi' => 2, // Sistem Informasi Bisnis
                'nama' => 'Admin User 2',
                'username' => '1002',  // Unique NIDN as username
                'password' => Hash::make('adminpassword2'),
                'image' => null,
            ],
            [
                'id_level' => 1, // Admin
                'id_prodi' => 3, // Fullstack Development
                'nama' => 'Admin User 3',
                'username' => '1003',  // Unique NIDN as username
                'password' => Hash::make('adminpassword3'),
                'image' => null,
            ],
            
            // Pimpinan users (4)
            [
                'id_level' => 2, // Pimpinan
                'id_prodi' => 1, // Teknik Informatika
                'nama' => 'Pimpinan 1',
                'username' => '1004',  // Unique NIDN as username
                'password' => Hash::make('pimpinanpassword1'),
                'image' => null,
            ],
            [
                'id_level' => 2, // Pimpinan
                'id_prodi' => 2, // Sistem Informasi Bisnis
                'nama' => 'Pimpinan 2',
                'username' => '1005',  // Unique NIDN as username
                'password' => Hash::make('pimpinanpassword2'),
                'image' => null,
            ],
            [
                'id_level' => 2, // Pimpinan
                'id_prodi' => 3, // Fullstack Development
                'nama' => 'Pimpinan 3',
                'username' => '1006',  // Unique NIDN as username
                'password' => Hash::make('pimpinanpassword3'),
                'image' => null,
            ],
            [
                'id_level' => 2, // Pimpinan
                'id_prodi' => 1, // Teknik Informatika
                'nama' => 'Pimpinan 4',
                'username' => '1007',  // Unique NIDN as username
                'password' => Hash::make('pimpinanpassword4'),
                'image' => null,
            ],
            
            // Dosen users (13)
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 1, // Teknik Informatika
                'nama' => 'Dosen 1',
                'username' => '2001',  // Unique NIDN as username
                'password' => Hash::make('dosenpassword1'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 1, // Teknik Informatika
                'nama' => 'Dosen 2',
                'username' => '2002',  // Unique NIDN as username
                'password' => Hash::make('dosenpassword2'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 1, // Teknik Informatika
                'nama' => 'Dosen 3',
                'username' => '2003',  // Unique NIDN as username
                'password' => Hash::make('dosenpassword3'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 2, // Sistem Informasi Bisnis
                'nama' => 'Dosen 4',
                'username' => '2004',  // Unique NIDN as username
                'password' => Hash::make('dosenpassword4'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 2, // Sistem Informasi Bisnis
                'nama' => 'Dosen 5',
                'username' => '2005',  // Unique NIDN as username
                'password' => Hash::make('dosenpassword5'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 2, // Sistem Informasi Bisnis
                'nama' => 'Dosen 6',
                'username' => '2006',  // Unique NIDN as username
                'password' => Hash::make('dosenpassword6'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 3, // Fullstack Development
                'nama' => 'Dosen 7',
                'username' => '2007',  // Unique NIDN as username
                'password' => Hash::make('dosenpassword7'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 3, // Fullstack Development
                'nama' => 'Dosen 8',
                'username' => '2008',  // Unique NIDN as username
                'password' => Hash::make('dosenpassword8'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 3, // Fullstack Development
                'nama' => 'Dosen 9',
                'username' => '2009',  // Unique NIDN as username
                'password' => Hash::make('dosenpassword9'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 1, // Teknik Informatika
                'nama' => 'Dosen 10',
                'username' => '2010',  // Unique NIDN as username
                'password' => Hash::make('dosenpassword10'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 2, // Sistem Informasi Bisnis
                'nama' => 'Dosen 11',
                'username' => '2011',  // Unique NIDN as username
                'password' => Hash::make('dosenpassword11'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 3, // Fullstack Development
                'nama' => 'Dosen 12',
                'username' => '2012',  // Unique NIDN as username
                'password' => Hash::make('dosenpassword12'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 3, // Fullstack Development
                'nama' => 'Dosen 13',
                'username' => '2013',  // Unique NIDN as username
                'password' => Hash::make('dosenpassword13'),
                'image' => null,
            ]
        ];

        // Insert dummy data into m_user table
        DB::table('m_user')->insert($data);
    }
}
