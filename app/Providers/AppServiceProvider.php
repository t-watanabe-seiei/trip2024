<?php

namespace App\Providers;

// use Illuminate\Support\ServiceProvider;
use App\Models\User;  //追記
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;//追記
use Illuminate\Support\Facades\Gate;  //追記

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // \URL::forceScheme('https');
        $this->registerPolicies();    
        Gate::define('admin', function (User $user) {
            return ($user->role == 1);     // 管理者ユーザー
        });
        Gate::define('general', function (User $user) {
            return ($user->role == 10);    // 一般ユーザー
        });
    }
}
