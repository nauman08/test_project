<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TestController;

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

Route::get('/', [TestController::class , 'index'])->name('home');
Route::get('/home', [TestController::class , 'index'])->name('home');
Route::get('admin/home', [TestController::class, 'adminHome'])->name('admin.route')->middleware('is_admin');
Route::get('/remove/{id}', [TestController::class , 'removeUser'])->name('remove');
Route::post('/registerAdmin', [TestController::class , 'adminReg'])->name('registerAdmin');
Route::post('/solution', [TestController::class , 'solution'])->name('solution');
