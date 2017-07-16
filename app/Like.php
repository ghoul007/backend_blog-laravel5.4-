<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable =['user_id','movie_id'];


    public function user(){

        return $this->belongsTo('App\User');
    }
    public function movie(){

        return $this->belongsTo('App\Movie');
    }
}
