<?php

use App\Http\Controllers\admin\bank\DestroybankController;
use App\Http\Controllers\admin\bank\StorebankController;
use App\Http\Controllers\admin\GiftController;
use App\Http\Controllers\admin\product\DestroyProductController;
use App\Http\Controllers\admin\product\StoreProductController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\SignInController;
use App\Http\Controllers\auth\signUpController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\user\IndexUsersController;
use App\Http\Controllers\admin\product\IndexProductsController;
use App\Http\Controllers\admin\bank\IndexBanksController;
use App\Http\Controllers\admin\bank\UpdateBankController;
use App\Http\Controllers\admin\IndexTransactionController;
use App\Http\Controllers\admin\product\UpdateProductController;
use App\Http\Controllers\admin\transaction\updateTransactionController;
use App\Http\Controllers\auth\SignOutController;
use App\Http\Controllers\client\AccountController;
use App\Http\Controllers\client\BankController;
use App\Http\Controllers\client\ChangePasswordController;
use App\Http\Controllers\client\DepositController;
use App\Http\Controllers\client\GiftController as ClientGiftController;
use App\Http\Controllers\client\HoldingController;
use App\Http\Controllers\client\HomeController;
use App\Http\Controllers\client\MarketController;
use App\Http\Controllers\client\RecordController;
use App\Http\Controllers\client\TeamController;
use App\Http\Controllers\client\WithdrawController;
use App\Models\Transaction;
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

Route::get('/sign-up/{invite_code?}', [signUpController::class, 'signUp'])->name('auth.signUp');
Route::post('/store/sign-up', [signUpController::class, 'store'])->name('auth.store');

Route::get('/callback', function () {
    return view('client.bank-choose');
});

Route::prefix('/site')->group(function () {

    Route::post('/sign-out', [SignOutController::class, 'signOut'])->name('auth.signOut');

    Route::prefix('/client')->group(function () {

        Route::get('/home', [HomeController::class, 'home'])->name('client.home');
        Route::get('/market', [MarketController::class, 'market'])->name('client.market');
        Route::get('/holdings', [HoldingController::class, 'holdings'])->name('client.holdings');
        Route::get('/account', [AccountController::class, 'account'])->name('client.account');
        Route::get('/deposit', [DepositController::class, 'deposit'])->name('client.deposit');
        Route::get('/withdraw', [WithdrawController::class, 'withdraw'])->name('client.withdraw');
        Route::get('/team', [TeamController::class, 'team'])->name('client.team');
        Route::get('/record', [RecordController::class, 'record'])->name('client.record');
        Route::get('/record/deposit', [RecordController::class, 'record_deposit'])->name('client.record.deposit');
        Route::get('/record/withdraw', [RecordController::class, 'record_withdraw'])->name('client.record.withdraw');
        Route::get('/change-passord', [ChangePasswordController::class, 'change'])->name('client.change-passord');
        Route::get('/gift', [ClientGiftController::class, 'gift'])->name('client.gift');
        Route::get('/bank', [BankController::class, 'bank'])->name('client.bank');
        Route::get('/bank/choose', [BankController::class, 'bank_choose'])->name('client.bank.choose');

        Route::post('/market/invest/{productId}', [MarketController::class, 'invest'])->name('client.invest');
        Route::post('/holding/claim', [HoldingController::class, 'claim'])->name('client.claim');
        Route::post('/deposit/store', [DepositController::class, 'store'])->name('client.deposit.store');
        Route::post('/withdraw/store', [WithdrawController::class, 'store'])->name('client.withdraw.store');
        Route::post('/bank/store', [BankController::class, 'store'])->name('client.bank.store');
        Route::post('/change/passord', [ChangePasswordController::class, 'changePassword'])->name('client.change.passord');
        Route::post('/gift/redeem', [ClientGiftController::class, 'redeem'])->name('client.gift.redeem');

    });

    Route::prefix('/admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/user-index', [IndexUsersController::class, 'index'])->name('admin.user.index');
        Route::get('/product-index', [IndexProductsController::class, 'index'])->name('admin.product.index');
        Route::get('/bank-index', [IndexBanksController::class, 'index'])->name('admin.bank.index');
        Route::get('/transaction-index', [IndexTransactionController::class, 'index'])->name('admin.transaction.index');
        Route::get('/gift-index', [GiftController::class, 'index'])->name('admin.gift.index');
    
        Route::post('/product-store', [StoreProductController::class, 'store'])->name('admin.product.store');
        Route::post('/bank-store', [StorebankController::class, 'store'])->name('admin.bank.store');
        Route::post('/gift-store', [GiftController::class, 'store'])->name('admin.gift.store');
    
        Route::put('/products/{id}/update', [UpdateProductController::class, 'update'])->name('admin.product.update');
        Route::put('/bank/{id}/update', [UpdateBankController::class, 'update'])->name('admin.bank.update');
        
        Route::delete('/product/{id}/delete', [DestroyProductController::class, 'destroy'])->name('admin.product.destroy');
        Route::delete('/bank/{id}/delete', [DestroybankController::class, 'destroy'])->name('admin.bank.destroy');
        Route::delete('/gift/{id}/delete', [GiftController::class, 'destroy'])->name('admin.gift.destroy');

        Route::patch('/transactions/status/{id}', [updateTransactionController::class, 'updateStatus'])->name('admin.transaction.status');
    
    });
});