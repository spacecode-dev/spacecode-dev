<?php

namespace SpaceCode\GoDesk\Layouts;

use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class Date extends Layout
{
    /**
     * @var string
     */
    protected $name = 'date';

    /**
     * @var string
     */
    protected $title = 'Date';

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
            \Laravel\Nova\Fields\Date::make(__('Value'), 'value')->rules('required'),
        ];
    }
}