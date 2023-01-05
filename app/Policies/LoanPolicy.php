<?php

namespace App\Policies;

use App\Models\Loan;
use App\Models\User;
use App\Shared\UserConstant;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class LoanPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Loan $loan
     * @return Response|bool
     */
    public function view(User $user, Loan $loan)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Loan $loan
     * @return Response|bool
     */
    public function update(User $user, Loan $loan)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Loan $loan
     * @return Response|bool
     */
    public function delete(User $user, Loan $loan)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Loan $loan
     * @return Response|bool
     */
    public function restore(User $user, Loan $loan)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Loan $loan
     * @return Response|bool
     */
    public function forceDelete(User $user, Loan $loan)
    {
        //
    }

    /**
     * Determine whether the user can permanently show the model.
     *
     * @param User $user
     * @param Loan $loan
     * @return Response|bool
     */
    public function show(User $user, Loan $loan)
    {
        return $user->id === (int)$loan->user_id;
    }

    /**
     * Determine whether the user can permanently approve the model.
     *
     * @param User $user
     * @param Loan $loan
     * @return Response|bool
     */
    public function approve(User $user)
    {
        return $user->isAdmin;
    }
}
