<?php

namespace App\Http\Controllers;

use App\Models\HashTag;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HashTagsController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tag' => 'required|string|max:255',
            'users_id' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $tag = HashTag::create([
            'tag' => $request->get('tag'),
            'users_id' => $request->get('users_id'),
        ]);
        return response()->json(['message' => 'tag Created', 'data' => $tag], 200);
    }
}
