<?php

namespace SpaceCode\GoDesk\Layouts;

use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class Element extends Layout
{
    /**
     * @var string
     */
    protected $name = 'element';

    /**
     * @var string
     */
    protected $title = 'Element';

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
            Flexible::make(__('Fields'), 'fields')
                ->button(__('Add'))
                ->addLayout(H2::class)
                ->addLayout(H3::class)
                ->addLayout(H4::class)
                ->addLayout(H5::class)
                ->addLayout(H6::class)
                ->addLayout(Paragraph::class)
                ->addLayout(Blockquote::class)
                ->addLayout(Boolean::class)
                ->addLayout(Date::class)
                ->addLayout(DateTime::class)
                ->addLayout(Number::class)
                ->addLayout(Image::class)
                ->addLayout(BulletedList::class)
                ->addLayout(NumberedList::class)
        ];
    }
}