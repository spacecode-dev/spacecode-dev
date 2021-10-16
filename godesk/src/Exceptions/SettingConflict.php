<?php

namespace SpaceCode\GoDesk\Exceptions;

use InvalidArgumentException;

class SettingConflict extends InvalidArgumentException
{
    /**
     * @return static
     */
    public static function currentLang(): SettingConflict
    {
        return new static(__('You can\'t delete Primary Language from list of Languages.'));
    }

    /**
     * @return static
     */
    public static function reserved(): SettingConflict
    {
        return new static(__('This prefix reserved by System. Use another prefix.'));
    }

    /**
     * @return static
     */
    public static function url(): SettingConflict
    {
        return new static(__('This prefix is already exists and reserved by some page.'));
    }

    /**
     * @return static
     */
    public static function transEn(): SettingConflict
    {
        return new static(__('The value in the first row first column must be "en".'));
    }

    /**
     * @return static
     */
    public static function transErrorLang(): SettingConflict
    {
        return new static(__('The values in the first row all columns (except first) must be format languages such as "ru", "uk", "de", "it" (not "en") without quotation marks.'));
    }

    /**
     * @return static
     */
    public static function notInArray(): SettingConflict
    {
        return new static(__('The primary language is missing from the selected language list.'));
    }

    /**
     * @return static
     */
    public static function complexRequest(): SettingConflict
    {
        return new static(__('Request is too complex. Try not to make global changes.'));
    }
}
