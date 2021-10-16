<?php
namespace SpaceCode\GoDesk\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SpaceCode\GoDesk\Exceptions\PostCategoryConflict;
use SpaceCode\GoDesk\GoDesk;

class PostCategory extends Model
{
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

    public static function boot()
    {
        parent::boot();

        static::saving(function($model) {
            if ($model->parent_id && $model->parent->slug === $model->slug) {
                if ($model->parent->slug === $model->slug) {
                    throw PostCategoryConflict::itSelf($model->title);
                }
            }
            $already = self::all()->map(function ($entity) use($model) {
                if($model->id !== $entity->id) return $entity->originalUrl;
            })->filter();
            if($already->count() > 0 && $model->parent_id && in_array($model->originalUrl, $already->toArray())) {
                throw PostCategoryConflict::url($model->originalUrl, $model->guard_name);
            }

            return true;
        });
    }

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? config('auth.defaults.guard');
        $attributes['index'] = $attributes['index'] ?? collect(['google', 'yandex', 'bing', 'duck', 'baidu', 'yahoo'])->map(function ($index) {
                return [$index => collect(GoDesk::websiteLangs())->mapWithKeys(function ($lang) use($index) {
                    if($index === 'google')
                        return [$lang => '1'];
                    return (object)[$lang => '0'];
                })];
            })->collapse();
        $attributes['document_state'] = $attributes['document_state'] ?? 'dynamic';
        parent::__construct($attributes);
        $this->setTable('post_categories');
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * @return BelongsToMany
     */
    public function posts() : BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_post_category', 'post_id', 'post_category_id');
    }

    /**
     * @return BelongsTo
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class, 'template_id');
    }
}
