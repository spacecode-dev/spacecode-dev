<?php

namespace SpaceCode\GoDesk\Traits;

use Laravel\Nova\Fields\FieldCollection;
use Laravel\Nova\Panel;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

trait TabsOnEdit
{

    /**
     * @param NovaRequest $request
     * @return FieldCollection
     */
    public function creationFields(NovaRequest $request): FieldCollection
    {
        return new FieldCollection(
            [
                'Tabs' => [
                    'component' => 'tabs',
                    'fields' => $this->removeNonCreationFields($request, $this->resolveFields($request)),
                    'panel' => Panel::defaultNameForCreate($request->newResource()),
                ],
            ]
        );
    }

    /**
     * @param NovaRequest $request
     * @param $model
     * @return mixed
     */
    public static function fill(NovaRequest $request, $model)
    {
        return static::fillFields(
            $request, $model,
            (new static($model))->creationFieldsWithoutReadonly($request)
        );
    }

    /**
     * @param NovaRequest $request
     * @param $model
     * @return mixed
     */
    public static function fillForUpdate(NovaRequest $request, $model)
    {
        return static::fillFields(
            $request, $model,
            (new static($model))->updateFieldsWithoutReadonly($request)
        );
    }

    /**
     * @param NovaRequest $request
     * @return mixed
     */
    public function creationFieldsWithoutReadonly(NovaRequest $request)
    {
        return $this->parentCreationFields($request)
            ->reject(function ($field) use ($request) {
                return $field->isReadonly($request);
            });
    }

    /**
     * @param NovaRequest $request
     * @return mixed
     */
    public function updateFieldsWithoutReadonly(NovaRequest $request)
    {
        return $this->parentUpdateFields($request)
            ->reject(function ($field) use ($request) {
                return $field->isReadonly($request);
            });
    }

    /**
     * @param NovaRequest $request
     * @return mixed
     */
    public function parentCreationFields(NovaRequest $request)
    {
        return parent::creationFields($request);
    }

    /**
     * @param NovaRequest $request
     * @return mixed
     */
    public function parentUpdateFields(NovaRequest $request)
    {
        return parent::updateFields($request);
    }

    /**
     * @param NovaRequest $request
     * @return mixed
     */
    public static function rulesForCreation(NovaRequest $request)
    {
        return static::formatRules($request, (new static(static::newModel()))
            ->parentCreationFields($request)
            ->mapWithKeys(function ($field) use ($request) {
                return $field->getCreationRules($request);
            })->all());
    }

    /**
     * @param NovaRequest $request
     * @param null $resource
     * @return mixed
     */
    public static function rulesForUpdate(NovaRequest $request, $resource = null)
    {
        return static::formatRules($request, (new static(static::newModel()))
            ->parentUpdateFields($request)
            ->mapWithKeys(function ($field) use ($request) {
                return $field->getUpdateRules($request);
            })->all());
    }

    /**
     * @param NovaRequest $request
     * @return FieldCollection
     */
    public function updateFields(NovaRequest $request): FieldCollection
    {
        return new FieldCollection(
            [
                'Tabs' => [
                    'component' => 'tabs',
                    'fields' => $this->removeNonUpdateFields($request, $this->resolveFields($request)),
                    'panel' => Panel::defaultNameForUpdate($this->resolveResource($request)),
                ],
            ]
        );
    }

    /**
     * @param $label
     * @param FieldCollection $fields
     * @return FieldCollection
     */
    protected function assignToPanels($label, FieldCollection $fields): FieldCollection
    {
        return $fields->map(function ($field) use ($label) {
            if (!is_array($field) && !$field->panel) {
                $field->panel = $label;
            }
            return $field;
        });
    }

    /**
     * @param NovaRequest $request
     * @return $this|Resource
     */
    private function resolveResource(NovaRequest $request)
    {
        if ($this instanceof Resource) {
            return $this;
        }
        return $request->newResource();
    }
}