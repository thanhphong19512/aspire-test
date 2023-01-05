<?php

namespace App\Services\ScheduledRepaymentsLoan;

use Illuminate\Support\ServiceProvider;

class ScheduledRepaymentsLoanServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ScheduledRepaymentsLoanServiceInterface::class, ScheduledRepaymentsLoanService::class);
    }
}
