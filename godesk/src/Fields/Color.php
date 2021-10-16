<?php

namespace SpaceCode\GoDesk\Fields;

use Laravel\Nova\Fields\Field;

class Color extends Field
{
    /**
     * @var string
     */
    public $component = 'color';

    /**
     * Color constructor.
     * @param $name
     * @param null $attribute
     * @param null $resolveCallback
     */
    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->slider();
    }

    /**
     * @param string $type
     * @return $this
     */
    public function pickerType(string $type): self
    {
        return $this->withMeta(['pickerType' => $type]);
    }

    /**
     * @param array $palette
     * @return $this
     */
    public function palette(array $palette): self
    {
        return $this->withMeta(['palette' => $palette]);
    }

    /**
     * @return $this
     */
    public function chrome(): self
    {
        return $this->pickerType('chrome');
    }

    /**
     * @return $this
     */
    public function compact(): self
    {
        return $this->pickerType('compact');
    }

    /**
     * @return $this
     */
    public function grayscale(): self
    {
        return $this->pickerType('grayscale');
    }

    /**
     * @return $this
     */
    public function material(): self
    {
        return $this->pickerType('material');
    }

    /**
     * @return $this
     */
    public function photoshop(): self
    {
        return $this->pickerType('photoshop');
    }

    /**
     * @return $this
     */
    public function sketch(): self
    {
        return $this->pickerType('sketch');
    }

    /**
     * @return $this
     */
    public function slider(): self
    {
        return $this->pickerType('slider');
    }

    /**
     * @return $this
     */
    public function swatches(): self
    {
        return $this->pickerType('swatches');
    }
}