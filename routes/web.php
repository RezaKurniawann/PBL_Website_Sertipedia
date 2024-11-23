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
use App\Http\Controllers\PeriodeController;

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
            Route::post('/list', [UserController::class, 'list']);
            Route::get('/create_ajax', [UserController::class, 'create_ajax']);
            Route::post('/ajax', [UserController::class, 'store_ajax']);
            Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']);
            Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']);
            Route::get('/import', [UserController::class, 'import']);
            Route::post('/import_ajax', [UserController::class, 'import_ajax']);
            Route::get('/export_excel', [UserController::class, 'export_excel']);
            Route::get('/export_pdf', [UserController::class, 'export_pdf']);
        });
        Route::prefix('level')->group(function () {
            Route::get('/', [LevelController::class, 'index']);
            Route::post('/list', [LevelController::class, 'list']);
            Route::get('/create_ajax', [LevelController::class, 'create_ajax']);
            Route::post('/ajax', [LevelController::class, 'store_ajax']);
            Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);
            Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']);
            Route::get('/import', [LevelController::class, 'import']);
            Route::post('/import_ajax', [LevelController::class, 'import_ajax']);
            Route::get('/export_excel', [LevelController::class, 'export_excel']);
            Route::get('/export_pdf', [LevelController::class, 'export_pdf']);
        });
        Route::prefix('pangkat')->group(function () {
            Route::get('/', [PangkatController::class, 'index']);
            Route::post('/list', [PangkatController::class, 'list']);
            Route::get('/create_ajax', [PangkatController::class, 'create_ajax']);
            Route::post('/ajax', [PangkatController::class, 'store_ajax']);
            Route::get('/{id}/edit_ajax', [PangkatController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [PangkatController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [PangkatController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [PangkatController::class, 'delete_ajax']);
            Route::get('/{id}/show_ajax', [PangkatController::class, 'show_ajax']);
            Route::get('/import', [PangkatController::class, 'import']);
            Route::post('/import_ajax', [PangkatController::class, 'import_ajax']);
            Route::get('/export_excel', [PangkatController::class, 'export_excel']);
            Route::get('/export_pdf', [PangkatController::class, 'export_pdf']);
        });
        Route::prefix('golongan')->group(function () {
            Route::get('/', [GolonganController::class, 'index']);
            Route::post('/list', [GolonganController::class, 'list']);
            Route::get('/create_ajax', [GolonganController::class, 'create_ajax']);
            Route::post('/ajax', [GolonganController::class, 'store_ajax']);
            Route::get('/{id}/edit_ajax', [GolonganController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [GolonganController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [GolonganController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [GolonganController::class, 'delete_ajax']);
            Route::get('/{id}/show_ajax', [GolonganController::class, 'show_ajax']);
            Route::get('/import', [GolonganController::class, 'import']);
            Route::post('/import_ajax', [GolonganController::class, 'import_ajax']);
            Route::get('/export_excel', [GolonganController::class, 'export_excel']);
            Route::get('/export_pdf', [GolonganController::class, 'export_pdf']);
        });
        Route::prefix('jabatan')->group(function () {
            Route::get('/', [JabatanController::class, 'index']);
            Route::post('/list', [JabatanController::class, 'list']);
            Route::get('/create_ajax', [JabatanController::class, 'create_ajax']);
            Route::post('/ajax', [JabatanController::class, 'store_ajax']);
            Route::get('/{id}/edit_ajax', [JabatanController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [JabatanController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [JabatanController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [JabatanController::class, 'delete_ajax']);
            Route::get('/{id}/show_ajax', [JabatanController::class, 'show_ajax']);
            Route::get('/import', [JabatanController::class, 'import']);
            Route::post('/import_ajax', [JabatanController::class, 'import_ajax']);
            Route::get('/export_excel', [JabatanController::class, 'export_excel']);
            Route::get('/export_pdf', [JabatanController::class, 'export_pdf']);
        });
        Route::prefix('vendor')->group(function () {
            Route::get('/', [VendorController::class, 'index']);
            Route::post('/list', [VendorController::class, 'list']);
            Route::get('/create_ajax', [VendorController::class, 'create_ajax']);
            Route::post('/ajax', [VendorController::class, 'store_ajax']);
            Route::get('/{id}/edit_ajax', [VendorController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [VendorController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [VendorController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [VendorController::class, 'delete_ajax']);
            Route::get('/{id}/show_ajax', [VendorController::class, 'show_ajax']);
            Route::get('/import', [VendorController::class, 'import']);
            Route::post('/import_ajax', [VendorController::class, 'import_ajax']);
            Route::get('/export_excel', [VendorController::class, 'export_excel']);
            Route::get('/export_pdf', [VendorController::class, 'export_pdf']);
        });
        Route::prefix('periode')->group(function () {
            Route::get('/', [PeriodeController::class, 'index']);
            Route::post('/list', [PeriodeController::class, 'list']);
            Route::get('/create_ajax', [PeriodeController::class, 'create_ajax']);
            Route::post('/ajax', [PeriodeController::class, 'store_ajax']);
            Route::get('/{id}/edit_ajax', [PeriodeController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [PeriodeController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [PeriodeController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [PeriodeController::class, 'delete_ajax']);
            Route::get('/{id}/show_ajax', [PeriodeController::class, 'show_ajax']);
            Route::get('/import', [PeriodeController::class, 'import']);
            Route::post('/import_ajax', [PeriodeController::class, 'import_ajax']);
            Route::get('/export_excel', [PeriodeController::class, 'export_excel']);
            Route::get('/export_pdf', [PeriodeController::class, 'export_pdf']);
        });
        Route::prefix('event')->group(function () {
            Route::prefix('pelatihan')->group(function () {
                Route::get('/', [PelatihanController::class, 'index']);
                Route::post('/list', [PelatihanController::class, 'list']);
                Route::get('/create_ajax', [PelatihanController::class, 'create_ajax']);
                Route::post('/ajax', [PelatihanController::class, 'store_ajax']);
                Route::get('/{id}/edit_ajax', [PelatihanController::class, 'edit_ajax']);
                Route::put('/{id}/update_ajax', [PelatihanController::class, 'update_ajax']);
                Route::get('/{id}/delete_ajax', [PelatihanController::class, 'confirm_ajax']);
                Route::delete('/{id}/delete_ajax', [PelatihanController::class, 'delete_ajax']);
                Route::get('/{id}/show_ajax', [PelatihanController::class, 'show_ajax']);
                Route::post('/import_ajax', [PelatihanController::class, 'import_ajax']);
                Route::get('/export_excel', [PelatihanController::class, 'export_excel']);
                Route::get('/export_pdf', [PelatihanController::class, 'export_pdf']);
            });
            Route::prefix('sertifikasi')->group(function () {
                Route::get('/', [SertifikasiController::class, 'index']);
                Route::post('/list', [SertifikasiController::class, 'list']);
                Route::get('/create_ajax', [SertifikasiController::class, 'create_ajax']);
                Route::post('/ajax', [SertifikasiController::class, 'store_ajax']);
                Route::get('/{id}/edit_ajax', [SertifikasiController::class, 'edit_ajax']);
                Route::put('/{id}/update_ajax', [SertifikasiController::class, 'update_ajax']);
                Route::get('/{id}/delete_ajax', [SertifikasiController::class, 'confirm_ajax']);
                Route::delete('/{id}/delete_ajax', [SertifikasiController::class, 'delete_ajax']);
                Route::get('/{id}/show_ajax', [SertifikasiController::class, 'show_ajax']);
                Route::post('/import_ajax', [SertifikasiController::class, 'import_ajax']);
                Route::get('/export_excel', [SertifikasiController::class, 'export_excel']);
                Route::get('/export_pdf', [SertifikasiController::class, 'export_pdf']);
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
                Route::post('/list', [MataKuliahController::class, 'list']);
                Route::get('/create_ajax', [MataKuliahController::class, 'create_ajax']);
                Route::post('/ajax', [MataKuliahController::class, 'store_ajax']);
                Route::get('/{id}/edit_ajax', [MataKuliahController::class, 'edit_ajax']);
                Route::put('/{id}/update_ajax', [MataKuliahController::class, 'update_ajax']);
                Route::get('/{id}/delete_ajax', [MataKuliahController::class, 'confirm_ajax']);
                Route::delete('/{id}/delete_ajax', [MataKuliahController::class, 'delete_ajax']);
                Route::get('/{id}/show_ajax', [MataKuliahController::class, 'show_ajax']);
                Route::get('/import', [MataKuliahController::class, 'import']);
                Route::post('/import_ajax', [MataKuliahController::class, 'import_ajax']);
                Route::get('/export_excel', [MataKuliahController::class, 'export_excel']);
                Route::get('/export_pdf', [MataKuliahController::class, 'export_pdf']);
            });
            Route::prefix('bidangminat')->group(function () {
                Route::get('/', [BidangMinatController::class, 'index']);
                Route::post('/list', [BidangMinatController::class, 'list']);
                Route::get('/create_ajax', [BidangMinatController::class, 'create_ajax']);
                Route::post('/ajax', [BidangMinatController::class, 'store_ajax']);
                Route::get('/{id}/edit_ajax', [BidangMinatController::class, 'edit_ajax']);
                Route::put('/{id}/update_ajax', [BidangMinatController::class, 'update_ajax']);
                Route::get('/{id}/delete_ajax', [BidangMinatController::class, 'confirm_ajax']);
                Route::delete('/{id}/delete_ajax', [BidangMinatController::class, 'delete_ajax']);
                Route::get('/{id}/show_ajax', [BidangMinatController::class, 'show_ajax']);
                Route::get('/import', [BidangMinatController::class, 'import']);
                Route::post('/import_ajax', [BidangMinatController::class, 'import_ajax']);
                Route::get('/export_excel', [BidangMinatController::class, 'export_excel']);
                Route::get('/export_pdf', [BidangMinatController::class, 'export_pdf']);
            });
            Route::prefix('kompetensi')->group(function () {
                Route::get('/', [KompetensiController::class, 'index']);
                Route::post('/list', [KompetensiController::class, 'list']);
                Route::get('/create_ajax', [KompetensiController::class, 'create_ajax']);
                Route::post('/ajax', [KompetensiController::class, 'store_ajax']);
                Route::get('/{id}/edit_ajax', [KompetensiController::class, 'edit_ajax']);
                Route::put('/{id}/update_ajax', [KompetensiController::class, 'update_ajax']);
                Route::get('/{id}/delete_ajax', [KompetensiController::class, 'confirm_ajax']);
                Route::delete('/{id}/delete_ajax', [KompetensiController::class, 'delete_ajax']);
                Route::get('/{id}/show_ajax', [KompetensiController::class, 'show_ajax']);
                Route::get('/import', [KompetensiController::class, 'import']);
                Route::post('/import_ajax', [KompetensiController::class, 'import_ajax']);
                Route::get('/export_excel', [KompetensiController::class, 'export_excel']);
                Route::get('/export_pdf', [KompetensiController::class, 'export_pdf']);
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
