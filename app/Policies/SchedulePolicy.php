<?php

namespace App\Policies;

use App\Models\Schedule;
use App\Models\User;

class SchedulePolicy
{
    /**
     * Détermine si l'utilisateur peut créer un créneau horaire.
     */
    public function create(User $user)
    {
        return $user->doctor === 1;
    }
}
