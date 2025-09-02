<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RumahSakitController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

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
});

require __DIR__.'/auth.php';
