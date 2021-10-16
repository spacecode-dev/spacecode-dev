<?php

namespace SpaceCode\GoDesk;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
//    /**
//     * @param Media $media
//     * @return string
//     */
//    public function getPath(Media $media): string
//    {
//        $name = $this->resolveSubdomainName(request()->getHost());
//        $store = Store::where('name', $name)->first();
//        $store->getStorageInstance(config('thesale.digitalOcean'));
//        return $name . '/' . $media->collection_name . '/' . $media->id . '/';
//    }

//    /**
//     * @param Media $media
//     * @return string
//     */
//    public function getPathForConversions(Media $media): string
//    {
//        return $this->getPath($media).'conversions/';
//    }

//    /**
//     * @param Media $media
//     * @return string
//     */
//    public function getPathForResponsiveImages(Media $media): string
//    {
//        return $this->getPath($media).'responsive/';
//    }
}
