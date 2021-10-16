<?php

namespace SpaceCode\GoDesk\Models;

use Carbon\Carbon;
use DateTime;

class Sitemap
{
    /**
     * @var bool
     */
    public $testing = false;

    /**
     * @var array
     */
    private $items = [];

    /**
     * @var array
     */
    private $sitemaps = [];

    /**
     * @var string
     */
    private $title = null;

    /**
     * @var string
     */
    private $link = null;

    /**
     * Enable or disable xsl styles.
     * @var bool
     */
    private $useStyles = true;

    /**
     * Set custom location for xsl styles (must end with slash).
     * @var string
     */
    private $sloc = '/vendor/godesk/sitemap/';

    /**
     * Enable or disable cache.
     *
     * @var bool
     */
    private $useCache = false;

    /**
     * Unique cache key.
     *
     * @var string
     */
    private $cacheKey = 'godesk-sitemap.';

    /**
     * Cache duration, can be int or timestamp.
     * @var Carbon|Datetime|int
     */
    private $cacheDuration = 3600;

    /**
     * Escaping html entities.
     * @var bool
     */
    private $escaping = true;

    /**
     * Use limitSize() for big sitemaps.
     * @var bool
     */
    private $useLimitSize = false;

    /**
     * Custom max size for limitSize().
     * @var bool
     */
    private $maxSize = null;

    /**
     * Use gzip compression.
     * @var bool
     */
    private $useGzip = false;

    /**
     * Populating model variables from configuration file.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->useCache = isset($config['use_cache']) ? $config['use_cache'] : $this->useCache;
        $this->cacheKey = isset($config['cache_key']) ? $config['cache_key'] : $this->cacheKey;
        $this->cacheDuration = isset($config['cache_duration']) ? $config['cache_duration'] : $this->cacheDuration;
        $this->escaping = isset($config['escaping']) ? $config['escaping'] : $this->escaping;
        $this->useLimitSize = isset($config['use_limit_size']) ? $config['use_limit_size'] : $this->useLimitSize;
        $this->useStyles = isset($config['use_styles']) ? $config['use_styles'] : $this->useStyles;
        $this->sloc = isset($config['styles_location']) ? $config['styles_location'] : $this->sloc;
        $this->maxSize = isset($config['max_size']) ? $config['max_size'] : $this->maxSize;
        $this->testing = isset($config['testing']) ? $config['testing'] : $this->testing;
        $this->useGzip = isset($config['use_gzip']) ? $config['use_gzip'] : $this->useGzip;
    }

    /**
     * Returns $items array.
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Returns $sitemaps array.
     * @return array
     */
    public function getSitemaps(): array
    {
        return $this->sitemaps;
    }

    /**
     * Returns $title value.
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Returns $link value.
     * @return string
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * Returns $useStyles value.
     * @return bool
     */
    public function getUseStyles(): bool
    {
        return $this->useStyles;
    }

    /**
     * Returns $sloc value.
     * @return string
     */
    public function getSloc(): string
    {
        return $this->sloc;
    }

    /**
     * Returns $useCache value.
     * @return bool
     */
    public function getUseCache(): bool
    {
        return $this->useCache;
    }

    /**
     * Returns $CacheKey value.
     * @return string
     */
    public function getCacheKey(): string
    {
        return $this->cacheKey;
    }

    /**
     * Returns $CacheDuration value.
     * @return string
     */
    public function getCacheDuration()
    {
        return $this->cacheDuration;
    }

    /**
     * Returns $escaping value.
     * @return bool
     */
    public function getEscaping(): bool
    {
        return $this->escaping;
    }

    /**
     * Returns $useLimitSize value.
     * @return bool
     */
    public function getUseLimitSize(): bool
    {
        return $this->useLimitSize;
    }

    /**
     * Returns $maxSize value.
     * @return bool|null
     */
    public function getMaxSize(): ?bool
    {
        return $this->maxSize;
    }

    /**
     * Returns $useGzip value.
     * @return bool|mixed
     */
    public function getUseGzip(): bool
    {
        return $this->useGzip;
    }

    /**
     * Sets $escaping value.
     * @param $b
     */
    public function setEscaping($b)
    {
        $this->escaping = $b;
    }

    /**
     * Adds item to $items array.
     * @param $items
     */
    public function setItems($items)
    {
        $this->items[] = $items;
    }

    /**
     * Adds sitemap to $sitemaps array.
     * @param array $sitemap
     */
    public function setSitemaps(array $sitemap)
    {
        $this->sitemaps[] = $sitemap;
    }

    /**
     * Sets $title value.
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Sets $link value.
     * @param string $link
     */
    public function setLink(string $link)
    {
        $this->link = $link;
    }

    /**
     * Sets $useStyles value.
     * @param bool $useStyles
     */
    public function setUseStyles(bool $useStyles)
    {
        $this->useStyles = $useStyles;
    }

    /**
     * Sets $sloc value.
     * @param string $sloc
     */
    public function setSloc(string $sloc)
    {
        $this->sloc = $sloc;
    }

    /**
     * Sets $useLimitSize value.
     * @param bool $useLimitSize
     */
    public function setUseLimitSize(bool $useLimitSize)
    {
        $this->useLimitSize = $useLimitSize;
    }

    /**
     * Sets $maxSize value.
     * @param int $maxSize
     */
    public function setMaxSize(int $maxSize)
    {
        $this->maxSize = $maxSize;
    }

    /**
     * Sets $useGzip value.
     * @param bool $useGzip
     */
    public function setUseGzip($useGzip=true)
    {
        $this->useGzip = $useGzip;
    }

    /**
     * Limit size of $items array to 50000 elements (1000 for google-news).
     * @param int $max
     */
    public function limitSize($max = 50000)
    {
        $this->items = array_slice($this->items, 0, $max);
    }

    /**
     * Reset $items array.
     * @param array $items
     */
    public function resetItems($items = [])
    {
        $this->items = $items;
    }

    /**
     * Reset $sitemaps array.
     * @param array $sitemaps
     */
    public function resetSitemaps($sitemaps = [])
    {
        $this->sitemaps = $sitemaps;
    }

    /**
     * Set use cache value.
     * @param bool $useCache
     */
    public function setUseCache($useCache = true)
    {
        $this->useCache = $useCache;
    }

    /**
     * Set cache key value.
     * @param string $cacheKey
     */
    public function setCacheKey(string $cacheKey)
    {
        $this->cacheKey = $cacheKey;
    }

    /**
     * Set cache duration value.
     *
     * @param Carbon|Datetime|int $cacheDuration
     */
    public function setCacheDuration($cacheDuration)
    {
        $this->cacheDuration = $cacheDuration;
    }
}
