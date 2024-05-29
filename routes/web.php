<?php

use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// 表示
Route::view('/', 'index');

// お問い合わせ画面
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'sendMail']);
Route::get('/contact/complete', [ContactController::class, 'complete'])->name('contact.complete'); // 修正: GET メソッドを許可

// 管理画面
Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        // ログイン時のみアクセス可能なルート
        Route::middleware('auth')->group(function () {
            // ブログ
            Route::resource('blogs', AdminBlogController::class)->except('show'); // 修正: resources → resource
            // ユーザー登録画面
            Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
            // ユーザー登録処理
            Route::post('/users', [UserController::class, 'store'])->name('users.store');
            // ログアウト
            Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        });

        // 未ログイン時のみアクセス可能なルート
        Route::middleware('guest')->group(function () {
            // ログイン画面
            Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
            // ログイン処理
            Route::post('/login', [AuthController::class, 'login']);
        });
    });
