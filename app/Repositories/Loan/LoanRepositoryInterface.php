<?php

namespace App\Repositories\Loan;

use App\Repositories\BaseRepositoriesInterface;
use Illuminate\Database\Eloquent\Collection;

interface LoanRepositoryInterface extends BaseRepositoriesInterface
{
    /**
     * @param int $userId
     * @return Collection
     */
    public function getUserLoans(int $userId): Collection;

    /**
     * @param int $loanId
     * @param array $loanData
     * @return bool
     */
    public function updateLoan(int $loanId, array $loanData): bool;
}
