<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use SpaceCode\GoDesk\Models\User;

class License extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    public static $types = ['solo', 'pro'];

    /**
     * @var array
     */
    public static $statuses = ['active', 'inactive'];

    /**
     * @var string[]
     */
    protected $casts = [
        'purchased_at' => 'datetime:Y-m-d',
    ];

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
