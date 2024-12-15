<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\KompetensiController;
use App\Http\Controllers\Api\PelatihanController;
use App\Http\Controllers\Api\ProdiController;
use App\Http\Controllers\Api\SertifikasiController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\DetailPelatihanController;
use App\Http\Controllers\Api\DetailSertifikasiController;
use App\Http\Controllers\api\NotifikasiController;
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

//kompetensi
Route::get('kompetensis', [KompetensiController::class, 'index']);
Route::get('kompetensis/{kompetensi}', [KompetensiController::class, 'show']);

//pelatihan
Route::get('pelatihans', [PelatihanController::class, 'show']);
Route::get('verifikasi/pelatihan', [PelatihanController::class, 'verifikasiPelatihan']);
Route::get('users/pelatihan', [PelatihanController::class, 'showUserPelatihan']);
Route::put('status/pelatihan/{id_pelatihan}', [PelatihanController::class, 'updateStatus']);
Route::put('status/sertifikasi/{id_sertifikasi}', [SertifikasiController::class, 'updateStatus']);
//prodi
Route::get('prodis', [ProdiController::class, 'index']);
Route::get('prodis/{prodi}', [ProdiController::class, 'show']);
//sertifikasi
Route::get('sertifikasis', [SertifikasiController::class, 'index']);
Route::get('verifikasi/sertifikasi', [SertifikasiController::class, 'verifikasiSertifikasi']);
Route::get('users/sertifikasi', [SertifikasiController::class, 'showUserSertifikasi']);
//user
Route::get('users', [UserController::class, 'index']);
Route::get('users/{user}', [UserController::class, 'show']);
Route::put('users/update/{user}', [UserController::class, 'update']);

Route::get('users/pelatihan/{id_pelatihan}', [PelatihanController::class, 'getUserDetailsByPelatihan']);
Route::get('users/sertifikasi/{id_sertikasi}', [SertifikasiController::class, 'getUserDetailsBySertifikasi']);

Route::get('users/imageProfile/{user}', [ProfileController::class, 'getImageProfile']);
Route::get('users/profile/{user}', [ProfileController::class, 'getDataProfile']);
Route::get('users/bidangminat/{user}', [ProfileController::class, 'getUserBidangMinat']);
Route::get('users/matakuliah/{user}', [ProfileController::class, 'getUserMataKuliah']);
Route::get('users/ownSertifikasi/{user}', [ProfileController::class, 'getOwnSertifikasi']);
Route::get('users/ownPelatihan/{user}', [ProfileController::class, 'getOwnPelatihan']);

//detail pelatihan
Route::get('d_pelatihans', [DetailPelatihanController::class, 'index']);
Route::get('d_pelatihans/{d_pelatihan}', [DetailPelatihanController::class, 'show']);
Route::put('d_pelatihans/update/{d_pelatihan}', [DetailPelatihanController::class, 'update']);

//detail sertifikasi
Route::get('d_sertifikasis', [DetailSertifikasiController::class, 'index']);
Route::get('d_sertifikasis/{d_sertifikasi}', [DetailSertifikasiController::class, 'show']);
Route::put('d_sertifikasis/update/{d_sertifikasi}', [DetailSertifikasiController::class, 'update']);


// statistik
Route::get('statistiks', [StatistikController::class, 'index']);
Route::get('sertifikasi_statistiks', [StatistikController::class, 'listSertifikasi']);
Route::get('pelatihan_statistiks', [StatistikController::class, 'listPelatihan']);

Route::get('notifikasi/showPelatihan/{id_user}', [NotifikasiController::class, 'NotifikasiStatusPelatihan']);
Route::get('notifikasi/showSertifikasi/{id_user}', [NotifikasiController::class, 'NotifikasiStatusSertifikasi']);
Route::get('notifikasi/downloadSurat/{fileName}', [NotifikasiController::class, 'downloadFile']);

Route::get('statistik', [StatistikController::class, 'index']);

// notifikasi
Route::get('/notifikasi', [NotifikasiController::class, 'fetchData']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::options('{any}', function () {
    return response()->json(['status' => 'OK'], 200);
})->where('any', '.*');


