<?php

namespace SpaceCode\GoDesk;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Spatie\Permission\Models\Role;

class AttachToRole extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @param ActionFields $fields
     * @param Collection $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $role = Role::getModel()->find($fields['role']);
        foreach ($models as $model) {
            $role->givePermissionTo($model);
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Select::make(__('Role'), 'role')->options(Role::getModel()->get()->pluck('name', 'id')->toArray())->displayUsingLabels(),
        ];
    }
}