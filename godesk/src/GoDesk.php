<?php

namespace SpaceCode\GoDesk;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SpaceCode\GoDesk\Models\Page;
use SpaceCode\GoDesk\Models\Portfolio;
use SpaceCode\GoDesk\Models\Post;
use SpaceCode\GoDesk\Models\PostCategory;
use SpaceCode\GoDesk\Models\PostTag;
use SpaceCode\GoDesk\Models\Settings;

/**
 * Class GoDesk
 * @package SpaceCode\GoDesk
 */
class GoDesk
{
    /**
     * @var array
     */
    public static $variables = [
        ':w-title',
        ':w-excerpt',
        ':w-desc',
        ':e-name',
        ':e-excerpt'
    ];

    /**
     * @return Repository|Application|mixed
     */
    public static function name()
    {
        return config('godesk.name');
    }

    /**
     * @return string
     */
    public static function profilePath(): string
    {
        return '/' . get_setting('prefix_profile');
    }

    /**
     * @return Repository|Application|mixed
     */
    public static function adminPrefix()
    {
        return str_replace('/', '', config('godesk.admin_path'));
    }

    /**
     * @return Collection
     */
    public static function disallowPath(): Collection
    {
        return collect([
            self::adminPrefix(),
            get_setting('prefix_profile'),
            'login',
            'logout',
            'reset',
            'password',
            'nova-api',
            'nova-vendor',
            'godesk-api',
            'godesk-vendor',
            'telescope',
            'horizon',
            'api',
        ]);
    }

    /**
     * @return array
     */
    public static function reservedPath(): array
    {
        return self::locales()->keys()->merge([
            self::adminPrefix(),
            'login',
            'logout',
            'reset',
            'password',
            'nova-api',
            'nova-vendor',
            'godesk-api',
            'godesk-vendor',
            'telescope',
            'horizon',
            'api',
        ])->toArray();
    }

    /**
     * @param $text
     * @param $entity
     * @return string
     */
    public static function withVariables($text, $entity): string
    {
        return str_replace(self::$variables, [
            get_locale_setting('website_title'),
            get_locale_setting('website_excerpt'),
            get_locale_setting('website_description'),
            $entity->title,
            $entity->excerpt,
        ], $text);
    }

    /**
     * @param $file
     * @return string
     */
    public static function image($file): string
    {
        return Storage::disk(config('godesk.filemanager.disk'))->url($file);
    }

    /**
     * @param null $path
     * @return string
     */
    public static function url($path = null): string
    {
        return url($path);
    }

    /**
     * @param $entity
     * @param $lang
     * @return string
     */
    public static function urlByLocale($entity, $lang): string
    {
        if($lang === self::websiteLang())
           $lang = '';
        $type = Str::snake(class_basename($entity));
        if($type === 'page') {
            if(isset($entity->type) && $entity->type === 'home') {
                return url($lang);
            } else if (isset($entity->type) && $entity->type === 'page') {
                $url = $entity->slug;
                $parent = $entity;
                while ($parent = $parent->parent) {
                    $url = $parent->slug . '/' . $url;
                }
                return url(!empty($lang) ? "{$lang}/{$url}" : $url);
            }
        } else if ($type === 'post') {
            $url = $entity->slug;
            $prefix = get_setting('prefix_post');
            return url(!empty($lang) ? "{$lang}/{$prefix}/{$url}" : "$prefix/$url");
        } else if ($type === 'portfolio') {
            $url = $entity->slug;
            $prefix = get_setting('prefix_portfolio');
            return url(!empty($lang) ? "{$lang}/{$prefix}/{$url}" : "$prefix/$url");
        } else if ($type === 'post_tag') {
            $url = $entity->slug;
            $prefix = get_setting('prefix_post_tag');
            return url(!empty($lang) ? "{$lang}/{$prefix}/{$url}" : "$prefix/$url");
        } else if ($type === 'post_category') {
            $url = $entity->slug;
            $prefix = get_setting('prefix_post_category');
            $parent = $entity;
            while ($parent = $parent->parent) {
                $url = $parent->slug . '/' . $url;
            }
            return url(!empty($lang) ? "{$lang}/{$prefix}/{$url}" : "{$prefix}/$url");
        }
        return url($entity->slug);
    }

    /**
     * @param $type
     * @param $id
     * @param null $lang
     * @return string|null
     */
    public static function urlById($type, $id, $lang = null): ?string
    {
        if($type === 'page') {
            $entity = Page::find($id);
        } else if ($type === 'post') {
            $entity = Post::find($id);
        } else if ($type === 'portfolio') {
            $entity = Portfolio::find($id);
        } else if ($type === 'post_tag') {
            $entity = PostTag::find($id);
        } else if ($type === 'post_category') {
            $entity = PostCategory::find($id);
        } else {
            return null;
        }
        return self::urlByLocale($entity, $lang);
    }

    /**
     * @return Collection
     */
    public static function locales(): Collection
    {
        return collect([
            'ab' => __('Abkhazian'),
            'az' => __('Azerbaijani'),
            'ay' => __('Aymara'),
            'sq' => __('Albanian'),
            'am' => __('Amharic'),
            'en' => __('English'),
            'ar' => __('Arab'),
            'hy' => __('Armenian'),
            'as' => __('Assamese'),
            'aa' => __('Afarsky'),
            'af' => __('Afrikaans'),
            'eu' => __('Basque'),
            'ba' => __('Bashkir'),
            'be' => __('Belorussian'),
            'bn' => __('Bengal'),
            'my' => __('Burmese'),
            'bi' => __('Bislama'),
            'bh' => __('Bihar'),
            'bg' => __('Bulgarian'),
            'br' => __('Breton'),
            'dz' => __('Bhutani'),
            'cy' => __('Welsh'),
            'wa' => __('Walloon'),
            'hu' => __('Hungarian'),
            'vo' => __('Volapuk'),
            'wo' => __('Wolof'),
            'vi' => __('Vietnamese'),
            'gl' => __('Galician'),
            'kl' => __('Greenlandic'),
            'el' => __('Greek'),
            'ka' => __('Georgian'),
            'gn' => __('Guarani'),
            'gu' => __('Gujarati'),
            'gd' => __('Gaelic (Scottish)'),
            'gv' => __('Gaelic (the language of the Isle of Man)'),
            'da' => __('Danish'),
            'he' => __('Jewish'),
            'zu' => __('Zulu'),
            'yi' => __('Yiddish'),
            'id' => __('Indonesian'),
            'ia' => __('Interlingua'),
            'ie' => __('Interlingue'),
            'iu' => __('Inuktitut'),
            'ik' => __('Inupiac'),
            'ga' => __('Irish'),
            'is' => __('Icelandic'),
            'es' => __('Spanish'),
            'it' => __('Italian'),
            'yo' => __('Yoruba'),
            'kk' => __('Kazakh'),
            'km' => __('Cambodian'),
            'kn' => __('Kannada'),
            'ca' => __('Catalan'),
            'ks' => __('Kashmiri'),
            'qu' => __('Quechua'),
            'rw' => __('Kinyarwanda (Rwanda)'),
            'ky' => __('Kyrgyz'),
            'rn' => __('Kirundi (Rundi)'),
            'zh' => __('Chinese'),
            'ko' => __('Korean'),
            'co' => __('Corsican'),
            'xh' => __('Scythe'),
            'ku' => __('Kurdish'),
            'lo' => __('Lao'),
            'lv' => __('Latvian'),
            'la' => __('Latin'),
            'li' => __('Limburger'),
            'ln' => __('Lingala'),
            'lt' => __('Lithuanian'),
            'mk' => __('Macedonian'),
            'mg' => __('Malagasy'),
            'ms' => __('Malay'),
            'ml' => __('Malayalam'),
            'mt' => __('Maltese'),
            'mi' => __('Maori'),
            'mr' => __('Marathi'),
            'mo' => __('Moldavian'),
            'mn' => __('Mongolian'),
            'na' => __('Nauruan'),
            'de' => __('German'),
            'ne' => __('Nepali'),
            'nl' => __('Dutch'),
            'no' => __('Norwegian'),
            'oc' => __('Occitan'),
            'or' => __('Oriya'),
            'om' => __('Oromo (Athan, Galla)'),
            'pa' => __('Punjabi'),
            'pl' => __('Polish'),
            'pt' => __('Portuguese'),
            'ps' => __('Pashto (Pushto)'),
            'rm' => __('Romance'),
            'ro' => __('Romanian'),
            'ru' => __('Russian'),
            'sm' => __('Samoan'),
            'sg' => __('Sangro'),
            'sa' => __('Sanskrit'),
            'ss' => __('Swati'),
            'sh' => __('Serbo-Croatian'),
            'sr' => __('Serbian'),
            'st' => __('Sesotho'),
            'si' => __('Sinhalese'),
            'sd' => __('Sindhi'),
            'sk' => __('Slovak'),
            'sl' => __('Slovenian'),
            'so' => __('Somali'),
            'sw' => __('Swahili'),
            'su' => __('Sundanese'),
            'tl' => __('Tagalog'),
            'tg' => __('Tajik'),
            'th' => __('Thai'),
            'ta' => __('Tamil'),
            'tt' => __('Tatar'),
            'te' => __('Telugu'),
            'bo' => __('Tibetan'),
            'ti' => __('Tigrinya'),
            'to' => __('Tongan'),
            'tn' => __('Tswana (Setswana)'),
            'ts' => __('Tsonga'),
            'tr' => __('Turkish'),
            'tk' => __('Turkmen'),
            'uz' => __('Uzbek'),
            'ug' => __('Uyghur'),
            'uk' => __('Ukrainian'),
            'ur' => __('Urdu'),
            'fo' => __('Faroese'),
            'fa' => __('Farsi'),
            'fj' => __('Fiji'),
            'fi' => __('Finnish'),
            'fr' => __('French'),
            'fy' => __('Frisian'),
            'ha' => __('Hausa'),
            'hi' => __('Hindi'),
            'hr' => __('Croatian'),
            'tw' => __('Chvi'),
            'cs' => __('Czech'),
            'sv' => __('Swedish'),
            'sn' => __('Shauna'),
            'eo' => __('Esperanto'),
            'et' => __('Estonian'),
            'jv' => __('Javanese'),
            'ja' => __('Japanese'),
        ]);
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function localeValue($key)
    {
        return self::locales()[$key];
    }

    /**
     * @return mixed
     */
    public static function adminLang()
    {
        return request()->user()->lang;
    }

    /**
     * @return mixed
     */
    public static function websiteLang()
    {
        return get_setting('website_lang');
    }

    /**
     * @return Repository|Application|mixed
     */
    public static function timezone()
    {
        return !get_setting('website_timezone') ? config('app.timezone') : get_setting('website_timezone');
    }

    /**
     * @return string|string[]
     */
    public static function locale()
    {
        return str_replace('_', '-', app()->getLocale());
    }

    /**
     * @return array
     */
    public static function websiteLangs(): array
    {
        return get_setting('website_langs');
    }

    /**
     * @return array
     */
    public static function websiteLangsWithNames(): array
    {
        return collect(get_setting('website_langs'))->map(function ($key) {
            return [$key => self::localeValue($key)];
        })->collapse()->toArray();
    }

    /**
     * @param $string
     * @return string
     */
    public static function translatableAttribute($string): string
    {
        return $string . '.' . request()->user()->lang;
    }

    /**
     * @return bool
     */
    public static function isMultiLang(): bool
    {
        return count(get_setting('website_langs')) > 1;
    }

    /**
     * @return PendingRouteRegistration
     */
    public static function routes(): PendingRouteRegistration
    {
        return new PendingRouteRegistration;
    }

    /**
     * @return string
     */
    public static function version(): string
    {
        return once(function () {
            $manifest = json_decode(File::get(__DIR__.'/../composer.json'), true);
            return $manifest['version'] ?? '1.x';
        });
    }

    /**
     * @return array
     */
    public static function requiredPermissions(): array
    {
        return [
            'Contact Form viewAny',
            'Contact Form view',
            'Contact Form create',
            'Contact Form update',
            'Contact Form delete',
            'Contact Form restore',
            'Contact Form forceDelete',

            'Page viewAny',
            'Page view',
            'Page create',
            'Page update',
            'Page delete',
            'Page restore',
            'Page forceDelete',

            'Portfolio viewAny',
            'Portfolio view',
            'Portfolio create',
            'Portfolio update',
            'Portfolio delete',
            'Portfolio restore',
            'Portfolio forceDelete',

            'Post viewAny',
            'Post view',
            'Post create',
            'Post update',
            'Post delete',
            'Post restore',
            'Post forceDelete',
            'Post attach any Post Tag',
            'Post detach any Post Tag',
            'Post attach any Post Category',
            'Post detach any Post Category',

            'Post Tag viewAny',
            'Post Tag view',
            'Post Tag create',
            'Post Tag update',
            'Post Tag delete',

            'Post Category viewAny',
            'Post Category view',
            'Post Category create',
            'Post Category update',
            'Post Category delete',

            'Permission viewAny',
            'Permission view',
            'Permission create',
            'Permission update',
            'Permission delete',

            'Role viewAny',
            'Role view',
            'Role create',
            'Role update',
            'Role delete',

            'User viewAny',
            'User view',
            'User create',
            'User update',
            'User delete',

            'Application viewAny',
            'Application view',
            'Application create',
            'Application update',
            'Application delete',

            'Template viewAny',
            'Template view',
            'Template create',
            'Template update',
            'Template delete',

            'Settings viewAny',
            'Filemanager viewAny',

            'viewNova',
            'viewHorizon',
            'viewTelescope',
        ];
    }

    /**
     * @return array
     */
    public static function requiredRoles(): array
    {
        return [
            'developer',
            'admin'
        ];
    }

    /**
     * @return string[]
     */
    public static function translatedModels(): array
    {
        return [
            Page::class,
            Post::class,
            Portfolio::class,
            PostTag::class,
            PostCategory::class,
            Settings::class
        ];
    }

    /**
     * @param $recipient
     * @param $notification
     * @param null $locale
     */
    public static function notifyByMail($recipient, $notification, $locale = null)
    {
        if($locale) {
            Notification::route('mail', $recipient)->notify(($notification)->locale($locale));
        } else {
            Notification::route('mail', $recipient)->notify(($notification));
        }
    }
}
