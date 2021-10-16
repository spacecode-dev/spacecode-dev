<?php

namespace SpaceCode\GoDesk\Layouts;

use Laravel\Nova\Fields\Text;
use SpaceCode\GoDesk\GoDesk;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class H4 extends Layout
{
    /**
     * @var string
     */
    protected $name = 'h4';

    /**
     * @var string
     */
    protected $title = 'Heading H4';

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
            Text::make(__('Value'), 'value')->rules('required')->translatable(GoDesk::websiteLangsWithNames()),
        ];
    }
}