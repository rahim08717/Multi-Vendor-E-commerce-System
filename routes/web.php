<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminSellerController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminDashboardController;

// --- Public Routes ---
Route::get('/', [FrontendController::class, 'index'])->name('front.home');
Route::get('/product/{id}', [FrontendController::class, 'show'])->name('product.details');

// --- Cart Routes ---
Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::get('/cart', [CartController::class, 'cart'])->name('cart.index');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// --- Auth Routes ---
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

// --- Checkout Routes (Logged-in Users) ---
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place');
});

// ==========================================
// ADMIN ROUTES
// ==========================================
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard (Fix: Pointing to Controller)
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Order Management
    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::post('/admin/order/update/{id}', [AdminOrderController::class, 'updateStatus'])->name('admin.order.update');
    Route::get('/admin/activity-logs', [AdminOrderController::class, 'activityLogs'])->name('admin.logs');

    // Seller Management
    Route::get('/admin/sellers', [AdminSellerController::class, 'index'])->name('admin.sellers.index');
    Route::get('/admin/seller/status/{id}', [AdminSellerController::class, 'toggleStatus'])->name('admin.seller.status');

    // Role & Permission Management
    Route::get('/admin/roles', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::get('/admin/roles/edit/{id}', [RoleController::class, 'edit'])->name('admin.roles.edit');
    Route::post('/admin/roles/update/{id}', [RoleController::class, 'update'])->name('admin.roles.update');
});

// ==========================================
// SELLER ROUTES
// ==========================================
Route::middleware(['auth', 'role:seller'])->group(function () {

    // Dashboard (FIX: সঠিক কন্ট্রোলারে পাঠানো হলো)
    Route::get('/seller/dashboard', [SellerController::class, 'dashboard'])->name('seller.dashboard');

    // Product Management
    Route::get('/seller/products', [SellerController::class, 'index'])->name('seller.products.index');
    Route::get('/seller/product/create', [SellerController::class, 'create'])->name('seller.product.create'); // নাম ঠিক করা হলো
    Route::post('/seller/product/store', [SellerController::class, 'store'])->name('seller.product.store'); // নাম ঠিক করা হলো

    // Product Edit/Update/Delete (Add these if needed based on controller)
    Route::get('/seller/product/edit/{id}', [SellerController::class, 'edit'])->name('seller.products.edit');
    Route::put('/seller/product/update/{id}', [SellerController::class, 'update'])->name('seller.products.update'); // PUT used generally
    Route::delete('/seller/product/delete/{id}', [SellerController::class, 'destroy'])->name('seller.products.destroy');

    // Order Management
    Route::get('/seller/orders', [SellerController::class, 'orders'])->name('seller.orders.index');
    // Seller Routes গ্রুপের ভেতরে এটা বসাও
    Route::post('/seller/order/update/{id}', [SellerController::class, 'updateOrderStatus'])->name('seller.order.update');
});
