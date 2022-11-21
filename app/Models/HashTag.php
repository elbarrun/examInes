<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HashTag extends Model
{
    use HasFactory;
    protected $fillable = [
        'tag', 'users_id'
    ];
    public function users(){
        return $this->belongsToMany('App\Models\User', 'hash_tags')->withTimestamps();
    }


}
