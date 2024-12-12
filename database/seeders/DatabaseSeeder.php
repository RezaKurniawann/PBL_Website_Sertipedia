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
use Database\Seeders\PangkatSeeder;
use Database\Seeders\GolonganSeeder;
use Database\Seeders\JabatanSeeder;

use Database\Seeders\KompetensiSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\SertifikasiSeeder;
use Database\Seeders\PelatihanSeeder;
use Database\Seeders\DetailSertifikasiSeeder;
use Database\Seeders\DetailPelatihanSeeder;
use Database\Seeders\AdminSeeder;

use Database\Seeders\UserMataKuliahSeeder;
use Database\Seeders\PelatihanMataKuliahSeeder;
use Database\Seeders\SertifikasiMataKuliahSeeder;
use Database\Seeders\ProdiMataKuliahSeeder;

use Database\Seeders\UserBidangMinatSeeder;
use Database\Seeders\PelatihanBidangMinatSeeder;
use Database\Seeders\SertifikasiBidangMinatSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Call other seeders here
        $this->call([
            MataKuliahSeeder::class,
            BidangMinatSeeder::class,
            VendorSeeder::class,
            PeriodeSeeder::class,
            LevelSeeder::class,
            PangkatSeeder::class,
            GolonganSeeder::class,
            JabatanSeeder::class,
            SertifikasiSeeder::class,
            PelatihanSeeder::class,
            ProdiSeeder::class,
            KompetensiSeeder::class,

            AdminSeeder::class,
            UserSeeder::class,
            
            // DetailSertifikasiSeeder::class,
            // DetailPelatihanSeeder::class,

            UserMataKuliahSeeder::class,
            PelatihanMataKuliahSeeder::class,
            ProdiMataKuliahSeeder::class,
            SertifikasiMataKuliahSeeder::class,

            UserBidangMinatSeeder::class,
            PelatihanBidangMinatSeeder::class,
            SertifikasiBidangMinatSeeder::class,
            
        ]);
    }
}
