<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
   protected $fillable = [
        'id',
        'name',
        'description',
        'user_id'

    ];

    public function user(){
		return $this->belongsTo('App\User');
    }

    public function projects(){
        return $this->hasMany('App\Project');
    }
    public function tasks(){
        return $this->hasMany('App\Task');
    }
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
