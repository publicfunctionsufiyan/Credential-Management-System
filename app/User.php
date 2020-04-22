<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Activitylog\Traits\LogsActivity;


class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, Notifiable;
    use HasRoles;
    use LogsActivity;
    use HasMediaTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $with = ['media'];
    protected $fillable = [
        'name', 'email', 'password', 'user_type', 'status'
    ];

    protected $hidden = ['password'];
    protected static $logFillable = true;


    public function projects()
    {
        return $this->belongsToMany('App\Project', 'assigneds')->using(Assigned::class);
    }

    public function credentails()
    {
        return $this->belongsToMany('App\Credentail', 'assigneds')->using(Assigned::class);
    }


}
