<?php

namespace SpaceCode\GoDesk\Exceptions;

use InvalidArgumentException;

class PostCategoryConflict extends InvalidArgumentException
{
    /**
     * @param string $title
     * @param string $guardName
     * @return static
     */
    public static function url(string $title, string $guardName): PostCategoryConflict
    {
        return new static(__('This post category `:title` is already exists for guard `:guardName`.', ['title' => $title, 'guardName' => $guardName]));
    }

    /**
     * @param string $title
     * @return static
     */
    public static function itSelf(string $title): PostCategoryConflict
    {
        return new static(__('This post category `:title` can\'t be child of itself. Choose another parent.', ['title' => $title]));
    }
}
