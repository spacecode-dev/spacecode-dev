<?php

declare(strict_types=1);

namespace SpaceCode\GoDesk\Policy;

use Illuminate\Auth\Access\HandlesAuthorization;
use SpaceCode\GoDesk\Traits\Resolve;

class ContactFormPolicy
{
    use HandlesAuthorization, Resolve;

    /**
     * @param $user
     * @return bool
     */
    public function viewAny($user): bool
    {
        return $this->checkAssignment($user, 'Contact Form viewAny');
    }

    /**
     * @param $user
     * @return bool
     */
    public function view($user): bool
    {
        return $this->checkAssignment($user, 'Contact Form view');
    }

    /**
     * @return bool
     */
    public function create(): bool
    {
        return false;
    }

    /**
     * @param $user
     * @return bool
     */
    public function update($user): bool
    {
        return $this->checkAssignment($user, 'Contact Form update');
    }

    /**
     * @param $user
     * @return bool
     */
    public function delete($user): bool
    {
        return $this->checkAssignment($user, 'Contact Form delete');
    }

    /**
     * @param $user
     * @return bool
     */
    public function restore($user): bool
    {
        return $this->checkAssignment($user, 'Contact Form restore');
    }

    /**
     * @param $user
     * @return bool
     */
    public function forceDelete($user): bool
    {
        return $this->checkAssignment($user, 'Contact Form forceDelete');
    }
}