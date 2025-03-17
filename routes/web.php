<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
Route::get('/', [ProductController::class, 'index'])->name('home');


// Route cho admin
// Các route cho danh mục
Route::get('admin/categories', [AdminController::class, 'categories'])->name('admin.categories.index');
Route::get('admin/categories/create', [AdminController::class, 'createCategory'])->name('admin.categories.create');
Route::post('admin/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
Route::get('admin/categories/{id}/edit', [AdminController::class, 'editCategory'])->name('admin.categories.edit');
Route::put('admin/categories/{id}', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
Route::delete('admin/categories/{id}', [AdminController::class, 'destroyCategory'])->name('admin.categories.destroy');

Route::get('admin/users', [AdminController::class, 'index'])->name('admin.users.index');
Route::get('admin/users/create', [AdminController::class, 'create'])->name('admin.users.create');
Route::post('admin/users', [AdminController::class, 'store'])->name('admin.users.store');
Route::get('admin/users/{id}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
Route::put('admin/users/{id}', [AdminController::class, 'update'])->name('admin.users.update');
Route::delete('admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
// Các route cho sản phẩm
Route::get('admin/products', [AdminController::class, 'products'])->name('admin.products.index');
route::get('admin/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
Route::post('admin/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
route::get('admin/products/{name}/show', [AdminController::class, 'showProduct'])->name('admin.products.show');
Route::get('admin/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
Route::put('admin/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
Route::delete('admin/products/{id}', [AdminController::class, 'destroyProduct'])->name('admin.products.destroy');
Route::get('admin/payment', [AdminController::class, 'indexPayment'])->name('admin.reports.indexPayment');


Route::get('admin/orders', [AdminController::class, 'orders'])->name('admin.orders.index');
Route::get('admin/orders/create', [AdminController::class, 'createOrder'])->name('admin.orders.create');
Route::post('admin/orders', [AdminController::class, 'storeOrder'])->name('admin.orders.store');
Route::get('admin/orders/{id}/edit', [AdminController::class, 'editOrder'])->name('admin.orders.edit');
Route::put('admin/orders/{id}', [AdminController::class, 'updateOrder'])->name('admin.orders.update');
Route::delete('admin/orders/{id}', [AdminController::class, 'destroyOrder'])->name('admin.orders.destroy');
Route::patch('/admin/orders/{order}', [AdminController::class, 'updateStatus'])->name('admin.orders.updateStatus');
Route::get('admin/orders/{id}', [AdminController::class, 'showOrder'])->name('admin.orders.showOrder');

// Route cho các controller khác
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::get('/products/category/{category}', [ProductController::class, 'list'])->name('products.list');
Route::get('/products/category/{category}/{id}', [ProductController::class, 'showFromList'])->name('products.showFromList');
Route::get('showUser/{id}/edit', [UserController::class, 'edit'])->name('showUser.edit');
Route::post('products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('products/showSearch/{product}', [ProductController::class, 'showSearch'])->name('products.showSearch');

Route::put('user/showUser/{id}', [UserController::class, 'update'])->name('showUser.update');
Route::get('user/showUser/{id}', [UserController::class, 'show'])->name('showUser.show');

Route::get('/user/orders', [OrderController::class, 'index'])->name('user.orders.index');
Route::post('/user/orders', [OrderController::class, 'store'])->name('user.orders.store');
Route::get('/user/orders/{id}', [OrderController::class, 'show'])->name('user.orders.show');

// Hiển thị form đăng ký
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

// Xử lý đăng ký người dùng
Route::post('/register', [AuthController::class, 'register']);

// Hiển thị form đăng nhập
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Xử lý đăng nhập người dùng
Route::post('/login', [AuthController::class, 'login']);

// Xử lý đăng xuất người dùng
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('user/cart', [CartController::class, 'index'])->name('user.cart.index');
Route::post('user/cart/{product}', [CartController::class, 'add'])->name('user.cart.add');
Route::patch('user/cart/{id}', [CartController::class, 'update'])->name('user.cart.update');
Route::delete('user/cart/{product}', [CartController::class, 'remove'])->name('user.cart.remove');

