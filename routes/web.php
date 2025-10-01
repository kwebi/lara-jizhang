<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return to_route('transactions.index');
});

// 登录页面路由
Route::get('/login', [LoginController::class, 'index'])->name('login');
// 登录处理路由
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
# 登出路由
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register'); // 新增这个路由
Route::post('/register', [RegisterController::class, 'store'])->name('register.store') ; // 新增这个路由



Route::middleware(['auth'])->group(function () {
    // 首页 - 交易记录列表
    
    // 交易记录相关路由
    Route::resource('transactions', TransactionController::class);
    
    // 分类管理
    Route::resource('categories', CategoryController::class);
    
    // 账户管理
    Route::resource('accounts', AccountController::class);
    
    // 成员管理
    Route::resource('members', MemberController::class);
    
    // 标签管理
    Route::resource('tags', TagController::class);

    //用户管理
    Route::resource('users', UserController::class);
    
    // 统计报表
    // Route::get('/reports', [TransactionController::class, 'reports'])->name('reports');
});
