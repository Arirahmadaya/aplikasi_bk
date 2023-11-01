<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KonselingController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\WaliKelasController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\GuruBKController;
use Illuminate\Support\Facades\Route;

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
Route::middleware(['guest'])->group(function(){
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login']);

});

Route::get('/home', function (){
    return redirect('/admin');
});

Route::middleware('auth')->group(function () {
    // Rute untuk user yang sudah login
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    Route::middleware('userAkses:operator')->group(function () {
        // Rute untuk operator
        Route::get('/admin/operator', [AdminController::class, 'operator']);
        Route::get('/admin/operator/user', [AdminController::class, 'data_user']);
        Route::get('/admin/operator/kelas', [AdminController::class, 'data_kelas']);
        Route::get('/admin/operator/siswa', [AdminController::class, 'data_siswa']);
        Route::get('/admin/operator/riwayat', [AdminController::class, 'data_riwayat']);
        Route::get('/admin/operator/walikelas', [AdminController::class, 'data_walikelas']);
        Route::get('/admin/operator/operator', [AdminController::class, 'data_operator']);
        Route::get('/admin/operator/gurubk', [AdminController::class, 'data_gurubk']);
        Route::get('/admin/operator/create_kelas', [KelasController::class, 'create_kelas']);
        Route::get('/admin/operator/edit_kelas', [KelasController::class, 'edit']);
        Route::get('/admin/operator/create_siswa', [SiswaController::class, 'create_siswa']);
        Route::get('/admin/operator/edit_siswa', [SiswaController::class, 'edit']);
        Route::get('/admin/operator/create_user', [UserController::class, 'create_user']);
        Route::get('/admin/operator/edit_user', [UserController::class, 'edit']);
        Route::get('/admin/operator/create_walikelas', [WaliKelasController::class, 'create_walikelas']);
        Route::get('/admin/operator/edit_walikelas', [WaliKelasController::class, 'edit']);
        Route::get('/admin/operator/create_operator', [OperatorController::class, 'create_operator']);
        Route::get('/admin/operator/edit_operator', [OperatorController::class, 'edit']);
        Route::get('/admin/operator/create_gurubk', [GuruBKController::class, 'create_gurubk']);
        Route::get('/admin/operator/edit_gurubk', [GuruBKController::class, 'edit']);
        Route::get('/admin/operator/profile', [UserController::class, 'profile']);
    });

    Route::middleware('userAkses:wali_kelas')->group(function () {
        // Rute untuk wali kelas
        Route::get('/admin/wali_kelas', [AdminController::class, 'wali_kelas']);
        Route::get('/admin/wali_kelas/siswa', [AdminController::class, 'data_siswa_wali_kelas']);
        Route::get('/admin/wali_kelas/pelanggaran', [AdminController::class, 'data_pelanggaran_wali_kelas']);
        Route::get('/admin/wali_kelas/riwayat', [AdminController::class, 'data_riwayat_wali_kelas']);
        Route::get('/admin/wali_kelas/create_siswa', [SiswaController::class, 'create_siswa']);
        Route::get('/admin/wali_kelas/edit_siswa', [SiswaController::class, 'edit']);
        Route::get('/admin/wali_kelas/create_pelanggaran', [PelanggaranController::class, 'create_pelanggaran']);
        Route::get('/admin/wali_kelas/edit_pelanggaran', [PelanggaranController::class, 'edit']);
        Route::get('/admin/wali_kelas/profile', [UserController::class, 'profile']);
    });

    Route::middleware('userAkses:guru_bk')->group(function () {
        // Rute untuk guru BK
        Route::get('/admin/guru_bk', [AdminController::class, 'guru_bk']);
        Route::get('/admin/guru_bk/kelas', [AdminController::class, 'data_kelas']);
        Route::get('/admin/guru_bk/siswa', [AdminController::class, 'data_siswa']);
        Route::get('/admin/guru_bk/pelanggaran', [AdminController::class, 'data_pelanggaran_guru_bk']);
        Route::get('/admin/guru_bk/konseling', [AdminController::class, 'data_konseling']);
        Route::get('/admin/guru_bk/riwayat', [AdminController::class, 'data_riwayat']);
        Route::get('/admin/guru_bk/hasil', [AdminController::class, 'data_hasil']);
        Route::get('/admin/guru_bk/create_kelas', [KelasController::class, 'create_kelas']);
        Route::get('/admin/guru_bk/edit_kelas', [KelasController::class, 'edit']);
        Route::get('/admin/guru_bk/create_siswa', [SiswaController::class, 'create_siswa']);
        Route::get('/admin/guru_bk/edit_siswa', [SiswaController::class, 'edit']);
        Route::get('/admin/guru_bk/create_pelanggaran', [PelanggaranController::class, 'create_pelanggaran']);
        Route::get('/admin/guru_bk/edit_pelanggaran', [PelanggaranController::class, 'edit']);
        Route::get('/admin/guru_bk/create_konseling', [KonselingController::class, 'create_konseling']);
        Route::get('/admin/guru_bk/edit_konseling', [KonselingController::class, 'edit']);
        Route::get('/admin/guru_bk/create_riwayat', [RiwayatController::class, 'create_riwayat']);
        Route::get('/admin/guru_bk/edit_riwayat', [RiwayatController::class, 'edit']);
        Route::get('/admin/guru_bk/create_hasil', [HasilController::class, 'create_hasil']);
        Route::get('/admin/guru_bk/cetak_hasil', [HasilController::class, 'cetak_hasil']);
        Route::get('/admin/guru_bk/edit_hasil', [HasilController::class, 'edit']);
        Route::get('/admin/guru_bk/profile', [UserController::class, 'profile']);
    

    });

    Route::middleware('userAkses:siswa')->group(function () {
        // Rute untuk siswa
        Route::get('/admin/siswa', [AdminController::class, 'siswa']);
        Route::get('/admin/siswa/pelanggaran', [AdminController::class, 'data_pelanggaran_siswa']);
        Route::get('/admin/siswa/konseling', [AdminController::class, 'data_konseling_siswa']);
        Route::get('/admin/siswa/profile', [UserController::class, 'profile']);
    });
});

Route::resource('user', UserController::class);
Route::resource('kelas', KelasController::class);
Route::resource('siswa', SiswaController::class);
Route::resource('pelanggaran', PelanggaranController::class);
Route::resource('konseling', KonselingController::class);
Route::resource('riwayat', RiwayatController::class);
Route::resource('hasil', HasilController::class);
Route::resource('walikelas', WaliKelasController::class);
Route::resource('operator', OperatorController::class);
Route::resource('gurubk', GuruBKController::class);




Route::middleware('auth')->group(function () {
    // Rute untuk user yang sudah login
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/logout', [SesiController::class, 'logout']);
});
