<?php
namespace SpaceCode\GoDesk\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use SpaceCode\GoDesk\GoDesk;
use Whitecube\NovaFlexibleContent\Concerns\HasFlexible;
use Whitecube\NovaFlexibleContent\Value\FlexibleCast;

class Template extends Model
{
    use HasFlexible;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $casts = [
        'blocks' => FlexibleCast::class
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function($model) {
            if(!$model->use_blocks) {
                $model->blocks = null;
            }
            return true;
        });

        static::deleting(function($model) {
            File::deleteDirectory(Str::of($model->title)->slug('-'));
            return true;
        });
    }

    /**
     * @return array
     */
    public function getContentAttribute(): array
    {
        return collect(GoDesk::websiteLangs())->mapWithKeys(function ($lang) {
            $folder = Str::of($this->title)->slug('-');
            $filePath = resource_path("views/vendor/godesk/templates/{$folder}/{$lang}.blade.php");
            return (object)[
                $lang => File::exists($filePath) ? Str::between(File::get($filePath), '@section(\'content\')' . "\n", "\n" . '@stop

@section(\'css\')') : null
            ];
        })->toArray();
    }

    /**
     * @param $content
     */
    public function setContentAttribute($content)
    {
        if(isset($content)) {
            $oldModel = Template::where('id', $this->id)->first();
            if($oldModel) {
                foreach (GoDesk::websiteLangs() as $lang) {
                    $folder = Str::of($oldModel->title)->slug('-');
                    $oldFilePath = resource_path("views/vendor/godesk/templates/{$folder}/{$lang}.blade.php");
                    File::delete($oldFilePath);
                }
            }

            foreach (GoDesk::websiteLangs() as $lang) {
                $folder = Str::of($this->title)->slug('-');
                $folderPath = resource_path("views/vendor/godesk/templates/{$folder}");
                $filePath = resource_path("views/vendor/godesk/templates/{$folder}/{$lang}.blade.php");

                if(!File::isDirectory($folderPath)){
                    File::makeDirectory($folderPath);
                }

                File::put($filePath, '@include(\'godesk::index.inc.slot\')
@extends(\'godesk::index.index\')
@section(\'content\')' . "\n    " . $content[$lang] . "\n" . '@stop

@section(\'css\')
    {{----}}
@stop

@section(\'js\')
    {{----}}
@stop');
            }
        }
    }
}
