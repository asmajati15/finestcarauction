<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LotController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [LotController::class, 'index'])->name('lot.index');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//     Route::get('/lot', [LotController::class, 'index'])->name('lot.index');
//     Route::get('/lot/{lot_id}', [LotController::class, 'show'])->name('lot.show');
//     Route::post('/bid/{lot_id}', [BidController::class, 'newBid'])->name('bid.new');
//     Route::get('/history', [HistoryController::class, 'index'])->name('bid.history');
//     Route::get('/history/invoice/{lot_id}', [HistoryController::class, 'invoice'])->name('bid.invoice');
//     Route::get('/sell', [LotController::class, 'sell'])->name('lot.sell');
//     Route::post('/lot', [LotController::class,'store'])->name('lot.store');
//     Route::put('/lot/{lot_id}', [LotController::class, 'update'])->name('lot.update');
//     Route::delete('/lot/{lot_id}', [LotController::class, 'destroy'])->name('lot.destroy');
//     Route::post('/close/{lot_id}', [LotController::class, 'close'])->name('lot.close');
//     Route::put('/open/{lot_id}', [LotController::class, 'open'])->name('lot.open');
//     Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
//     Route::post('/category', [CategoryController::class,'store'])->name('category.store');
//     Route::put('/category/{category_id}', [CategoryController::class, 'update'])->name('category.update');
//     Route::delete('/category/{category_id}', [CategoryController::class, 'destroy'])->name('category.destroy');
// });

Route::middleware('auth', 'user-access:user')->group(function () {
    Route::post('/message', [MessageController::class, 'store'])->name('message');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/items/{lot_id}', [LotController::class, 'show'])->name('lot.show');
    Route::post('/bid/{lot_id}', [BidController::class, 'newBid'])->name('bid.new');
    Route::get('/history', [HistoryController::class, 'index'])->name('bid.history');
    Route::delete('/history/{bid_id}', [BidController::class, 'destroy'])->name('bid.destroy');
    Route::get('/history/invoice/{bid_id}', [HistoryController::class, 'invoice'])->name('bid.invoice');
});

Route::middleware('auth', 'user-access:manager')->prefix('manager')->name('manager.')->group(function () {
    Route::get('/', [AdminController::class, 'manager'])->name('index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/sell', [LotController::class, 'sell'])->name('lot.sell');
    Route::post('/lot', [LotController::class,'store'])->name('lot.store');
    Route::get('/lot/{lot_id}', [LotController::class, 'showAdmin'])->name('lot.show');
    Route::put('/lot/{lot_id}', [LotController::class, 'update'])->name('lot.update');
    Route::delete('/lot/{lot_id}', [LotController::class, 'destroy'])->name('lot.destroy');
    Route::put('/statusup/{lot_id}', [LotController::class, 'statusUp'])->name('lot.statusUp');
    Route::put('/close/{lot_id}', [LotController::class, 'close'])->name('lot.close');
    Route::put('/open/{lot_id}', [LotController::class, 'open'])->name('lot.open');
    Route::get('/history', [HistoryController::class, 'indexManager'])->name('bid.history');
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category', [CategoryController::class,'store'])->name('category.store');
    Route::put('/category/{category_id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{category_id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/report', [AdminController::class, 'report'])->name('lot.report');
});

Route::middleware('auth', 'user-access:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/lot/{lot_id}', [LotController::class, 'showAdmin'])->name('lot.show');
    Route::get('/user', [AdminController::class, 'userList'])->name('userList');
    Route::post('/user', [AdminController::class,'store'])->name('store');
    Route::put('/user/{user_id}', [AdminController::class, 'update'])->name('update');
    Route::put('/blacklist/{user_id}', [AdminController::class, 'blacklist'])->name('blacklist');
    Route::put('/unblacklist/{user_id}', [AdminController::class, 'unblacklist'])->name('unblacklist');
    Route::delete('/user/{user_id}', [AdminController::class, 'destroy'])->name('destroy');
    Route::get('/report', [AdminController::class, 'report'])->name('lot.report');
});

require __DIR__.'/auth.php';
