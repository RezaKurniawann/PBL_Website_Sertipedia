<?php

namespace Database\Seeders;

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
            // Pimpinan
            [
                'id_level' => 2,
                'id_prodi' => 1,
                'id_pangkat' => 4, // Penata Tk. 1
                'id_golongan' => 3, // IIIC
                'id_jabatan' => 2, // Lektor
                'nama' => 'Pimpinan TI',
                'email' => 'pimpinan_ti@example.com',
                'no_telp' => '081234567001',
                'nip' => 1002,
                'password' => Hash::make('password123'),
                'image' => null,
            ],
            [
                'id_level' => 2,
                'id_prodi' => 2,
                'id_pangkat' => 3, // Penata
                'id_golongan' => 2, // IIIB
                'id_jabatan' => 3, // Lektor Kepala
                'nama' => 'Pimpinan SIB',
                'email' => 'pimpinan_sib@example.com',
                'no_telp' => '081234567002',
                'nip' => 1003,
                'password' => Hash::make('password123'),
                'image' => null,
            ],
            [
                'id_level' => 2,
                'id_prodi' => 3,
                'id_pangkat' => 5, // Pembina
                'id_golongan' => 4, // IIID
                'id_jabatan' => 4, // Profesor
                'nama' => 'Pimpinan FD',
                'email' => 'pimpinan_fd@example.com',
                'no_telp' => '081234567003',
                'nip' => 1004,
                'password' => Hash::make('password123'),
                'image' => null,
            ],

            // Dosen
            [
                'id_level' => 3,
                'id_prodi' => 1,
                'id_pangkat' => 2, // Penata Muda Tk. 1
                'id_golongan' => 1, // IIIA
                'id_jabatan' => 1, // Asisten Ahli
                'nama' => 'Dosen 1',
                'email' => 'dosen1@example.com',
                'no_telp' => '081234567004',
                'nip' => 2001,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3,
                'id_prodi' => 1,
                'id_pangkat' => 3, // Penata
                'id_golongan' => 2, // IIIB
                'id_jabatan' => 2, // Lektor
                'nama' => 'Dosen 2',
                'email' => 'dosen2@example.com',
                'no_telp' => '081234567005',
                'nip' => 2002,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3,
                'id_prodi' => 2,
                'id_pangkat' => 4, // Penata Tk. 1
                'id_golongan' => 3, // IIIC
                'id_jabatan' => 3, // Lektor Kepala
                'nama' => 'Dosen 3',
                'email' => 'dosen3@example.com',
                'no_telp' => '081234567006',
                'nip' => 2003,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3,
                'id_prodi' => 2,
                'id_pangkat' => 5, // Pembina
                'id_golongan' => 4, // IIID
                'id_jabatan' => 4, // Profesor
                'nama' => 'Dosen 4',
                'email' => 'dosen4@example.com',
                'no_telp' => '081234567007',
                'nip' => 2004,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3,
                'id_prodi' => 3,
                'id_pangkat' => 3, // Penata
                'id_golongan' => 2, // IIIB
                'id_jabatan' => 2, // Lektor
                'nama' => 'Dosen 5',
                'email' => 'dosen5@example.com',
                'no_telp' => '081234567008',
                'nip' => 2005,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3,
                'id_prodi' => 3,
                'id_pangkat' => 6, // Pembina Tk. 1
                'id_golongan' => 5, // IVA
                'id_jabatan' => 4, // Profesor
                'nama' => 'Dosen 6',
                'email' => 'dosen6@example.com',
                'no_telp' => '081234567009',
                'nip' => 2006,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3,
                'id_prodi' => 1,
                'id_pangkat' => 3, // Penata
                'id_golongan' => 2, // IIIB
                'id_jabatan' => 3, // Lektor Kepala
                'nama' => 'Dosen 7',
                'email' => 'dosen7@example.com',
                'no_telp' => '081234567010',
                'nip' => 2007,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3,
                'id_prodi' => 2,
                'id_pangkat' => 4, // Penata Tk. 1
                'id_golongan' => 3, // IIIC
                'id_jabatan' => 2, // Lektor
                'nama' => 'Dosen 8',
                'email' => 'dosen8@example.com',
                'no_telp' => '081234567011',
                'nip' => 2008,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3,
                'id_prodi' => 3,
                'id_pangkat' => 5, // Pembina
                'id_golongan' => 4, // IIID
                'id_jabatan' => 4, // Profesor
                'nama' => 'Dosen 9',
                'email' => 'dosen9@example.com',
                'no_telp' => '081234567012',
                'nip' => 2009,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3,
                'id_prodi' => 1,
                'id_pangkat' => 6, // Pembina Tk. 1
                'id_golongan' => 5, // IVA
                'id_jabatan' => 3, // Lektor Kepala
                'nama' => 'Dosen 10',
                'email' => 'dosen10@example.com',
                'no_telp' => '081234567013',
                'nip' => 2010,
                'password' => Hash::make('dosen123'),
                'image' => null,
            ],
        ];

        DB::table('m_user')->insert($data);
    }
}
