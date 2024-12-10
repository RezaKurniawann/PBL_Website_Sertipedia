<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\BidangMinatController;
use App\Http\Controllers\Api\KompetensiController;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\MataKuliahController;
use App\Http\Controllers\Api\PelatihanController;
use App\Http\Controllers\Api\ProdiController;
use App\Http\Controllers\Api\SertifikasiController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VendorController;  
use App\Http\Controllers\Api\DetailPelatihanController;
use App\Http\Controllers\Api\DetailSertifikasiController;
use App\Http\Controllers\Api\PeriodeController;  
use App\Http\Controllers\Api\StatistikController;
use App\Http\Controllers\Api\ProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', LoginController::class);
Route::post('/logout', LogoutController::class);

//bidangminat
Route::get('bidangminats', [BidangMinatController::class, 'index']);
Route::get('bidangminats/{bidangminat}', [BidangMinatController::class, 'show']);
//kompetensi
Route::get('kompetensis', [KompetensiController::class, 'index']);
Route::get('kompetensis/{kompetensi}', [KompetensiController::class, 'show']);
//level
Route::get('levels', [LevelController::class, 'index']);
Route::get('levels/{level}', [LevelController::class, 'show']);
//matakuliah
Route::get('matakuliahs', [MataKuliahController::class, 'index']);
Route::get('matakuliahs/{matakuliah}', [MataKuliahController::class, 'show']);
//pelatihan
Route::get('pelatihans', [PelatihanController::class, 'index']);
Route::get('pelatihans/{pelatihan}', [PelatihanController::class, 'show']);
//prodi
Route::get('prodis', [ProdiController::class, 'index']);
Route::get('prodis/{prodi}', [ProdiController::class, 'show']);
//sertifikasi
Route::get('sertifikasis', [SertifikasiController::class, 'index']);
Route::get('sertifikasis/{sertifikasi}', [SertifikasiController::class, 'show']);
//user
Route::get('users', [UserController::class, 'index']);
Route::get('users/{user}', [UserController::class, 'show']);
Route::put('users/update/{user}', [UserController::class, 'update']);

Route::get('users/imageProfile/{user}', [ProfileController::class, 'getImageProfile']);
Route::get('users/profile/{user}', [ProfileController::class, 'getDataProfile']);
Route::get('users/bidangminat/{user}', [ProfileController::class, 'getUserBidangMinat']);
Route::get('users/matakuliah/{user}', [ProfileController::class, 'getUserMataKuliah']);
Route::get('users/ownSertifikasi/{user}', [ProfileController::class, 'getOwnSertifikasi']);
Route::get('users/ownPelatihan/{user}', [ProfileController::class, 'getOwnPelatihan']);

//vendor
Route::get('vendors', [VendorController::class, 'index']);
Route::get('vendors/{vendor}', [VendorController::class, 'show']);
//detail pelatihan
Route::get('d_pelatihans', [DetailPelatihanController::class, 'index']);
Route::get('d_pelatihans/{d_pelatihan}', [DetailPelatihanController::class, 'show']);
Route::put('d_pelatihans/update/{d_pelatihan}', [DetailPelatihanController::class, 'update']);

//detail sertifikasi
Route::get('d_sertifikasis', [DetailSertifikasiController::class, 'index']);
Route::get('d_sertifikasis/{d_sertifikasi}', [DetailSertifikasiController::class, 'show']);
Route::put('d_sertifikasis/update/{d_sertifikasi}', [DetailSertifikasiController::class, 'update']);
//periode
Route::get('periode', [PeriodeController::class, 'index']);
Route::get('periode/{periode}', [PeriodeController::class, 'show']);

// statistik
Route::get('statistik', [StatistikController::class, 'index']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

