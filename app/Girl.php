<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Myevent;

class Girl extends Model
{
    //
    protected $fillable = ['name', 'description', 'sex', 'ptivate', 'phone_settings', 'views_all'];

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

    public function privatephotos()
    {
        return $this->hasMany('App\Privatephoto');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function target()
    {
        //return $this->hasOne('App\Target');
        return $this->belongsToMany('App\Target', 'girl_target', 'girl_id');
    }

    public function interest()
    {
        //return $this->hasOne('App\Target');
        return $this->belongsToMany('App\Interest', 'girl_interess');
    }

    public function like()
    {
        return $this->hasOne('App\Girl');
    }

    public function eventorganizer()
    {
        return $this->hasMany('App\Myevent');
    }
}


