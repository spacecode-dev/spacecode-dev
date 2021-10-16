<?php

declare(strict_types=1);

namespace SpaceCode\GoDesk\Policy;

use Illuminate\Auth\Access\HandlesAuthorization;
use SpaceCode\GoDesk\Traits\Resolve;

class PagePolicy
{
    use HandlesAuthorization, Resolve;

    /**
     * @param $user
     * @return bool
     */
    public function viewAny($user): bool
    {
        return $this->checkAssignment($user, 'Page viewAny');
    }

    /**
     * @param $user
     * @return bool
     */
    public function view($user): bool
    {
        return $this->checkAssignment($user, 'Page view');
    }

    /**
     * @param $user
     * @return bool
     */
    public function create($user): bool
    {
        return $this->checkAssignment($user, 'Page create');
    }

    /**
     * @param $user
     * @return bool
     */
    public function update($user): bool
    {
        return $this->checkAssignment($user, 'Page update');
    }

    /**
     * @param $user
     * @param $page
     * @return bool
     */
    public function delete($user, $page): bool
    {
        if($page->type === 'home') {
            return false;
        }
        return $this->checkAssignment($user, 'Page delete');
    }

    /**
     * @param $user
     * @return bool
     */
    public function restore($user): bool
    {
        return $this->checkAssignment($user, 'Page restore');
    }

    /**
     * @param $user
     * @param $page
     * @return bool
     */
    public function forceDelete($user, $page): bool
    {
        if($page->type === 'home') {
            return false;
        }
        return $this->checkAssignment($user, 'Page forceDelete');
    }
}