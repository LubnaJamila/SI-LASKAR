<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardPetugasController;
use App\Http\Controllers\HasilKunjunganController;
use App\Http\Controllers\HotspotController;
use App\Http\Controllers\HotspotPetugasController;
use App\Http\Controllers\KlasteringController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\RencanaKunjunganController;
use App\Http\Controllers\RencanaTimController;
use App\Http\Controllers\TeamController;
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

Route::get('/', function () {
    return view('landing-page');
});

//ROUTE AUTH
Route::get('/login', [AuthController::class,'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth','admin'])->group(function () {

    Route::get('/dashboard', [DashboardAdminController::class,'index'])->name('admin.dashboard');

    Route::get('/hotspot', [HotspotController::class,'index'])->name('hotspot');
    
    Route::get('/petugas', [PetugasController::class,'index'])->name('petugas');
    Route::post('/petugas/store', [PetugasController::class, 'store'])->name('petugas.store');
    Route::put('/petugas/{id}', [PetugasController::class, 'update'])->name('petugas.update');

    Route::get('/team', [DashboardAdminController::class,'team'])->name('team');
    Route::get('/team/tambah_team', [DashboardAdminController::class,'tambah_team'])->name('tambah_team');
    Route::post('/team/tambah_team/store', [TeamController::class,'store'])->name('tambah_team.store');
    Route::get('/users/{id}/detail', [TeamController::class, 'getUserDetail'])->name('users.detail');
    Route::get('/team/{team}/edit', [TeamController::class,'edit'])->name('team.edit');
    Route::put('/team/{team}', [TeamController::class,'update'])->name('team.update');

    Route::get('/periode_kunjungan', [PeriodeController::class,'index'])->name('periode_kunjungan');
    Route::post('/periode_kunjungan/store', [PeriodeController::class, 'store'])->name('periode.store');
    Route::put('/periode_kunjungan/{id}', [PeriodeController::class, 'update'])->name('periode.update');
    Route::put('/periode_kunjungan/{id}/open',[PeriodeController::class,'open'])->name('periode.open');
    Route::put('/periode_kunjungan/{id}/close',[PeriodeController::class,'close'])->name('periode.close');

    Route::get('/rencana_tim', [RencanaTimController::class,'index'])->name('rencana_tim');

    Route::get('/wps', [KlasteringController::class,'index'])->name('wps');
    Route::post('/wps/run', [KlasteringController::class, 'run'])->name('klastering.run');
    Route::get('/wps/{periode}', [KlasteringController::class, 'show'])->name('klastering.show');

    Route::get('/hasil_kunjungan', [HasilKunjunganController::class,'index'])->name('hasil_kunjungan');
    



});

Route::middleware(['auth','petugas'])->group(function () {

    Route::get('/belum_join_team', [DashboardPetugasController::class, 'belum_join_team'])->name('belum.team');

});

Route::middleware(['auth','petugas','petugas.team'])->group(function () {
    
    Route::get('/petugas/dashboard', [DashboardPetugasController::class,'index'])->name('petugas.dashboard');
    Route::get('/petugas/hotspot', [HotspotPetugasController::class,'index'])->name('petugas.hotspot');
    Route::post('/hotspot/store', [HotspotPetugasController::class, 'store'])->name('hotspot.store');
    Route::get('/rencana_kunjungan',[RencanaKunjunganController::class,'index'])->name('rencana_kunjungan');
    Route::post('/rencana_kunjungan/store',[RencanaKunjunganController::class,'store'])->name('rencana.store');
    Route::get('/rencana_kunjungan/realisasi_kunjungan',[DashboardPetugasController::class,'realisasi_kunjungan'])->name('realisasi_kunjungan');
    Route::get( '/rencana_kunjungan/{rencana}/realisasi', [KunjunganController::class, 'create'])->name('realisasi_kunjungan.create');
    Route::post('/rencana_kunjungan/{rencana}/realisasi', [KunjunganController::class, 'store'])->name('realisasi_kunjungan.store');
    Route::get('/kunjungan_saya', [KunjunganController::class, 'index'])->name('kunjungan_saya');
});

// Route::middleware('auth')->get('/belum_join_team', function () {
//     return view('petugas.belum-join-team.belum-join-team');
// })->name('belum.team');

// Route::get('/geojson/kecamatan', [App\Http\Controllers\GeoJsonController::class, 'kecamatan'])
//     ->name('geojson.kecamatan');

    Route::get('/geojson/kecamatan', [KlasteringController::class, 'geojson'])->name('geojson.kecamatan');

// ROUTE ADMIN
//Route::get('/dashboard', [DashboardAdminController::class,'index'])->name('dashboard');
// Route::get('/hotspot', [DashboardAdminController::class,'hotspot'])->name('hotspot');
// Route::get('/petugas', [DashboardAdminController::class,'petugas'])->name('petugas');
// Route::get('/team', [DashboardAdminController::class,'team'])->name('team');
// Route::get('/team/tambah_team', [DashboardAdminController::class,'tambah_team'])->name('tambah_team');
Route::get('/lsl', [DashboardAdminController::class,'lsl'])->name('lsl');
// Route::get('/wps', [DashboardAdminController::class,'wps'])->name('wps');
// Route::get('/hasil_kunjungan', [DashboardAdminController::class,'hasil_kunjungan'])->name('hasil_kunjungan');
Route::get('/hasil_kunjungan/detail_hasil_kunjungan', [DashboardAdminController::class,'detail_hasil_kunjungan'])->name('detail_hasil_kunjungan');
// Route::get('/periode_kunjungan', [DashboardAdminController::class,'periode_kunjungan'])->name('periode_kunjungan');
// Route::get('/rencana_tim', [DashboardAdminController::class,'rencana_tim'])->name('rencana_tim');

//ROUTE PETUGAS
// Route::get('/dashboard_petugas', [DashboardPetugasController::class,'index'])->name('dashboard_petugas');
// Route::get('/belum_join_team', [DashboardPetugasController::class,'belum_join_team'])->name('belum_join_team');