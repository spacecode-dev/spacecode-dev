<?php

namespace SpaceCode\GoDesk\Traits;

use File;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait Resolve {

    /**
     * @param $name
     * @return string
     */
    public function resolvePath($name): string
    {
        if($name[0] === '/') {
            return $name;
        } else {
            return '/' . $name;
        }
    }

    /**
     * @param $value
     * @return string
     */
    public function toLowerCase($value): string
    {
        return Str::lower($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function upperFirst($value): string
    {
        return Str::ucfirst(Str::lower($value));
    }

    /**
     * @param $statuses
     * @return array
     */
    public function statusOptions($statuses): array
    {
        return collect($statuses)->keys()->map(function ($key) {
            return [$key => __(Str::ucfirst($key))];
        })->collapse()->toArray();
    }

    /**
     * @return array
     */
    public function guardOptions(): array
    {
        return collect(config('auth.guards'))->mapWithKeys(function ($value, $key) {
            return [$key => $key];
        })->toArray();
    }

    /**
     * @return array
     */
    public function stateOptions(): array
    {
        return ['static' => __('Static'), 'dynamic' => __('Dynamic')];
    }

    /**
     * @param $type
     * @return array|Collection
     */
    public function getTemplate($type)
    {
        $templates = ['default' => 'Default'];
        if (File::exists(resource_path('views/vendor/godesk/templates/' . $type))) {
            $files = File::allFiles(resource_path('views/vendor/godesk/templates/' . $type));
            foreach ($files as $file) {
                if($file->getContents()[0] === '{') {
                    $contents = trim(str_replace('Template:', '', preg_split('/\{{--|\--}}(, *)?/', $file->getContents(), -1, PREG_SPLIT_NO_EMPTY)[0]));
                    if($contents !== 'Example') {
                        $names = str_replace('.blade.php', '', $file->getFilename());
                        $templates = Arr::add($templates, $names, $contents);
                    }
                }
            }
        }
        return $templates;
    }

    /**
     * @return string|null
     */
    public function linkSvg(): ?string
    {
        if($this->id) {
            $array = collect([]);
            collect($this->locales)->map(function ($locale) use($array) {
                $url = $locale ? $locale : $this->url;
                $array->push("<a style='padding-top: 2px; text-decoration: none' class='inline-flex cursor-pointer text-70 hover:text-primary mr-1' href='{$url}' target='_blank' aria-role='button'><svg width='22' height='22' class='fill-current' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'><path d='M9.26 13a2 2 0 0 1 .01-2.01A3 3 0 0 0 9 5H5a3 3 0 0 0 0 6h.08a6.06 6.06 0 0 0 0 2H5A5 5 0 0 1 5 3h4a5 5 0 0 1 .26 10zm1.48-6a2 2 0 0 1-.01 2.01A3 3 0 0 0 11 15h4a3 3 0 0 0 0-6h-.08a6.06 6.06 0 0 0 0-2H15a5 5 0 0 1 0 10h-4a5 5 0 0 1-.26-10z' /></svg></a>");
            });
            return $array->implode(' ');
        }
        return null;
    }

    /**
     * @param $model
     * @return bool
     */
    public function isAuthor($model): bool
    {
        return $model->author->isAdmin() || $model->author_id === Auth::user()->id;
    }

    /**
     * @param $user
     * @param $perm
     * @return bool
     */
    public function checkAssignment($user, $perm): bool
    {
        if($user->isAdmin()) {
            return true;
        }
        if ($user->roles->count() > 0) {
            foreach ($user->roles as $role) {
                if ($role->permissions->contains('name', $perm)) {
                    return true;
                }
            }
        }
        if ($user->permissions->count() > 0) {
            if ($user->permissions->contains('name', $perm)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $key
     * @param $value
     */
    public function putSession($key, $value)
    {
        session()->put($key, $value);
    }
}