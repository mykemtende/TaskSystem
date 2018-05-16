<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'user_id',
        

    ];


    public function users(){
		return $this->belongsToMany('App\User');
    }

    

    public function category(){
		return $this->belongsTo('App\Category');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
