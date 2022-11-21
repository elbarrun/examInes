<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
        'users_id'
    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function hashtag()
    {
        return $this->belongsToMany('App\Models\HashTag');
    }
}


