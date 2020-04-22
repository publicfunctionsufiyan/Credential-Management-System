<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\Activitylog\Traits\LogsActivity;

class Assigned extends Pivot
{
    protected $table = 'assigneds';

    use LogsActivity;
    //
    protected $fillable = [
        'user_id', 'project_id', 'credentail_id'
    ];
    protected static $logFillable = true;
}
