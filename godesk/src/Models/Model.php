<?php

namespace SpaceCode\GoDesk\Models;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SpaceCode\GoDesk\GoDesk;

class Model extends BaseModel
{
    /**
     * @param $field
     * @param $limit
     * @param $end
     * @return mixed|string
     */
    public function limit($field, $limit, $end): string
    {
        return Str::limit((string)$this->{$field}, $limit, $end);
    }

    /**
     * @return string
     */
    public function getThumbnailAttribute(): string
    {
        if ($this->image) {
            return Storage::disk(config('godesk.filemanager.disk'))->url($this->image);
        }
        return '#';
    }

    /**
     * @return Application|UrlGenerator|string|null
     */
    public function getUrlAttribute()
    {
        $locale = app()->getLocale();
        $lang = '';
        if (GoDesk::isMultiLang() && GoDesk::websiteLang() !== $locale) {
            $lang = $locale;
        }
        $type = Str::snake(class_basename($this));
        if ($type === 'page') {
            if (isset($this->type) && $this->type === 'home') {
                return url($lang);
            } else if (isset($this->type) && $this->type === 'page') {
                $url = $this->slug;
                $parent = $this;
                while ($parent = $parent->parent) {
                    $url = $parent->slug . '/' . $url;
                }
                return url(!empty($lang) ? "{$lang}/{$url}" : $url);
            }
        } else if ($type === 'post') {
            $url = $this->slug;
            $prefix = get_setting('prefix_post');
            return url(!empty($lang) ? "{$lang}/{$prefix}/{$url}" : "$prefix/$url");
        } else if ($type === 'portfolio') {
            $url = $this->slug;
            $prefix = get_setting('prefix_portfolio');
            return url(!empty($lang) ? "{$lang}/{$prefix}/{$url}" : "$prefix/$url");
        } else if ($type === 'post_tag') {
            $url = $this->slug;
            $prefix = get_setting('prefix_post_tag');
            return url(!empty($lang) ? "{$lang}/{$prefix}/{$url}" : "$prefix/$url");
        } else if ($type === 'post_category') {
            $url = $this->slug;
            $prefix = get_setting('prefix_post_category');
            $parent = $this;
            while ($parent = $parent->parent) {
                $url = $parent->slug . '/' . $url;
            }
            return url(!empty($lang) ? "{$lang}/{$prefix}/{$url}" : "{$prefix}/$url");
        }
        return url($this->slug);
    }

    /**
     * @return Application|UrlGenerator|string|null
     */
    public function getOriginalUrlAttribute()
    {
        $type = Str::snake(class_basename($this));
        if ($type === 'page') {
            if ($this->type === 'home') {
                $url = '';
            } elseif ($this->type === 'page') {
                $url = $this->slug;
                $parent = $this;
                while ($parent = $parent->parent) {
                    $url = $parent->slug . '/' . $url;
                }
            } else {
                $url = $this->slug;
            }
            return url($url);
        } else if ($type === 'post') {
            $url = $this->slug;
            $prefix = get_setting('prefix_post');
            return url("$prefix/$url");
        } else if ($type === 'portfolio') {
            $url = $this->slug;
            $prefix = get_setting('prefix_portfolio');
            return url("$prefix/$url");
        } else if ($type === 'post_tag') {
            $url = $this->slug;
            $prefix = get_setting('prefix_post_tag');
            return url("$prefix/$url");
        } else if ($type === 'post_category') {
            $url = $this->slug;
            $parent = $this;
            $prefix = get_setting('prefix_post_category');
            while ($parent = $parent->parent) {
                $url = $parent->slug . '/' . $url;
            }
            return url("$prefix/$url");
        }
        return url($this->slug);
    }

    /**
     * @return array|null
     */
    public function getLocalesAttribute(): ?array
    {
        if ($this->indexType === 'custom') {
            return [];
        } else {
            return collect(GoDesk::websiteLangs())->map(function ($lang) {
                if ($lang === app()->getLocale()) {
                    return [$lang => null];
                } else {
                    return [$lang => GoDesk::urlByLocale($this, $lang)];
                }
            })->collapse()->toArray();
        }
    }

    /**
     * @param null $lang
     * @return Model
     */
    public function translateMutator($lang = null): Model
    {
        $entity = $this;
        if (!$lang)
            $lang = app()->getLocale();
        collect($entity->getCasts())->map(function ($cast, $keyCast) use ($entity, $lang) {
            if ($cast === 'array' && $keyCast !== 'index') {
                if (isset($entity->{$keyCast}[$lang])) {
                    $entity->{$keyCast} = $entity->{$keyCast}[$lang];
                } else {
                    $entity->{$keyCast} = collect($entity->{$keyCast})->first();
                }
            } else if ($cast === 'array' && $keyCast === 'index') {
                $entity->{$keyCast} = collect($entity->{$keyCast})->mapWithKeys(function ($index, $keyIndex) use ($lang) {
                    if (isset($index[$lang])) {
                        return [$keyIndex => $index[$lang]];
                    } else {
                        return [$keyIndex => collect($index)->first()];
                    }
                });
            }
        });
        return $entity;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        if(isset($this->parent_id) && !empty($this->parent_id)) {
            return $this->parent->translateMutator();
        }
        return null;
    }

    /**
     * @return mixed
     */
    public function getChildren()
    {
        if($this->children && $this->children->count() > 0) {
            return $this->children->map(function ($a) {
                return $a->translateMutator();
            });
        }
        return collect([]);
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        if($this->tags && $this->tags->count() > 0) {
            return $this->tags->map(function ($a) {
                return $a->translateMutator();
            });
        }
        return collect([]);
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        if($this->categories && $this->categories->count() > 0) {
            return $this->categories->map(function ($a) {
                return $a->translateMutator();
            });
        }
        return collect([]);
    }

    /**
     * @return mixed
     */
    public function getPosts()
    {
        if($this->posts && $this->posts->count() > 0) {
            return $this->posts->map(function ($a) {
                return $a->translateMutator();
            });
        }
        return collect([]);
    }
}