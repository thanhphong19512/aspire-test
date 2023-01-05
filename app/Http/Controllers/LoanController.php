<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoanRequest;
use App\Models\Loan;
use App\Services\Loan\LoanServiceInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    /**
     * @var LoanServiceInterface
     */
    protected LoanServiceInterface $loanService;

    /**
     * @param LoanServiceInterface $loanService
     */
    public function __construct(
        LoanServiceInterface $loanService
    )
    {
        $this->loanService = $loanService;
    }

    /**
     * @return string
     */
    public function index(): string
    {
        try {
            $loans = $this->loanService->getUserLoans(auth()->user()->id);
        } catch (\Exception $e) {
            return response()->error();
        }

        return response()->success($loans);
    }

    /**
     * @param Loan $loan
     * @return string
     * @throws AuthorizationException
     */
    public function show(Loan $loan): string
    {
        try {
            $this->authorizeForUser(Auth::user(), 'show', [$loan]);
        } catch (\Exception $e) {
            return response()->error();
        }

        return response()->success($loan);
    }

    /**
     * @param StoreLoanRequest $request
     * @return string
     */
    public function store(StoreLoanRequest $request): string
    {
        try {
            $loan = [
                'amount' => $request->get('amount'),
                'term' => $request->get('term')
            ];
            $this->loanService->createLoan($loan);
        } catch (\Exception $e) {
            return response()->error();
        }

        return response()->success();
    }

    /**
     * @param Loan $loan
     * @return string
     * @throws AuthorizationException
     */
    public function approveLoan(Loan $loan): string
    {
        try {
            $this->authorize('approve', $loan);
            $this->loanService->approveLoan($loan->loan_id);
        } catch (\Exception $e) {
            return response()->error();
        }

        return response()->success();
    }
}
