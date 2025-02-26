<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
        
         

      
        Gate::define('update-post', function ($user, $post) {
          return $user->id === $post->user_id;
      });


      Gate::define('delete-post', function ($user, $post) {
          return $user->id === $post->user_id;
      });
    
  
    }
}