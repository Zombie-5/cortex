<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\SignInController;
use App\Http\Controllers\auth\signUpController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\user\IndexUsersController;
use App\Http\Controllers\admin\product\IndexProductsController;
use App\Http\Controllers\admin\bank\IndexBanksController;
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

});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dash', function () {
    return view('admin.dashboard');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});
