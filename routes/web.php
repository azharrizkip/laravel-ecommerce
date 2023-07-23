<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\BuyerController;


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
    return redirect()->route('login'); // Redirect to the login page
});

// Menampilkan halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Memproses data login
Route::post('/login', [LoginController::class, 'login']);
// Logout user
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin dashboard route
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/staff', [AdminController::class, 'manageStaff'])->name('admin.manageStaff');
Route::get('/admin/staff/add', [AdminController::class, 'addStaffForm'])->name('admin.addStaffForm');
Route::post('/admin/staff/add', [AdminController::class, 'addStaff'])->name('admin.addStaff');
Route::get('/admin/staff/edit/{id}', [AdminController::class, 'editStaffForm'])->name('admin.editStaffForm');
Route::post('/admin/staff/edit/{id}', [AdminController::class, 'editStaff'])->name('admin.editStaff');
Route::delete('/admin/staff/delete/{id}', [AdminController::class, 'deleteStaff'])->name('admin.deleteStaff');
Route::get('/admin/product', [AdminController::class, 'manageProducts'])->name('admin.manageProducts');
Route::get('/admin/product/add', [AdminController::class, 'addProductForm'])->name('admin.addProductForm');
Route::post('/admin/product/add', [AdminController::class, 'addProduct'])->name('admin.addProduct');
Route::get('/admin/product/edit/{id}', [AdminController::class, 'editProductForm'])->name('admin.editProductForm');
Route::put('/admin/product/edit/{id}', [AdminController::class, 'editProduct'])->name('admin.editProduct');
Route::delete('/admin/product/delete/{id}', [AdminController::class, 'deleteProduct'])->name('admin.deleteProduct');

// Staff dashboard route
Route::get('/staff/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');
Route::get('/staff/product', [StaffController::class, 'manageProducts'])->name('staff.manageProducts');
Route::get('/staff/product/add', [StaffController::class, 'addProductForm'])->name('staff.addProductForm');
Route::post('/staff/product/add', [StaffController::class, 'addProduct'])->name('staff.addProduct');
Route::get('/staff/product/edit/{id}', [StaffController::class, 'editProductForm'])->name('staff.editProductForm');
Route::put('/staff/product/edit/{id}', [StaffController::class, 'editProduct'])->name('staff.editProduct');
Route::delete('/staff/product/delete/{id}', [StaffController::class, 'deleteProduct'])->name('staff.deleteProduct');
Route::get('staff/buyers', [StaffController::class, 'indexBuyers'])->name('staff.manageBuyers');
Route::get('staff/buyers/add', [StaffController::class, 'createBuyer'])->name('staff.createBuyer');
Route::post('staff/buyers/add', [StaffController::class, 'storeBuyer'])->name('staff.storeBuyer');
Route::get('staff/buyers/edit/{id}', [StaffController::class, 'editBuyer'])->name('staff.editBuyer');
Route::put('staff/buyers/edit/{id}', [StaffController::class, 'updateBuyer'])->name('staff.updateBuyer');
Route::delete('staff/buyers/delete/{id}', [StaffController::class, 'deleteBuyer'])->name('staff.deleteBuyer');

// Buyer dashboard route
Route::get('/buyer/dashboard', [BuyerController::class, 'dashboard'])->name('buyer.dashboard');
Route::post('/buyer/add-to-cart/{productId}', [BuyerController::class, 'addToCart'])
    ->name('buyer.addToCart');
Route::post('/buyer/remove-from-cart/{productId}', [BuyerController::class, 'removeFromCart'])
    ->name('buyer.removeFromCart');
