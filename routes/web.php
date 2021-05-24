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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::group([
    'prefix' => 'en',
], function () {

    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            if (Auth::user() && Auth::user()->can('isAdmin')) {
                return redirect(\route('productIndex'));
            } else {
                if (Auth::user()) {
                    return view('welcome');
                } else {
                    return redirect()->route('login-view');
                }
            }
        })->name('adminHome');

        Route::get('/', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('productIndex');

        Route::get('login', [AuthController::class, 'loginView'])->name('login-view');

        Route::post('login', [AuthController::class, 'login'])->name('login');

        Route::get('logout', [AuthController::class, 'logout'])->name('logout');

//        Route::get('/', function () {
//            return view('welcome');
//        })->name('welcome');

    });

});

