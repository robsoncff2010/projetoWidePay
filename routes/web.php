<?php

use App\Http\Controllers\Sistema\Url\UrlController;
use Illuminate\Support\Facades\Auth;
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

Route::group(['middleware' => ['auth'], 'prefix' => '/'], function () {
    Route::get('', [UrlController::class, 'index'])->name('index');
    Route::get('lista', [UrlController::class, 'index'])->name('indexList');
    Route::post('getList', [UrlController::class, 'getList'])->name('getList');
    Route::post('urlRegister', [UrlController::class, 'store'])->name('urlRegister');
    Route::post('urlEdit', [UrlController::class, 'edit'])->name('urlEdit');
    Route::post('urlDelete', [UrlController::class, 'destroy'])->name('urlDelete');
});

Auth::routes();
