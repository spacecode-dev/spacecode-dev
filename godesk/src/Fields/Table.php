<?php

namespace SpaceCode\GoDesk\Fields;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class Table extends Field
{
    /**
     * @var string
     */
    public $component = 'table-field';

    /**
     * @var bool
     */
    public $showOnIndex = false;

    /**
     * @var bool
     */
    public $canAdd = true;

    /**
     * @var bool
     */
    public $canDelete = true;

    /**
     * @param mixed $min
     * @return $this
     */
    public function minRows($min): self
    {
        return $this->withMeta(['minRows' => $min]);
    }

    /**
     * @param mixed $max
     * @return $this
     */
    public function maxRows($max): self
    {
        return $this->withMeta(['maxRows' => $max]);
    }

    /**
     * @param mixed $min
     * @return $this
     */
    public function minColumns($min): self
    {
        return $this->withMeta(['minColumns' => $min]);
    }

    /**
     * @param mixed $max
     * @return $this
     */
    public function maxColumns($max): self
    {
        return $this->withMeta(['maxColumns' => $max]);
    }

    /**
     * @return $this
     */
    public function disableAdding(): self
    {
        $this->canAdd = false;

        return $this;
    }

    /**
     * @return $this
     */
    public function disableDeleting(): self
    {
        $this->canDelete = false;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'canAdd' => $this->canAdd,
            'canDelete' => $this->canDelete,
        ]);
    }

    /**
     * @param NovaRequest $request
     * @param string $requestAttribute
     * @param object $model
     * @param string $attribute
     * @return void
     */
    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        if ($request->exists($requestAttribute)) {
            $model->{$attribute} = json_decode($request[$requestAttribute], true);
        }
    }
}