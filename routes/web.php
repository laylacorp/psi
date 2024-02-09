<?php

use App\Http\Controllers\BelumDiverifikasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\KategoriJobController;
use App\Http\Controllers\NegaraController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [DashboardController::class, 'index']);
Route::get('/belum_diverifikasi', [BelumDiverifikasiController::class, 'index']);


// Kategori Job
Route::get('/kategori_job', [KategoriJobController::class, 'index']);
Route::resource('kategori_job', KategoriJobController::class);
Route::get('/kategori_job/{id}/edit', [KategoriJobController::class, 'edit']);
Route::put('/kategori_job/{id}', [KategoriJobController::class, 'update']);

// Job
Route::get('/job', [JobController::class, 'index']);
Route::resource('job', JobController::class);
Route::get('/job/{id}/edit', [JobController::class, 'edit']);
Route::put('/job/{id}', [JobController::class, 'update']);
Route::get('/negara/list', [JobController::class, 'getList'])->name('negara.list');
Route::get('/kategori_job/list', [JobController::class, 'getKategoriJobList'])->name('kategori_job.list');
// web.php atau file rute lainnya
Route::get('/getKategoriJob', [JobController::class, 'getKategoriJob'])->name('getKategoriJob');


// Negara
Route::get('/negara', [NegaraController::class, 'index']);
Route::resource('negara', NegaraController::class);
Route::get('/negara/{id}/edit', [NegaraController::class, 'edit']);
Route::put('/negara/{id}', [NegaraController::class, 'update']);
