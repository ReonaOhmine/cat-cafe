<?php

use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index');

//お問い合わせ画面
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'sendMail']);
Route::get('/contact/complete', [ContactController::class, 'complete'])->name('contact.complete'); // 修正: GET メソッドを許可

//ブログ一覧画面
Route::get('Admin/blogs', [AdminBlogController::class, 'index'])->name('admin.blogs.index');
//ブログ投稿画面
Route::get('Admin/blogs/create', [AdminBlogController::class, 'create'])->name('admin.blogs.create');
//ブログ投稿処理
Route::post('Admin/blogs', [AdminBlogController::class, 'store'])->name('admin.blogs.store');
//指定したIDのブログ編集画面
Route::get('Admin/blogs/{blog}', [AdminBlogController::class, 'edit'])->name('admin.blogs.edit');
//指定したIDのブログ更新処理
Route::put('Admin/blogs/{blog}', [AdminBlogController::class, 'update'])->name('admin.blogs.update');
//指定したIDのブログ削除処理
Route::delete('Admin/blogs/{blog}', [AdminBlogController::class, 'destroy'])->name('admin.blogs.destroy');
