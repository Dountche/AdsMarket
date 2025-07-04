<?php

namespace App\Policies;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Ad $ad): bool
    {
        return $user->id === $ad->user_id || $user->is_admin;
    }

    public function delete(User $user, Ad $ad): bool
    {
        return $user->id === $ad->user_id || $user->is_admin;
    }
}
