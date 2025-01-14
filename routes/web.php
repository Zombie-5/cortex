<?php

use App\Http\Controllers\admin\product\DestroyProductController;
use App\Http\Controllers\admin\product\StoreProductController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\SignInController;
use App\Http\Controllers\auth\signUpController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\user\IndexUsersController;
use App\Http\Controllers\admin\product\IndexProductsController;
use App\Http\Controllers\admin\bank\IndexBanksController;
use App\Http\Controllers\admin\product\UpdateProductController;
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

Route::get('', [SignInController::class, 'signIn'])->name('auth.signIn');
Route::post('/sign-in', [SignInController::class, 'authenticate'])->name('auth.authenticate');

Route::get('/sign-up', [signUpController::class, 'signUp'])->name('auth.signUp');
Route::post('/store/sign-up', [signUpController::class, 'store'])->name('auth.store');

Route::prefix('/admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/user-index', [IndexUsersController::class, 'index'])->name('admin.user.index');
    Route::get('/product-index', [IndexProductsController::class, 'index'])->name('admin.product.index');
    Route::get('/bank-index', [IndexBanksController::class, 'index'])->name('admin.bank.index');

    Route::post('/product-store', [StoreProductController::class, 'store'])->name('admin.product.store');

    //Route::put('/product/update/{produto}', [UpdateProductController::class, 'update'])->name('admin.product.update');

    Route::delete('/product/{id}/delete', [DestroyProductController::class, 'destroy'])->name('admin.product.destroy');

});

Route::put('/welcome', function () {
    return dd('oioi directo');
})->name('admin.product.update');
