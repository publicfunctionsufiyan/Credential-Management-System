<?php

namespace App\Http\Controllers;

use App\Http\Requests\CredentialValidator;
use Illuminate\Http\Request;
use App\Credentail;
use App\Assigned;
use App\Project;
use App\User;
use LengthException;

class CredentialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // GET CREDENTAILS BY USER
    public function getCredentialsByUser($id)
    {
        $user = User::find($id);
        $credentials = $user->credentails;
        return response()->json(['Credentials' => $credentials], 200);
    }
    // GET CREDENTAILS BY PROJECT
    public function getCredentialsByProject($id)
    {
        $project = Project::find($id);
        $credentials = $project->credentails;
        return response()->json(['Credentials' => $credentials], 200);
    }


     public function index()
    {
        //
        return Credentail::all();
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
    public function store(CredentialValidator $request)
    {

        return Credentail::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Credentail::find($id);
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
    public function update(CredentialValidator $request, $id)
    {
        $credentail = Credentail::findOrFail($id);
        $credentail->update($request->all());

        return $credentail;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $credentail = Credentail::findOrFail($id);
        $credentail->delete();

        return 204;
    }
}
