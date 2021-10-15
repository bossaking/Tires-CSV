<?php

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



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/new', [App\Http\Controllers\HomeController::class, 'createNew'])->name('new-tire');
Route::post('/create-new-tire', [App\Http\Controllers\HomeController::class, 'createNewTire'])->name('create-new-tire');
Route::get('/generate-csv', [App\Http\Controllers\HomeController::class, 'generateCSV'])->name('generate-csv');
