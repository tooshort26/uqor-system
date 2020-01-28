<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Campus extends Authenticatable 
{
	use Notifiable;

    protected $fillable = ['email', 'name', 'address', 'approved'];

    protected $hidden = [
    	'password'
    ];
}
