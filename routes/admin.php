<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\ServiceController;


Route::prefix('room')->group(function() {
    Route::get('/', [RoomController:: class, 'index'])->name('room.index');
    Route::get('xoa/{id}', [RoomController::class, 'remove'])->name('room.remove');
    Route::get('tao-moi', [RoomController::class, 'addForm'])->name('room.add');
    Route::post('tao-moi', [RoomController::class, 'saveAdd']);
    Route::get('cap-nhat/{id}', [RoomController::class, 'editForm'])->name('room.edit');
    Route::post('cap-nhat/{id}', [RoomController::class, 'saveEdit']);
});

Route::prefix('service')->group(function() {
    Route::get('/', [ServiceController:: class, 'index'])->name('service.index');
    Route::get('xoa/{id}', [ServiceController::class, 'remove'])->name('service.remove');
    Route::get('tao-moi', [ServiceController::class, 'addForm'])->name('service.add');
    Route::post('tao-moi', [ServiceController::class, 'saveAdd']);
    Route::get('cap-nhat/{id}', [ServiceController::class, 'editForm'])->name('service.edit');
    Route::post('cap-nhat/{id}', [ServiceController::class, 'saveEdit']);
});

Route::view('layout', 'admin.layouts.main');


