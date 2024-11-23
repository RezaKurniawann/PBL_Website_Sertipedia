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
use App\Models\KompetensiModel;
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
                    Route::get('/', [MataKuliahController::class, 'index']);
                    Route::post('/list', [MataKuliahController::class, 'list']);
                    Route::get('/create', [MataKuliahController::class, 'create']);
                    Route::post('/', [MataKuliahController::class, 'store']);
                    Route::get('/create_ajax', [MataKuliahController::class, 'create_ajax']);
                    Route::post('/ajax', [MataKuliahController::class, 'store_list']);
                    Route::get('/{id}', [MataKuliahController::class, 'show']);
                    Route::get('/{id}/edit', [MataKuliahController::class, 'edit']);
                    Route::put('/{id}', [MataKuliahController::class, 'update']);
                    Route::get('/{id}/edit_ajax', [MataKuliahController::class, 'edit_ajax']);
                    Route::put('/{id}/update_ajax', [MataKuliahController::class, 'update_ajax']);
                    Route::get('/{id}/delete_ajax', [MataKuliahController::class, 'confirm_ajax']);
                    Route::delete('/{id}/delete_ajax', [MataKuliahController::class, 'delete']);
                    Route::delete('/{id}', [MataKuliahController::class, 'destroy']);
                });
                Route::prefix('bidangminat')->group(function () {
                    Route::get('/', [BidangMinatController::class, 'index']);
                });
                Route::prefix('kompetensi')->group(function () {
                    Route::get('/', [KompetensiController::class, 'index']);
                    Route::post('/list', [KompetensiController::class, 'list']);
                    Route::get('/create', [KompetensiController::class, 'create']);
                    Route::post('/', [KompetensiController::class, 'store']);
                    Route::get('/create_ajax', [KompetensiController::class, 'create_ajax']);
                    Route::post('/ajax', [KompetensiController::class, 'store_list']);
                    Route::get('/{id}', [KompetensiController::class, 'show']);
                    Route::get('/{id}/edit', [KompetensiController::class, 'edit']);
                    Route::put('/{id}', [KompetensiController::class, 'update']);
                    Route::get('/{id}/edit_ajax', [KompetensiController::class, 'edit_ajax']);
                    Route::put('/{id}/update_ajax', [KompetensiController::class, 'update_ajax']);
                    Route::get('/{id}/delete_ajax', [KompetensiController::class, 'confirm_ajax']);
                    Route::delete('/{id}/delete_ajax', [KompetensiController::class, 'delete']);
                    Route::delete('/{id}', [KompetensiController::class, 'destroy']);
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
Route::get('profile', [ProfileController::class, 'index'])->name('profile.show');
Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/kompetensi', [KompetensiController::class, 'index']);
Route::post('/kompetensi/list', [KompetensiController::class, 'list'])->name('kompetensi.list');
Route::get('/kompetensi/{id}/detail_ajax', [KompetensiController::class, 'detail_ajax']);


Route::post('matakuliah/list', [MatakuliahController::class, 'list']);


// Route::get('/', function () {
//     return view('welcome');
// });
