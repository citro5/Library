<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', [FrontController::class, 'getHome'])->name('home');

//Route::get('/book', [BookController::class, 'index'])->name('book.index');
Route::resource('book', BookController::class);
Route::get('/book/{id}/destroy', [BookController::class, 'destroy'])->name('book.destroy');
Route::get('/book/{id}/destroy/confirm', [BookController::class, 'confirmDestroy'])->name('book.destroy.confirm');

//Route::get('/author', [AuthorController::class, 'index'])->name('author.index');
Route::resource('author', AuthorController::class);
Route::get('/author/{id}/destroy', [AuthorController::class, 'destroy'])->name('author.destroy');
Route::get('/author/{id}/destroy/confirm', [AuthorController::class, 'confirmDestroy'])->name('author.destroy.confirm');
//Route::get('/author/{id}/update', [AuthorController::class, 'update'])->name('author.update');
