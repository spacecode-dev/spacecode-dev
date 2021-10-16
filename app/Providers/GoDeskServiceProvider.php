<?php

namespace App\Providers;

use SpaceCode\GoDesk\GoDeskApplicationServiceProvider;
use SpaceCode\GoDesk\Models\User;

/**
 * Class GoDeskServiceProvider
 * @package App\Providers
 */
class GoDeskServiceProvider extends GoDeskApplicationServiceProvider
{
    /**
     * @param User $user
     */
    public function boot(User $user)
    {
        parent::boot($user);
    }
}
