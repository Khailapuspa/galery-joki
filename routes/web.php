<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommentController;

// Landing Page
Route::get('/', function () {
    return view('landing-page');
})->name('landing-page');
Route::get('/landing-page', [LandingPageController::class, 'showTrending']);

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware(['auth', 'checkEmailDomain']); // Middleware diterapkan disini

// Posts Routes
Route::get('/Vposts', [PostsController::class, 'index'])->name('Vposts.index')->middleware('checkEmailDomain');
Route::get('/Vposts/create', [PostsController::class, 'create'])->name('Vposts.create')->middleware('checkEmailDomain');
Route::post('/Vposts', [PostsController::class, 'store'])->name('posts.store')->middleware('checkEmailDomain');
Route::get('/Vpost/edit/{id}', [PostsController::class, 'edit'])->name('posts.edit')->middleware('checkEmailDomain');
Route::put('/Vposts/{post}', [PostsController::class, 'update'])->name('posts.update')->middleware('checkEmailDomain');
Route::get('/Vposts/{id}', [PostsController::class, 'show'])->name('Vposts.show');
Route::post('/posts/{post}/like', [PostsController::class, 'like'])->name('posts.like');

// Gallery Routes
Route::get('/Vgalery', [GaleryController::class, 'index'])->name('Vgalery.index')->middleware('checkEmailDomain');
Route::post('/Vgaleri', [GaleryController::class, 'store'])->name('Vgalery.store')->middleware('checkEmailDomain');
Route::get('/Vgalery/{id}', [GaleryController::class, 'show'])->name('Vgalery.show')->middleware('checkEmailDomain');
Route::post('/Vgalery/{id}/upload', [GaleryController::class, 'uploadPhoto'])->name('Vgalery.uploadPhoto')->middleware('checkEmailDomain');
Route::post('/Vgaleri/{id}/upload', [FotoController::class, 'store'])->name('Vgalery.uploadPhoto')->middleware('checkEmailDomain');
Route::put('Vgalery/{id}', [GaleryController::class, 'update'])->name('Vgalery.update')->middleware('checkEmailDomain');
Route::delete('Vgalery/{id}', [GaleryController::class, 'destroy'])->name('Vgalery.destroy')->middleware('checkEmailDomain');

// Photo Routes
Route::get('/Vfoto', [FotoController::class, 'index'])->name('Vfoto.index')->middleware('checkEmailDomain');
Route::get('/Vfoto/create', [FotoController::class, 'create'])->name('Vfoto.create')->middleware('checkEmailDomain');
Route::post('/Vfoto', [FotoController::class, 'store'])->name('Vfoto.store')->middleware('checkEmailDomain');
Route::get('Vfoto/{id}/edit', [FotoController::class, 'edit'])->name('Vfoto.edit')->middleware('checkEmailDomain');
Route::put('Vfoto/{id}', [FotoController::class, 'update'])->name('Vfoto.update')->middleware('checkEmailDomain');
Route::delete('/Vfoto/{id}', [FotoController::class, 'destroy'])->name('Vfoto.destroy')->middleware('checkEmailDomain');

// Category Routes
Route::get('/Vkategori', [KategoriController::class, 'index'])->name('Vkategori.index')->middleware('checkEmailDomain');
Route::post('/Vkategori', [KategoriController::class, 'store'])->name('Vkategori.store')->middleware('checkEmailDomain');
Route::put('/Vkategori/{id}', [KategoriController::class, 'update'])->name('Vkategori.update')->middleware('checkEmailDomain');
Route::delete('/Vkategori/{id}', [KategoriController::class, 'destroy'])->name('Vkategori.destroy')->middleware('checkEmailDomain');

// Komentar
Route::post('posts/{post}/comment', [CommentController::class, 'store'])->name('posts.comment');

// Authenticated User Pages
Route::middleware(['auth', 'checkEmailDomain'])->group(function () {
    Route::view('/tables', 'tables')->name('tables');
    Route::view('/wallet', 'wallet')->name('wallet');
    Route::view('/profile', 'account-pages.profile')->name('profile');
});

// Account Pages
Route::view('/signin', 'account-pages.signin')->name('signin');
Route::view('/signup', 'account-pages.signup')->name('signup')->middleware('guest');

// Registration & Login
Route::get('/sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('sign-up');
Route::post('/sign-up', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/sign-in', [LoginController::class, 'create'])->middleware('guest')->name('sign-in');
Route::post('/sign-in', [LoginController::class, 'store'])->middleware('guest');

Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

// Password Reset
Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'store'])->middleware('guest');

// User Profile and Management
Route::middleware(['auth', 'checkEmailDomain'])->group(function () {
    Route::get('/laravel-examples/user-profile', [ProfileController::class, 'index'])->name('users.profile');
    Route::put('/laravel-examples/user-profile/update', [ProfileController::class, 'update'])->name('users.update');
    Route::get('/laravel-examples/users-management', [UserController::class, 'index'])->name('users-management');
});

