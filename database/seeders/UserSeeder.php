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
                'id_prodi' => 1, // Teknik Informatika
                'id_matakuliah' => 1, // Example course ID
                'id_bidangminat' => 1, // Example bidangminat ID
                'nama' => 'Pimpinan 1',
                'username' => '1004',  // Unique NIDN as username
                'password' => Hash::make('pimpinanpassword1'),
                'image' => null,
            ],
            [
                'id_level' => 2, // Pimpinan
                'id_prodi' => 2, // Sistem Informasi Bisnis
                'id_matakuliah' => 2, // Example course ID
                'id_bidangminat' => 2, // Example bidangminat ID
                'nama' => 'Pimpinan 2',
                'username' => '1005',  // Unique NIDN as username
                'password' => Hash::make('pimpinanpassword2'),
                'image' => null,
            ],
            [
                'id_level' => 2, // Pimpinan
                'id_prodi' => 3, // Fullstack Development
                'id_matakuliah' => 3, // Example course ID
                'id_bidangminat' => 3, // Example bidangminat ID
                'nama' => 'Pimpinan 3',
                'username' => '1006',  // Unique NIDN as username
                'password' => Hash::make('pimpinanpassword3'),
                'image' => null,
            ],
            [
                'id_level' => 2, // Pimpinan
                'id_prodi' => 1, // Teknik Informatika
                'id_matakuliah' => 1, // Example course ID
                'id_bidangminat' => 4, // Example bidangminat ID
                'nama' => 'Pimpinan 4',
                'username' => '1007',  // Unique NIDN as username
                'password' => Hash::make('pimpinanpassword4'),
                'image' => null,
            ],
            
        
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 1, // Teknik Informatika
                'id_matakuliah' => 1, // Example course ID
                'id_bidangminat' => 5, // Example bidangminat ID
                'nama' => 'Dosen 1',
                'username' => '2001',  // Unique NIDN as username
                'password' => Hash::make('dosenpassword1'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 1, // Teknik Informatika
                'id_matakuliah' => 2, // Example course ID
                'id_bidangminat' => 6, // Example bidangminat ID
                'nama' => 'Dosen 2',
                'username' => '2002',  // Unique NIDN as username
                'password' => Hash::make('dosenpassword2'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 1, // Teknik Informatika
                'id_matakuliah' => 3, // Example course ID
                'id_bidangminat' => 7, // Example bidangminat ID
                'nama' => 'Dosen 3',
                'username' => '2003',  // Unique NIDN as username
                'password' => Hash::make('dosenpassword3'),
                'image' => null,
            ],
            [
                'id_level' => 3, // Dosen
                'id_prodi' => 2, // Sistem Informasi Bisnis
                'id_matakuliah' => 4, // Example course ID
                'id_bidangminat' => 8, // Example bidangminat ID
                'nama' => 'Dosen 4',
                'username' => '2004',  // Unique NIDN as username
                'password' => Hash::make('dosenpassword4'),
                'image' => null,
            ],
            // Continue similarly for other dosen users...
        ];

        // Insert dummy data into m_user table
        DB::table('m_user')->insert($data);
    }
}
