<?php

namespace SpaceCode\GoDesk\Traits;

use Laravel\Nova\Fields\Field;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Laravel\Nova\Http\Requests\NovaRequest;
use Symfony\Component\HttpFoundation\FileBag;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @mixin \SpaceCode\GoDesk\Fields\Media
 */
trait HandlesCustomProperties
{
    /**
     * @var array
     */
    protected $customPropertiesFields = [];

    /**
     * @var array
     */
    protected $customProperties = [];

    /**
     * @param array $customPropertiesFields
     * @return $this
     */
    public function customPropertiesFields(array $customPropertiesFields): self
    {
        $this->customPropertiesFields = collect($customPropertiesFields);
        return $this->withMeta(compact('customPropertiesFields'));
    }

    /**
     * @param array $customProperties
     * @return $this
     */
    public function customProperties(array $customProperties): self
    {
        $this->customProperties = $customProperties;
        return $this;
    }

    /**
     * @param NovaRequest $request
     * @param HasMedia $model
     * @param string $collection
     */
    private function fillCustomPropertiesFromRequest(NovaRequest $request, HasMedia $model, string $collection)
    {
        $mediaItems = $model->getMedia($collection);
        $items = $request->get('__media__', [])[$collection] ?? [];
        if ($items instanceof FileBag) {
            return;
        }
        collect($items)
            ->reject(function ($value) {
                return $value instanceof UploadedFile || $value instanceof FileBag;
            })
            ->each(function ($id, int $index) use ($request, $mediaItems, $collection) {
                if (! $media = $mediaItems->where('id', $id)->first()) {
                    return;
                }
                $this->fillMediaCustomPropertiesFromRequest($request, $media, $index, $collection);
            });
    }

    /**
     * @param NovaRequest $request
     * @param Media $media
     * @param int $index
     * @param string $collection
     */
    private function fillMediaCustomPropertiesFromRequest(NovaRequest $request, Media $media, int $index, string $collection)
    {
        $media->refresh();

        /** @var Field $field */
        foreach ($this->customPropertiesFields as $field) {
            $targetAttribute = "custom_properties->{$field->attribute}";
            $requestAttribute = "__media-custom-properties__.{$collection}.{$index}.{$field->attribute}";
            $field->fillInto($request, $media, $targetAttribute, $requestAttribute);
        }
        $media->save();
    }
}