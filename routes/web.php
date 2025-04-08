<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
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

//users auth
// user
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//admins auth
Route::get('/admin-login',[AuthController::class, 'showadlogin'])->name('admin-login');
Route::post('/admin-login', [AuthController::class, 'adlogin']);
// Route::get('/admin-signup', [AuthController::class, 'showadsignup'])->name('admin-signup');
// Route::post('/admin-signup', [AuthController::class, 'adsignup'])->middleware('auth:admin')->name('admin-signup');
Route::get('/admin-signup', [AuthController::class, 'showadsignup'])->name('admin-signup');
Route::post('/admin-signup', [AuthController::class, 'adsignup']);
Route::get('/admin-logout', [AuthController::class,'adlogout'])->name('admin-logout');

//dashboard admin control
Route::get('/admin-dashboard',[DashboardController::class, 'showAdminDashboard'])->name('admin-dashboard');
Route::get('/admin/product', [DashboardController::class,'productAdmin']) -> name('admin.product');
Route::get('/admin/product', [ProductController::class, 'loadProductAdmin'])->name('products.index');
Route::get('/admin/product/create', [ProductController::class, 'addProductAdmin'])->name('products.create');
Route::post('/admin/products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/admin/transaction', [DashboardController::class, 'transaction']) -> name('admin.transaction');
Route::get('/admin/transaction', [TransactionsController::class, 'loadTransaction'])->name('transactions.index');
Route::get('/admin/transaction/{id}/edit', [TransactionsController::class, 'edit'])->name('transactions.edit');
Route::put('/admin/transaction/{id}', [TransactionsController::class, 'update'])->name('transactions.update');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::get('/admin/category', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/admin/category', [CategoryController::class, 'store'])->name('categories.store');
Route::put('/admin/category/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/admin/category/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::get('/admin/category/{id}/edit', [CategoryController::class,'edit'])->name('category.edit');
Route::get('/admin/category/create', [CategoryController::class, 'addCategoryAdmin'])->name('category.create');



//notifications control
Route::get('/admin-dashboard/notif', [DashboardController::class, 'notificationTransaction'])->name('transactions.notification');


//admin blender control

Route::get('/download/blender/{filename}', function ($filename) {
    $path = public_path('folder_blender/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->download($path);
})->where('filename', '.*');

//user blender control

// dashboard user control
Route::permanentRedirect('/', '/dashboard');
Route::get('/dashboard', [DashboardController::class,'index']);
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/categories', [DashboardController::class, 'indexU'])->name('categories.indexU');
Route::get('/profile', [DashboardController::class, 'showProfile'])->name('profile');
Route::get('/teams', [DashboardController::class, 'showteams'])->name('teams');
// Route::get('/categories', [CategoryController::class, 'showCategories'])->name('categories.index');
Route::get('/categories/{category_id}/products', [DashboardController::class, 'showProductsByCategory'])->name('categories.products');
Route::get('/dashboard/{category_id}/products', [DashboardController::class, 'showProductsByCategory1'])->name('categories1.products');
Route::get('/products',[DashboardController::class, 'showproducts']) ->name('products1.index');

//pembayaran control
// Route::post('/purchase/{product}', [TransactionsController::class, 'purchase'])->name('purchase');
// Route::get('/download/{product}', [TransactionsController::class, 'download'])->name('product.download');
Route::post('/approve/{transaction}', [TransactionsController::class, 'approve'])->name('approve.transaction');

Route::get('/download-file/blender/{product}', [TransactionsController::class, 'download'])->name('products.download')->middleware('auth');

Route::post('/purchase/{product}', [TransactionsController::class, 'purchase'])->name('purchase');
Route::post('/midtrans-webhook', [TransactionsController::class, 'handleWebhook']);
Route::get('/payment-success', [TransactionsController::class, 'paymentSuccess']);
