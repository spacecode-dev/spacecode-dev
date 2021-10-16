<?php

namespace SpaceCode\GoDesk\Layouts;

use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Text;
use SpaceCode\GoDesk\GoDesk;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class HTML extends Layout
{
    /**
     * @var string
     */
    protected $name = 'html';

    /**
     * @var string
     */
    protected $title = 'HTML';

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
            Code::make(__('Value'), 'value')->rules('required')->translatable(GoDesk::websiteLangsWithNames()),
        ];
    }
}