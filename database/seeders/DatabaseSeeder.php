<?php
namespace Database\Seeders;

use App\Models\SertifikasiModel;
use Illuminate\Database\Seeder;

use Database\Seeders\BidangMinatSeeder;
use Database\Seeders\MataKuliahSeeder;
use Database\Seeders\VendorSeeder;
use Database\Seeders\PeriodeSeeder;
use Database\Seeders\LevelSeeder;
use Database\Seeders\ProdiSeeder;
use Database\Seeders\KompetensiSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\SertifikasiSeeder;
use Database\Seeders\PelatihanSeeder;
use Database\Seeders\DetailSertifikasiSeeder;
use Database\Seeders\DetailPelatihanSeeder;
use Database\Seeders\AdminSeeder;



class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Call other seeders here
        $this->call([
            ProdiSeeder::class,
            LevelSeeder::class,
            KompetensiSeeder::class,
            MataKuliahSeeder::class,
            BidangMinatSeeder::class,
            VendorSeeder::class,
            PeriodeSeeder::class,
            UserSeeder::class,
            SertifikasiSeeder::class,
            PelatihanSeeder::class,
            DetailSertifikasiSeeder::class,
            DetailPelatihanSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
