<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CollectorController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoanCategoryController;
use App\Http\Controllers\Admin\LoanController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SubAccountController;
use App\Http\Controllers\Admin\TransactionTypeController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index'])->middleware('can:admin.home')->name('admin.home');

Route::resource('users', UserController::class)->only(['index','edit','update'])->names('admin.users');
Route::resource('roles', RoleController::class)->names('admin.roles');
Route::resource('clients', ClientController::class)->names('admin.clients');
Route::resource('partners', PartnerController::class)->names('admin.partners');
Route::resource('collectors', CollectorController::class)->names('admin.collectors');
Route::resource('loancategories', LoanCategoryController::class)->names('admin.loancategories');
Route::resource('loans', LoanController::class)->names('admin.loans');
Route::resource('payments', PaymentController::class)->names('admin.payments');
Route::resource('transactiontypes', TransactionTypeController::class)->names('admin.transactiontypes');
Route::resource('accounts', AccountController::class)->names('admin.accounts');
Route::resource('subaccounts', SubAccountController::class)->names('admin.subaccounts');
