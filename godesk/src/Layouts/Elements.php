<?php

namespace SpaceCode\GoDesk\Layouts;

use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class Elements extends Layout
{
    /**
     * @var string
     */
    protected $name = 'elements';

    /**
     * @var string
     */
    protected $title = 'Elements';

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
            Flexible::make(__('Elements'), 'elements')
                ->button(__('Add'))
                ->addLayout(Element::class)
        ];
    }
}