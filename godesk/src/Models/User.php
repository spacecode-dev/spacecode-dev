<?php

namespace SpaceCode\GoDesk\Models;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    /**
     * @var array
     */
    protected $fillable = [
        'lang', 'name', 'avatar', 'email', 'phone', 'password',
    ];

    /**
     * @var string
     */
    protected $guard_name = 'web';

    /**
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    /**
     * @return MorphToMany
     */
    public function roles(): MorphToMany
    {
        return $this->morphToMany(Role::class, 'model', 'model_has_roles', 'model_id', 'role_id');
    }

    /**
     * @return MorphToMany
     */
    public function permissions(): MorphToMany
    {
        return $this->morphToMany(Permission::class, 'model', 'model_has_permissions', 'model_id', 'permission_id');
    }

    /**
     * @return mixed
     */
    public function isAdmin(): bool
    {
        return $this->roles->whereIn('name', ['admin', 'developer'])->count() ? true : false;
    }

    /**
     * @return mixed
     */
    public function isDeveloper(): bool
    {
        return $this->roles->whereIn('name', ['developer'])->count() ? true : false;
    }

    /**
     * @return mixed
     */
    public function hasAccessToAdminPanel(): bool
    {
        if($this->isAdmin())
            return true;
        if ($this->roles->count() > 0) {
            foreach ($this->roles as $role) {
                if ($role->permissions->contains('name', 'viewNova'))
                    return true;
            }
        }
        if ($this->permissions->count() > 0) {
            if ($this->permissions->contains('name', 'viewNova'))
                return true;
        }
        return false;
    }
}
