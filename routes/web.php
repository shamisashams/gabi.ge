<?php

use App\Http\Controllers\Auth\AuthController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        if (Auth::user() && Auth::user()->can('isAdmin')) {
//            return redirect(\route('productIndex', app()->getLocale()));
        } else {
            if (Auth::user()) {
                return view('welcome');
            } else {
                return redirect()->route('login-view', app()->getLocale());
            }
        }
    })->name('adminHome');

    Route::get('login', [AuthController::class, 'loginView'])->name('login-view');
});
