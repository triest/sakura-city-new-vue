<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Myevent extends Model
{
    //
    protected $table = "myevents";


    //организатор
    public function organizer()
    {
        return $this->hasOne('App\Girl');
    }

    //учстники
    public function participant()
    {
        return $this->hasMany('App\Girl');
    }
}
