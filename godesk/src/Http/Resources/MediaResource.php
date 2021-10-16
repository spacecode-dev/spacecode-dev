<?php

namespace SpaceCode\GoDesk\Http\Resources;

use Illuminate\Http\Request;
use SpaceCode\GoDesk\Traits\HandlesConversions;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    use HandlesConversions;

    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /**
         * This is incompatible with following settings on the Field.
         * - conversionOnIndexView
         * - conversionOnDetailView
         * - conversionOnForm
         * - conversionOnPreview
         * - serializeMediaUsing
         *
         */
        return array_merge($this->resource->toArray(), ['__media_urls__' => $this->getConversionUrls($this->resource)]);
    }
}