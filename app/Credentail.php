<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Credentail extends Model
{
    use LogsActivity;

    // public function project(){
    //     return $this->belongsTo(Project::class);
    // }

    public $fillable = ['email', 'password', 'API_KEY', 'project_id', 'role', 'secret', 'Private_Key', 'Public_Key', 'other_properties'];
    protected static $logFillable = true;

    public function users()
    {
        return $this->belongsToMany('App\User', 'assigneds')->using(Assigned::class);
    }

    public function projects()
    {
        return $this->belongsTo('App\Project', 'project_id');
    }
}
