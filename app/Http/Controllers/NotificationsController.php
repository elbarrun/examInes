<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class NotificationsController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'notFollowedByMe' => 'required|boolean|max:255',
            'notFollowedToMe' => 'required|boolean|max:255',
            'newAccountsFollowingMe' => 'required|boolean|max:255',
            'users_id' => 'required|',
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }

        $notifications = Notifications::create([
            'notFollowedByMe' => $request->get('notFollowedByMe'),
            'notFollowedToMe' => $request->get('notFollowedToMe'),
            'newAccountsFollowingMe' => $request->get('newAccountsFollowingMe'),
            'users_id' => $request->get('users_id'),
        ]);
        return response()->json(['message'=>'notification Created','data'=>$notifications],200);
    }
    public function show(Notifications $notification)
    {
        return response()->json(['message'=>'','data'=>$notification],200);
    }
    public function show_user(Notifications $notification)
    {
        return response()->json(['message'=>'','data'=>$notification->users],200);

    }
}
