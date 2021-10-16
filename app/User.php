<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;
use SpaceCode\GoDesk\Models\User as GoDeskUser;

class User extends GoDeskUser
{
    /**
     * @return HasMany
     */
    public function licenses() : HasMany
    {
        return $this->hasMany(License::class, 'author_id');
    }
}
