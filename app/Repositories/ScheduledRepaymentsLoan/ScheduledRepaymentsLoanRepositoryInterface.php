<?php

namespace App\Repositories\ScheduledRepaymentsLoan;

use App\Repositories\BaseRepositoriesInterface;
use Illuminate\Database\Eloquent\Collection;

interface ScheduledRepaymentsLoanRepositoryInterface extends BaseRepositoriesInterface
{
    /**
     * @param array $scheduledRepayments
     * @return bool
     */
    public function bulkCreate(array $scheduledRepayments): bool;

    /**
     * @param int $scheduledRepaymentId
     * @return bool
     */
    public function repaymentLoan(int $scheduledRepaymentId): bool;

    /**
     * @param int $loanId
     * @return Collection
     */
    public function getPendingRepayment(int $loanId): Collection;
}
