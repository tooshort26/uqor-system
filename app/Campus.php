<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Campus extends Authenticatable 
{
	use Notifiable;

    protected $fillable = ['email', 'name', 'address', 'approved', 'password',  'profile', 'phone_number'];

    protected $hidden = [
    	'password'
    ];

    public function setPasswordAttribute($value)
    {
    	return $this->attributes['password'] = Hash::make($value);
    }

    public function forms()
    {
       return $this->belongsToMany('App\Form')->withTimestamps()->withPivot('status');
    }
}
