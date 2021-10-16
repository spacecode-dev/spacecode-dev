<?php
namespace SpaceCode\GoDesk\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use SpaceCode\GoDesk\GoDesk;

class PostTag extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $appends = ['url', 'originalUrl', 'locales'];

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
            if(!is_tag_index()) {
                if(!$model->slug) {
                    $model->slug = Str::slug($model->title[GoDesk::adminLang()]);
                }
                $model->template_id = null;
                $empty = collect([]);
                $zero = collect([]);
                collect(GoDesk::websiteLangs())->map(function ($lang) use($empty, $zero) {
                    $empty->put($lang, null);
                    $zero->put($lang, '0');
                });
                $model->excerpt = $empty->toArray();
                $model->content = $empty->toArray();
                $model->meta_title = $empty->toArray();
                $model->meta_description = $empty->toArray();
                $model->meta_keywords = $empty->toArray();
                $model->index = ['google' => $zero->toArray(), 'yandex' => $zero->toArray(), 'bing' => $zero->toArray(), 'duck' => $zero->toArray(), 'baidu' => $zero->toArray(), 'yahoo' => $zero->toArray()];
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
        $this->setTable('post_tags');
    }

    /**
     * @return BelongsToMany
     */
    public function posts() : BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_post_tag', 'post_id', 'post_tag_id');
    }

    /**
     * @return BelongsTo
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class, 'template_id');
    }
}
