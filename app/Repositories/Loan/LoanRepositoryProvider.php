<?php

namespace App\Repositories\Loan;

use Illuminate\Support\ServiceProvider;

class LoanRepositoryProvider extends ServiceProvider
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
        $this->app->bind(LoanRepositoryInterface::class, LoanRepository::class);
    }
}
