<?php

namespace App\Providers;

use App\Campus;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        if (env('REDIRECT_HTTPS')) {
            $this->app['request']->server->set('HTTPS', true);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        if (env('REDIRECT_HTTPS')) {
            $url->formatScheme('https');
        }

        $no = Campus::withCount(['forms' => function ($query) {
            $query->where('status', '!=' , 'approved');
        }])->pluck('forms_count');

        $no = $no->sum();

        View::composer('admin.layouts.dashboard-template', function ($view) use ($no) {
            $view->with('no_of_pending_submitted_forms', $no);
        });
    }
}
