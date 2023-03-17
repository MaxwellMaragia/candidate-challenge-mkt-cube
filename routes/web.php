<?php

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

Route::controller(App\Http\Controllers\PostcardController::class)->group(function () {
    Route::get('/', 'index')->name('postcards.index');
    Route::get('/postcards/{postcard}', 'show')->name('postcards.show');
    Route::get('/search','search')->name('search');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\PostcardManagement::class,'index'])->name('dashboard');
    Route::get('/postcards-management/archive', [\App\Http\Controllers\PostcardManagement::class,'archive']);
    Route::post('/postcards-management/{postcard}/restore', [\App\Http\Controllers\PostcardManagement::class,'restore'])->withTrashed();
    Route::delete('/postcards-management/{postcard}/delete', [\App\Http\Controllers\PostcardManagement::class,'destroy'])->withTrashed();
});

//robots txt controller
Route::controller(\App\Http\Controllers\RobotsTxtController::class)->group(function (){
    Route::get('robots.txt', 'index');
});

Route::resource('postcards-management',\App\Http\Controllers\PostcardManagement::class);



