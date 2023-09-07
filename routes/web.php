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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(\App\Http\Controllers\PostController::class)->group(function () {
    Route::get('/post', 'create')->name('post.create');
    Route::post('/post/store', 'store')->name('post.store');
    Route::get('/post-status/{id}', 'post_status')->name('post.status');
});

Route::controller(\App\Http\Controllers\SettingController::class)->group(function () {
    Route::get('/website-settings', 'index')->name('setting.index');
    Route::get('/website/add', 'add_website')->name('setting.website.add');
    Route::post('/website/store', 'store_website')->name('setting.website.store');
    Route::get('/website/edit/{id}', 'edit_website')->name('setting.website.edit');
    Route::post('/website/update/{id}', 'update_website')->name('setting.website.update');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
