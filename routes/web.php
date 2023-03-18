<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
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



Route::middleware('auth')->group(function () {
    Route::get('/userProducts', [UsersController::class, 'userProducts'])->name('userProducts');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('index');
    #products
    Route::get('/products', [ProductsController::class, 'index'])->name('products');
    Route::get('/products/getProducts', [ProductsController::class, 'getProducts'])->name('getProducts');
    Route::get('/addProduct', [ProductsController::class, 'addProduct'])->name('addProduct');
    Route::post('/saveProduct', [ProductsController::class, 'saveProduct'])->name('saveProduct');
    Route::post('/deleteProduct/{id}', [ProductsController::class, 'deleteProduct'])->name('deleteProduct');
    Route::post('/editProduct/{id}/', [ProductsController::class, 'editProduct'])->name('editProduct');
    Route::post('/updateProduct', [ProductsController::class, 'updateProduct'])->name('updateProduct');
    Route::get('/getProductsToAssign', [ProductsController::class, 'getProductsToAssign'])->name('getProductsToAssign');

    #users
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::get('/addUser', [UsersController::class, 'addUser'])->name('addUser');
    Route::post('/storeUser', [UsersController::class, 'storeUser'])->name('storeUser');
    Route::post('/updateUser', [UsersController::class, 'updateUser'])->name('updateUser');
    Route::post('/deleteUser/{id}', [UsersController::class, 'deleteUser'])->name('deleteUser');
    Route::post('/editUser/{id}', [UsersController::class, 'editUser'])->name('editUser');
    Route::get('/getUsers', [UsersController::class, 'getUsers'])->name('getUsers');
    Route::post('/assignSave', [UsersController::class, 'assignSave'])->name('assignSave');
});
require __DIR__ . '/auth.php';
