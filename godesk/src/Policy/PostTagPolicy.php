<?php

declare(strict_types=1);

namespace SpaceCode\GoDesk\Policy;

use Illuminate\Auth\Access\HandlesAuthorization;
use SpaceCode\GoDesk\Traits\Resolve;

class PostTagPolicy
{
    use HandlesAuthorization, Resolve;

    /**
     * @param $user
     * @return bool
     */
    public function viewAny($user): bool
    {
        return $this->checkAssignment($user, 'Post Tag viewAny');
    }

    /**
     * @param $user
     * @return bool
     */
    public function view($user): bool
    {
        return $this->checkAssignment($user, 'Post Tag view');
    }

    /**
     * @param $user
     * @return bool
     */
    public function create($user): bool
    {
        return $this->checkAssignment($user, 'Post Tag create');
    }

    /**
     * @param $user
     * @return bool
     */
    public function update($user): bool
    {
        return $this->checkAssignment($user, 'Post Tag update');
    }

    /**
     * @param $user
     * @return bool
     */
    public function delete($user): bool
    {
        return $this->checkAssignment($user, 'Post Tag delete');
    }
}