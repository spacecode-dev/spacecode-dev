<?php

namespace SpaceCode\GoDesk\Layouts;

use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class NumberedList extends Layout
{
    /**
     * @var string
     */
    protected $name = 'ol';

    /**
     * @var string
     */
    protected $title = 'Numbered List';

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
            Flexible::make(__('Items'), 'items')
                ->button(__('Add'))
                ->addLayout(Item::class)
        ];
    }
}