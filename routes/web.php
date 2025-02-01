<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionsController;
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
// dashboard controller
Route::permanentRedirect('/', '/dashboard');
Route::get('/dashboard', [DashboardController::class,'index']);
Route::get('/admin-dashboard', [DashboardController::class, 'showAdminDashboard']) -> name('admin.home');
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::get('/admin/product', [DashboardController::class,'productAdmin']) -> name('admin.product');
Route::get('/admin/product', [ProductController::class, 'loadProductAdmin'])->name('products.index');
Route::get('/admin/transaction', [DashboardController::class, 'transaction']) -> name('admin.transaction');
Route::get('/admin/transaction', [DashboardController::class, 'loadTransaction'])->name('transactions.index');
// Route untuk halaman tambah produk
Route::get('/admin/product/create', [ProductController::class, 'addProductAdmin'])->name('products.create');
Route::post('/admin/products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/admin/transaction{id}/edit', [ProductController::class, 'editTransaction'])->name('transactions.edit');
Route::get('/admin/transaction/{id}', [ProductController::class, 'destroyTransaction'])->name('transactions.destroy');


Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// user
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// admin
Route::get('/admin-login',[AuthController::class, 'showadlogin'])->name('admin-login');
Route::post('/admin-login', [AuthController::class, 'adlogin']);
Route::get('/admin-signup', [AuthController::class, 'showadsignup'])->name('admin-signup');
Route::post('/admin-signup', [AuthController::class, 'adsignup']);
Route::get('/admin-logout', [AuthController::class,'adlogout'])->name('admin-logout');

Route::get('/download/blender/{filename}', function ($filename) {
    $path = public_path('folder_blender/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->download($path);
})->where('filename', '.*');

Route::post('/purchase/{id}', [TransactionsController::class, 'purchase'])->middleware('auth');
Route::get('/download/{id}', [TransactionsController::class, 'download'])->middleware('auth');
