<?php

 /**
  *  app/Providers/RepositoryServiceProvider.php
  *
  * Date-Time: 19.05.21
  * Time: 10:20
  * @author Vito Makhatadze <vitomaxatadze@gmail.com>
  */

 namespace App\Providers;

 use App\Repositories\DepositRepositoryInterface;
 use App\Repositories\Eloquent\Base\BaseRepository;
 use App\Repositories\Eloquent\Base\EloquentRepositoryInterface;
 use App\Repositories\Eloquent\DepositRepository;
 use App\Repositories\Eloquent\LanguageRepository;
 use App\Repositories\Eloquent\TranslationRepository;
 use App\Repositories\Eloquent\UserRepository;
 use App\Repositories\Eloquent\VerificationRepository;
 use App\Repositories\LanguageRepositoryInterface;
 use App\Repositories\TranslationRepositoryInterface;
 use App\Repositories\UserRepositoryInterface;
 use App\Repositories\VerificationRepositoryInterface;
 use Illuminate\Support\ServiceProvider;
 use App\Repositories\CategoryRepositoryInterface;
 use App\Repositories\Eloquent\CategoryRepository;

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
	 $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
     }

 }
 