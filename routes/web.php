<?php

use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\TranslationController;
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
Route::prefix('{locale?}')
    ->middleware('setlocale')
    ->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', function () {
                if (Auth::user() && Auth::user()->can('isAdmin')) {
                    return redirect(\route('productIndex', app()->getLocale()));
                } else {
                    if (Auth::user()) {
                        return view('welcome');
                    } else {
                        return redirect()->route('login-view', app()->getLocale());
                    }
                }
            })->name('adminHome');


            Route::get('login', [AuthController::class, 'loginView'])->name('login-view');
            Route::post('login', [AuthController::class, 'login'])->name('login');


            Route::middleware(['auth', 'can:isAdmin'])->group(function () {
                Route::get('product', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('productIndex');
                Route::get('logout', [AuthController::class, 'logout'])->name('logout');

                Route::resource('languages', LanguageController::class)
                    ->name('index', 'languageIndex')
                    ->name('create', 'languageCreateView')
                    ->name('store', 'languageCreate')
                    ->name('edit', 'languageEditView')
                    ->name('update', 'languageUpdate')
                    ->name('destroy', 'languageDestroy')
                    ->name('show', 'languageShow');

                Route::resource('translations', TranslationController::class)
                    ->name('index', 'translationIndex')
                    ->name('store', 'translationStore')
                    ->name('create', 'translationCreate')
                    ->name('show', 'translationShow')
                    ->name('edit', 'translationEdit')
                    ->name('update', 'translationUpdate')
                    ->name('destroy', 'translationDestroy');

                // Features
                Route::resource('features', FeatureController::class)
                    ->name('index', 'featureIndex')
                    ->name('create', 'featureCreateView')
                    ->name('store', 'featureCreate')
                    ->name('edit', 'featureEditView')
                    ->name('update', 'featureUpdate')
                    ->name('destroy', 'featureDestroy')
                    ->name('show', 'featureShow');


            });


        });

        Route::get('/', function () {
            return view('welcome');
        })->name('welcome');

    });

