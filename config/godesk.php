<?php

return [
    'name' => 'GoDesk',
    'admin_path' => env('GODESK_ADMIN_PATH', '/admin'),
    'filemanager' => [
        'disk'      => env('FILEMANAGER_DISK', 'public'),
        'order'     => env('FILEMANAGER_ORDER', 'mime'),
        'direction' => env('FILEMANAGER_DIRECTION', 'asc'),
        'cache'     => env('FILEMANAGER_CACHE', false),
        'buttons'   => [
            // Menu
            'create_folder'   => true,
            'upload_button'   => true,
            'select_multiple' => true,
            // Folders
            'rename_folder'   => true,
            'delete_folder'   => true,
            // Files
            'rename_file'     => true,
            'delete_file'     => true,
            'download_file'   => true,
        ],
        'filters'   => [
            'Images'     => ['jpg', 'jpeg', 'png', 'gif', 'svg', 'bmp', 'tiff'],
            'Documents'  => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pps', 'pptx', 'odt', 'rtf', 'md', 'txt', 'css'],
            'Videos'     => ['mp4', 'avi', 'mov', 'mkv', 'wmv', 'flv', '3gp', 'h264'],
            'Audios'     => ['mp3', 'ogg', 'wav', 'wma', 'midi'],
            'Compressed' => ['zip', 'rar', 'tar', 'gz', '7z', 'pkg'],
        ],
        'filter'    => false,
        'naming'    => \SpaceCode\GoDesk\Services\DefaultNamingStrategy::class,
        'jobs'      => [],
    ],
    'sitemap' => [
        'use_cache' => false,
        'cache_key' => 'godesk-sitemap.' . \Illuminate\Support\Str::slug(str_replace(['http://', 'https://'], '', config('app.url')), '-'),
        'cache_duration' => 0,
        'escaping' => true,
        'use_limit_size' => false,
        'max_size' => null,
        'use_styles' => true,
        'styles_location' => '/vendor/sitemap/',
        'use_gzip' => false
    ],
    'media-library' => [
        'enable-existing-media' => false,
    ],
    'settings' => [
        'reload_page_on_save' => false,
        'models' => [
            'settings' => \SpaceCode\GoDesk\Models\Settings::class,
        ],
    ],
    'max_locales_shown_on_index' => 3,
    'langs' => ['en', 'ru', 'uk'],
    'responsive' => [
        'hide_all_sidebar_headlines' => false,
        'hidden_sidebar_headlines' => [],
        'resource_tables_sticky_actions' => false,
        'resource_tables_sticky_actions_on_mobile' => false,
        'hide_update_and_continue_editing_button' => false,
        'hide_update_and_continue_editing_button_on_mobile' => false,
        'fixed_sidebar' => false
    ]
];