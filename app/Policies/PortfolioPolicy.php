<?php

namespace App\Policies;

use App\Models\Finance\Portfolio;
use App\Models\User;

class PortfolioPolicy
{
    public function createTransaction(User $user, Portfolio $portfolio): bool
    {
        return $portfolio->user_id === $user->id;
    }
}
