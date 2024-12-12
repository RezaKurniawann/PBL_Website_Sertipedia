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
                'nama' => 'Rosa Andrie Asmara, ST., MT., Dr. Eng.',
                'email' => 'rosa.andrie@polinema.ac.id',
                'no_telp' => '081234567001',
                'nip' => "0010108003",
                'password' => Hash::make('Pimpinan123'),
                'image' => null,
            ],
            [
                'id_level' => 3,
                'id_prodi' => 1,
                'id_pangkat' => 2, // Penata Muda Tk. 1
                'id_golongan' => 1, // IIIA
                'id_jabatan' => 1, // Asisten Ahli
                'nama' => 'Ade Ismail, S.Kom., M.TI',
                'email' => 'ade.ismail@polinema.ac.id',
                'no_telp' => '081234567004',
                'nip' => "0404079101",
                'password' => Hash::make('Dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3,
                'id_prodi' => 1,
                'id_pangkat' => 3, // Penata
                'id_golongan' => 2, // IIIB
                'id_jabatan' => 2, // Lektor
                'nama' => 'Agung Nugroho Pramudhita, S.T., M.T.',
                'email' => 'agung.nugroho@polinema.ac.id',
                'no_telp' => '081234567005',
                'nip' => "0010028903",
                'password' => Hash::make('Dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3,
                'id_prodi' => 2,
                'id_pangkat' => 4, // Penata Tk. 1
                'id_golongan' => 3, // IIIC
                'id_jabatan' => 3, // Lektor Kepala
                'nama' => 'Ahmadi Yuli Ananta, ST., M.M.',
                'email' => 'ahmadi.yuli@polinema.ac.id',
                'no_telp' => '081234567006',
                'nip' => "0005078102",
                'password' => Hash::make('Dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3,
                'id_prodi' => 2,
                'id_pangkat' => 5, // Pembina
                'id_golongan' => 4, // IIID
                'id_jabatan' => 4, // Profesor
                'nama' => 'Annisa Puspa Kirana, S.Kom., M.Kom',
                'email' => 'annisa.puspa@polinema.ac.id',
                'no_telp' => '081234567007',
                'nip' => "0023018906",
                'password' => Hash::make('Dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3,
                'id_prodi' => 3,
                'id_pangkat' => 3, // Penata
                'id_golongan' => 2, // IIIB
                'id_jabatan' => 2, // Lektor
                'nama' => 'Annisa Taufika Firdausi, ST., MT.',
                'email' => 'annisa.taufika@polinema.ac.id',
                'no_telp' => '081234567008',
                'nip' => "0014128704",
                'password' => Hash::make('Dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3,
                'id_prodi' => 3,
                'id_pangkat' => 6, // Pembina Tk. 1
                'id_golongan' => 5, // IVA
                'id_jabatan' => 4, // Profesor
                'nama' => 'Anugrah Nur Rahmanto, S.Sn., M.Ds.',
                'email' => 'anugrah.nur@polinema.ac.id',
                'no_telp' => '081234567009',
                'nip' => "0030129101",
                'password' => Hash::make('Dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3,
                'id_prodi' => 1,
                'id_pangkat' => 3, // Penata
                'id_golongan' => 2, // IIIB
                'id_jabatan' => 3, // Lektor Kepala
                'nama' => 'Ariadi Retno Ririd, S.Kom., M.Kom.',
                'email' => 'ariadi.retno@polinema.ac.id',
                'no_telp' => '081234567010',
                'nip' => "0010088101",
                'password' => Hash::make('Dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3,
                'id_prodi' => 2,
                'id_pangkat' => 4, // Penata Tk. 1
                'id_golongan' => 3, // IIIC
                'id_jabatan' => 2, // Lektor
                'nama' => 'Arie Rachmad Syulistyo, S.Kom., M.Kom',
                'email' => 'arie.rachmad@polinema.ac.id',
                'no_telp' => '081234567011',
                'nip' => "0024088701",
                'password' => Hash::make('Dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3,
                'id_prodi' => 3,
                'id_pangkat' => 5, // Pembina
                'id_golongan' => 4, // IIID
                'id_jabatan' => 4, // Profesor
                'nama' => 'Arief Prasetyo, S.Kom., M.Kom.',
                'email' => 'arief.prasetyo@polinema.ac.id',
                'no_telp' => '081234567012',
                'nip' => "0013037905",
                'password' => Hash::make('Dosen123'),
                'image' => null,
            ],
            [
                'id_level' => 3,
                'id_prodi' => 1,
                'id_pangkat' => 6, // Pembina Tk. 1
                'id_golongan' => 5, // IVA
                'id_jabatan' => 3, // Lektor Kepala
                'nama' => 'Astrifidha Rahma Amalia,S.Pd., M.Pd.',
                'email' => 'astrifidha.rahma@polinema.ac.id',
                'no_telp' => '081234567013',
                'nip' => "0021059405",
                'password' => Hash::make('Dosen123'),
                'image' => null,
            ],  
            [
                'id_level' => 3,
                'id_prodi' => 2,
                'id_pangkat' => 5,
                'id_golongan' => 4, 
                'id_jabatan' => 2, 
                'nama' => 'Atiqah Nurul Asri, S.Pd., M.Pd.',
                'email' => 'atiqah.nurul@polinema.ac.id',
                'no_telp' => '081234567011',
                'nip' => "0025067607",
                'password' => Hash::make('Dosen123'),
                'image' => null,
            ], 
            [
                'id_level' => 3,
                'id_prodi' => 2,
                'id_pangkat' => 3,
                'id_golongan' => 4, 
                'id_jabatan' => 1, 
                'nama' => 'Bagas Satya Dian Nugraha, ST., MT.',
                'email' => 'bagas.satya@polinema.ac.id',
                'no_telp' => '081234567012',
                'nip' => "0016069009",
                'password' => Hash::make('Dosen123'),
                'image' => null,
            ],           
        ];
        DB::table('m_user')->insert($data);
    }
}
