<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\User\PostController as UserPostController;
use App\Http\Controllers\UserController;
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

Route::get('/', [PostController::class, 'index'])->name('home');
Route::post('/', [PostController::class, 'store'])->name('home.store');

Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::middleware('guest')->controller(UserController::class)->group(function () {
    Route::get('/signup', 'create')->name('sign_up.create');
    Route::post('/signup', 'store')->name('sign_up.store');
    Route::get('/signin', 'loginForm')->name('login.create');
    Route::post('/signin', 'login')->name('login');
});

Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('user')->prefix('user')->name('user.')->group(function () {
    Route::resource('/posts', UserPostController::class);
});

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('/posts', AdminController::class);
});
