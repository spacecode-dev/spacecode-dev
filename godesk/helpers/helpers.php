<?php

use Illuminate\Support\Str;
use SpaceCode\GoDesk\GoDesk;
use SpaceCode\GoDesk\Tools\SettingsTool;

if (!function_exists('get_settings')) {
    /**
     * @param null $settingKeys
     * @return array
     */
    function get_settings($settingKeys = null): array
    {
        return SettingsTool::getSettings($settingKeys);
    }
}

if (!function_exists('get_setting')) {
    /**
     * @param $settingKey
     * @param null $default
     * @return mixed
     */
    function get_setting($settingKey, $default = null)
    {
        $setting = SettingsTool::getSetting($settingKey, $default);
        if (is_json($setting)) {
            return json_decode($setting);
        }
        return $setting;
    }
}

if (!function_exists('get_locale_setting')) {
    /**
     * @param $settingKey
     * @return mixed
     */
    function get_locale_setting($settingKey)
    {
        $setting = SettingsTool::getSetting($settingKey);
        if(!$setting) {
            return 0;
        }
        return json_decode($setting)->{app()->getLocale()};
    }
}

if (!function_exists('get_variables_text')) {
    /**
     * @return mixed
     */
    function get_variables_text(): string
    {
        return '<h4>' . __('List of variables to use:') . '</h4><ul class="leading-normal text-sm">
<li class="mt-1 mb-1"><span class="bg-success px-2 rounded-lg text-white">:w-title</span> ' . __('`Settings -> Website -> Title`') . '</li>
<li class="mb-1"><span class="bg-success px-2 rounded-lg text-white">:w-excerpt</span> ' . __('`Settings -> Website -> Excerpt`') . '</li>
<li class="mb-1"><span class="bg-success px-2 rounded-lg text-white">:w-desc</span> ' . __('`Settings -> Website -> Description`') . '</li>
<li class="mb-1"><span class="bg-success px-2 rounded-lg text-white">:e-name</span> ' . __('`Resource -> Content -> Name`') . '</li>
<li><span class="bg-success px-2 rounded-lg text-white">:e-excerpt</span> ' . __('`Resource -> Content -> Excerpt`') . '</li>
</ul>';
    }
}

if (!function_exists('get_favicon')) {
    /**
     * @param $path
     * @param $size
     * @return string
     */
    function get_favicon($path, $size): string
    {
        $mime = explode('.', $path)[1];
        $name = explode('.', $path)[0];
        return GoDesk::image("{$name}_{$size}.{$mime}");
    }
}

if (!function_exists('body_class')) {
    /**
     * @param $entity
     * @return string
     */
    function body_class($entity): string
    {
        $returnClasses = collect([]);
        if ($entity->indexType !== 'custom') {
            $returnClasses = $returnClasses->merge([$entity->indexType, "$entity->indexType-$entity->id", $entity->slug]);
        }
        if ($entity->indexType === 'page') {
            $returnClasses = $returnClasses->merge($entity->type);
            if ($entity->type === 'home') {
                $returnClasses = $returnClasses->reject(function ($class) use ($entity) {
                    return $class === "$entity->indexType-$entity->id" || $class === $entity->slug || $class === $entity->indexType;
                });
            }
        }
        if (is_array($entity->indexClasses) && count($entity->indexClasses) > 0) {
            $returnClasses = $returnClasses->merge($entity->indexClasses);
        }
        return $returnClasses->values()->unique()->implode(' ');
    }
}

if (!function_exists('robots_all')) {
    /**
     * @param $type
     * @param $index
     * @return string
     */
    function robots_all($type, $index): string
    {
        $indexing = collect($index)->filter();
        if (get_setting('indexing_' . $type . '_priority')) {
            $indexing = collect(get_settings([
                'indexing_' . $type . '_google',
                'indexing_' . $type . '_yandex',
                'indexing_' . $type . '_bing',
                'indexing_' . $type . '_duck',
                'indexing_' . $type . '_baidu',
                'indexing_' . $type . '_yahoo'
            ]))->map(function ($value) {
                return json_decode($value)->{app()->getLocale()};
            })->filter();
        }
        return $indexing->count() > 0 ? 'index, follow' : 'noindex, nofollow';
    }
}

if (!function_exists('robots_google')) {
    /**
     * @param $type
     * @param $index
     * @return string
     */
    function robots_google($type, $index): string
    {
        $indexing = $index['google'] ?? '1';
        if (get_setting('indexing_' . $type . '_priority')) {
            $indexing = get_locale_setting('indexing_' . $type . '_google');
        }
        return $indexing ? 'index, follow' : 'noindex, nofollow';
    }
}

if (!function_exists('robots_yandex')) {
    /**
     * @param $type
     * @param $index
     * @return string
     */
    function robots_yandex($type, $index): string
    {
        $indexing = $index['yandex'] ?? '0';
        if (get_setting('indexing_' . $type . '_priority')) {
            $indexing = get_locale_setting('indexing_' . $type . '_yandex');
        }
        return $indexing ? 'index, follow' : 'noindex, nofollow';
    }
}

if (!function_exists('robots_bing')) {
    /**
     * @param $type
     * @param $index
     * @return string
     */
    function robots_bing($type, $index): string
    {
        $indexing = $index['bing'] ?? '0';
        if (get_setting('indexing_' . $type . '_priority')) {
            $indexing = get_locale_setting('indexing_' . $type . '_bing');
        }
        return $indexing ? 'index, follow' : 'noindex, nofollow';
    }
}

if (!function_exists('robots_duck')) {
    /**
     * @param $type
     * @param $index
     * @return string
     */
    function robots_duck($type, $index): string
    {
        $indexing = $index['duck'] ?? '0';
        if (get_setting('indexing_' . $type . '_priority')) {
            $indexing = get_locale_setting('indexing_' . $type . '_duck');
        }
        return $indexing ? 'index, follow' : 'noindex, nofollow';
    }
}

if (!function_exists('robots_baidu')) {
    /**
     * @param $type
     * @param $index
     * @return string
     */
    function robots_baidu($type, $index): string
    {
        $indexing = $index['baidu'] ?? '0';
        if (get_setting('indexing_' . $type . '_priority')) {
            $indexing = get_locale_setting('indexing_' . $type . '_baidu');
        }
        return $indexing ? 'index, follow' : 'noindex, nofollow';
    }
}

if (!function_exists('robots_yahoo')) {
    /**
     * @param $type
     * @param $index
     * @return string
     */
    function robots_yahoo($type, $index): string
    {
        $indexing = $index['yahoo'] ?? '0';
        if (get_setting('indexing_' . $type . '_priority')) {
            $indexing = get_locale_setting('indexing_' . $type . '_yahoo');
        }
        return $indexing ? 'index, follow' : 'noindex, nofollow';
    }
}

if (!function_exists('meta_title')) {
    /**
     * @param $entity
     * @return string
     */
    function meta_title($entity): string
    {
        $global = get_locale_setting('indexing_' . $entity->indexType . '_meta_title');
        $result = $entity->meta_title;
        if (get_setting('indexing_' . $entity->indexType . '_priority') && !empty($global)) {
            $result = $global;
        } else if (empty($entity->meta_title)) {
            $result = $entity->title;
        }
        return GoDesk::withVariables(strip_tags($result), $entity);
    }
}

if (!function_exists('meta_description')) {
    /**
     * @param $entity
     * @return string
     */
    function meta_description($entity): string
    {
        $global = get_locale_setting('indexing_' . $entity->indexType . '_meta_description');
        $result = $entity->meta_description;
        if (get_setting('indexing_' . $entity->indexType . '_priority') && !empty($global)) {
            $result = $global;
        } else if (empty($entity->meta_description) && !empty($entity->excerpt)) {
            $result = $entity->excerpt;
        }
        return GoDesk::withVariables(strip_tags($result), $entity);
    }
}

if (!function_exists('is_parent')) {
    /**
     * @param $entity
     * @return string
     */
    function is_parent($entity): string
    {
        if (isset($entity->parent_id) && !empty($entity->parent_id)) {
            return $entity->parent->url;
        }
        return '';
    }
}

if (!function_exists('is_pagination')) {
    /**
     * @param $entity
     * @param $type
     * @return string|string[]
     */
    function is_pagination($entity, $type)
    {
        if (property_exists($entity, 'paginationItem') && !empty($entity->paginationItem) && $entity->paginationItem->count() > 0) {
            if ($type === 'first') {
                return $entity->getUrl(true);
            } elseif ($type === 'last') {
                return url()->current() . '?page=' . $entity->paginationItem->lastPage();
            } elseif ($type === 'next') {
                return $entity->paginationItem->nextPageUrl();
            } elseif ($type === 'prev') {
                return str_replace('?page=1', '', $entity->paginationItem->previousPageUrl());
            }
        }
        return '';
    }
}

if (!function_exists('is_json')) {
    /**
     * @param $string
     * @return bool
     */
    function is_json($string): bool
    {
        json_decode($string);
        return (json_last_error() === JSON_ERROR_NONE);
    }
}

if (!function_exists('is_tag_index')) {
    /**
     * @return bool
     */
    function is_tag_index(): bool
    {
        if (get_setting('use_blog') && !get_setting('blog_hide_tags')) {
            return true;
        }
        return false;
    }
}

if (!function_exists('get_ip')) {
    /**
     * @return mixed|string
     */
    function get_ip(): string
    {
        $keys = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'];
        foreach ($keys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }
}

if (!function_exists('ip_info')) {
    /**
     * @param null $ip
     * @param string $purpose
     * @param bool $deep_detect
     * @return array|string|null
     */
    function ip_info($ip = null, $purpose = 'location', $deep_detect = true)
    {
        $output = null;
        if (filter_var($ip, FILTER_VALIDATE_IP) === false) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect)
                $ip = get_ip();
        }
        $purpose = str_replace(['name', "\n", "\t", ' ', '-', '_'], null, strtolower(trim($purpose)));
        $support = ['country', 'countrycode', 'state', 'region', 'city', 'location', 'address'];
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = json_decode(file_get_contents('http://ip-api.com/json/' . $ip));
            if ($ipdat->status === 'success' && @strlen(trim($ipdat->countryCode)) === 2) {
                switch ($purpose) {
                    case 'location':
                        $output = [
                            'city' => @$ipdat->city,
                            'state' => @$ipdat->regionName,
                            'country' => @$ipdat->country,
                            'country_code' => @$ipdat->countryCode
                        ];
                        break;
                    case 'address':
                        $address = [$ipdat->country];
                        if (@strlen($ipdat->regionName) >= 1)
                            $address[] = $ipdat->regionName;
                        if (@strlen($ipdat->city) >= 1)
                            $address[] = $ipdat->city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case 'city':
                        $output = @$ipdat->city;
                        break;
                    case 'region':
                    case 'state':
                        $output = @$ipdat->regionName;
                        break;
                    case 'country':
                        $output = @$ipdat->country;
                        break;
                    case 'countrycode':
                        $output = @$ipdat->countryCode;
                        break;
                }
            }
        }
        return $output;
    }
}

