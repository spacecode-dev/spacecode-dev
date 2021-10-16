<?php

namespace SpaceCode\GoDesk\Traits;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @mixin \SpaceCode\GoDesk\Fields\Media
 */
trait HandlesConversions
{
    /**
     * @param string $conversionOnIndexView
     * @return $this
     */
    public function conversionOnIndexView(string $conversionOnIndexView): self
    {
        return $this->withMeta(compact('conversionOnIndexView'));
    }

    /**
     * @param string $conversionOnDetailView
     * @return $this
     */
    public function conversionOnDetailView(string $conversionOnDetailView): self
    {
        return $this->withMeta(compact('conversionOnDetailView'));
    }

    /**
     * @param string $conversionOnForm
     * @return $this
     */
    public function conversionOnForm(string $conversionOnForm): self
    {
        return $this->withMeta(compact('conversionOnForm'));
    }

    /**\
     * @param string $conversionOnPreview
     * @return $this
     */
    public function conversionOnPreview(string $conversionOnPreview): self
    {
        return $this->withMeta(compact('conversionOnPreview'));
    }

    /**
     * @param Media $media
     * @return array
     */
    public function getConversionUrls(Media $media): array
    {
        return [
            '__original__' => $media->getFullUrl(),
            'indexView' => $media->getFullUrl($this->meta['conversionOnIndexView'] ?? ''),
            'detailView' => $media->getFullUrl($this->meta['conversionOnDetailView'] ?? ''),
            'form' => $media->getFullUrl($this->meta['conversionOnForm'] ?? ''),
            'preview' => $media->getFullUrl($this->meta['conversionOnPreview'] ?? ''),
        ];
    }
}