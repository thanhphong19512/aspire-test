<?php

namespace App\Repositories\Loan;

use App\Models\Loan;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class LoanRepository extends BaseRepository implements LoanRepositoryInterface
{
    /**
     * @param Loan $model
     */
    public function __construct(Loan $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $userId
     * @return Collection
     */
    public function getUserLoans(int $userId): Collection
    {
        return $this->model->select()->where('user_id', $userId)->get();
    }

    /**
     * @param int $loanId
     * @param array $loanData
     * @return bool
     */
    public function updateLoan(int $loanId, array $loanData): bool
    {
        return $this->model->where('loan_id', $loanId)->update($loanData);
    }
}
