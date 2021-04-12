<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('lpd', LpdController::class);
Route::apiResource('admin', AdminController::class);
Route::put('admin/{admin}/aktivasi_admin', [AdminController::class,'aktivasiAdmin']);

Route::apiResource('nasabah', NasabahController::class);
Route::put('nasabah/{nasabah}/aktivasi_nasabah', [NasabahController::class,'aktivasiNasabah']);

Route::apiResource('transaksi', TransaksiController::class);