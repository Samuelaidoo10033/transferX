<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\AddAccountsController;
use App\Http\Controllers\AddRecipientController;
use App\Http\Controllers\BankListController;
use App\Http\Controllers\CancelTransactionController;
use App\Http\Controllers\CompleteForgotPasswordController;
use App\Http\Controllers\ConfirmPaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeleteAccountsController;
use App\Http\Controllers\DeleteRecipientController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GetRecipientTransactionHistory;
use App\Http\Controllers\GetTransactionController;
use App\Http\Controllers\GetWalletController;
use App\Http\Controllers\GetWalletDetailsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\RecipientsController;
use App\Http\Controllers\SendMoneyController;
use App\Http\Controllers\ShowRecipientController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\SignOutController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\UpdateAccountController;
use App\Http\Controllers\UpdateRecipientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/sign-in', SignInController::class);
Route::post('/sign-out', SignOutController::class);
Route::post('/sign-up', SignUpController::class);
Route::post('/forgot-password', ForgotPasswordController::class);
Route::post('/complete-forgot-password', CompleteForgotPasswordController::class);

Route::get('/rates',RateController::class);

Route::middleware(['auth:api'])->group(function () {

    //Profile
    Route::prefix('profile')->group(function() {
        Route::get('', [ProfileController::class, 'index'])->name('profile.show');
        Route::post('update', [ProfileController::class, 'update'])->name('profile.update');
    });


    //Recipients
    Route::get('/recipients', RecipientsController::class);
    Route::post('/recipients', AddRecipientController::class);
    Route::get('/recipients/{recipient}', ShowRecipientController::class);
    Route::delete('/recipients/{recipient}', DeleteRecipientController::class);
    Route::put('/recipients/{recipient}', UpdateRecipientController::class);
    Route::get('/transaction-history/{recipient}', GetRecipientTransactionHistory::class);


    //Transactions
    Route::post('/send-money', SendMoneyController::class);
    Route::post('/confirm-payment/{reference}', ConfirmPaymentController::class);
    Route::post('/cancel-transaction/{reference}', CancelTransactionController::class);
    Route::get('/transaction/{reference}', GetTransactionController::class);
    Route::get('/transactions', TransactionsController::class);


    //Bank List
    Route::get('/bank-list', BankListController::class);

    //Dashboard
    Route::get('dashboard', DashboardController::class);

    //Accounts
    Route::get('/accounts', AccountsController::class);
    Route::post('/accounts', AddAccountsController::class);
    Route::put('/accounts/{account}', UpdateAccountController::class);
    Route::get('/accounts/{account}', DeleteAccountsController::class);
    Route::get('/wallets', GetWalletController::class);
    Route::get('/wallet/{wallet}', GetWalletDetailsController::class);




});
