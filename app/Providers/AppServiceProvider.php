<?php

namespace App\Providers;

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
        // Company
        $this->app->bind(
            'App\Repositories\Company\CompanyInterface',
            'App\Repositories\Company\CompanyRepository'
        );
        // Employee
        $this->app->bind(
            'App\Repositories\Employee\EmployeeInterface',
            'App\Repositories\Employee\EmployeeRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
