<?php

namespace App\Http\Controllers;

use App\Models\HashTag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller

{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'lastname' => 'string|max:255',
            'biography' => 'string|max:255',
            'website' => 'string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'lastname' => $request->get('lastname'),
            'biography' => $request->get('biography'),
            'website' => $request->get('website'),
            'password' => Hash::make($request->get('password')),
        ]);
        return response()->json(['message' => 'User Created', 'data' => $user], 200);
    }
    public function show(User $user)
    {
        return response()->json(['message'=>'','data'=>$user],200);
    }
    public function bookEvent(Request $request, User $user, HashTag $tag)
    {
        $note = '';
        if($request->note){
            $note = $request->note;
        }
        if($user->events()->save($tag, array('note' => $note))){
            return response()->json(['message'=>'User Event
Created','data'=>$tag],200);
        }
        return response()->json(['message'=>'Error','data'=>null],400);
    }
    public function listTweets(User $user)
    {
        $tweet = $user->tweets;
        return response()->json(['message'=>null,'data'=>$tweet],200);
    }
}
