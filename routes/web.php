<?php

use App\Http\Controllers\Admin\deshboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\auth\ProfileController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\Controller;
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

Route::redirect('/', '/login');

Route::group(['middleware' => ['guest']], function () {
    // login Routes
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('user.login');

    //Register Routs
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/user/register', [RegisterController::class, 'register'])->name('register.perform');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [deshboardController::class, 'index'])->name('deshboard');

    //logut Routes
    Route::post('/user/logout', [LoginController::class, 'logout'])->name('logout');

    //profile Route
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/email/update', [ProfileController::class, 'updateEmail'])->name('email.update');
    Route::post('/profile/password/update', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::post('/profile/picture/update', [ProfileController::class, 'update_profile_picture'])->name('profile.picture.update');

    //User Management Route
    Route::get('/User/manageement', [UserManagementController::class, 'index'])->name('user.management');
    Route::post('/get/users', [UserManagementController::class, 'getUsers'])->name('get.user');
    Route::get('/get/user/roles', [UserManagementController::class, 'role_for_option'])->name('get.user.role');
    Route::post('/add/user', [UserManagementController::class, 'add_user'])->name('add.user');
    Route::post('/delete/user', [UserManagementController::class, 'delete_user'])->name('delete.user');

    //Setting Routes
    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings');
    Route::post('/set/theme', [SettingController::class, 'set_theme'])->name('theme.settings');
    Route::post('/set/app/name', [SettingController::class, 'set_app_name'])->name('app.name.settings');
    Route::post('/set/app/logo', [SettingController::class, 'set_app_logo'])->name('app.logo.settings');

});
