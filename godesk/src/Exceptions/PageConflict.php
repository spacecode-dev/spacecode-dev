<?php

namespace SpaceCode\GoDesk\Exceptions;

use InvalidArgumentException;

class PageConflict extends InvalidArgumentException
{
    /**
     * @param string $title
     * @param string $guardName
     * @return static
     */
    public static function url(string $title, string $guardName): PageConflict
    {
        return new static(__('This page `:title` is already exists for guard `:guardName`.', ['title' => $title, 'guardName' => $guardName]));
    }

    /**
     * @param string $title
     * @return static
     */
    public static function homeType(string $title): PageConflict
    {
        return new static(__('This page `:title` can\'t be child of the page with type `home`. Choose another parent.', ['title' => $title]));
    }

    /**
     * @param string $title
     * @return static
     */
    public static function likePrefix(string $title): PageConflict
    {
        return new static(__('This page `:title` can\'t be child of the page with prefix like `post and etc.`. Choose another parent.', ['title' => $title]));
    }

    /**
     * @param string $title
     * @return static
     */
    public static function itSelf(string $title): PageConflict
    {
        return new static(__('This page `:title` can\'t be child of itself. Choose another parent.', ['title' => $title]));
    }

    /**
     * @param string $title
     * @param string $slug
     * @return static
     */
    public static function reserved(string $title, string $slug): PageConflict
    {
        return new static(__('This page `:title` with slug `:slug` reserved by System. Use another slug.', ['title' => $title, 'slug' => $slug]));
    }
}
