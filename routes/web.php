<?php

use Illuminate\Support\Facades\Route;
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

// Route::get('/', function () {
//     return redirect('/dashboard');
// })->middleware('auth');

// Route::get('/', function () {
//     return redirect('/dashboard');
// })->middleware('auth');

Route::get('/', function () {
    return view('landing-page');
})->name('landing-page');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/Vposts', [PostsController::class, 'index'])->name('Vposts.index');
Route::get('/Vposts/create', [PostsController::class, 'create'])->name('Vposts.create');
Route::post('/Vposts', [PostsController::class, 'store'])->name('Vposts.store');

Route::get('/Vgalery', [GaleryController::class, 'index'])->name('Vgalery.index');
Route::post('/Vgaleri', [GaleryController::class, 'store'])->name('Vgalery.store');
Route::get('/Vgalery/{id}', [GaleryController::class, 'show'])->name('Vgalery.show');
Route::post('/Vgalery/{id}/upload', [GaleryController::class, 'uploadPhoto'])->name('Vgalery.uploadPhoto');
Route::post('/Vgaleri/{id}/upload', [FotoController::class, 'store'])->name('Vgalery.uploadPhoto');
Route::delete('/Vfoto/{id}', [FotoController::class, 'destroy'])->name('Vfoto.destroy');

Route::get('/Vfoto', [FotoController::class, 'index'])->name('Vfoto.index');
Route::get('/Vfoto/create', [FotoController::class, 'create'])->name('Vfoto.create');
Route::post('/Vfoto', [FotoController::class, 'store'])->name('Vfoto.store');

Route::get('/Vkategori', [KategoriController::class, 'index'])->name('Vkategori.index');
Route::post('V/kategori', [KategoriController::class, 'store'])->name('Vkategori.store');

Route::get('/tables', function () {
    return view('tables');
})->name('tables')->middleware('auth');

Route::get('/tables', function () {
    return view('tables');
})->name('tables')->middleware('auth');

Route::get('/wallet', function () {
    return view('wallet');
})->name('wallet')->middleware('auth');

Route::get('/profile', function () {
    return view('account-pages.profile');
})->name('profile')->middleware('auth');

Route::get('/signin', function () {
    return view('account-pages.signin');
})->name('signin');

Route::get('/signup', function () {
    return view('account-pages.signup');
})->name('signup')->middleware('guest');

Route::get('/sign-up', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('sign-up');

Route::post('/sign-up', [RegisterController::class, 'store'])
    ->middleware('guest');

Route::get('/sign-in', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('sign-in');

Route::post('/sign-in', [LoginController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'store'])
    ->middleware('guest');

Route::get('/laravel-examples/user-profile', [ProfileController::class, 'index'])->name('users.profile')->middleware('auth');
Route::put('/laravel-examples/user-profile/update', [ProfileController::class, 'update'])->name('users.update')->middleware('auth');
Route::get('/laravel-examples/users-management', [UserController::class, 'index'])->name('users-management')->middleware('auth');
