<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    // REGISTER
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), ['name' => 'required', 'email' => 'required|email', 'password' => 'required', 'user_type' => 'required', 'status' => 'required', 'image' => 'required']);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $user->addMedia($input['image'])->toMediaCollection('avatar');
        if ($user->user_type == 0) $user->assignRole('admin');
        if ($user->user_type == 1) $user->assignRole('user');
        $success['token'] = $user->createToken('Laravel Password Grant Client')->accessToken;
        $success['name'] = $user->name;
        $success['id'] = $user->id;
        return response()->json(['success' => $success], 200);
    }

    //LOGIN
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $user->getMedia();
            $success['token'] = $user->createToken('Laravel Password Grant Client')->accessToken;
            unset($user->password);
            $success['user'] = $user;
            return response()->json(['success' => $success], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    //LOGOUT
    public function logout(Request $request)
    {

        $token = $request->user()->token();
        $token->revoke();

        $response = 'You have been succesfully logged out!';
        return response($response, 200);
    }

    //Admins
    public function getAdmin(Request $request)
    {
        $users = User::where('user_type', "0")->get();
        return response()->json(['success' => $users], 200);
    }

    //Users
    public function getUsers(Request $request)
    {
        $users = User::where('user_type', "1")->get();
        return response()->json(['success' => $users], 200);
    }

    //Remove User
    public function removeUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['success' => true], 200);
    }

    //Update User
    public function userUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        $user->addMedia($request['image'])->toMediaCollection('avatar');
        return $user;
    }
}
