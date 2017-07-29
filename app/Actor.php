<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    //

    public $fillable= ['name','age'];


    public function movies(){
        return $this->belongsToMany('App\Movie')->withTimestamps();
    }
}
