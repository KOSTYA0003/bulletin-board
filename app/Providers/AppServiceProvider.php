<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View; //
use Illuminate\Support\ServiceProvider; //

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    public function boot()
    {
        View::composer('*', function ($view) {
            $rootCategories = Category::whereNull('parent_id')
                ->with(['children' => function ($query) {
                    $query->withCount('advertisements');
                }])
                ->withCount('advertisements')
                ->get();

            $view->with('rootCategories', $rootCategories);
        });
    }
}
