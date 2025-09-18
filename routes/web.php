<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TagController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    // 首页 - 交易记录列表
    Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');
    
    // 交易记录相关路由
    Route::resource('transactions', TransactionController::class)->except(['index']);
    
    // 分类管理
    Route::resource('categories', CategoryController::class);
    
    // 账户管理
    Route::resource('accounts', AccountController::class);
    
    // 成员管理
    Route::resource('members', MemberController::class);
    
    // 标签管理
    Route::resource('tags', TagController::class);
    
    // 统计报表
    Route::get('/reports', [TransactionController::class, 'reports'])->name('reports');
});
