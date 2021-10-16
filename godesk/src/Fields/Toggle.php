<?php

namespace SpaceCode\GoDesk\Fields;

use Laravel\Nova\Fields\Field;

class Toggle extends Field
{
    /**
     * @var string
     */
    public $component = 'toggle';

    /**
     * @param $color
     * @return $this
     */
    public function color($color): self
    {
        return $this->withMeta([
            'color' => $color
        ]);
    }
}