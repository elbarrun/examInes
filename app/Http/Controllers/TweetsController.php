<?php

namespace App\Http\Controllers;

use App\Models\HashTag;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TweetsController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:255',
            'users_id' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $tweet = Tweet::create([
            'message' => $request->get('message'),
            'users_id' => $request->get('users_id'),
        ]);
        return response()->json(['message' => 'tweet Created', 'data' => $tweet], 200);
    }
    public function tagToTweet(Request $request, Tweet $tweet, HashTag $tag)
    {
        $tag = '';
        if($request->tag){
            $tag = $request->tag;
        }
        if($tweet->hashtag()->save($tag)){
            return response()->json(['message'=>'tag to Created','data'=>$tag],200);
        }
        return response()->json(['message'=>'Error','data'=>null],400);
    }

    public function listHashTags(tweet $tweet){
        $hashtag = $tweet->hashtag;
        return response()->json(['message'=>null,'data'=>$tweet],200);
    }
}
