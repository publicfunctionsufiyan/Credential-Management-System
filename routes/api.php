<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Activitylog\Models\Activity;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

    // Route::get('users', 'UserController@index');
    Route::post('/login', 'Api\AuthController@login');

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/register', 'Api\AuthController@register')->middleware('role:admin');
    Route::post('/update-user/{id}', 'Api\AuthController@userUpdate')->middleware('role:admin');
    Route::delete('/delete-user/{id}', 'Api\AuthController@removeUser')->middleware('role:admin');
    Route::get('/admins', 'Api\AuthController@getAdmin')->middleware('role:admin');
    Route::get('/users', 'Api\AuthController@getUsers')->middleware('role:admin');

    Route::post('/assign-project', 'AssignedController@store')->middleware('role:admin');

    Route::get('/activity-log', function () {
        return Activity::all();
    })->middleware('role:admin');

    Route::get('/stats', 'StatsController@count')->middleware('role:admin');

    //ALL CREDENTIALS CONTROLLERS
    Route::post('/create-credential', 'CredentialController@store')->middleware('role:admin|user');
    Route::post('/update-credential/{id}', 'CredentialController@update')->middleware('role:admin|user');
    Route::get('/users-credentials/{id}', 'CredentialController@getCredentialsByUser')->middleware('role:admin|user');
    //for Admin
    Route::delete('/delete-credential/{id}', 'CredentialController@destroy')->middleware('role:admin');
    Route::get('/project-credentials/{id}', 'CredentialController@getCredentialsByProject')->middleware('role:admin');

    //ALL PROJECT CONTROLLERS
    Route::get('/users-projects/{id}', 'ProjectController@getProjectsByUser')->middleware('role:user');
    //for Admin
    Route::post('/create-project', 'ProjectController@store')->middleware('role:admin');
    Route::get('/view-project', 'ProjectController@index')->middleware('role:admin');
    Route::post('/update-project/{id}', 'ProjectController@update')->middleware('role:admin');
    Route::delete('/delete-project/{id}', 'ProjectController@destroy')->middleware('role:admin');
    Route::get('/project-users/{id}', 'ProjectController@getUsersByProject')->middleware('role:admin');
    Route::post('/remove-user/{project}', 'ProjectController@removeUserFromProject')->middleware('role:admin');
    Route::post('/remove-credential/{credentail}', 'ProjectController@removeCredentialFromProject')->middleware('role:admin');
    Route::get('/existing-users/{project}', 'ProjectController@getExistingUsers')->middleware('role:admin');
});
