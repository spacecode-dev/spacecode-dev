<?php

declare(strict_types=1);

namespace SpaceCode\GoDesk\Policy;

use Illuminate\Auth\Access\HandlesAuthorization;
use SpaceCode\GoDesk\Traits\Resolve;

class UserPolicy
{
    use HandlesAuthorization, Resolve;

    /**
     * @param $user
     * @return bool
     */
    public function viewAny($user): bool
    {
        return $this->checkAssignment($user, 'User viewAny');
    }

    /**
     * @param $user
     * @return bool
     */
    public function view($user): bool
    {
        return $this->checkAssignment($user, 'User view');
    }

    /**
     * @param $user
     * @return bool
     */
    public function create($user): bool
    {
        return $this->checkAssignment($user, 'User create');
    }

    /**
     * @param $user
     * @return bool
     */
    public function update($user): bool
    {
        return $this->checkAssignment($user, 'User update');
    }

    /**
     * @param $user
     * @return bool
     */
    public function delete($user): bool
    {
        return $this->checkAssignment($user, 'User delete');
    }

    /**
     * @param $user
     * @return bool
     */
    public function attachAnyRole($user): bool
    {
        return $this->checkAssignment($user, 'User attach any Role');
    }

    /**
     * @param $user
     * @return bool
     */
    public function attachRole($user): bool
    {
        return $this->checkAssignment($user, 'User attach Role');
    }

    /**
     * @param $user
     * @return bool
     */
    public function detachAnyRole($user): bool
    {
        return $this->checkAssignment($user, 'User detach any Role');
    }

    /**
     * @param $user
     * @return bool
     */
    public function detachRole($user): bool
    {
        return $this->checkAssignment($user, 'User detach Role');
    }

    /**
     * @param $user
     * @return bool
     */
    public function attachAnyPermission($user): bool
    {
        return $this->checkAssignment($user, 'User attach any Permission');
    }

    /**
     * @param $user
     * @return bool
     */
    public function detachAnyPermission($user): bool
    {
        return $this->checkAssignment($user, 'User detach any Permission');
    }
}