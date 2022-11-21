<?php

use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\TweetsController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(UsersController::class)->group(function() {
    Route::post('register', 'register');
    Route::get('users/{user}', 'show');
    Route::get('users/{user}/tweets', 'listTweets');
});

Route::controller(NotificationsController::class)->group(function(){
Route::post('notifications', 'store');
Route::get('notifications/{notification}', 'show');
Route::get('notifications/{notification}/user', 'show_user');
});

Route::controller(TweetsController::class)->group(function() {
    Route::post('tweet', 'store');
    Route::post('tweet/{tweet}/tag/{tag}', 'tagToTweet');
    Route::get('tweet/{tweet}/tag', 'listHashTags');
});

Route::controller(\App\Http\Controllers\HashTagsController::class)->group(function() {
    Route::post('tag', 'store');
});
