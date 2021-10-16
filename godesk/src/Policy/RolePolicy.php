<?php

declare(strict_types=1);

namespace SpaceCode\GoDesk\Policy;

use Illuminate\Auth\Access\HandlesAuthorization;
use SpaceCode\GoDesk\GoDesk;
use SpaceCode\GoDesk\Traits\Resolve;

class RolePolicy
{
    use HandlesAuthorization, Resolve;

    /**
     * @param $user
     * @return bool
     */
    public function viewAny($user): bool
    {
        return $this->checkAssignment($user, 'Role viewAny');
    }

    /**
     * @param $user
     * @return bool
     */
    public function view($user): bool
    {
        return $this->checkAssignment($user, 'Role view');
    }

    /**
     * @param $user
     * @return bool
     */
    public function create($user): bool
    {
        return $this->checkAssignment($user, 'Role create');
    }

    /**
     * @param $user
     * @param $role
     * @return bool
     */
    public function update($user, $role): bool
    {
        return $this->requiredRules($user, $role->name, 'Role update');
    }

    /**
     * @param $user
     * @param $role
     * @return bool
     */
    public function delete($user, $role): bool
    {
        return $this->requiredRules($user, $role->name, 'Role delete');
    }

    /**
     * @param $user
     * @param $name
     * @param $perm
     * @return bool
     */
    private function requiredRules($user, $name, $perm): bool
    {
        if(in_array($name, GoDesk::requiredRoles())) {
            return false;
        }
        return $this->checkAssignment($user, $perm);
    }
}