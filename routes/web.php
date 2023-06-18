<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
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

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [BookController::class, 'index'])->name('home');
    Route::get('/detail', [BookController::class, 'detail'])->name('book.all');
    Route::get('/detail/{id}', [BookController::class, 'showDetail'])->name('book.detail');
});

Route::group(['middleware' => ['auth', 'Admin']], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/bookList', [AdminController::class, 'bookList'])->name('admin.bookList');
    Route::get('/admin/addBook', [AdminController::class, 'addBook'])->name('admin.addBook');
    Route::post('/admin/addBook', [AdminController::class, 'storeBook'])->name('admin.storeBook');
});
