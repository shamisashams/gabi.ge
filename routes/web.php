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
use App\Models\Language;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;

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

                Route::get('pages/add_help', [PageController::class,'addHelp'])->name('addHelp');
                Route::post('pages/add_help', [PageController::class,'addHelpStore'])->name('addHelpStore');
                Route::get('pages/edit_help/{help}/add', [PageController::class,'editHelp'])->name('editHelp');
                Route::put('pages/edit_help/{help}/update', [PageController::class,'updateHelp'])->name('helpUpdate');
                Route::get('pages/edit_help/{help}/destroy', [PageController::class,'deleteHelp'])->name('deleteHelp');

                Route::get('pages/add_faq', [PageController::class,'addFaq'])->name('addFaq');
                Route::post('pages/add_faq', [PageController::class,'faqStore'])->name('faqStore');
                Route::get('pages/faq/{faq}/edit', [PageController::class,'editFaq'])->name('editFaq');
                Route::put('pages/faq/{faq}/update', [PageController::class,'updateFaq'])->name('faqUpdate');
                Route::get('pages/faq/{faq}/destroy', [PageController::class,'deleteFaq'])->name('deleteFaq');

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

                Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class)
                    ->name('index', 'blogIndex')
                    ->name('store', 'blogStore')
                    ->name('create', 'blogCreate')
                    ->name('show', 'blogShow')
                    ->name('edit', 'blogEdit')
                    ->name('update', 'blogUpdate')
                    ->name('destroy', 'blogDestroy');

                // Settings
                Route::resource('htag', \App\Http\Controllers\Admin\HtagController::class)->except('destroy')
                    ->name('index', 'hTagIndex')
                    ->name('create', 'hTagCreateView')
                    ->name('store', 'hTagCreate')
                    ->name('edit', 'hTagEditView')
                    ->name('update', 'hTagUpdate')
                    ->name('show', 'hTagShow');

                Route::resource('shipping', \App\Http\Controllers\Admin\ShippingController::class);

                Route::post('shipping/{shipping}/destroy', [\App\Http\Controllers\Admin\ShippingController::class, 'destroy'])->name('shipping.destroy');

                Route::get('password',[\App\Http\Controllers\Admin\PasswordController::class, 'index'])->name('password.index');
                Route::post('password',[\App\Http\Controllers\Admin\PasswordController::class, 'update'])->name('password.update');

                Route::resource('country', \App\Http\Controllers\Admin\CountryController::class);

                Route::get('country/{country}/destroy', [\App\Http\Controllers\Admin\CountryController::class, 'destroy'])->name('country.destroy');
            });
        });
        Route::middleware(['active'])->group(function () {
            Route::get('/', [HomeController::class, 'index'])->name('welcome');

            //Route::get('/catalogue/{category}', [CatalogueController::class, 'catalogue'])->name('catalogue');
            //Route::get('/catalogue/{category}/details/{product}', [CatalogueController::class, 'show'])->name('productDetails');

            Route::get('forgot-password',function (){
               return view('auth.forgot-password');
            })->name('forgot-pass');

            Route::post('/forgot-password', function (Request $request) {
                $request->validate(['email' => 'required|email']);

                $status = Password::sendResetLink(
                    $request->only('email')
                );

                return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
            })->middleware('guest')->name('password.email');

            Route::get('/reset-password', function ($locale) {
                return view('auth.reset-password', ['token' => \request()->get('token'), 'email' => \request()->get('email')]);
            })->middleware('guest')->name('password.reset');


            Route::post('/reset-password', function (Request $request) {
                $request->validate([
                    'token' => 'required',
                    'email' => 'required|email',
                    'password' => 'required|min:8|confirmed',
                ]);

                $status = Password::reset(
                    $request->only('email', 'password', 'password_confirmation', 'token'),
                    function ($user, $password) {
                        $user->forceFill([
                            'password' => Hash::make($password)
                        ])->setRememberToken(Str::random(60));

                        $user->save();

                        event(new PasswordReset($user));
                    }
                );

                return $status === Password::PASSWORD_RESET
                    ? redirect()->back()->with('status', 'success')
                    : back()->withErrors(['password' => [__($status)]]);
            })->middleware('guest')->name('password.update');


            Route::get('/blog/{blog}',[\App\Http\Controllers\BlogController::class,'viewBlog'])->name('viewBlog');


            Route::get('/addcartcount/{id}/{type}', [CartController::class, 'addCartCount'])->name('addCartCount');
            Route::get('/removefromcart', [CartController::class, 'removeFromCart'])->name('removeFromCart');
            Route::get('/addtocart/{id}', [CartController::class, 'addToCart'])->name('addToCart');
            Route::get('/getcartcount', [CartController::class, 'getCartCount'])->name('getCartCount');
            Route::get('/getfeatures/{id}', [HomeController::class, 'getSingleProductFeaturesApi'])->name('getFeatures');

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
            /*Route::get('blogs', function () {
                return view('pages.blogs.index');
            })->name('blogs');*/
            Route::get('single-blog', function () {
                return view('pages.single-blog.index');
            })->name('single-blog');
            Route::get('success', function () {
                return view('pages.result.success');
            })->name('success');
            Route::get('failure', function () {
                return view('pages.result.failure');
            })->name('failure');

            Route::get('/facebook-auth', [AuthController::class, 'facebookAuth'])->name('facebookAuth');

            //Social-------------------------------------------------------
            Route::get('/auth/facebook/redirect', function (){
                return Socialite::driver('facebook')->redirect();
            })->name('fb-redirect');

            Route::get('/auth/facebook/callback',function (){
                //dd('jdfhgjdhjf urkl');
                $facebookUser = Socialite::driver('facebook')->stateless()->user();

                //dd($facebookUser);
                $email = uniqid();
                if($facebookUser->email !== null) $email = $facebookUser->email;
                $user = User::updateOrCreate([
                    'facebook_id' => $facebookUser->id,

                ], [
                    'email' => $email,
                    'name' => $facebookUser->name,
                    'facebook_id' => $facebookUser->id,
                    'facebook_token' => $facebookUser->token,
                    'facebook_refresh_token' => $facebookUser->refreshToken,
                    'facebook_avatar' => $facebookUser->avatar,
                ]);

                $localization = Language::where('abbreviation', app()->getLocale())->first();
                if (!$localization) {
                    throw new Exception('Localization not exist.');
                }

                if(!$user->profile){
                    $user->profile()->create([
                        'language_id' => $localization->id,
                        'first_name' => '',
                        'last_name' => '',
                        'country' => ''
                    ]);

                    $token = Str::random(40);
                    $user->roles()->attach('2');
                    $user->tokens()->create([
                        'token' => Hash::make($token),
                        'validate_till' => Carbon::now()->addDays(1)
                    ]);
                }




                //dd($user);

                Auth::login($user);

                return redirect(route('profile'));
            })->name('fb-callback');

            Route::get('/auth/google/redirect', function (){
                return Socialite::driver('google')->redirect();
            })->name('google-redirect');

            Route::get('/auth/google/callback',function (){
                $googleUser = Socialite::driver('google')->user();

                //dd($googleUser);
                $user = User::updateOrCreate([
                    //'facebook_id' => $facebookUser->id,
                    'email' => $googleUser->email,
                ], [
                    'name' => $googleUser->name,
                    'google_id' => $googleUser->id,
                    'google_token' => $googleUser->token,
                    'google_refresh_token' => $googleUser->refreshToken,
                    'facebook_avatar' => $googleUser->avatar,
                ]);

                $localization = Language::where('abbreviation', app()->getLocale())->first();
                if (!$localization) {
                    throw new Exception('Localization not exist.');
                }

                if(!$user->profile){
                    $user->profile()->create([
                        'language_id' => $localization->id,
                        'first_name' => '',
                        'last_name' => '',
                        'country' => ''
                    ]);

                    $token = Str::random(40);
                    $user->roles()->attach('2');
                    $user->tokens()->create([
                        'token' => Hash::make($token),
                        'validate_till' => Carbon::now()->addDays(1)
                    ]);
                }



                //dd($user);

                Auth::login($user);

                return redirect(route('profile'));
            })->name('google-callback');
            //--------------------------------------------------------------------------

//            Route::get('/faceook-callback', [AuthController::class],);

            Route::middleware(['authFront'])->group(function () {
                Route::get('logout', [\App\Http\Controllers\Auth\AuthFrontendController::class, 'logout'])->name('logoutFront');
                Route::get('profile', [UserController::class, 'index'])->name('profile');
                Route::post('profile-update', [UserController::class, 'update'])->name('profileUpdate');
                Route::post('change-password', [UserController::class, 'changePassword'])->name('changePassword');
                Route::post('save-order', [PurchaseController::class, 'saveOrder'])->name('saveOrder');
                Route::get('order-details/{id}', [UserController::class, 'orderDetails'])->name('orderDetails');
                Route::get('download-pdf/{id}', [UserController::class, 'downloadPdf'])->name('downloadPdf');
                Route::get('add-address',[UserController::class,'addAddress'])->name('client.add-address');
                Route::post('add-address',[UserController::class,'storeAddress'])->name('client.store-address');
                Route::put('edit-address',[UserController::class,'updateAddress'])->name('client.update-address');
                Route::get('address/{address}/destroy',[UserController::class,'deleteAddress'])->name('client.delete-address');
                Route::post('avatar',[UserController::class,'updateAvatar'])->name('avatar');
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

            Route::get('category/{category?}', [CatalogueController::class, 'catalogueSeo'])->name('catalogueSeo');
            Route::get('{category}/{product}', [CatalogueController::class, 'showSeo'])->name('productDetailsSeo');




            Route::any('payments/bog/status',[PurchaseController::class, 'bogResponse'])->name('bogResponse');

            Route::fallback(\App\Http\Controllers\ProxyController::class.'@proxy')->name('proxy');



        });
        Route::any('bog/callback/status', [\App\BogPay\BogCallbackController::class, 'status'])->withoutMiddleware('web')->name('bogCallbackStatus');
        Route::any('bog/callback/refund',[\App\BogPay\BogCallbackController::class, 'refund'])->withoutMiddleware('web')->name('bogCallbackRefund');

    });



