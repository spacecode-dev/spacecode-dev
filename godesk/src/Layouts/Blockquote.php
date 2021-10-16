<?php

namespace SpaceCode\GoDesk\Layouts;

use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Text;
use SpaceCode\GoDesk\GoDesk;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class Blockquote extends Layout
{
    /**
     * @var string
     */
    protected $name = 'blockquote';

    /**
     * @var string
     */
    protected $title = 'Blockquote';

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
            Markdown::make(__('Value'), 'value')->rules('required')->translatable(GoDesk::websiteLangsWithNames()),
        ];
    }
}