<?php

namespace App\Repositories\ScheduledRepaymentsLoan;

use App\Models\ScheduledRepaymentsLoan;
use App\Repositories\BaseRepository;
use App\Shared\LoanConstant;
use Illuminate\Database\Eloquent\Collection;

class ScheduledRepaymentsLoanRepository extends BaseRepository implements ScheduledRepaymentsLoanRepositoryInterface
{
    /**
     * @param ScheduledRepaymentsLoan $model
     */
    public function __construct(ScheduledRepaymentsLoan $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $scheduledRepayments
     * @return bool
     */
    public function bulkCreate(array $scheduledRepayments): bool
    {
        return $this->model->insert($scheduledRepayments);
    }

    /**
     * @param int $scheduledRepaymentId
     * @return bool
     */
    public function repaymentLoan(int $scheduledRepaymentId): bool
    {
        return $this->model->where('scheduled_repayments_loan_id', $scheduledRepaymentId)
            ->where('loan_state', LoanConstant::LOAN_STATE_PENDING)
            ->update([
                'loan_state' => LoanConstant::LOAN_STATE_PAID
            ]);
    }

    /**
     * @param int $loanId
     * @return Collection
     */
    public function getPendingRepayment(int $loanId): Collection
    {
        return $this->model
            ->where('loan_id', $loanId)
            ->where('loan_state', LoanConstant::LOAN_STATE_PENDING)
            ->get();
    }
}
