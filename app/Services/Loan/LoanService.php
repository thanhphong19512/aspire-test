<?php

namespace App\Services\Loan;

use App\Repositories\Loan\LoanRepositoryInterface;
use App\Services\ScheduledRepaymentsLoan\ScheduledRepaymentsLoanServiceInterface;
use App\Shared\LoanConstant;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class LoanService implements LoanServiceInterface
{
    /**
     * @var LoanRepositoryInterface $loanRepository
     */
    protected LoanRepositoryInterface $loanRepository;

    /**
     * @var ScheduledRepaymentsLoanServiceInterface $scheduledRepaymentsLoanService
     */
    protected ScheduledRepaymentsLoanServiceInterface $scheduledRepaymentsLoanService;

    /**
     * @param LoanRepositoryInterface $loanRepository
     */
    public function __construct(LoanRepositoryInterface $loanRepository, ScheduledRepaymentsLoanServiceInterface $scheduledRepaymentsLoanService)
    {
        $this->loanRepository = $loanRepository;
        $this->scheduledRepaymentsLoanService = $scheduledRepaymentsLoanService;
    }

    /**
     * @param array $attributes
     * @return bool
     */
    public function createLoan(array $attributes): bool
    {
        $amount = Arr::get($attributes, 'amount');
        $term = Arr::get($attributes, 'term', LoanConstant::DEFAULT_LOAN_TERM);
        $paymentCycle = Arr::get($attributes, 'payment_cycle', LoanConstant::DEFAULT_PAYMENT_CYCLE);

        $loanData = [
            'user_id' => auth()->user()->id,
            'interest_rate' => LoanConstant::DEFAULT_INTEREST_RATE,
            'amount' => $amount,
            'term' => Arr::get($attributes, 'term', LoanConstant::DEFAULT_LOAN_TERM),
            'payment_cycle' => $paymentCycle,
        ];

        DB::beginTransaction();
        try {
            $loan = $this->loanRepository->create($loanData);
            $this->scheduledRepaymentsLoanService->createScheduledRepaymentLoan($loan->loan_id, $amount, LoanConstant::DEFAULT_INTEREST_RATE, $term, $paymentCycle);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            // log error

            return false;
        }

        return true;
    }

    /**
     * @param int $userId
     * @return Collection|null
     */
    public function getUserLoans(int $userId): ?Collection
    {
        return $this->loanRepository->getUserLoans($userId);
    }

    /**
     * @param int $loanId
     * @return bool
     */
    public function approveLoan(int $loanId): bool
    {
        $this->loanRepository->findOrFail($loanId);

        $data = [
            'approved_user_id' => auth()->user()->id,
            'approved_at' => date('Y-m-d H:i:s'),
            'loan_state' => LoanConstant::LOAN_STATE_APPROVED
        ];

        return $this->loanRepository->updateLoan($loanId, $data);
    }
}
