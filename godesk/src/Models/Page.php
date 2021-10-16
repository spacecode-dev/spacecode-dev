<?php
namespace SpaceCode\GoDesk\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use SpaceCode\GoDesk\Exceptions\PageConflict;
use SpaceCode\GoDesk\GoDesk;

class Page extends Model
{
    use SoftDeletes;

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
        'index' => 'array',
        'variables' => 'object'
    ];

    /**
     * @var array
     */
    public static $statuses = ['published', 'pending'];

    public static function boot()
    {
        parent::boot();

        static::saving(function($model) {

            $prefixes = Settings::where('key', 'LIKE', 'prefix_%')->pluck('value');
            if(!$model->parent_id) {
                $langs = get_setting('website_langs');
                if(in_array($model->slug, collect($langs)->concat(GoDesk::reservedPath())->all())) {
                    throw PageConflict::reserved($model->title, $model->slug);
                }
            } elseif ($model->parent_id) {
                if($model->parent->type === 'home') {
                    throw PageConflict::homeType($model->title);
                } else if (in_array($model->parent->slug, $prefixes->toArray())) {
                    throw PageConflict::likePrefix($model->title);
                } else if ($model->parent->slug === $model->slug) {
                    throw PageConflict::itSelf($model->title);
                }
            }

            $already = self::all()->map(function ($page) use($model) {
                if($model->id !== $page->id) return $page->originalUrl;
            })->filter();
            if($already->count() > 0 && $model->parent_id && in_array($model->originalUrl, $already->toArray())) {
                throw PageConflict::url($model->originalUrl, $model->guard_name);
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
        $attributes['type'] = $attributes['type'] ?? 'page';
        $attributes['author_id'] = $attributes['author_id'] ?? Auth::id();
        $attributes['status'] = $attributes['status'] ?? 'pending';
        $attributes['is_system'] = $attributes['is_system'] ?? 0;
        $attributes['index'] = $attributes['index'] ?? collect(['google', 'yandex', 'bing', 'duck', 'baidu', 'yahoo'])->map(function ($index) {
                return [$index => collect(GoDesk::websiteLangs())->mapWithKeys(function ($lang) use($index) {
                    if($index === 'google')
                        return [$lang => '1'];
                    return (object)[$lang => '0'];
                })];
            })->collapse();
        $attributes['document_state'] = $attributes['document_state'] ?? 'dynamic';
        parent::__construct($attributes);
        $this->setTable('pages');
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
        return $this->hasMany(self::class, 'parent_id', 'id');
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
