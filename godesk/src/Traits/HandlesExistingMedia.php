<?php

namespace SpaceCode\GoDesk\Traits;

use SpaceCode\GoDesk\Fields\Media;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Collection;
use Laravel\Nova\Http\Requests\NovaRequest;
use Spatie\MediaLibrary\Support\TemporaryDirectory;
use Spatie\MediaLibrary\MediaCollections\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @mixin Media
 */
trait HandlesExistingMedia
{
    /**
     * @return $this
     */
    public function enableExistingMedia(): self
    {
        return $this->withMeta(['existingMedia' => (bool) config('godesk.media-library.enable-existing-media')]);
    }

    /**
     * @param NovaRequest $request
     * @param $data
     * @param HasMedia $model
     * @param string $collection
     * @param Collection $medias
     * @return Collection
     */
    private function addExistingMedia(NovaRequest $request, $data, HasMedia $model, string $collection, Collection $medias): Collection
    {
        $addedMediaIds = $medias->pluck('id')->toArray();
        return collect($data)
            ->filter(function ($value) use ($addedMediaIds) {
                return (! ($value instanceof UploadedFile)) && ! (in_array((int) $value, $addedMediaIds));
            })->map(function ($model_id, int $index) use ($request, $model, $collection) {
                $mediaClass = config('media-library.media_model');
                $existingMedia = $mediaClass::find($model_id);
                $temporaryDirectory = TemporaryDirectory::create();
                $temporaryFile = $temporaryDirectory->path($existingMedia->file_name);
                app(Filesystem::class)->copyFromMediaLibrary($existingMedia, $temporaryFile);
                $media = $model->addMedia($temporaryFile)->withCustomProperties($this->customProperties);
                if ($this->responsive) {
                    $media->withResponsiveImages();
                }
                $media = $media->toMediaCollection($collection);
                $this->fillMediaCustomPropertiesFromRequest($request, $media, $index, $collection);
                $temporaryDirectory->delete();
                return $media->getKey();
            });
    }
}