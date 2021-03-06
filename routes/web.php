<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('permission-denied', [PagesController::class, 'permissionDenied'])->name('permission-denied');

// 用户身份验证相关的路由
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// 用户注册相关路由
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// 密码重置相关路由
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Email 认证相关路由
Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

Route::match(['put', 'patch'], 'users/{id}', [UsersController::class, 'update'])->name('users.update');
Route::get('users/{id}', [UsersController::class, 'show'])->name('users.show');
Route::get('users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');

Route::get('/topics', [PagesController::class, 'home'])->name('topics.index');
Route::get('/topics/create', [TopicsController::class, 'create'])->name('topics.create');
Route::post('/topics', [TopicsController::class, 'store'])->name('topics.store');
Route::get('/topics/{id}/edit', [TopicsController::class, 'edit'])->name('topics.edit');
Route::match(['put', 'patch'], '/topics/{id}', [TopicsController::class, 'update'])->name('topics.update');
Route::delete('/topics/{id}', [TopicsController::class, 'destroy'])->name('topics.destroy');
Route::get('topics/{id}/{slug?}', [TopicsController::class, 'show'])->name('topics.show');// 末尾

Route::get('categories/{id}', [TopicsController::class, 'category'])->name('categories.topics.index');

Route::post('images', [ImagesController::class, 'store'])->name('images.store');

Route::post('replies', [RepliesController::class, 'store'])->name('replies.store');
Route::delete('replies/{id}', [RepliesController::class, 'destroy'])->name('replies.destroy');

Route::get('notifications', [NotificationsController::class, 'index'])->name('notifications.index');
