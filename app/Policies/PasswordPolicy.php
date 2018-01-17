<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Password;
use Illuminate\Auth\Access\HandlesAuthorization;

class PasswordPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the password.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Password  $password
     * @return mixed
     */
    public function view(User $user, Password $password)
    {
        //
    }

    /**
     * Determine whether the user can create passwords.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the password.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Password  $password
     * @return mixed
     */
    public function update(User $user, Password $password)
    {
        //
    }

    /**
     * Determine whether the user can delete the password.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Password  $password
     * @return mixed
     */
    public function delete(User $user, Password $password)
    {
        //
    }
}
