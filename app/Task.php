<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
     protected $fillable = [
        'name',
        'department_id',
        'access_level_id',
        'user_id',
        'duedate',
        'priority',
        'category_id',
        'description'
    ];

    public function accesslevel(){
        return $this->belongsTo('App\AccessLevel');
    }
    public function user(){
		return $this->belongsTo('App\User');
    }

    public function department(){
		return $this->belongsTo('App\Department');
    }

    public function category(){
		return $this->belongsTo('App\Category');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
