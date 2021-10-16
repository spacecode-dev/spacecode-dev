<?php

namespace SpaceCode\GoDesk\Layouts;

use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class Color extends Layout
{
    /**
     * @var string
     */
    protected $name = 'color';

    /**
     * @var string
     */
    protected $title = 'Color';

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
            \SpaceCode\GoDesk\Fields\Color::make(__('Value'), 'value')->rules('required')
        ];
    }
}