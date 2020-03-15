<?php

namespace App\Providers;

use App\Campus;
use App\Role;
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

        if (Schema::hasTable('campuses')) {
            $no = Campus::withCount(['forms' => function ($query) {
                $query->where('status', '!=' , 'approved');
            }])->pluck('forms_count');

            $no = $no->sum();

            View::composer('admin.layouts.dashboard-template', function ($view) use ($no) {
                $view->with('no_of_pending_submitted_forms', $no);
            });
        }

        View::composer('campus.auth.register', function ($view) {
            $view->with('roles',Role::get());
            $view->with('campuses',['Tandag','Cantilan','San Miguel','Cagwait','Lianga','Tagbina','Bislig']);
        });

        
    }
}
