<?php

namespace App\Policies;

use App\Models\FamilyAccount;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FamilyAccountPolicy
{
    use HandlesAuthorization;

    public function view(User $user, FamilyAccount $familyAccount)
    {
        return $familyAccount->users->contains($user->id);
    }

    public function manage(User $user, FamilyAccount $familyAccount)
    {
        return $familyAccount->owner_id === $user->id;
    }
}