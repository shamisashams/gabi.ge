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
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;
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
        Route::prefix('adminpanel')->group(function () {
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

                Route::get('feature-answers/{id}', [ProductController::class, 'getFeatureAnswers'])
                    ->name('productFeatureAnswers');

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

                Route::resource('user', \App\Http\Controllers\Admin\UserController::class)
                    ->name('index', 'userIndex')
                    ->name('create', 'userCreateView')
                    ->name('store', 'userCreate')
                    ->name('edit', 'userEditView')
                    ->name('update', 'userUpdate')
                    ->name('destroy', 'userDestroy')
                    ->name('show', 'userShow');

                Route::resource('order', \App\Http\Controllers\Admin\OrderController::class)
                    ->name('index', 'orderIndex')
                    ->name('create', 'orderCreateView')
                    ->name('store', 'orderCreate')
                    ->name('edit', 'orderEditView')
                    ->name('update', 'orderUpdate')
                    ->name('destroy', 'orderDestroy')
                    ->name('show', 'orderShow');
                Route::resource('subscriber', \App\Http\Controllers\Admin\SubscriberController::class)
                    ->name('index', 'subscriberIndex')

                    ->name('destroy', 'subscriberDestroy');
            });
        });
        Route::middleware(['active'])->group(function () {
            Route::get('/', [HomeController::class, 'index'])->name('welcome');

            Route::get('/catalogue/{category}', [CatalogueController::class, 'catalogue'])->name('catalogue');
            Route::get('/catalogue/{category}/details/{product}', [CatalogueController::class, 'show'])->name('productDetails');

            //Route::fallback(CatalogueController::class.'@proxy')->name('product-catalog');



            Route::get('/addcartcount/{id}/{type}', [CartController::class, 'addCartCount'])->name('addCartCount');
            Route::get('/removefromcart', [CartController::class, 'removeFromCart'])->name('removeFromCart');
            Route::get('/addtocart/{id}', [CartController::class, 'addToCart'])->name('addToCart');
            Route::get('/getcartcount', [CartController::class, 'getCartCount'])->name('getCartCount');
            Route::get('/getFeatures/{id}', [HomeController::class, 'getSingleProductFeaturesApi'])->name('getFeatures');

            //Login


            Route::get('/login-view', [\App\Http\Controllers\Auth\AuthFrontendController::class, 'loginView'])->name('loginViewFront');
            Route::post('/register', [\App\Http\Controllers\Auth\AuthFrontendController::class, 'register'])->name('register');
            Route::post('login', [\App\Http\Controllers\Auth\AuthFrontendController::class, 'login'])->name('loginFront');
            Route::get('cart', [CartController::class, 'index'])->name('cart');
            Route::match(['get', 'post'], 'contact-us', [ContactController::class, 'index'])->name('contactUs');
            Route::get('about-us', [\App\Http\Controllers\AboutController::class, 'index'])->name('aboutUs');
            Route::get('helps', function () {
                return view('pages.helps.index');
            })->name('helps');

            Route::get('/facebook-auth', [AuthController::class, 'facebookAuth'])->name('facebookAuth');

//            Route::get('/faceook-callback', [AuthController::class],);

            Route::middleware(['authFront'])->group(function () {
                Route::get('logout', [\App\Http\Controllers\Auth\AuthFrontendController::class, 'logout'])->name('logoutFront');
                Route::get('profile', [UserController::class, 'index'])->name('profile');
                Route::post('profile-update', [UserController::class, 'update'])->name('profileUpdate');
                Route::post('change-password', [UserController::class, 'changePassword'])->name('changePassword');
                Route::post('save-order', [PurchaseController::class, 'saveOrder'])->name('saveOrder');
                Route::get('order-details/{id}', [UserController::class, 'orderDetails'])->name('orderDetails');
                Route::get('download-pdf/{id}', [UserController::class, 'downloadPdf'])->name('downloadPdf');
            });

            Route::get('privacy-policy', function () {
                return view('auth.privacy-policy');
            })->name('privacyPolicy');

            Route::get('deletion-callback', [AuthController::class, 'facebookDataDeletionCallback'])->name('deletionCallback');

            Route::post('subscribe',[ContactController::class, 'subscribe'])->name('subscribe');

            Route::get('best-sellers',[CatalogueController::class, 'bestSellers'])->name('bestSellers');
            Route::get('summer-discount',[CatalogueController::class, 'discount'])->name('discount');
            Route::get('new',[CatalogueController::class, 'new'])->name('new');

            Route::get('/page/{slug?}',[\App\Http\Controllers\PageController::class, 'viewPage'])->name('viewPage');

            Route::get('/{category?}', [CatalogueController::class, 'catalogueSeo'])->name('catalogueSeo');
            Route::get('/{category?}/{product?}', [CatalogueController::class, 'showSeo'])->name('productDetailsSeo');

            Route::any('payments/bog/status',[PurchaseController::class, 'bogResponse'])->name('bogResponse');

            Route::any('bog/callback/status', [\App\BogPay\BogCallbackController::class, 'status'])->withoutMiddleware('web');
            Route::any('bog/callback/refund',[\App\BogPay\BogCallbackController::class, 'refund'])->withoutMiddleware('web');

        });
    });

