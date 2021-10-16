<?php

namespace SpaceCode\GoDesk\Http\Controllers;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DownloadMediaController extends Controller
{
    /**
     * @param Media $media
     * @return Media
     */
    public function show(Media $media)
    {
        return $media;
    }
}