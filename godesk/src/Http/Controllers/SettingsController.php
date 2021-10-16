<?php

namespace SpaceCode\GoDesk\Http\Controllers;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Nova\ResolvesFields;
use Illuminate\Routing\Controller;
use Laravel\Nova\Contracts\Resolvable;
use Laravel\Nova\Fields\FieldCollection;
use Illuminate\Support\Facades\Validator;
use Laravel\Nova\Http\Requests\NovaRequest;
use SpaceCode\GoDesk\Exceptions\SettingConflict;
use SpaceCode\GoDesk\GoDesk;
use SpaceCode\GoDesk\Models\Page;
use SpaceCode\GoDesk\Models\Settings;
use SpaceCode\GoDesk\Tools\SettingsTool;
use Illuminate\Http\Resources\ConditionallyLoadsAttributes;
use Intervention\Image\Facades\Image;
use Laravel\Nova\Panel;
use stdClass;

class SettingsController extends Controller
{
    use ResolvesFields, ConditionallyLoadsAttributes;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function get(Request $request): JsonResponse
    {
        $fields = $this->assignToPanels('Settings', $this->availableFields($request->get('path', 'general')));
        $panels = $this->panelsWithDefaultLabel('Settings', app(NovaRequest::class));

        $addResolveCallback = function (&$field) {
            if (!empty($field->attribute)) {
                if ($field->attribute === 'translates') {
                    $files = \File::files(resource_path('lang'));
                    if (count($files)) {
                        $array = collect('en');
                        foreach (\File::files(resource_path('lang')) as $key => $file) {
                            if ($file->getExtension() === 'json' && $file->getBasename() !== 'en.json') {
                                $array->push(str_replace('.json', '', $file->getBasename()));
                            }
                        }
                        $contents = collect([]);
                        $array->map(function ($lang) use ($contents) {
                            $content = collect(json_decode(\File::get(resource_path('lang/' . $lang . '.json'))))->values();
                            $contents->push($content);
                        });
                        $result = collect();
                        $contents->first()->map(function ($item, $key) use ($contents, $result) {
                            $array = collect();
                            $array->push($item);
                            $contents->skip(1)->map(function ($sItem) use ($array, $key) {
                                $array->push($sItem[$key]);
                            });
                            $result->push($array->toArray());
                        });
                        $result->prepend($array->toArray());
                        $field->resolve([$field->attribute => $result->toArray()]);
                    } else {
                        $setting = SettingsTool::getSettingsModel()::findOrNew('website_langs');
                        $filtered = collect(json_decode($setting->value))->reject(function ($value, $key) {
                            return $value === 'en';
                        });
                        $field->resolve([$field->attribute => [$filtered->values()->prepend('en')->toArray(), ['', '']]]);
                    }
                } else {
                    $setting = SettingsTool::getSettingsModel()::findOrNew($field->attribute);
                    if (count($field->rules) && in_array('json', $field->rules)) {
                        $val = json_decode($setting->value);
                    } else {
                        $val = $setting->value;
                    }
                    $field->resolve([$field->attribute => isset($setting) ? $val : '']);
                }
            }

            if (!empty($field->meta['fields'])) {
                foreach ($field->meta['fields'] as $_field) {
                    $setting = SettingsTool::getSettingsModel()::where('key', $_field->attribute)->first();
                    $_field->resolve([$_field->attribute => isset($setting) ? $setting->value : '']);
                }
            }
        };

        $changeNameCallback = function (&$panel) {
            $panel->name = __($panel->name);
        };

        $fields->each(function (&$field) use ($addResolveCallback) {
            // ToDo lang list trans
//            if($field->resolveCallback) {
//                function LocalesWithCallback($callback){
//                    if (is_callable($callback)) {
//                        $argument = collect(GoDesk::websiteLangs())->map(function ($key) {
//                            return [$key => GoDesk::localeValue($key)];
//                        })->collapse()->toArray();
//                        call_user_func($callback, $argument);
//                    }
//                }
//                $resolveCallback = $field->resolveCallback;
//                LocalesWithCallback(function($newValue) use ($resolveCallback) {
//                    dd($resolveCallback);
//                    $resolveCallback = $newValue;
//                });
//            }

            if (Str::contains($field->helpText, ':label')) {
                $field->helpText = __($field->helpText, ['label' => __($field->meta['tab'])]);
            } else {
                $field->helpText = __($field->helpText);
            }
            $field->panel = __($field->panel);

            $field->meta = collect($field->meta)->mapWithKeys(function ($valueItem, $keyItem) {
                if ($keyItem === 'value') {
                    return [$keyItem => get_variables_text()];
                } else if ($keyItem === 'tab') {
                    return [$keyItem => __($valueItem)];
                } else if ($keyItem === 'tabInfo') {
                    return [$keyItem => collect($valueItem)->mapWithKeys(function ($valueInfo, $keyInfo) {
                        if ($keyInfo === 'title' || $keyInfo === 'name') {
                            return [$keyInfo => __($valueInfo)];
                        } else {
                            return [$keyInfo => $valueInfo];
                        }
                    })->toArray()];
                } else if ($keyItem === 'options') {
                    return [$keyItem => collect($valueItem)->map(function ($option) {
                        $option['label'] = __($option['label']);
                        return $option;
                    })];
                } else {
                    return [$keyItem => $valueItem];
                }
            })->toArray();

            if ($field->component === 'key-value-field') {
                $field->keyLabel = __($field->keyLabel);
                $field->valueLabel = __($field->valueLabel);
                $field->actionText = __($field->actionText);
            }

            if ($field->component === 'nova-dependency-container') {
//                dd($field->meta['fields']);
                $field->meta['fields'] = collect($field->meta['fields'])->map(function ($f) {
                    $f->name = __($f->name);
                    $f->meta = collect($f->meta)->mapWithKeys(function ($valueItem, $keyItem) {
                        if ($keyItem === 'value') {
                            return [$keyItem => __($valueItem)];
                        } else {
                            return [$keyItem => $valueItem];
                        }
                    })->toArray();
                    return $f;
                })->toArray();
            }

            if (Str::contains($field->name, ':label')) {
                $field->name = __($field->name, ['label' => __($field->meta['tab'])]);
            } else {
                $field->name = __($field->name);
            }

            $addResolveCallback($field);
        });

        collect($panels)->each(function (&$panel) use ($changeNameCallback) {
            $changeNameCallback($panel);
        })->toArray();

        return response()->json([
            'panels' => $panels,
            'fields' => $fields,
        ], 200);
    }

    /**
     * @param NovaRequest $request
     * @return Application|ResponseFactory|JsonResponse|Response
     * @throws ValidationException
     * @throws FileNotFoundException
     */
    public function save(NovaRequest $request)
    {
        $fields = $this->availableFields($request->get('path', 'general'));

        // NovaDependencyContainer support
        $fields = $fields->map(function ($field) {
            if (!empty($field->attribute)) return $field;
            if (!empty($field->meta['fields'])) return $field->meta['fields'];
            return null;
        })->filter()->flatten();

        $rules = [];
        foreach ($fields as $field) {
            $fakeResource = new stdClass;
            $fakeResource->{$field->attribute} = get_setting($field->attribute);
            $field->resolve($fakeResource, $field->attribute); // For nova-translatable support
            $rules = array_merge($rules, $field->getUpdateRules($request));
        }

        Validator::make($request->all(), $rules)->validate();

        $fields->whereInstanceOf(Resolvable::class)->each(function ($field) use ($request) {
            if (empty($field->attribute)) return;
            if ($field->isReadonly(app(NovaRequest::class))) return;
            $settingsClass = SettingsTool::getSettingsModel();

            // For nova-translatable support
            if (!empty($field->meta['translatable']['original_attribute'])) $field->attribute = $field->meta['translatable']['original_attribute'];

            $existingRow = $settingsClass::where('key', $field->attribute)->first();

            $tempResource = new stdClass;
            $field->fill($request, $tempResource);

            if (!property_exists($tempResource, $field->attribute)) return;

            if (isset($existingRow)) {
                if ($field->attribute === 'website_favicon' && $existingRow->value !== $tempResource->{$field->attribute}) {
                    $existing_array = explode('.', $existingRow->value);
                    $existing_mime = $existing_array[sizeof($existing_array) - 1];
                    $existing_path = str_replace(".{$existing_mime}", '', $existingRow->value);
                    $temp_array = explode('.', $tempResource->{$field->attribute});
                    $temp_mime = $temp_array[sizeof($temp_array) - 1];
                    $temp_path = str_replace(".{$temp_mime}", '', $tempResource->{$field->attribute});
                    $disk = config('godesk.filemanager.disk');
                    foreach (['32', '180'] as $size) {
                        $path = "{$temp_path}_{$size}.{$temp_mime}";
                        Storage::disk($disk)->delete("{$existing_path}.{$existing_mime}");
                        Storage::disk($disk)->delete("{$existing_path}_{$size}.{$existing_mime}");
                        Storage::disk($disk)->copy($tempResource->{$field->attribute}, $path);
                        $image = Image::make(Storage::disk($disk)->get($path));
                        $image->resize($size, $size);
                        $image->save(storage_path('app/public/' . $path));
                    }
                } elseif ($field->attribute === 'website_langs') {

                    $tempLang = $request->get('website_lang');

                    $existedLangs = collect(json_decode($existingRow->value))->sort()->values();
                    $tempLangs = collect($tempResource->{$field->attribute})->sort()->values();

                    if(!in_array($tempLang, $tempLangs->toArray())) {
                        throw SettingConflict::notInArray();
                    }

                    $removedArray = $existedLangs->diff($tempLangs)->toArray();
                    $addedArray = $tempLangs->diff($existedLangs)->toArray();

                    if(boolval(count($addedArray)) && boolval(count($removedArray))) {
                        throw SettingConflict::complexRequest();
                    }

                    if(boolval(count($addedArray)) || boolval(count($removedArray))) {
                        collect(GoDesk::translatedModels())->map(function ($modelString) use ($addedArray, $removedArray) {
                            $modelClass = app($modelString);
                            $modelClass->all()->map(function ($model) use ($addedArray, $removedArray) {
                                if(boolval(count($addedArray))) {
                                    if(class_basename($model) === 'Settings') {
                                        $keys = Settings::whereIn('key', ['website_description', 'website_excerpt', 'website_title'])->orWhere('key', 'like', 'indexing_%')->get()->reject(function ($key) {
                                            return Str::contains($key->key, '_priority');
                                        });
                                        $keys->map(function ($set) use($addedArray) {
                                            $newValue = collect(json_decode($set->value));
                                            collect($addedArray)->map(function ($lang) use ($newValue) {
                                                $newValue->put($lang, $newValue[GoDesk::adminLang()]);
                                            });
                                            $set->value = json_encode($newValue);
                                            $set->save();
                                        });
                                    } else {
                                        collect($model->getCasts())->map(function ($cast, $keyCast) use ($addedArray, $model) {
                                            if ($cast === 'array' && $keyCast !== 'index') {
                                                $transVar = collect($model->{$keyCast});
                                                collect($addedArray)->map(function ($lang) use ($transVar) {
                                                    $transVar->put($lang, $transVar[GoDesk::adminLang()]);
                                                });
                                                $model->{$keyCast} = $transVar->all();
                                            } else if ($cast === 'array' && $keyCast === 'index') {
                                                $transVar = collect($model->{$keyCast});
                                                $model->{$keyCast} = $transVar->mapWithKeys(function ($index, $keyIndex) use ($addedArray) {
                                                    return [$keyIndex => collect($index)->merge(
                                                        collect($addedArray)->mapWithKeys(function ($lang) use($index) {
                                                            return [$lang => $index[GoDesk::adminLang()]];
                                                        })->all()
                                                    )->all()];
                                                })->all();
                                            }
                                        });
                                    }
                                } else if (boolval(count($removedArray))) {
                                    if(class_basename($model) === 'Settings') {
                                        $keys = Settings::whereIn('key', ['website_description', 'website_excerpt', 'website_title'])->orWhere('key', 'like', 'indexing_%')->get()->reject(function ($key) {
                                            return Str::contains($key->key, '_priority');
                                        });
                                        $keys->map(function ($set) use($removedArray) {
                                            $newValue = collect(json_decode($set->value));
                                            collect($removedArray)->map(function ($lang) use ($newValue) {
                                                $newValue->pull($lang);
                                            });
                                            $set->value = json_encode($newValue);
                                            $set->save();
                                        });
                                    } else {
                                        collect($model->getCasts())->map(function ($cast, $keyCast) use ($removedArray, $model) {
                                            if ($cast === 'array' && $keyCast !== 'index') {
                                                $transVar = collect($model->{$keyCast});
                                                collect($removedArray)->map(function ($lang) use ($transVar) {
                                                    $transVar->pull($lang);
                                                });
                                                $model->{$keyCast} = $transVar->all();
                                            } else if ($cast === 'array' && $keyCast === 'index') {
                                                $transVar = collect($model->{$keyCast});
                                                $model->{$keyCast} = $transVar->mapWithKeys(function ($index, $keyIndex) use ($removedArray) {
                                                    return [$keyIndex => collect($index)->except($removedArray)];
                                                })->all();
                                            }
                                        });
                                    }
                                }
                                $model->save();
                            });
                        });
                    }

                    $websiteLang = $settingsClass::where('key', 'website_lang')->first();
                    $websiteLang->value = $request->get('website_lang');
                    $websiteLang->save();

                    $websiteLangs = $settingsClass::where('key', 'website_langs')->first();
                    $websiteLangs->value = $request->get('website_langs');
                    $websiteLangs->save();

                } elseif (Str::contains($field->attribute, 'prefix_')) {
                    // Reserved by system
                    if (in_array($tempResource->{$field->attribute}, GoDesk::reservedPath())) {
                        throw SettingConflict::reserved();
                    }
                    // Unique page slug
                    $exist = Page::whereNull('parent_id')->where('slug', '!=', $tempResource->{$field->attribute})->pluck('slug')->toArray();
                    if (in_array($tempResource->{$field->attribute}, $exist)) {
                        throw SettingConflict::url();
                    }
                    // Update profile prefix
                    if ($field->attribute === 'prefix_profile') {
                        Artisan::call('route:clear');
                    }
                }
                if ($field->attribute !== 'website_lang' && $field->attribute !== 'website_langs') {
                    $existingRow->value = $tempResource->{$field->attribute};
                    $existingRow->save();
                }
            } else {
                if ($field->attribute === 'website_favicon') {
                    $temp_array = explode('.', $tempResource->{$field->attribute});
                    $temp_mime = $temp_array[sizeof($temp_array) - 1];
                    $temp_path = str_replace(".{$temp_mime}", '', $tempResource->{$field->attribute});
                    $disk = config('godesk.filemanager.disk');
                    foreach (['32', '180'] as $size) {
                        $path = "{$temp_path}_{$size}.{$temp_mime}";
                        Storage::disk($disk)->copy($tempResource->{$field->attribute}, $path);
                        $image = Image::make(Storage::disk($disk)->get($path));
                        $image->resize($size, $size);
                        $image->save(storage_path('app/public/' . $path));
                    }

                } elseif ($field->attribute === 'translates') {
                    $v = $tempResource->{$field->attribute};
                    if ($v[0][0] !== 'en') {
                        throw SettingConflict::transEn();
                    }
                    foreach ($v[0] as $k => $l) {
                        if (!$k && $l !== 'en') {
                            throw SettingConflict::transEn();
                        }
                        if (!in_array($l, GoDesk::locales()->keys()->toArray())) {
                            throw SettingConflict::transErrorLang();
                        }
                    }
                    $array = collect($v)->map(function ($row) {
                        if (collect($row)->filter()->count()) {
                            return collect($row);
                        }
                    })->filter();
                    $langs = $array->first();
                    $result = $langs->map(function ($lang, $langIndex) use ($array) {
                        return [$lang => $array->skip(1)->values()->map(function ($string) use ($langIndex) {
                            return [$string[0] => $string[$langIndex]];
                        })];
                    });
                    $result->map(function ($value) {
                        collect($value)->map(function ($val, $lang) {
                            $content = json_encode($val->collapse()->unique()->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                            \File::put(resource_path('lang/' . $lang . '.json'), $content);
                        });
                    });
                }
                if ($field->attribute !== 'translates' && $field->attribute !== 'website_lang' && $field->attribute !== 'website_langs') {
                    $newRow = new $settingsClass;
                    $newRow->key = $field->attribute;
                    $newRow->value = $tempResource->{$field->attribute};
                    $newRow->save();
                }
            }
        });

        if (config('godesk.settings.reload_page_on_save', false) === true || $request->get('path') === 'supplements' || $request->get('path') === 'languages') {
            return response()->json(['reload' => true]);
        }

        return response('', 204);
    }

    /**
     * @param Request $request
     * @param $fieldName
     * @return Application|ResponseFactory|Response
     */
    public function deleteImage(Request $request, $fieldName)
    {
        $existingRow = SettingsTool::getSettingsModel()::where('key', $fieldName)->first();
        if (isset($existingRow)) {
            if ($existingRow->key === 'website_favicon') {
                $existing_array = explode('.', $existingRow->value);
                $existing_mime = $existing_array[sizeof($existing_array) - 1];
                $existing_path = str_replace(".{$existing_mime}", '', $existingRow->value);
                $disk = config('godesk.filemanager.disk');
                foreach (['32', '180'] as $size) {
                    Storage::disk($disk)->delete("{$existing_path}.{$existing_mime}");
                    Storage::disk($disk)->delete("{$existing_path}_{$size}.{$existing_mime}");
                }
            }
            $existingRow->value = null;
            $existingRow->save();
        }
        return response('', 204);
    }

    /**
     * @param string $path
     * @return FieldCollection
     */
    protected function availableFields($path = 'general'): FieldCollection
    {
        return (new FieldCollection(($this->filter(SettingsTool::getFields($path)))))->authorized(request());
    }

    /**
     * @param Request $request
     * @param string $path
     * @return array
     */
    protected function fields(Request $request, $path = 'general'): array
    {
        return SettingsTool::getFields($path);
    }

    /**
     * @param string $label
     * @param NovaRequest $request
     * @return array
     */
    protected function panelsWithDefaultLabel(string $label, NovaRequest $request): array
    {
        $method = $this->fieldsMethod($request);

        return with(
            collect(array_values($this->{$method}($request, $request->get('path', 'general'))))->whereInstanceOf(Panel::class)->unique('name')->values(),
            function ($panels) use ($label) {
                return $panels->when($panels->where('name', $label)->isEmpty(), function ($panels) use ($label) {
                    return $panels->prepend((new Panel($label))->withToolbar());
                })->all();
            }
        );
    }
}
