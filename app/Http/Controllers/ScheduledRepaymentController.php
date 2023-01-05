<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepaymentRequest;
use App\Services\ScheduledRepaymentsLoan\ScheduledRepaymentsLoanServiceInterface;
use Exception;

class ScheduledRepaymentController extends Controller
{
    /**
     * @var ScheduledRepaymentsLoanServiceInterface
     */
    protected ScheduledRepaymentsLoanServiceInterface $scheduledRepaymentsLoanService;

    /**
     * @param ScheduledRepaymentsLoanServiceInterface $scheduledRepaymentsLoanService
     */
    public function __construct(
        ScheduledRepaymentsLoanServiceInterface $scheduledRepaymentsLoanService
    )
    {
        $this->scheduledRepaymentsLoanService = $scheduledRepaymentsLoanService;
    }

    /**
     * @param RepaymentRequest $request
     * @return string
     * @throws Exception
     */
    public function repaymentLoan(RepaymentRequest $request): string
    {
        try {
            $repaymentId = $request->repayment;
            $repaymentAmount = $request->get('amount');

            $this->scheduledRepaymentsLoanService->repaymentLoan($repaymentId, $repaymentAmount);
        } catch (\Exception $e) {
            return response()->error();
        }

        return response()->success();
    }
}
