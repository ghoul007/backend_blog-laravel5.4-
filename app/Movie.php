<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{


    protected $fillable = ['user_id', 'title', 'description'];

    public function user()
    {

        return $this->belongsTo('App\User');
    }


    public function likes()
    {

        return $this->hasMany('App\Like');
    }


    public function actors()
    {
        return $this->belongsToMany('App\Actor')->withTimestamps();
    }
}









