<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ChangePasswordController;



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

Route::get('/', [Controller::class, 'index'])->name('homepage');
Route::get('login',[LoginController::class,'loginForm'])->name('login');
Route::post('login', [LoginController::class, 'postLogin']);
Route::get('logout',function(){
    Auth::logout();
    return redirect(route('login'));
})->name('logout');

Route::get('changepass',[ChangePasswordController::class,'changePassword'])->name('change');
Route::post('changepass', [ChangePasswordController::class, 'postchangePassword']);
