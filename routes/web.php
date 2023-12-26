<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalonController;
use App\Http\Controllers\PemilihanController;
use App\Http\Controllers\DetailPemilihanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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

Route::get('/login', function () {
    return view('admin.login');
});

// auth
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('IsLogin');


// user
Route::get('/user', [UserController::class, 'index'])->middleware('IsLogin', 'IsAdmin');
Route::post('/user', [UserController::class, 'store'])->middleware('IsLogin', 'IsAdmin');
Route::put('/user/{id}', [UserController::class, 'update'])->middleware('IsLogin', 'IsAdmin');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->middleware('IsLogin', 'IsAdmin');

// pemilihan
Route::get('/pemilihan', [PemilihanController::class, 'index'])->middleware('IsLogin', 'IsAdmin');
Route::post('/pemilihan', [PemilihanController::class, 'store'])->middleware('IsLogin', 'IsAdmin');
Route::put('/pemilihan/{id}', [PemilihanController::class, 'update'])->middleware('IsLogin', 'IsAdmin');
Route::delete('/pemilihan/{id}', [PemilihanController::class, 'destroy'])->middleware('IsLogin', 'IsAdmin');

// calon
Route::get('/calon', [CalonController::class, 'index'])->middleware('IsLogin', 'IsAdmin');
Route::post('/calon', [CalonController::class, 'store'])->middleware('IsLogin', 'IsAdmin');
Route::put('/calon/{id}', [CalonController::class, 'update'])->middleware('IsLogin', 'IsAdmin');
Route::delete('/calon/{id}', [CalonController::class, 'destroy'])->middleware('IsLogin', 'IsAdmin');
