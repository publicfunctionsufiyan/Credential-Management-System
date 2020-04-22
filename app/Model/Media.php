<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    protected $appends = ['url'];

    //
    public function getUrlAttribute()
    {
        return $this->getFullUrl();
    }
}
