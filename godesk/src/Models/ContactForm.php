<?php
namespace SpaceCode\GoDesk\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ContactForm extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $casts = [
        'data' => 'array'
    ];

    /**
     * @var array
     */
    protected $appends = ['detail'];

    /**
     * @var array
     */
    public static $statuses = ['new', 'pending', 'processed', 'completed', 'canceled', 'deleted'];

    /**
     * Request constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable('contact_form');
    }

    /**
     * @return array|mixed
     */
    public function getDetailAttribute(): array
    {
        if(!$this->data) {
            return $this->data;
        }
        return collect($this->data)->map(function ($value) {
            return [Str::snake($value[0]) => $value[1]];
        })->collapse()->toArray();
    }
}
