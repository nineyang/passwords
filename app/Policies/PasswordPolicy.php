<?php

namespace App\Policies;

use App\Models\Box;
use App\Models\User;
use App\Models\Password;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class PasswordPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the password.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Password $password
     * @return mixed
     */
    public function view(User $user, Password $password, Box $box)
    {
        return $user->id === $password->user_id
            && $user->id === $box->user_id
            && $password->box_id === $box->id;
    }

    /**
     * Determine whether the user can create passwords.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the password.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Password $password
     * @return mixed
     */
    public function update(User $user, Password $password, Box $box)
    {
        return $user->id === $password->user_id
            && $user->id === $box->user_id
            && $password->box_id === $box->id;
    }

    /**
     * Determine whether the user can delete the password.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Password $password
     * @return mixed
     */
    public function delete(User $user, Password $password, Box $box)
    {
        return $user->id === $password->user_id
            && $user->id === $box->user_id
            && $password->box_id === $box->id;
    }

    /**
     * Determine whether the user can delete the password.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Password $password
     * @return mixed
     */
    public function restore(User $user, Password $password, Box $box)
    {
        return $user->id === $password->user_id
            && $user->id === $box->user_id
            && $password->box_id === $box->id;
    }

    /**
     * Determine whether the user can delete the password.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Password $password
     * @return mixed
     */
    public function viewPassword(User $user, Password $password)
    {
        if ($user->id !== $password->user_id) {
            return false;
        }

        switch ($password->safety_level) {
            case 2:
                return Hash::check(request()->get('main_password'), $user->password);
                break;
            case 3:
                $key = $password->user_id . ':view';
                $res = Cache::get($key) == request()->get('code');
                if ($res) {
                    Cache::delete($key);
                }
                return $res;
                break;
            default:
                return true;
                break;
        }
    }
}
