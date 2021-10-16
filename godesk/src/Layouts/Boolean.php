<?php

namespace SpaceCode\GoDesk\Layouts;

use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class Boolean extends Layout
{
    /**
     * @var string
     */
    protected $name = 'boolean';

    /**
     * @var string
     */
    protected $title = 'Boolean';

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
            \Laravel\Nova\Fields\Boolean::make(__('Value'), 'value')->rules('required'),
        ];
    }
}