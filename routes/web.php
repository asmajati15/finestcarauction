<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LotController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\HistoryController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'user-access:masyarakat')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/lot', [LotController::class, 'index'])->name('lot.index');
    Route::get('/lot/{lot_id}', [LotController::class, 'show'])->name('lot.show');
    Route::post('/bid/{lot_id}', [BidController::class, 'newBid'])->name('bid.new');
    Route::get('/history', [HistoryController::class, 'index'])->name('bid.history');
    Route::get('/history/invoice/{lot_id}', [HistoryController::class, 'invoice'])->name('bid.invoice');
});

Route::middleware('auth', 'user-access:admin', 'user-access:petugas')->group(function () {
});

Route::middleware('auth', 'user-access:petugas,admin')->group(function () {
    Route::get('/sell', [LotController::class, 'sell'])->name('lot.sell');
    Route::post('/lot', [LotController::class,'store'])->name('lot.store');
    Route::put('/lot/{lot_id}', [LotController::class, 'update'])->name('lot.update');
    Route::delete('/lot/{lot_id}', [LotController::class, 'destroy'])->name('lot.destroy');
    Route::post('/close/{lot_id}', [LotController::class, 'close'])->name('lot.close');
    Route::post('/open/{lot_id}', [LotController::class, 'open'])->name('lot.open');
});

require __DIR__.'/auth.php';
