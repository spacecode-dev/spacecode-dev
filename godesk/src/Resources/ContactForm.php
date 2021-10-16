<?php

namespace SpaceCode\GoDesk\Resources;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Resource;
use SpaceCode\GoDesk\Fields\Table;
use SpaceCode\GoDesk\Fields\Toggle;
use SpaceCode\GoDesk\Traits\Resolve;

class ContactForm extends Resource
{
    use Resolve;

    /**
     * @var string
     */
    public static $model = \SpaceCode\GoDesk\Models\ContactForm::class;

    /**
     * @var string
     */
    public static $title = 'id';

    /**
     * @var array
     */
    public static $search = [
        'source',
    ];

    /**
     * @var array
     */
    public static $statuses = [
        'new' => 'warning',
        'pending' => 'warning',
        'processed' => 'success',
        'completed' => 'success',
        'canceled' => 'danger',
        'deleted' => 'danger'
    ];

    /**
     * @return string
     */
    public static function group(): string
    {
        return __('Requests');
    }

    /**
     * @return array|string|null
     */
    public static function label()
    {
        return __('Contact Form');
    }

    /**
     * @return array|string|null
     */
    public static function singularLabel()
    {
        return __('Contact Form');
    }

    /**
     * @return array|Application|Translator|string|null
     */
    public static function createButtonLabel()
    {
        return __('Create');
    }

    /**
     * @return array|Application|Translator|string|null
     */
    public static function updateButtonLabel()
    {
        return __('Update');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        if($this->id) {
            $form = $this::$model::withTrashed()->find($this->id);
            if($form->view !== '1') {
                $form->update(['view' => '1']);
            }
        }
        return [

            /**
             * Index
             */
            ID::make()->asBigInt()->sortable()->onlyOnIndex(),

            Text::make(__('Source'), 'source')->onlyOnIndex(),

            Text::make(__('Updated At'), 'updated_at')
                ->onlyOnIndex()
                ->sortable()
                ->displayUsing(function($date) {
                    return $date->diffForHumans();
                }),

            Badge::make(__('Status'), 'status', function () {
                if ($this->isSoftDeleted()) return 'deleted';
                return $this->status;
            })->map(self::$statuses)
                ->labels($this->statusOptions(self::$statuses))
                ->sortable()
                ->onlyOnIndex(),

            Toggle::make(__('Viewed'), 'view')->onlyOnIndex(),

            /**
             * Form
             */
            Select::make(__('Status'), 'status')
                ->onlyOnForms()
                ->rules('required')
                ->options(collect($this::$model::$statuses)->mapWithKeys(function ($key) {
                    return [$key => __(ucfirst($key))];
                })),

            Text::make(__('Source'), 'source')->hideFromIndex()->readonly(),

            Table::make(__('Options'), 'data')
                ->disableAdding()
                ->disableDeleting()
                ->readonly()
                ->hideFromIndex(),

            Textarea::make(__('Note'), 'note')->hideFromIndex(),

            DateTime::make(__('Created At'), 'created_at')
                ->exceptOnForms()
                ->hideFromIndex(),

            DateTime::make(__('Updated At'), 'updated_at')
                ->exceptOnForms()
                ->hideFromIndex(),

        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
