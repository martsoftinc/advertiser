<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\BalanceModel;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

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
        
    View::composer('*', function ($view) {
        if (auth()->check()) { // Ensure the user is authenticated
            $balance = BalanceModel::where('user_id', auth()->id())->first();
            $view->with('balance', $balance); // Share the balance with all views
        }
    });

    View::composer('*', function ($view) {
        if (auth()->check()) { // Ensure the user is authenticated
            $user = auth()->user();
            $view->with('user', $user->name); // Share the balance with all views
        }
    });
}
}
