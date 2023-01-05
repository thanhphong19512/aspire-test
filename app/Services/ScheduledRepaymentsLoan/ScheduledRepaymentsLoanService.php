<?php

namespace App\Services\ScheduledRepaymentsLoan;

use App\Repositories\Loan\LoanRepositoryInterface;
use App\Repositories\ScheduledRepaymentsLoan\ScheduledRepaymentsLoanRepositoryInterface;
use App\Services\Loan\LoanServiceInterface;
use App\Shared\LoanConstant;
use Exception;
use Illuminate\Support\Facades\DB;

class ScheduledRepaymentsLoanService implements ScheduledRepaymentsLoanServiceInterface
{
    /**
     * @var ScheduledRepaymentsLoanRepositoryInterface $scheduledRepaymentsLoanRepository
     */
    protected ScheduledRepaymentsLoanRepositoryInterface $scheduledRepaymentsLoanRepository;

    /**
     * @var LoanRepositoryInterface $loanRepository
     */
    protected LoanRepositoryInterface $loanRepository;

    /**
     * @param ScheduledRepaymentsLoanRepositoryInterface $scheduledRepaymentsLoanRepository
     * @param LoanServiceInterface $loanService
     */
    public function __construct(ScheduledRepaymentsLoanRepositoryInterface $scheduledRepaymentsLoanRepository, LoanRepositoryInterface $loanRepository)
    {
        $this->scheduledRepaymentsLoanRepository = $scheduledRepaymentsLoanRepository;
        $this->loanRepository = $loanRepository;
    }

    /**
     * @param int $loanId
     * @param float $loanAmount
     * @param float $interestRate
     * @param int $term
     * @param int $paymentCycle
     * @return bool
     */
    public function createScheduledRepaymentLoan(int $loanId, float $loanAmount, float $interestRate, int $term, int $paymentCycle): bool
    {
        $interest = $loanAmount * $interestRate / 100;
        $interestOfEachPayment = round($interest / $term, 2);
        $amountOfEachPayment = round($loanAmount / $term, 2);

        $_temp = 1;
        $_paymentCycle = $paymentCycle;
        $data = [];
        $totalDebtPaymentAmount = 0;

        do {
            if ($_temp == $term) {
                $amountOfEachPayment = $loanAmount - $totalDebtPaymentAmount;
            }

            $data[] = [
                'loan_id' => $loanId,
                'debt' => $amountOfEachPayment,
                'interest' => $interestOfEachPayment,
                'total' => $amountOfEachPayment + $interestOfEachPayment,
                'created_at' => date('Y-m-d H:i:s'),
                'payment_period' => $_temp,
                'payment_term' => date('Y-m-d 00:00:00', strtotime("+$_paymentCycle day"))
            ];

            $totalDebtPaymentAmount += $amountOfEachPayment;
            $_temp++;
            $_paymentCycle += $paymentCycle;
        } while ($_temp <= $term);

        return $this->scheduledRepaymentsLoanRepository->bulkCreate($data);
    }

    public function repaymentLoan(int $scheduledRepaymentId, float $amount): bool
    {
        $scheduledRepayment = $this->scheduledRepaymentsLoanRepository->findOrFail($scheduledRepaymentId);
        $loan = $this->loanRepository->findOrFail($scheduledRepayment->loan_id);

        if (!$loan->approved_user_id) {
            throw new Exception('This loan has not been approved.');
        }

        if ($scheduledRepayment->total > $amount) {
            throw new Exception('Payment amount is not enough.');
        }

        DB::beginTransaction();
        try {
            $this->scheduledRepaymentsLoanRepository->repaymentLoan($scheduledRepaymentId);

            if ($this->scheduledRepaymentsLoanRepository->getPendingRepayment($scheduledRepayment->loan_id)->count() === 0) {
                $data = [
                    'loan_state' => LoanConstant::LOAN_STATE_PAID
                ];

                $this->loanRepository->updateLoan($scheduledRepayment->loan_id, $data);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            // log error

            return false;
        }

        return true;
    }
}
