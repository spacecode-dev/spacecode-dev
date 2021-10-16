<?php
namespace SpaceCode\GoDesk\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use SpaceCode\GoDesk\GoDesk;

class Post extends Model
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
        'index' => 'array'
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
        $this->setTable('posts');
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * @return BelongsToMany
     */
    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(PostCategory::class, 'post_post_category', 'post_id', 'post_category_id');
    }

    /**
     * @return BelongsToMany
     */
    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(PostTag::class, 'post_post_tag', 'post_id', 'post_tag_id');
    }

    /**
     * @return BelongsTo
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class, 'template_id');
    }
}
