<?php

namespace App\Services\Loan;

use App\Models\Loan;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface LoanServiceInterface
{
    /**
     * @param array $attributes
     * @return bool
     */
    public function createLoan(array $attributes): bool;

    /**
     * @param int $userId
     * @return Collection|null
     */
    public function getUserLoans(int $userId): ?Collection;

    /**
     * @param int $loanId
     * @return bool
     */
    public function approveLoan(int $loanId): bool;
}
