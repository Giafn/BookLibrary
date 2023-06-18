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
    Route::post('/admin/storeBook', [AdminController::class, 'storeBook'])->name('admin.storeBook');
    Route::get('/admin/editBook/{id}', [AdminController::class, 'editBook'])->name('admin.editBook');
    Route::post('/admin/updateBook/{id}', [AdminController::class, 'updateBook'])->name('admin.updateBook');
    Route::delete('/admin/deleteBook/{id}', [AdminController::class, 'deleteBook'])->name('admin.deleteBook');
    Route::get('/admin/show/{id}', [AdminController::class, 'showImage'])->name('admin.showImage');

    Route::get('/admin/getall', [AdminController::class, 'getall'])->name('admin.getall');
});
