<?php

use App\Http\Controllers\BookController;
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
    return redirect()->route('home');
});

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [BookController::class, 'index'])->name('home');
    Route::get('/detail', [BookController::class, 'detail'])->name('book.all');
    Route::get('/detail/{id}', [BookController::class, 'showDetail'])->name('book.detail');
});
