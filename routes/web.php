<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\BookController;
use App\Http\Controllers\Web\ProfileController;

Route::get('/', function () {
    // If authenticated, go to dashboard, else show landing/welcome
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated Routes
// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Books Catalog (Web view)
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

    // Borrowing Routes
    Route::post('/borrow', [\App\Http\Controllers\Web\BorrowController::class, 'borrow'])->name('borrows.borrow');
    Route::get('/borrows/history', [\App\Http\Controllers\Web\BorrowController::class, 'history'])->name('borrows.history');
    
    // Admin & Petugas Routes
    Route::middleware('role:Admin,Petugas')->group(function () {
        // Return Book
        Route::post('/borrows/{id}/return', [\App\Http\Controllers\Web\BorrowController::class, 'returnBook'])->name('borrows.return');
        
        // Admin Books CRUD
        Route::get('/admin/books', [BookController::class, 'adminIndex'])->name('admin.books.index');
        Route::get('/admin/books/create', [BookController::class, 'create'])->name('admin.books.create');
        Route::post('/admin/books', [BookController::class, 'store'])->name('admin.books.store');
        Route::get('/admin/books/{id}/edit', [BookController::class, 'edit'])->name('admin.books.edit');
        Route::put('/admin/books/{id}', [BookController::class, 'update'])->name('admin.books.update');
        Route::delete('/admin/books/{id}', [BookController::class, 'destroy'])->name('admin.books.destroy');
        
        // Admin Categories CRUD
        Route::get('/admin/categories', [\App\Http\Controllers\Web\CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/admin/categories/create', [\App\Http\Controllers\Web\CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/admin/categories', [\App\Http\Controllers\Web\CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/admin/categories/{id}/edit', [\App\Http\Controllers\Web\CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/admin/categories/{id}', [\App\Http\Controllers\Web\CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/admin/categories/{id}', [\App\Http\Controllers\Web\CategoryController::class, 'destroy'])->name('admin.categories.destroy');

        // Admin Users CRUD
        Route::get('/admin/users', [\App\Http\Controllers\Web\UserController::class, 'index'])->name('admin.users.index');
        Route::get('/admin/users/create', [\App\Http\Controllers\Web\UserController::class, 'create'])->name('admin.users.create');
        Route::post('/admin/users', [\App\Http\Controllers\Web\UserController::class, 'store'])->name('admin.users.store');
        Route::get('/admin/users/{id}/edit', [\App\Http\Controllers\Web\UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/admin/users/{id}', [\App\Http\Controllers\Web\UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/admin/users/{id}', [\App\Http\Controllers\Web\UserController::class, 'destroy'])->name('admin.users.destroy');
    });
});
