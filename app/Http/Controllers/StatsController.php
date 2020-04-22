<?php

namespace App\Http\Controllers;

use Illuminate\http\Request;
use App\User;
use App\Project;
use App\Credentail;

class StatsController extends Controller
{
    public function count()
    {
        $users = User::where('user_type', '1')->count();
        $admins = User::where('user_type', '0')->count();
        $projects = Project::all()->count();
        $credentials = Credentail::all()->count();
        $success['Users'] = $users;
        $success['Admins'] = $admins;
        $success["Projects"] = $projects;
        $success['Credentials'] = $credentials;

        return response()->json(['success' => $success], 200);
    }
}
