<?php

namespace App;

use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Project extends Model implements HasMedia
{
    use LogsActivity;
    use HasMediaTrait;
    //
    protected $fillable = [
        'name', 'URL', 'description', 'status'
    ];
    protected static $logFillable = true;

    public function credentails()
    {
        return $this->hasMany('App\Credentail', 'project_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'assigneds')->using(Assigned::class);
    }


}
