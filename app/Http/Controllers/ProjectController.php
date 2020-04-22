<?php

namespace App\Http\Controllers;

use App\Assigned;
use App\Credentail;
use App\Http\Requests\ProjectValidator;
use Illuminate\Http\Request;
use App\Project;
use App\User;
use LengthException;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //SHOW ALL PROJECTS BY USER
    public function getExistingUsers(Project $project)
    {

        $filter_project = function($query)use($project){
               $query->where('projects.id','<>',$project->id);

        };

        $filter= User::whereHas('projects',$filter_project)->orWhereDoesntHave('projects')->get();




        return response()->json(['success' => $filter], 200);
    }

    public function getProjectsByUser($id)
    {
        $user = User::find($id);
        $projects = $user->projects;
        return response()->json(['projects' => $projects], 200);
    }

    // SHOW ALL USER BY PROJECT
    public function getUsersByProject($id)
    {
        $project = Project::find($id);
        $users = $project->users;
        return response()->json(['Users' => $users], 200);
    }


    public function index()
    {
        return Project::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectValidator $request)
    {
        $input = $request->all();
        // dd($input);
        $project = Project::create($input);
        $project->addMedia($input['image'])->toMediaCollection('projectVisual');
        // return $project;
        return response()->json(['success' => $project], 200);

        //  return Project::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectValidator $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());
        $project->addMedia($request['image'])->toMediaCollection('projectVisual');
        return $project;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return 204;
    }

    public function removeUserFromProject(Request $request, Project $project)
    {
        $project->users()->detach($request->input('user'));
        return response()->json(['success' => true], 200);
    }

    public function removeCredentialFromProject(Request $request, Credentail $credentail)
    {
        $credentail->delete();
        return response()->json(['success' => true], 200);
    }
}






























//
//$user = $request->user;
//$assigned = [];
//for ($i = 0; $i < count($user); $i++) {
//    $ass_id = Assigned::where('project_id', $id)->where('user_id', $user[$i])->get('id');
//    array_push($assigned, $ass_id[0]->id);
//}
//for ($j = 0; $j < count($assigned); $j++) {
//    $remove = Assigned::findOrFail($assigned[$j]);
//    $remove->delete();
//}
