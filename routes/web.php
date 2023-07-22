<?php

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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin-login', [App\Http\Controllers\Admin\AdminController::class,'login'])->name('admin-login');
Route::post('/admin/login', [App\Http\Controllers\Admin\AdminLoginController::class,'login'])->name('admin.login');

Route::group(['middleware' => ['auth']], function() {
    Route::group(['middleware' => ['role:Admin']], function () {
        Route::prefix('admin')->name('admin.')->group(function() {
            Route::get('/', [App\Http\Controllers\Admin\AdminController::class,'index'])->name('admin');
            Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
            Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
            Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);
            Route::resource('authors', \App\Http\Controllers\Admin\AuthorController::class);
            Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
            Route::resource('settings', \App\Http\Controllers\Admin\SettingController::class);
            Route::post('addItemsSettings', [App\Http\Controllers\Admin\SettingController::class, 'addItemsSettings']);

        });
    });
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

