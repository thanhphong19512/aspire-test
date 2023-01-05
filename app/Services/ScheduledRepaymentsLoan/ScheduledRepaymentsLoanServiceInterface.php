<?php

namespace App\Services\ScheduledRepaymentsLoan;

use App\Models\ScheduledRepaymentsLoan;
use App\Repositories\ScheduledRepaymentsLoan\ScheduledRepaymentsLoanRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ScheduledRepaymentsLoanServiceInterface
{

    /**
     * @param int $loanId
     * @param float $loanAmount
     * @param float $interestRate
     * @param int $term
     * @param int $paymentCycle
     * @return bool
     */
    public function createScheduledRepaymentLoan(int $loanId, float $loanAmount, float $interestRate, int $term, int $paymentCycle): bool;

    /**
     * @param int $scheduledRepaymentId
     * @param float $amount
     * @return bool
     */
    public function repaymentLoan(int $scheduledRepaymentId, float $amount): bool;
}
