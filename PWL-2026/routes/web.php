<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Product::with('Supplier')->get();
});

Route::get('products', [ProductController::class, 'index'])->name('product.index');
Route::get('product-create', [ProductController::class, 'create'])->name('product.create');
Route::post('products-store', [ProductController::class, 'store'])->name('product.store');
Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('products/{product}', [ProductController::class, 'update'])->name('product.update');
Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

Route::get('suppliers', [SupplierController::class, 'index'])->name('supplier.index');
Route::get('supplier-create', [SupplierController::class, 'create'])->name('supplier.create');
Route::post('supplier-store', [SupplierController::class, 'store'])->name('supplier.store');
Route::get('suppliers/{supplier}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
Route::put('suppliers/{supplier}', [SupplierController::class, 'update'])->name('supplier.update');
Route::delete('suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('supplier.destroy');