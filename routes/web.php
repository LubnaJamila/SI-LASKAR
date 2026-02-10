<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardPetugasController;
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

// ROUTE ADMIN
Route::get('/dashboard', [DashboardAdminController::class,'index'])->name('dashboard');
Route::get('/hotspot', [DashboardAdminController::class,'hotspot'])->name('hotspot');
Route::get('/petugas', [DashboardAdminController::class,'petugas'])->name('petugas');
Route::get('/team', [DashboardAdminController::class,'team'])->name('team');
Route::get('/team/tambah_team', [DashboardAdminController::class,'tambah_team'])->name('tambah_team');
Route::get('/lsl', [DashboardAdminController::class,'lsl'])->name('lsl');
Route::get('/wps', [DashboardAdminController::class,'wps'])->name('wps');
Route::get('/hasil_kunjungan', [DashboardAdminController::class,'hasil_kunjungan'])->name('hasil_kunjungan');
Route::get('/hasil_kunjungan/detail_hasil_kunjungan', [DashboardAdminController::class,'detail_hasil_kunjungan'])->name('detail_hasil_kunjungan');
Route::get('/periode_kunjungan', [DashboardAdminController::class,'periode_kunjungan'])->name('periode_kunjungan');
Route::get('/rencana_tim', [DashboardAdminController::class,'rencana_tim'])->name('rencana_tim');

//ROUTE PETUGAS
Route::get('/dashboard_petugas', [DashboardPetugasController::class,'index'])->name('dashboard_petugas');

//ROUTE AUTH
Route::get('/login', [AuthController::class,'loginForm'])->name('login');