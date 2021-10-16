<?php

namespace SpaceCode\GoDesk\Layouts;

use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class Number extends Layout
{
    /**
     * @var string
     */
    protected $name = 'number';

    /**
     * @var string
     */
    protected $title = 'Number';

    /**
     * @return string
     */
    public function title()
    {
        return __($this->title);
    }

    /**
     * @return array
     */
    public function fields()
    {
        return [
            Text::make(__('Name'), 'name')->rules('required', 'alpha_dash'),
            \Laravel\Nova\Fields\Number::make(__('Value'), 'value')->rules('required'),
        ];
    }
}