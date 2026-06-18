<?php

namespace App\Policies;

use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PortfolioPolicy
{
    public function access(User $user, Portfolio $portfolio)
    {
        return $portfolio->user->is($user) ? Response::allow() : Response::denyAsNotFound();
    }
}
