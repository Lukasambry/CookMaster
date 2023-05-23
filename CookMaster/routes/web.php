<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('room', \App\Http\Controllers\Admin\RoomController::class)->except(['show']);
});

Auth::routes();

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('user', \App\Http\Controllers\Admin\UserController::class)->except(['show']);
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('office', \App\Http\Controllers\Admin\OfficeController::class)->except(['show']);
});

Route::get('admin/office/list/{office}', [\App\Http\Controllers\Admin\OfficeController::class, 'list'])->name('admin.office.list');

Route::match(['get', 'post'], '/admin/users/{user}/unban', [\App\Http\Controllers\Admin\UserController::class, 'unban'])->name('admin.user.unban');
Route::match(['get', 'post'], '/admin/users/{user}/ban', [\App\Http\Controllers\Admin\UserController::class, 'ban'])->name('admin.user.ban');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


