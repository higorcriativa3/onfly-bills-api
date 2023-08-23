<?php

namespace App\Policies;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BillPolicy
{
    /**
     * Determine whether the user can list the model.
     */
    public function list(User $user): bool
    {
        return $user->id != null;
    }
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Bill $bill): Response
    {
        return $user->id === $bill->user_id 
                    ? Response::allow()
                    : Response::deny('You do not own this bill.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->id != null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Bill $bill): Response
    {
        return $user->id === $bill->user_id 
                    ? Response::allow()
                    : Response::deny('You do not own this bill.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Bill $bill): Response
    {
        return $user->id === $bill->user_id 
                    ? Response::allow()
                    : Response::deny('You do not own this bill.');
    }
}
