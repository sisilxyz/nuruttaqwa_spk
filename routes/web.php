<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\AlternatifController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/', [WelcomeController::class, 'index'])->name('landing');
Route::get('/search', [WelcomeController::class, 'search'])->name('search');
Route::post('/newdata', [WelcomeController::class, 'create'])->name('newdata');
Route::post('/newdatapost', [WelcomeController::class, 'store'])->name('newdatapost');
Route::post('/altimport', [AlternatifController::class, 'import_excel'])->name('altimport');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/kriteria', App\Http\Controllers\Admin\KriteriaController::class)->except(['create']);
Route::resource('/alternatif', App\Http\Controllers\Admin\AlternatifController::class)->except(['create','show']);
Route::resource('/rekomendasi', App\Http\Controllers\Admin\rekomendasiController::class)->except(['create','show']);
Route::resource('/crips', App\Http\Controllers\Admin\CripsController::class)->except(['index', 'create', 'show']);
//Route::resource('/penilaian',  App\Http\Controllers\Admin\PenilaianController::class);
//Route::get('/perhitungan', [App\Http\Controllers\Admin\AlgoritmaController::class, 'index'])->name('perhitungan.index');
