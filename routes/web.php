<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AthenticationController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ AthenticationController::class, 'index' ]);
Route::get('/login', [ AthenticationController::class, 'index' ])->name('login');
Route::get('/logout', [ AthenticationController::class, 'logout' ])->name('logout');
Route::post('/authenticate', [ AthenticationController::class, 'authenticate' ])->name('authenticate');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ DashboardController::class, 'index' ])->name('dashboard');
    Route::get('/profile', [ UserController::class, 'profile' ])->name('profile');
    Route::post('/updateProfile', [ UserController::class, 'updateProfile' ])->name('updateProfile');


    Route::middleware(['admin'])->group(function () {
        Route::get('/users', [ UserController::class, 'users' ])->name('users');
        Route::get('/user/edit/{id}', [ UserController::class, 'editUser' ])->name('editUser');
        Route::get('/user/delete/{id}', [ UserController::class, 'deleteUser' ])->name('deleteUser');
        Route::post('/user/updateUser/{id}', [ UserController::class, 'updateUser' ])->name('updateUser');
    });

    Route::get('/courses', [ DashboardController::class, 'index' ])->name('courses');
    
});