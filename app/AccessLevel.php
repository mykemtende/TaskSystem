<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessLevel extends Model
{
     protected $fillable = [
        'id',
        'name',
        'user_id'

    ];

    public function user(){
		return $this->belongsTo('App\User');
    }

    public function tasks(){
        return $this->hasMany('App\Task');
    }

}
