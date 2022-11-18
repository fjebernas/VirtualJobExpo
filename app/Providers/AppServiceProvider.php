<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrapFive();

        // data that are shared across all views
        View::share('statuses', [
                                    'Received',
                                    'Shortlisted',
                                    'Not qualified',
                                ]);

        View::share('job_level_types', [
                                    'entry-level',
                                    'intermediate',
                                    'senior',
                                    'internship',
                                ]);

        View::share('employment_types', [
                                    'full-time',
                                    'part-time',
                                ]);
    }
}
