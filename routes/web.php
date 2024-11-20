<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\SertifikasiController;
use App\Http\Controllers\DetailPelatihanController;
use App\Http\Controllers\DetailSertifikasiController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\BidangMinatController;
use App\Http\Controllers\KompetensiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VerifikasiPelatihanController;
use App\Http\Controllers\VerifikasiSertifikasiController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\JabatanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::pattern('id', '[0-9]+');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);

Route::get('logout', [AuthController::class, 'logout']);

Route::get('/', [LandingPageController::class, 'index']);

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/home', [AdminHomeController::class, 'index']);
        Route::prefix('manage')->group(function () {
            Route::prefix('user')->group(function () {
                Route::get('/', [UserController::class, 'index']);
                Route::get('/create_ajax', [UserController::class, 'create_ajax']);
                Route::post('/ajax', [UserController::class, 'store_ajax']);
                Route::get('/{id}', [UserController::class, 'show']);                
                Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);
                Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);
                Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);
                Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']);
                Route::delete('/{id}', [UserController::class, 'destroy']);
            });
            Route::prefix('level')->group(function () {
                Route::get('/', [LevelController::class, 'index']);
            });
            Route::prefix('pangkat')->group(function () {
                Route::get('/', [PangkatController::class, 'index']);
            });
            Route::prefix('golongan')->group(function () {
                Route::get('/', [GolonganController::class, 'index']);
            });
            Route::prefix('jabatan')->group(function () {
                Route::get('/', [JabatanController::class, 'index']);
            });
            Route::prefix('vendor')->group(function () {
                Route::get('/', [VendorController::class, 'index']);
            });
            Route::prefix('event')->group(function () {
                Route::prefix('pelatihan')->group(function () {
                    Route::get('/', [PelatihanController::class, 'index']);
                });
                Route::prefix('sertifikasi')->group(function () {
                    Route::get('/', [SertifikasiController::class, 'index']);
                });
            });
            Route::prefix('detailevent')->group(function () {
                Route::prefix('pelatihan')->group(function () {
                    Route::get('/', [DetailPelatihanController::class, 'index']);
                });
                Route::prefix('sertifikasi')->group(function () {
                    Route::get('/', [DetailSertifikasiController::class, 'index']);
                });
            });
            Route::prefix('jurusan')->group(function () {
                Route::prefix('matakuliah')->group(function () {
                    Route::get('/', [MataKuliahController::class, 'index']);
                });
                Route::prefix('bidangminat')->group(function () {
                    Route::get('/', [BidangMinatController::class, 'index']);
                });
                Route::prefix('kompetensi')->group(function () {
                    Route::get('/', [KompetensiController::class, 'index']);
                });
            });
        });
});

Route::middleware(['auth:user'])->group(function () {
    Route::get('/user/home', [UserHomeController::class, 'index'])->name('home');
    Route::prefix('/pimpinan')->group(function () {
        Route::prefix('/verifikasi')->group(function () {
            Route::get('/sertifikasi', [VerifikasiSertifikasiController::class, 'index']);
            Route::get('/pelatihan', [VerifikasiPelatihanController::class, 'index']);
        });
    });
});

Route::get('/user/profile', [ProfileController::class, 'index'])->name('profile');

// Route::get('/', function () {
//     return view('welcome');
// });
