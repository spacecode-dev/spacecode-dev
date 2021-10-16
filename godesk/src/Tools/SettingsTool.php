<?php

namespace SpaceCode\GoDesk\Tools;

use Laravel\Nova\Fields\Timezone;
use SpaceCode\GoDesk\Fields\Tabs;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;
use Illuminate\Support\Str;
use SpaceCode\GoDesk\Fields\Table;
use SpaceCode\GoDesk\Fields\Toggle;
use OptimistDigital\MultiselectField\Multiselect;
use SpaceCode\GoDesk\GoDesk;
use SpaceCode\GoDesk\Models\Settings;
use Epartment\NovaDependencyContainer\HasDependencies;

class SettingsTool extends Tool
{
    use HasDependencies;

    /**
     * @var array
     */
    protected static $cache = [];

    /**
     * @var array
     */
    protected static $fields = [];

    /**
     * @var array
     */
    protected static $casts = [];

    public function boot()
    {
        Nova::script('settings', __DIR__ . '/../../dist/js/settings.js');
    }

    public function renderNavigation()
    {
        return view('godesk::settings.navigation', ['fields' => static::$fields]);
    }

    /**
     * @param array|callable $fields
     * @param array $casts
     * @param string $path
     */
    public static function addSettingsFields($fields = [], $casts = [], $path = 'general')
    {
        $path = Str::lower(Str::slug($path));
        static::$fields[$path] = static::$fields[$path] ?? [];
        if (is_callable($fields)) $fields = [$fields];
        static::$fields[$path] = array_merge(static::$fields[$path], $fields ?? []);
        static::$casts = array_merge(static::$casts, $casts ?? []);
    }

    /**
     * @param array $casts
     **/
    public static function addCasts($casts = [])
    {
        static::$casts = array_merge(static::$casts, $casts);
    }

    /**
     * @param string $path
     * @return array
     */
    public static function getFields($path = 'general'): array
    {
        $rawFields = array_map(function ($fieldItem) {
            return is_callable($fieldItem) ? call_user_func($fieldItem) : $fieldItem;
        }, static::$fields[$path] ?? static::$fields);

        $fields = [];
        foreach ($rawFields as $rawField) {
            if (is_array($rawField)) $fields = array_merge($fields, $rawField);
            else $fields[] = $rawField;
        }

        return $fields;
    }

    public static function clearFields()
    {
        static::$fields = [];
        static::$casts = [];
        static::$cache = [];
    }

    /**
     * @return array
     */
    public static function getCasts(): array
    {
        return static::$casts;
    }

    /**
     * @param $settingKey
     * @param null $default
     * @return mixed
     */
    public static function getSetting($settingKey, $default = null)
    {
        if (isset(static::$cache[$settingKey])) return static::$cache[$settingKey];
        static::$cache[$settingKey] = static::getSettingsModel()::find($settingKey)->value ?? $default;
        return static::$cache[$settingKey];
    }

    /**
     * @param array|null $settingKeys
     * @return array
     */
    public static function getSettings(array $settingKeys = null): array
    {
        if (!empty($settingKeys)) {
            $hasMissingKeys = !empty(array_diff($settingKeys, array_keys(static::$cache)));

            if (!$hasMissingKeys) return collect($settingKeys)->mapWithKeys(function ($settingKey) {
                return [$settingKey => static::$cache[$settingKey]];
            })->toArray();

            return static::getSettingsModel()::find($settingKeys)->map(function ($setting) {
                static::$cache[$setting->key] = $setting->value;
                return $setting;
            })->pluck('value', 'key')->toArray();
        }

        return static::getSettingsModel()::all()->map(function ($setting) {
            static::$cache[$setting->key] = $setting->value;
            return $setting;
        })->pluck('value', 'key')->toArray();
    }

    /**
     * @return string
     */
    public static function getSettingsModel(): string
    {
        return config('godesk.settings.models.settings', Settings::class);
    }

    /**
     * @param $path
     * @return bool
     */
    public static function doesPathExist($path): bool
    {
        return array_key_exists($path, static::$fields);
    }

    public static function setSettingsFields()
    {
        self::addSettingsFields([
            Avatar::make(__('Favicon'), 'website_favicon')
                ->maxWidth(100)
                ->path('favicon'),
            Avatar::make(__('Logotype'), 'website_logo')
                ->maxWidth(200)
                ->path('logo'),
            Timezone::make(__('Timezone'), 'website_timezone')->searchable(),
            Text::make(__('Title'), 'website_title')
                ->translatable(GoDesk::websiteLangsWithNames()),
            Textarea::make(__('Excerpt'), 'website_excerpt')
                ->translatable(GoDesk::websiteLangsWithNames()),
            Textarea::make(__('Description'), 'website_description')
                ->translatable(GoDesk::websiteLangsWithNames()),
            KeyValue::make(__('Social'), 'website_social')
                ->keyLabel(__('Name'))
                ->valueLabel(__('Link'))
                ->actionText(__('Add'))
                ->rules('json'),
            KeyValue::make(__('Custom'), 'custom')
                ->keyLabel(__('Key'))
                ->valueLabel(__('Value'))
                ->actionText(__('Add'))
                ->rules('json')
        ], [], __('Website'));

        self::addSettingsFields(collect([
            [
                Text::make(__('Profile'), 'prefix_profile')
                    ->rules('required', 'max:255', function($attribute, $value, $fail) {
                        $prefixes = Settings::where('key', 'LIKE', 'prefix_%')->where('key', '!=', $attribute)->pluck('value')->toArray();
                        if (in_array($value, $prefixes)) {
                            return $fail(__('Prefix with this value already exists.'));
                        }
                    })
            ],
            get_setting('use_blog') ? [
                Text::make(__('Posts'), 'prefix_post')
                    ->rules('required', 'max:255', function($attribute, $value, $fail) {
                        $prefixes = Settings::where('key', 'LIKE', 'prefix_%')->where('key', '!=', $attribute)->pluck('value')->toArray();
                        if (in_array($value, $prefixes)) {
                            return $fail(__('Prefix with this value already exists.'));
                        }
                    }),
                Text::make(__('Post Tags'), 'prefix_post_tag')
                    ->rules('required', 'max:255', function($attribute, $value, $fail) {
                        $prefixes = Settings::where('key', 'LIKE', 'prefix_%')->where('key', '!=', $attribute)->pluck('value')->toArray();
                        if (in_array($value, $prefixes)) {
                            return $fail(__('Prefix with this value already exists.'));
                        }
                    }),
                Text::make(__('Post Categories'), 'prefix_post_category')
                    ->rules('required', 'max:255', function($attribute, $value, $fail) {
                        $prefixes = Settings::where('key', 'LIKE', 'prefix_%')->where('key', '!=', $attribute)->pluck('value')->toArray();
                        if (in_array($value, $prefixes)) {
                            return $fail(__('Prefix with this value already exists.'));
                        }
                    })
            ] : [],
            get_setting('use_portfolio') ? [
                Text::make(__('Portfolio'), 'prefix_portfolio')
                    ->rules('required', 'max:255', function($attribute, $value, $fail) {
                        $prefixes = Settings::where('key', 'LIKE', 'prefix_%')->where('key', '!=', $attribute)->pluck('value')->toArray();
                        if (in_array($value, $prefixes)) {
                            return $fail(__('Prefix with this value already exists.'));
                        }
                    })
            ] : [],
        ])->collapse()->toArray(), [], __('Prefixes'));

        self::addSettingsFields([
            Text::make(__('Google Tag Manager'), 'tracking_gtm')
                ->rules('nullable', 'starts_with:GTM-', 'size:11'),
            Text::make(__('Facebook Pixel'), 'tracking_fb')
                ->rules('nullable', 'numeric'),
            Text::make(__('LinkedIn Insight Tag'), 'tracking_linkedin')
                ->rules('nullable', 'numeric'),
        ], [], __('Tracking'));

        self::addSettingsFields([
            Toggle::make(__('Hide website from Index'), 'hide_from_index'),
            (new Tabs(__('Resources'), collect([
                [
                    __('Pages') => [
                        Heading::make(get_variables_text())->asHtml(),
                        Text::make(__('Title'), 'indexing_page_meta_title')
                            ->rules('max:55')
                            ->translatable(GoDesk::websiteLangsWithNames())
                            ->help(__('Resource\'s &#60;title&#62;. `:label -> Seo Fields -> Title` will be used as a priority.')),
                        Textarea::make(__('Meta Description'), 'indexing_page_meta_description')
                            ->rules('max:155')
                            ->translatable(GoDesk::websiteLangsWithNames())
                            ->help(__('Resource\'s Meta Description. `:label -> Seo Fields -> Meta Description` will be used as a priority.')),
                        Toggle::make(__('Use :label Indexing Settings as a priority'), 'indexing_page_priority'),
                        Toggle::make(__('Google'), 'indexing_page_google')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('Yandex'), 'indexing_page_yandex')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('Bing'), 'indexing_page_bing')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('DuckDuckGo'), 'indexing_page_duck')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('Baidu'), 'indexing_page_baidu')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('Yahoo'), 'indexing_page_yahoo')->translatable(GoDesk::websiteLangsWithNames())
                    ]
                ],
                get_setting('use_blog') ? [
                    __('Posts') => [
                        Heading::make(get_variables_text())->asHtml(),
                        Text::make(__('Title'), 'indexing_post_meta_title')
                            ->rules('max:55')
                            ->translatable(GoDesk::websiteLangsWithNames())
                            ->help(__('Resource\'s &#60;title&#62;. `:label -> Seo Fields -> Title` will be used as a priority.')),
                        Textarea::make(__('Meta Description'), 'indexing_post_meta_description')
                            ->rules('max:155')
                            ->translatable(GoDesk::websiteLangsWithNames())
                            ->help(__('Resource\'s Meta Description. `:label -> Seo Fields -> Meta Description` will be used as a priority.')),
                        Toggle::make(__('Use :label Indexing Settings as a priority'), 'indexing_post_priority'),
                        Toggle::make(__('Google'), 'indexing_post_google')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('Yandex'), 'indexing_post_yandex')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('Bing'), 'indexing_post_bing')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('DuckDuckGo'), 'indexing_post_duck')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('Baidu'), 'indexing_post_baidu')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('Yahoo'), 'indexing_post_yahoo')->translatable(GoDesk::websiteLangsWithNames())
                    ],
                    __('Post Tags') => [
                        Heading::make(get_variables_text())->asHtml(),
                        Text::make(__('Title'), 'indexing_post_tag_meta_title')
                            ->rules('max:55')
                            ->translatable(GoDesk::websiteLangsWithNames())
                            ->help(__('Resource\'s &#60;title&#62;. `:label -> Seo Fields -> Title` will be used as a priority.')),
                        Textarea::make(__('Meta Description'), 'indexing_post_tag_meta_description')
                            ->rules('max:155')
                            ->translatable(GoDesk::websiteLangsWithNames())
                            ->help(__('Resource\'s Meta Description. `:label -> Seo Fields -> Meta Description` will be used as a priority.')),
                        Toggle::make(__('Use :label Indexing Settings as a priority'), 'indexing_post_tag_priority'),
                        Toggle::make(__('Google'), 'indexing_post_tag_google')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('Yandex'), 'indexing_post_tag_yandex')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('Bing'), 'indexing_post_tag_bing')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('DuckDuckGo'), 'indexing_post_tag_duck')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('Baidu'), 'indexing_post_tag_baidu')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('Yahoo'), 'indexing_post_tag_yahoo')->translatable(GoDesk::websiteLangsWithNames())
                    ],
                    __('Post Categories') => [
                        Heading::make(get_variables_text())->asHtml(),
                        Text::make(__('Title'), 'indexing_post_category_meta_title')
                            ->rules('max:55')
                            ->translatable(GoDesk::websiteLangsWithNames())
                            ->help(__('Resource\'s &#60;title&#62;. `:label -> Seo Fields -> Title` will be used as a priority.')),
                        Textarea::make(__('Meta Description'), 'indexing_post_category_meta_description')
                            ->rules('max:155')
                            ->translatable(GoDesk::websiteLangsWithNames())
                            ->help(__('Resource\'s Meta Description. `:label -> Seo Fields -> Meta Description` will be used as a priority.')),
                        Toggle::make(__('Use :label Indexing Settings as a priority'), 'indexing_post_category_priority'),
                        Toggle::make(__('Google'), 'indexing_post_category_google')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('Yandex'), 'indexing_post_category_yandex')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('Bing'), 'indexing_post_category_bing')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('DuckDuckGo'), 'indexing_post_category_duck')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('Baidu'), 'indexing_post_category_baidu')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('Yahoo'), 'indexing_post_category_yahoo')->translatable(GoDesk::websiteLangsWithNames())
                    ]
                ] : [],
                get_setting('use_portfolio') ? [
                    __('Portfolio') => [
                        Heading::make(get_variables_text())->asHtml(),
                        Text::make(__('Title'), 'indexing_portfolio_meta_title')
                            ->rules('max:55')
                            ->translatable(GoDesk::websiteLangsWithNames())
                            ->help(__('Resource\'s &#60;title&#62;. `:label -> Seo Fields -> Title` will be used as a priority.')),
                        Textarea::make(__('Meta Description'), 'indexing_portfolio_meta_description')
                            ->rules('max:155')
                            ->translatable(GoDesk::websiteLangsWithNames())
                            ->help(__('Resource\'s Meta Description. `:label -> Seo Fields -> Meta Description` will be used as a priority.')),
                        Toggle::make(__('Use :label Indexing Settings as a priority'), 'indexing_portfolio_priority'),
                        Toggle::make(__('Google'), 'indexing_portfolio_google')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('Yandex'), 'indexing_portfolio_yandex')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('Bing'), 'indexing_portfolio_bing')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('DuckDuckGo'), 'indexing_portfolio_duck')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('Baidu'), 'indexing_portfolio_baidu')->translatable(GoDesk::websiteLangsWithNames()),
                        Toggle::make(__('Yahoo'), 'indexing_portfolio_yahoo')->translatable(GoDesk::websiteLangsWithNames())
                    ]
                ] : [],
            ])->collapse()->toArray()))->withToolbar(),
        ], [], __('Indexing'));

        self::addSettingsFields([
            Select::make(__('Primary Language'), 'website_lang')
                ->options(collect(get_setting('website_langs'))->map(function ($key) {
                    return [$key => GoDesk::locales()->toArray()[$key]];
                })->collapse()->toArray()),
            Multiselect::make(__('Languages'), 'website_langs')
                ->options(GoDesk::locales()->toArray())
                ->rules('min:1')
                ->saveAsJSON()
        ], [], __('Languages'));

        self::addSettingsFields([
            Toggle::make(__('Use Blog'), 'use_blog'),

            NovaDependencyContainer::make([
                Heading::make(__('Blog Settings')),
                Toggle::make(__('Hide Post Tags as separate page'), 'blog_hide_tags')->stacked(),
                Select::make(__('Editor Type'), 'blog_post_editor')->options([
                    'markdown' => 'Markdown',
                    'code' => 'Code',
                ])
            ])->dependsOn('use_blog', '1'),

            Toggle::make(__('Use Portfolio'), 'use_portfolio'),

        ], [], __('Supplements'));

        self::addSettingsFields([
            Table::make(__('Translates'), 'translates')
                ->minRows(2)
                ->maxRows(10000)
                ->minColumns(count(get_setting('website_langs')))
                ->maxColumns(10)
        ], [], __('Translates'));
    }
}