<?php

namespace App\Repositories\ScheduledRepaymentsLoan;

use App\Repositories\ScheduledRepaymentsLoan\ScheduledRepaymentsLoanRepository;
use App\Repositories\ScheduledRepaymentsLoan\ScheduledRepaymentsLoanRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class ScheduledRepaymentsLoanRepositoryProvider extends ServiceProvider
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
        $this->app->bind(ScheduledRepaymentsLoanRepositoryInterface::class, ScheduledRepaymentsLoanRepository::class);
    }
}
