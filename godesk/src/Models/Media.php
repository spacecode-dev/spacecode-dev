<?php

namespace SpaceCode\GoDesk\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    /**
     * @param array $attributes
     */
    public function __construct(Array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
