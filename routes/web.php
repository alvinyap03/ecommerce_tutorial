<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\BrowseController;
use App\Http\Controllers\CreateController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PurchaseController;




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
    Route::get('/main', [MainController::class, 'index'])->name('main');
    Route::post('/insert', [MainController::class, 'insert'])->name('insert');
    Route::middleware(['auth'])->group(function () {

    Route::post('/delete', [MainController::class, 'delete'])->name('delete');
    Route::post('/gotoupdate/{user_id}', [MainController::class, 'gotoupdate'])->name('gotoupdate');
    Route::post('/logout', [MainController::class, 'logout'])->name('logout');
    Route::get('/admin', [MainController::class, 'index'])->name('admin');
    Route::get('/purchase', [PurchaseController::class, 'index'])->name('purchase');


    // Protect UpdateController routes as well, if needed
    Route::get('/showUpdateForm/{user_id}', [UpdateController::class, 'showUpdateForm'])->name('update');
    Route::put('/update/{user}', [UpdateController::class, 'update'])->name('update.post');

    Route::get('/create', [CreateController::class, 'create'])->name('create');
    Route::post('/create', [CreateController::class, 'store'])->name('create.store');

});

Route::get('/', function () {
    return view('login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/browse', [BrowseController::class, 'index'])->name('browse');
Route::get('/go-to-admin', [BrowseController::class, 'goToAdmin'])->name('goToAdmin');
Route::post('/post', [BrowseController::class, 'store'])->name('post');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::delete('/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('remove.from.cart');
Route::post('/buy', [CartController::class, 'buy'])->name('buy');
