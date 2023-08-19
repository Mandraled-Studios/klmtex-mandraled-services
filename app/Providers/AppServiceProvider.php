<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

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
        Relation::morphMap([
            'categories' => \App\Models\Category::class,
            'subcategories' => \App\Models\Subcategory::class,
            'secondary_subcategories' => \App\Models\SecondarySubcategory::class,
        ]);

        // $this->app->bind('path.public', function() {
        //     return base_path()."/../";
        // });
    }
}
