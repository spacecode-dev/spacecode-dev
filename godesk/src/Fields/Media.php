<?php

namespace SpaceCode\GoDesk\Fields;

use Closure;
use Illuminate\Validation\ValidationException;
use Laravel\Nova\Fields\Field;
use SpaceCode\GoDesk\Traits\HandlesConversions;
use SpaceCode\GoDesk\Traits\HandlesCustomProperties;
use SpaceCode\GoDesk\Traits\HandlesExistingMedia;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Laravel\Nova\Http\Requests\NovaRequest;
use Spatie\MediaLibrary\InteractsWithMedia;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Media extends Field
{
    use HandlesCustomProperties, HandlesConversions, HandlesExistingMedia;

    /**
     * @var string
     */
    public $component = 'media-library-field';

    /**
     * @var
     */
    protected $setFileNameCallback;

    /**
     * @var
     */
    protected $setNameCallback;

    /**
     * @var
     */
    protected $serializeMediaCallback;

    /**
     * @var bool
     */
    protected $responsive = false;

    /**
     * @var array
     */
    protected $collectionMediaRules = [];

    /**
     * @var array
     */
    protected $singleMediaRules = [];

    /**
     * @var array
     */
    protected $customHeaders = [];

    /**
     * @var array
     */
    protected $defaultValidatorRules = [];

    /**
     * @var array
     */
    public $meta = ['type' => 'media'];

    /**
     * @param callable $serializeMediaUsing
     * @return $this
     */
    public function serializeMediaUsing(callable $serializeMediaUsing): self
    {
        $this->serializeMediaCallback = $serializeMediaUsing;
        return $this;
    }

    /**
     * @return $this
     */
    public function fullSize(): self
    {
        return $this->withMeta(['fullSize' => true]);
    }

    /**
     * @param array|callable|string $rules
     * @return $this
     */
    public function rules($rules): self
    {
        $this->collectionMediaRules = ($rules instanceof Rule || is_string($rules)) ? func_get_args() : $rules;
        return $this;
    }

    /**
     * @param $rules
     * @return $this
     */
    public function singleMediaRules($rules): self
    {
        $this->singleMediaRules = ($rules instanceof Rule || is_string($rules)) ? func_get_args() : $rules;
        return $this;
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function customHeaders(array $headers): self
    {
        $this->customHeaders = $headers;
        return $this;
    }

    /**
     * @param boolean $responsive
     * @return $this
     */
    public function withResponsiveImages($responsive = true): self
    {
        $this->responsive = $responsive;
        return $this;
    }

    /**
     * @param $callback
     * @return $this
     */
    public function setFileName($callback): self
    {
        $this->setFileNameCallback = $callback;
        return $this;
    }

    /**
     * @param $callback
     * @return $this
     */
    public function setName($callback): self
    {
        $this->setNameCallback = $callback;
        return $this;
    }

    /**
     * @param int $maxSize
     * @return $this
     */
    public function setMaxFileSize(int $maxSize): self
    {
        return $this->withMeta(['maxFileSize' => $maxSize]);
    }

    /**
     * @param array $types
     * @return $this
     */
    public function setAllowedFileTypes(array $types): self
    {
        return $this->withMeta(['allowedFileTypes' => $types]);
    }

    /**
     * @param NovaRequest $request
     * @param mixed $requestAttribute
     * @param HasMedia $model
     * @param mixed $attribute
     * @return Closure
     * @throws ValidationException
     */
    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute): Closure
    {
        $attr = $request['__media__'] ?? [];
        $data = $attr[$requestAttribute] ?? [];
        if ($attribute === 'ComputedField') {
            $attribute = call_user_func($this->computedCallback, $model);
        }
        collect($data)
            ->filter(function ($value) {
                return $value instanceof UploadedFile;
            })
            ->each(function ($media) use ($request, $requestAttribute) {
                $requestToValidateSingleMedia = array_merge($request->toArray(), [
                    $requestAttribute => $media,
                ]);
                Validator::make($requestToValidateSingleMedia, [
                    $requestAttribute => array_merge($this->defaultValidatorRules, (array)$this->singleMediaRules),
                ])->validate();
            });
        $requestToValidateCollectionMedia = array_merge($request->toArray(), [
            $requestAttribute => $data,
        ]);
        Validator::make($requestToValidateCollectionMedia, [$requestAttribute => $this->collectionMediaRules])
            ->validate();
        return function () use ($request, $data, $attribute, $model) {
            $this->handleMedia($request, $model, $attribute, $data);
            $this->fillCustomPropertiesFromRequest($request, $model, $attribute);
        };
    }

    /**
     * @param NovaRequest $request
     * @param $model
     * @param $attribute
     * @param $data
     */
    protected function handleMedia(NovaRequest $request, $model, $attribute, $data)
    {
        $remainingIds = $this->removeDeletedMedia($data, $model->getMedia($attribute));
        $newIds = $this->addNewMedia($request, $data, $model, $attribute);
        $existingIds = $this->addExistingMedia($request, $data, $model, $attribute, $model->getMedia($attribute));
        $this->setOrder($remainingIds->union($newIds)->union($existingIds)->sortKeys()->all());
    }

    /**
     * @param $ids
     */
    private function setOrder($ids)
    {
        $mediaClass = config('media-library.media_model');
        $mediaClass::setNewOrder($ids);
    }

    /**
     * @param NovaRequest $request
     * @param $data
     * @param HasMedia $model
     * @param string $collection
     * @return Collection
     */
    private function addNewMedia(NovaRequest $request, $data, HasMedia $model, string $collection): Collection
    {
        return collect($data)
            ->filter(function ($value) {
                return $value instanceof UploadedFile;
            })->map(function (UploadedFile $file, int $index) use ($request, $model, $collection) {
                $media = $model->addMedia($file)->withCustomProperties($this->customProperties);
                if ($this->responsive) {
                    $media->withResponsiveImages();
                }
                if (!empty($this->customHeaders)) {
                    $media->addCustomHeaders($this->customHeaders);
                }
                if (is_callable($this->setFileNameCallback)) {
                    $media->setFileName(
                        call_user_func($this->setFileNameCallback, $file->getClientOriginalName(), $file->getClientOriginalExtension(), $model)
                    );
                }
                if (is_callable($this->setNameCallback)) {
                    $media->setName(
                        call_user_func($this->setNameCallback, $file->getClientOriginalName(), $model)
                    );
                }
                $media = $media->toMediaCollection($collection);
                $this->fillMediaCustomPropertiesFromRequest($request, $media, $index, $collection);
                return $media->getKey();
            });
    }

    /**
     * @param $data
     * @param Collection $medias
     * @return Collection
     */
    private function removeDeletedMedia($data, Collection $medias): Collection
    {
        $remainingIds = collect($data)->filter(function ($value) {
            return !$value instanceof UploadedFile;
        })->map(function ($value) {
            return $value;
        });
        $medias->pluck('id')->diff($remainingIds)->each(function ($id) use ($medias) {

            /** @var Media $media */
            if ($media = $medias->where('id', $id)->first()) {
                $media->delete();
            }
        });
        return $remainingIds->intersect($medias->pluck('id'));
    }

    /**
     * @param HasMedia|InteractsWithMedia $resource
     * @param null $attribute
     */
    public function resolve($resource, $attribute = null)
    {
        $collectionName = $attribute ?? $this->attribute;
        if ($collectionName === 'ComputedField') {
            $collectionName = call_user_func($this->computedCallback, $resource);
        }
        $this->value = $resource->getMedia($collectionName)
            ->map(function (\Spatie\MediaLibrary\MediaCollections\Models\Media $media) {
                return array_merge($this->serializeMedia($media), ['__media_urls__' => $this->getConversionUrls($media)]);
            })->values();
        if ($collectionName) {
            $this->checkCollectionIsMultiple($resource, $collectionName);
        }
    }

    /**
     * @param HasMedia|InteractsWithMedia $resource
     * @param string $collectionName
     */
    protected function checkCollectionIsMultiple(HasMedia $resource, string $collectionName)
    {
        $resource->registerMediaCollections();
        $isSingle = collect($resource->mediaCollections)
                ->where('name', $collectionName)
                ->first()
                ->singleFile ?? false;
        $this->withMeta(['multiple' => !$isSingle]);
    }

    /**
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media $media
     * @return array
     */
    public function serializeMedia(\Spatie\MediaLibrary\MediaCollections\Models\Media $media): array
    {
        if ($this->serializeMediaCallback) {
            return call_user_func($this->serializeMediaCallback, $media);
        }
        return $media->toArray();
    }

    /**
     * @deprecated not needed, field recognizes single/multi file media by itself
     */
    public function multiple(): self
    {
        return $this;
    }

    /**
     * @deprecated
     * @see conversionOnIndexView
     * @param string $conversionOnIndexView
     * @return $this
     */
    public function thumbnail(string $conversionOnIndexView): self
    {
        return $this->withMeta(compact('conversionOnIndexView'));
    }

    /**
     * @deprecated
     * @param string $conversionOnPreview
     * @return Media
     * @see conversionOnPreview
     */
    public function conversion(string $conversionOnPreview): self
    {
        return $this->withMeta(compact('conversionOnPreview'));
    }

    /**
     * @deprecated
     * @param string $conversionOnDetailView
     * @return Media
     * @see conversionOnDetailView
     */
    public function conversionOnView(string $conversionOnDetailView): self
    {
        return $this->withMeta(compact('conversionOnDetailView'));
    }
}