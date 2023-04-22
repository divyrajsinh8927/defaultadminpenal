<?php

use App\Http\Controllers\Admin\deshboardController;
use App\Http\Controllers\Admin\SystemSettingController;
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
    Route::post('/profile/number/update', [ProfileController::class, 'update_mobile_number'])->name('mobile.number.update');

    //User Management Route
    Route::get('/User/manageement', [UserManagementController::class, 'index'])->name('user.management');
    Route::post('/get/users', [UserManagementController::class, 'getUsers'])->name('get.user');
    Route::get('/get/user/roles', [UserManagementController::class, 'role_for_option'])->name('get.user.role');
    Route::post('/add/user', [UserManagementController::class, 'add_user'])->name('add.user');
    Route::post('/delete/user', [UserManagementController::class, 'delete_user'])->name('delete.user');
    Route::post('/edit/user', [UserManagementController::class, 'edit_user'])->name('edit.user');
    Route::post('/update/user', [UserManagementController::class, 'update_user'])->name('update.user');

    //Setting Routes
    Route::get('/settings', [SystemSettingController::class, 'index'])->name('admin.settings');
    Route::post('/set/system/setting', [SystemSettingController::class, 'system_setting'])->name('set.system.settings');
    Route::post('/set/app/name', [SystemSettingController::class, 'set_app_name'])->name('app.name.settings');
    Route::post('/set/project/logo', [SystemSettingController::class, 'set_project_logo'])->name('project.logo.settings');
    Route::post('/set/app/logo', [SystemSettingController::class, 'set_app_logo'])->name('app.logo.settings');

});
