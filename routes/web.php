<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WelcomeController;
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

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [WelcomeController::class, 'index']);

    Route::middleware(['authorize:ADM'])->group(function () {
        Route::prefix('manage')->group(function () {
            Route::prefix('user')->group(function () {
                Route::get('/', [UserController::class, 'index']);
            });
            Route::prefix('level')->group(function () {
                Route::get('/', [LevelController::class, 'index']);
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

});
// Route::get('/', function () {
//     return view('welcome');
// });
