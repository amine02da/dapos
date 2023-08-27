<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Auth::routes(["register" => false]);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix("admin/dashboard")->middleware('auth')->group(
    function(){
        Route::get("/",[Dashboard\DashboardController::class, "index"]);
        Route::resource("/users",Dashboard\UserController::class);
        Route::resource("/categories",Dashboard\CategoryController::class);
        Route::resource("/products",Dashboard\ProductController::class);
        Route::resource("/clients",Dashboard\ClientController::class);
        Route::resource("/clients.orders",Dashboard\OrderController::class);
        Route::resource("/orders",Dashboard\GeneralOrderController::class);
        Route::get("/orders/{order}/products",[Dashboard\GeneralOrderController::class,"products"])->name("orders.products");
        Route::post("/change-status/{id}",[Dashboard\GeneralOrderController::class,"changerStatus"])->name("orders.changeStatus");
    }
);

require __DIR__.'/auth.php';
