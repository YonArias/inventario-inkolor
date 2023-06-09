<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// RUTAS NUEVAS PARA LOS NUEVAS SECCIONES
Route::get('/sales', function () {
    return view('sales');
})->middleware(['auth', 'verified'])->name('sales');

Route::controller(ProductsController::class)->group(function () {
    Route::get('/warehouse', "show");
    Route::get('/warehouse/create', "create");
    Route::post('/warehouse', "store");
    Route::get('/warehouse/{id}/edit', "edit");
    Route::patch('/warehouse/{id}', "update");
    Route::delete('/warehouse/{id}', "destroy");
})->middleware(['auth', 'verified'])->name('warehouse');

Route::get('/reports', function () {
    return view('reports');
})->middleware(['auth', 'verified'])->name('reports');

Route::get('/users', function () {
    return view('users');
})->middleware(['auth', 'verified'])->name('users');
// FINISH

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
