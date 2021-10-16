<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Release extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $appends = ['download'];

    /**
     * @return mixed
     */
    public function getDownloadAttribute(): string
    {
        return url('/nova-vendor/filemanager/actions/download-file?file=private/' . $this->link);
    }
}
