<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;
use App\Models\Sale_detail;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;

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
    $sales = Sale::get();
    $products = Product::get();
    $users = User::get();
    $detail_sales = Sale_detail::get();
    return view('dashboard')->with([
        'sales' => $sales,
        'products' => $products,
        'users' => $users,
        'details' => $detail_sales
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

// RUTAS NUEVAS PARA LOS NUEVAS SECCIONES
Route::controller(SalesController::class)->group(function () {
    Route::get('/api/data', 'index');
    Route::get('/sales', "show");
    Route::get('/sales/create', "create");
    Route::post('/sales', "store");
    Route::get('/sales/{sale}/edit', "edit");
    Route::patch('/sales/{sale}', "update");
    Route::delete('/sales/{sale}', "destroy");
})->middleware(['auth', 'verified'])->name('sales');

Route::get('/detail/delete/{detail}', function (Sale_detail $detail) {
    $products = Product::get();
    $producto_id = $detail->product_id;

    foreach ($products as $product){
        if($product->id == $producto_id) {
            $product->update([
                'stock' => $product->stock + (int)$detail->amount,
            ]);
        }
    }

    $detail->delete();

    $cadena = "/sales/ " . $detail->sale_id . " /edit/";
    return redirect($cadena);
});

Route::controller(ProductsController::class)->group(function () {
    Route::get('/warehouse', "show");
    Route::get('/warehouse/create', "create");
    Route::post('/warehouse', "store");
    Route::get('/warehouse/{id}/edit', "edit");
    Route::patch('/warehouse/{id}', "update");
    Route::delete('/warehouse/{id}', "destroy");
})->middleware(['auth', 'verified'])->name('warehouse');

Route::controller(ReportsController::class)->group(function () {
    Route::get('/reports', "index");
    Route::get('/reports/create', "create");
    Route::get('/reports/{table}', "show");
    Route::post('/reports', "store");
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
