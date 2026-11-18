
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/', [ProductController::class, 'index'])
    ->name('home');

Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class)
    ->except(['show']);
    
// Ordinateurs
Route::get('/ordinateurs', [ProductController::class, 'ordinateurs'])
    ->name('ordinateurs.index');

Route::get('/ordinateurs/create', [ProductController::class, 'createOrdinateur'])
    ->name('ordinateurs.create');

Route::post('/ordinateurs', [ProductController::class, 'storeOrdinateur'])
    ->name('ordinateurs.store');

// Imprimantes
Route::get('/imprimantes', [ProductController::class, 'imprimantes'])
    ->name('imprimantes.index');

Route::get('/imprimantes/create', [ProductController::class, 'createImprimante'])
    ->name('imprimantes.create');

Route::post('/imprimantes', [ProductController::class, 'storeImprimante'])
    ->name('imprimantes.store');
