<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RumahSakitController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rumah Sakit
Route::get('/rumah-sakit', [RumahSakitController::class, 'index'])->name('rumah_sakit.index');
Route::post('/rumah-sakit/store', [RumahSakitController::class, 'store'])->name('rumah_sakit.store');
Route::put('/rumah-sakit/update/{id}', [RumahSakitController::class, 'update'])->name('rumah_sakit.update');
Route::get('/rumah-sakit/search', [RumahSakitController::class, 'search']);
Route::get('/rumah-sakit/form/{method}/{id?}', [RumahSakitController::class, 'formView']);
Route::get('/rumah-sakit/view/{kode}', [RumahSakitController::class, 'singleView']);
Route::get('/rumah-sakit/delete/{id}', [RumahSakitController::class, 'delete']);

// Pasien
Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index');
Route::post('/pasien/store', [PasienController::class, 'store'])->name('pasien.store');
Route::put('/pasien/update/{id}', [PasienController::class, 'update'])->name('pasien.update');
Route::get('/pasien/search', [PasienController::class, 'search']);
Route::get('/pasien/form/{method}/{id?}', [PasienController::class, 'formView']);
Route::get('/pasien/view/{kode}', [PasienController::class, 'singleView']);
Route::get('/pasien/delete/{id}', [PasienController::class, 'delete']);