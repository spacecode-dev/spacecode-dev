<?php

namespace SpaceCode\GoDesk\Traits;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;

trait Help {

    /**
     * @return array|Application|Translator|string|null
     */
    public function template()
    {
        return __('Template used to render the resource. Resource\'s content will be selected from: `Tab Content -> Content field` by default.');
    }

    /**
     * @return array|Application|Translator|string|null
     */
    public function parent()
    {
        return __('If the resource has a parent then the link will be prefixed with the slug of that parent.');
    }

    /**
     * @return array|Application|Translator|string|null
     */
    public function name()
    {
        return __('Resource\'s name. Will be used as a &#60;title&#62; if `Settings -> Indexing -> :label tab -> Title` is empty.', ['label' => $this->label()]);
    }

    /**
     * @return array|Application|Translator|string|null
     */
    public function slug()
    {
        return __('Will be used to generate a resource link.');
    }

    /**
     * @return array|Application|Translator|string|null
     */
    public function documentState()
    {
        return __('The `Static` value indicates that the document changes extremely rarely, `Dynamic` (default) - the resource is created upon request and may change depending on additional request conditions.');
    }

    /**
     * @return array|Application|Translator|string|null
     */
    public function metaTitle()
    {
        return __('Resource\'s &#60;title&#62;. `Settings -> Indexing -> :label tab -> Title field` will be used by default.', ['label' => $this->label()]);
    }

    /**
     * @return array|Application|Translator|string|null
     */
    public function metaDescription()
    {
        return __('Resource\'s Meta Description. `Settings -> Indexing -> :label tab -> Meta Description field` will be used by default.', ['label' => $this->label()]);
    }

    /**
     * @return array|Application|Translator|string|null
     */
    public function metaKeys()
    {
        return __('Resource\'s Meta Keywords. `Settings -> Indexing -> :label tab -> Meta Keywords field` will be used by default.', ['label' => $this->label()]);
    }
}