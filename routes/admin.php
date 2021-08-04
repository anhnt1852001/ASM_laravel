<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;


Route::prefix('room')->group(function() {
    Route::get('/', [RoomController:: class, 'index'])->name('room.index');
    Route::get('xoa/{id}', [RoomController::class, 'remove'])->middleware('auth')->name('room.remove');
    Route::get('tao-moi', [RoomController::class, 'addForm'])->middleware('auth')->name('room.add');
    Route::post('tao-moi', [RoomController::class, 'saveAdd']);
    Route::get('cap-nhat/{id}', [RoomController::class, 'editForm'])->middleware('auth')->name('room.edit');
    Route::post('cap-nhat/{id}', [RoomController::class, 'saveEdit']);
});

Route::prefix('service')->group(function() {
    Route::get('/', [ServiceController:: class, 'index'])->name('service.index');
    Route::get('xoa/{id}', [ServiceController::class, 'remove'])->middleware('auth')->name('service.remove');
    Route::get('tao-moi', [ServiceController::class, 'addForm'])->middleware('auth')->name('service.add');
    Route::post('tao-moi', [ServiceController::class, 'saveAdd']);
    Route::get('cap-nhat/{id}', [ServiceController::class, 'editForm'])->middleware('auth')->name('service.edit');
    Route::post('cap-nhat/{id}', [ServiceController::class, 'saveEdit']);
});

Route::prefix('user')->group(function() {
    Route::get('/', [UserController:: class, 'index'])->name('user.index');
    Route::get('xoa/{id}', [UserController::class, 'remove'])->middleware('auth')->name('user.remove');
    Route::get('tao-moi', [UserController::class, 'addForm'])->middleware('auth')->name('user.add');
    Route::post('tao-moi', [UserController::class, 'saveAdd']);
    Route::get('cap-nhat/{id}', [UserController::class, 'editForm'])->middleware('auth')->name('user.edit');
    Route::post('cap-nhat/{id}', [UserController::class, 'saveEdit']);
});

Route::view('layout', 'admin.layouts.main');


