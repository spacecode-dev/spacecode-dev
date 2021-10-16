<?php

namespace SpaceCode\GoDesk\Layouts;

use Laravel\Nova\Fields\Text;
use SpaceCode\GoDesk\Fields\FilemanagerField;
use SpaceCode\GoDesk\GoDesk;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class Image extends Layout
{
    /**
     * @var string
     */
    protected $name = 'image';

    /**
     * @var string
     */
    protected $title = 'Image';

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
            FilemanagerField::make(__('Src'), 'src')->displayAsImage(),
            Text::make(__('Alt'), 'alt')->rules('required')->translatable(GoDesk::websiteLangsWithNames()),
        ];
    }
}