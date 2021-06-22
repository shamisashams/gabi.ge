<?php

use App\Http\Controllers\Admin\AnswerController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TranslationController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

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

                Route::resource('products', ProductController::class)
                    ->name('index', 'productIndex')
                    ->name('store', 'productStore')
                    ->name('create', 'productCreate')
                    ->name('show', 'productShow')
                    ->name('edit', 'productEdit')
                    ->name('update', 'productUpdate')
                    ->name('destroy', 'productDestroy');

                Route::resource('category', CategoryController::class)
                    ->name('index', 'categoryIndex')
                    ->name('create', 'categoryCreateView')
                    ->name('store', 'categoryCreate')
                    ->name('edit', 'categoryEditView')
                    ->name('update', 'categoryUpdate')
                    ->name('destroy', 'categoryDestroy')
                    ->name('show', 'categoryShow');

                // Features
                Route::resource('features', FeatureController::class)
                    ->name('index', 'featureIndex')
                    ->name('create', 'featureCreateView')
                    ->name('store', 'featureCreate')
                    ->name('edit', 'featureEditView')
                    ->name('update', 'featureUpdate')
                    ->name('destroy', 'featureDestroy')
                    ->name('show', 'featureShow');

                // Answers
                Route::resource('answers', AnswerController::class)
                    ->name('index', 'answerIndex')
                    ->name('store', 'answerStore')
                    ->name('show', 'answerShow')
                    ->name('create', 'answerCreate')
                    ->name('edit', 'answerEdit')
                    ->name('update', 'answerUpdate')
                    ->name('destroy', 'answerDestroy');

                // Settings
                Route::resource('settings', SettingController::class)->except('destroy')
                    ->name('index', 'settingIndex')
                    ->name('create', 'settingCreateView')
                    ->name('store', 'settingCreate')
                    ->name('edit', 'settingEditView')
                    ->name('update', 'settingUpdate')
                    ->name('show', 'settingShow');

                Route::resource('pages', PageController::class)->except('destroy')
                    ->name('index', 'pageIndex')
                    ->name('create', 'pageCreateView')
                    ->name('store', 'pageCreate')
                    ->name('edit', 'pageEditView')
                    ->name('update', 'pageUpdate')
                    ->name('show', 'pageShow');

                Route::resource('sales', SaleController::class)
                    ->name('index', 'saleIndex')
                    ->name('create', 'saleCreateView')
                    ->name('store', 'saleCreate')
                    ->name('edit', 'saleEditView')
                    ->name('update', 'saleUpdate')
                    ->name('show', 'saleShow')
                    ->name('destroy', 'saleDestroy');

                Route::resource('slider', SliderController::class)
                    ->name('index', 'sliderIndex')
                    ->name('create', 'sliderCreateView')
                    ->name('store', 'sliderCreate')
                    ->name('edit', 'sliderEditView')
                    ->name('update', 'sliderUpdate')
                    ->name('destroy', 'sliderDestroy')
                    ->name('show', 'sliderShow');
            });
        });
        Route::middleware(['active'])->group(function () {
            Route::get('/', [HomeController::class, 'index'])->name('welcome');

            Route::get('/catalogue/{category}', [CatalogueController::class, 'catalogue'])->name('catalogue');
            Route::get('/catalogue/{category}/details/{product}', [CatalogueController::class, 'show'])->name('productDetails');

            Route::get('/addcartcount/{id}/{type}', [CartController::class, 'addCartCount'])->name('addCartCount');
            Route::get('/removefromcart', [CartController::class, 'removeFromCart'])->name('removeFromCart');
            Route::get('/addtocart/{id}', [CartController::class, 'addToCart'])->name('addToCart');
            Route::get('/getcartcount', [CartController::class, 'getCartCount'])->name('getCartCount');

            //Login


            Route::get('/login-view',[\App\Http\Controllers\Auth\AuthFrontendController::class,'loginView'])->name('loginViewFront');
            Route::post('/register',[\App\Http\Controllers\Auth\AuthFrontendController::class,'register'])->name('register');
            Route::post('login', [\App\Http\Controllers\Auth\AuthFrontendController::class, 'login'])->name('loginFront');
            Route::get('cart', [CartController::class, 'index'])->name('cart');

            Route::middleware(['active'])->group(function () {
                Route::get('logout', [\App\Http\Controllers\Auth\AuthFrontendController::class, 'logout'])->name('logoutFront');
            });

        });
    });

