<?php
namespace SpaceCode\GoDesk\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use SpaceCode\GoDesk\GoDesk;

class Portfolio extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $appends = ['url', 'originalUrl', 'locales', 'thumbnail'];

    /**
     * @var array
     */
    protected $casts = [
        'title' => 'array',
        'excerpt' => 'array',
        'content' => 'array',
        'meta_title' => 'array',
        'meta_description' => 'array',
        'meta_keywords' => 'array',
        'index' => 'array',
        'variables' => 'object'
    ];

    /**
     * @var array
     */
    public static $statuses = ['published', 'pending'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? config('auth.defaults.guard');
        $attributes['author_id'] = $attributes['author_id'] ?? Auth::id();
        $attributes['status'] = $attributes['status'] ?? 'pending';
        $attributes['index'] = $attributes['index'] ?? collect(['google', 'yandex', 'bing', 'duck', 'baidu', 'yahoo'])->map(function ($index) {
                return [$index => collect(GoDesk::websiteLangs())->mapWithKeys(function ($lang) use($index) {
                    if($index === 'google')
                        return [$lang => '1'];
                    return (object)[$lang => '0'];
                })];
            })->collapse();
        $attributes['document_state'] = $attributes['document_state'] ?? 'dynamic';
        parent::__construct($attributes);
        $this->setTable('portfolio');
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * @return BelongsTo
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class, 'template_id');
    }
}
