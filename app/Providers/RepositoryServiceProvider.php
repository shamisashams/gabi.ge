<?php

 namespace App\Providers;

 use App\Repositories\AnswerRepositoryInterface;
 use App\Repositories\DepositRepositoryInterface;
 use App\Repositories\Eloquent\AnswerRepository;
 use App\Repositories\Eloquent\Base\BaseRepository;
 use App\Repositories\Eloquent\Base\EloquentRepositoryInterface;
 use App\Repositories\Eloquent\DepositRepository;
 use App\Repositories\Eloquent\FeatureRepository;
 use App\Repositories\Eloquent\LanguageRepository;
 use App\Repositories\Eloquent\PageRepository;
 use App\Repositories\Eloquent\SettingRepository;
 use App\Repositories\Eloquent\TranslationRepository;
 use App\Repositories\Eloquent\UserRepository;
 use App\Repositories\Eloquent\VerificationRepository;
 use App\Repositories\FeatureRepositoryInterface;
 use App\Repositories\LanguageRepositoryInterface;
 use App\Repositories\PageRepositoryInterface;
 use App\Repositories\SettingRepositoryInterface;
 use App\Repositories\TranslationRepositoryInterface;
 use App\Repositories\UserRepositoryInterface;
 use App\Repositories\VerificationRepositoryInterface;
 use Illuminate\Support\ServiceProvider;
 use App\Repositories\Eloquent\CategoryRepository;
 use App\Repositories\CategoryRepositoryInterface;
 use App\Repositories\Eloquent\ProductRepository;
 use App\Repositories\ProductRepositoryInterface;
 use App\Repositories\Eloquent\SaleRepository;
 use App\Repositories\SaleRepositoryInterface;

 /**
  * Class RepositoryServiceProvider
  * @package App\Providers
  */
 class RepositoryServiceProvider extends ServiceProvider
 {

     /**
      * Register services.
      *
      */
     public function register()
     {
	 //
     }

     /**
      * Bootstrap services.
      *
      * @return void
      */
     public function boot()
     {
	 $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
	 $this->app->bind(LanguageRepositoryInterface::class, LanguageRepository::class);
	 $this->app->bind(TranslationRepositoryInterface::class, TranslationRepository::class);
	 $this->app->bind(FeatureRepositoryInterface::class, FeatureRepository::class);
	 $this->app->bind(AnswerRepositoryInterface::class, AnswerRepository::class);
	 $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
	 $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
	 $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
	 $this->app->bind(PageRepositoryInterface::class, PageRepository::class);
	 $this->app->bind(SaleRepositoryInterface::class, SaleRepository::class);
     }

 }
 