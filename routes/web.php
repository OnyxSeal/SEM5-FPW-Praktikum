<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;

Route::get('/supplier', [SupplierController::class, 'index'])->name("supplier-index");
Route::get('/supplier/create', [SupplierController::class, 'create'])->name("tambah-supplier");
Route::get('/supplier/{id}/edit', [SupplierController::class, 'edit'])->name("supplier-edit");
Route::put('/supplier/{id}', [SupplierController::class, 'update'])->name("supplier-update");
Route::post('/supplier', [SupplierController::class, 'store'])->name("supplier-store");


Route::get('/product', [ProductController::class, 'index'])->name('product-index');
Route::get('/product/add', [ProductController::class, 'addProduct'])->name('tambah-barang');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product-detail');
// Route::get('/products/add', [ProductController::class, 'addProduct'])->name('tambah-barang');
// Route::get('/product/create', [ProductController::class, 'create'])->name('tambah-barang');
Route::post('/product', [ProductController::class, 'store'])->name('product-store');
Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product-edit');
Route::put('/product/{id}', [ProductController::class, 'update'])->name('product-update');
Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product-deleted');
Route::get('/product/export/excel', [ProductController::class, 'exportExcel'])->name('product-export-excel');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'RoleCheck:admin'])->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';