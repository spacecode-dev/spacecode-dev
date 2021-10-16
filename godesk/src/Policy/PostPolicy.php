<?php

declare(strict_types=1);

namespace SpaceCode\GoDesk\Policy;

use Illuminate\Auth\Access\HandlesAuthorization;
use SpaceCode\GoDesk\Traits\Resolve;

class PostPolicy
{
    use HandlesAuthorization, Resolve;

    /**
     * @param $user
     * @return bool
     */
    public function viewAny($user): bool
    {
        return $this->checkAssignment($user, 'Post viewAny');
    }

    /**
     * @param $user
     * @return bool
     */
    public function view($user): bool
    {
        return $this->checkAssignment($user, 'Post view');
    }

    /**
     * @param $user
     * @return bool
     */
    public function create($user): bool
    {
        return $this->checkAssignment($user, 'Post create');
    }

    /**
     * @param $user
     * @return bool
     */
    public function update($user): bool
    {
        return $this->checkAssignment($user, 'Post update');
    }

    /**
     * @param $user
     * @return bool
     */
    public function delete($user): bool
    {
        return $this->checkAssignment($user, 'Post delete');
    }

    /**
     * @param $user
     * @return bool
     */
    public function restore($user): bool
    {
        return $this->checkAssignment($user, 'Post restore');
    }

    /**
     * @param $user
     * @return bool
     */
    public function forceDelete($user): bool
    {
        return $this->checkAssignment($user, 'Post forceDelete');
    }

    /**
     * @param $user
     * @return bool
     */
    public function attachAnyPostTag($user): bool
    {
        return $this->checkAssignment($user, 'Post attach any Post Tag');
    }

    /**
     * @param $user
     * @return bool
     */
    public function detachAnyPostTag($user): bool
    {
        return $this->checkAssignment($user, 'Post detach any Post Tag');
    }

    /**
     * @param $user
     * @return bool
     */
    public function attachAnyPostCategory($user): bool
    {
        return $this->checkAssignment($user, 'Post attach any Post Category');
    }

    /**
     * @param $user
     * @return bool
     */
    public function detachAnyPostCategory($user): bool
    {
        return $this->checkAssignment($user, 'Post detach any Post Category');
    }
}