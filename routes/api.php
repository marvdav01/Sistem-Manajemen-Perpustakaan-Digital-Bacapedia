<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Kategori routes (Admin only)
    Route::middleware('role:Admin')->group(function () {
        Route::apiResource('kategoris', KategoriController::class);
    });

    // Buku routes
    Route::get('bukus', [BukuController::class, 'index']);
    Route::get('bukus/{id}', [BukuController::class, 'show']);
    
    Route::middleware('role:Admin')->group(function () {
        Route::post('bukus', [BukuController::class, 'store']);
        Route::put('bukus/{id}', [BukuController::class, 'update']);
        Route::delete('bukus/{id}', [BukuController::class, 'destroy']);
    });

    // Peminjaman routes
    Route::get('peminjaman', [\App\Http\Controllers\PeminjamanController::class, 'history']);
    Route::post('peminjaman', [\App\Http\Controllers\PeminjamanController::class, 'borrow']);
    
    Route::middleware('role:Admin,Petugas')->group(function () {
        Route::post('peminjaman/{id}/return', [\App\Http\Controllers\PeminjamanController::class, 'returnBook']);
    });
});
