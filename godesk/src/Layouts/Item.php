<?php

namespace SpaceCode\GoDesk\Layouts;

use Laravel\Nova\Fields\Text;
use SpaceCode\GoDesk\GoDesk;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class Item extends Layout
{
    /**
     * @var string
     */
    protected $name = 'item';

    /**
     * @var string
     */
    protected $title = 'Item';

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
            Text::make(__('Value'), 'value')->rules('required')->translatable(GoDesk::websiteLangsWithNames())
        ];
    }
}