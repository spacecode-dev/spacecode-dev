<?php

declare(strict_types=1);

namespace SpaceCode\GoDesk\Policy;

use Illuminate\Auth\Access\HandlesAuthorization;
use SpaceCode\GoDesk\GoDesk;
use SpaceCode\GoDesk\Traits\Resolve;

class PermissionPolicy
{
    use HandlesAuthorization, Resolve;

    /**
     * @param $user
     * @return bool
     */
    public function viewAny($user): bool
    {
        return $this->checkAssignment($user, 'Permission viewAny');
    }

    /**
     * @param $user
     * @return bool
     */
    public function view($user): bool
    {
        return $this->checkAssignment($user, 'Permission view');
    }

    /**
     * @param $user
     * @return bool
     */
    public function create($user): bool
    {
        return $this->checkAssignment($user, 'Permission create');
    }

    /**
     * @param $user
     * @return bool
     */
    public function update($user): bool
    {
        return $this->requiredRules($user, 'Permission update');
    }

    /**
     * @param $user
     * @return bool
     */
    public function delete($user): bool
    {
        return $this->requiredRules($user, 'Permission delete');
    }

    /**
     * @param $user
     * @param $perm
     * @return bool
     */
    private function requiredRules($user, $perm): bool
    {
        if(in_array($perm, GoDesk::requiredPermissions())) {
            return false;
        }
        return $this->checkAssignment($user, $perm);
    }
}