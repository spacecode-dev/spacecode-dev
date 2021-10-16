<?php

namespace SpaceCode\GoDesk\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use SpaceCode\GoDesk\Tools\SettingsTool;
use Illuminate\Support\Collection as BaseCollection;

class Settings extends Model
{
    /**
     * @var string
     */
    protected $primaryKey = 'key';

    /**
     * @var string
     */
    protected $table = 'settings';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @param $value
     */
    public function setValueAttribute($value)
    {
        $this->attributes['value'] = is_array($value) ? json_encode($value) : $value;
    }

    /**
     * @return bool|float|Carbon|BaseCollection|int|mixed|string|null
     */
    public function getValueAttribute()
    {
        $value = $this->attributes['value'] ?? null;
        $casts = SettingsTool::getCasts();
        $castType = $casts[$this->key] ?? null;

        if (!$castType) return $value;

        switch ($castType) {
            case 'int':
            case 'integer':
                return (int) $value;
            case 'real':
            case 'float':
            case 'double':
                return $this->fromFloat($value);
            case 'decimal':
                return $this->asDecimal($value, explode(':', $casts[$this->key], 2)[1]);
            case 'string':
                return (string) $value;
            case 'bool':
            case 'boolean':
                return (bool) $value;
            case 'object':
                return $this->fromJson($value, true);
            case 'array':
            case 'json':
                return $this->fromJson($value);
            case 'collection':
                return new BaseCollection($this->fromJson($value));
            case 'date':
                return $this->asDate($value);
            case 'datetime':
            case 'custom_datetime':
                return $this->asDateTime($value);
            case 'timestamp':
                return $this->asTimestamp($value);
        }

        return $value;
    }

    /**
     * @param $key
     * @return null
     */
    public static function getValueForKey($key)
    {
        $setting = static::where('key', $key)->get()->first();
        return isset($setting) ? $setting->value : null;
    }
}