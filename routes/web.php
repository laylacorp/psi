<?php

use App\Http\Controllers\BelumDiverifikasiController;
use App\Http\Controllers\DashboardController;
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


Route::get('/admin', [DashboardController::class, 'index']);
Route::get('/belum_diverifikasi', [BelumDiverifikasiController::class, 'index']);

// Admin Route
require __DIR__ . '/admin.php';

// Frontend Route
require __DIR__ . '/home.php';