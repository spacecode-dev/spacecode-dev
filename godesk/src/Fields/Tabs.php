<?php

namespace SpaceCode\GoDesk\Fields;

use RuntimeException;
use Laravel\Nova\Panel;
use Illuminate\Http\Resources\MergeValue;
use Laravel\Nova\Contracts\ListableField;

class Tabs extends Panel
{
    /**
     * @var mixed
     */
    public $defaultSearch = false;

    /**
     * @param string $tab
     * @param array $fields
     * @return $this
     */
    public function addFields(string $tab, array $fields): self
    {
        foreach ($fields as $field) {
            if ($field instanceof ListableField || $field instanceof Panel) {
                $this->addTab($field);
                continue;
            }
            if ($field instanceof MergeValue) {
                $this->addFields($tab, $field->data);
                continue;
            }
            $field->panel = $this->name;
            $field->withMeta([
                'tab' => $tab,
            ]);
            $this->data[] = $field;
        }

        return $this;
    }

    /**
     * @param $panel
     * @return $this
     */
    public function addTab($panel): self
    {
        if ($panel instanceof ListableField) {
            $panel->panel = $this->name;
            $panel->withMeta([
                'tab'         => $panel->name,
                'listable'    => false,
                'listableTab' => true,
            ]);
            $this->data[] = $panel;
        } elseif ($panel instanceof Panel) {
            $this->addFields($panel->name, $panel->data);
        } else {
            throw new RuntimeException(__('Only listable fields or Panel allowed.'));
        }

        return $this;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function defaultSearch(bool $value = true): self
    {
        $this->defaultSearch = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'component'     => 'detail-tabs',
            'defaultSearch' => $this->defaultSearch,
        ]);
    }

    /**
     * @param array|\Closure $fields
     * @return array
     */
    protected function prepareFields($fields): array
    {
        collect(is_callable($fields) ? $fields() : $fields)->each(function ($fields, $key) {
            if (is_string($key) && is_array($fields)) {
                $fields = new Panel($key, $fields);
            }
            $this->addTab($fields);
        });
        return $this->data;
    }
}