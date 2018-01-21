<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Box;
use Illuminate\Auth\Access\HandlesAuthorization;

class BoxPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Box $box
     * @return bool
     */
    public function view(User $user, Box $box)
    {
        return $user->id === $box->user_id;
    }

    /**
     * Determine whether the user can create boxes.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->status === config('status.user.available');
    }

    /**
     * Determine whether the user can create boxes.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function createPassword(User $user, Box $box)
    {
        return $user->status === config('status.user.available')
            && $box->status === config('status.box.available')
            && $user->id === $box->user_id;
    }

    /**
     * Determine whether the user can update the box.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Box $box
     * @return mixed
     */
    public function update(User $user, Box $box)
    {
        return $user->id === $box->user_id;
    }

    /**
     * Determine whether the user can delete the box.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Box $box
     * @return mixed
     */
    public function delete(User $user, Box $box)
    {
        return $user->id === $box->user_id;
    }
}
