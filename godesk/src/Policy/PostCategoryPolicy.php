<?php

declare(strict_types=1);

namespace SpaceCode\GoDesk\Policy;

use Illuminate\Auth\Access\HandlesAuthorization;
use SpaceCode\GoDesk\Traits\Resolve;

class PostCategoryPolicy
{
    use HandlesAuthorization, Resolve;

    /**
     * @param $user
     * @return bool
     */
    public function viewAny($user): bool
    {
        return $this->checkAssignment($user, 'Post Category viewAny');
    }

    /**
     * @param $user
     * @return bool
     */
    public function view($user): bool
    {
        return $this->checkAssignment($user, 'Post Category view');
    }

    /**
     * @param $user
     * @return bool
     */
    public function create($user): bool
    {
        return $this->checkAssignment($user, 'Post Category create');
    }

    /**
     * @param $user
     * @return bool
     */
    public function update($user): bool
    {
        return $this->checkAssignment($user, 'Post Category update');
    }

    /**
     * @param $user
     * @return bool
     */
    public function delete($user): bool
    {
        return $this->checkAssignment($user, 'Post Category delete');
    }
}