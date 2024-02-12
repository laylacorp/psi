<?php

use App\Http\Controllers\BelumDiverifikasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\KategoriJobController;
use App\Http\Controllers\NegaraController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SliderController;
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
Route::post('/simpan_job', [JobController::class, 'store'])->name('simpan_job'); 
Route::get('/job/{id}/edit', [JobController::class, 'edit']);
Route::put('/job/{id}', [JobController::class, 'update']);
Route::get('/getNegara', [JobController::class, 'getList'])->name('getNegara');
Route::get('/getKategoriJob', [JobController::class, 'getKategoriJobList'])->name('getKategoriJob');
// web.php atau file rute lainnya
// Route::get('/getKategoriJob', [JobController::class, 'getKategoriJob'])->name('getKategoriJob');


// Negara
Route::get('/negara', [NegaraController::class, 'index']);
Route::resource('negara', NegaraController::class);
Route::get('/negara/{id}/edit', [NegaraController::class, 'edit']);
Route::put('/negara/{id}', [NegaraController::class, 'update']);


// Slider
Route::get('/slider', [SliderController::class, 'index']);
Route::resource('slider', SliderController::class);
Route::get('/slider/{id}/edit', [SliderController::class, 'edit']);
Route::put('/slider/update/{id}', [SliderController::class, 'update'])->name('slider.update');


// Galeri
Route::get('/galeri', [GaleriController::class, 'index']);
Route::resource('galeri', GaleriController::class);
Route::get('/galeri/{id}/edit', [GaleriController::class, 'edit']);
Route::put('/galeri/update/{id}', [GaleriController::class, 'update'])->name('slider.update');


// Review
Route::get('/review', [ReviewController::class, 'index']);
Route::resource('review', ReviewController::class);
Route::get('/review/{id}/edit', [ReviewController::class, 'edit']);
Route::put('/review/{id}', [ReviewController::class, 'update']);


// Faq
Route::get('/faq', [FaqController::class, 'index']);
Route::resource('faq', FaqController::class);
Route::get('/faq/{id}/edit', [FaqController::class, 'edit']);
Route::put('/faq/{id}', [FaqController::class, 'update']);
