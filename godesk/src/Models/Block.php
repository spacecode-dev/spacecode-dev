<?php
namespace SpaceCode\GoDesk\Models;

use Illuminate\Database\Eloquent\Model;
use Whitecube\NovaFlexibleContent\Concerns\HasFlexible;
use Whitecube\NovaFlexibleContent\Value\FlexibleCast;

class Block extends Model
{
    use HasFlexible;

    protected $casts = [
        'content' => FlexibleCast::class
    ];

    /**
     * @var array
     */
    protected $guarded = ['id'];
}
