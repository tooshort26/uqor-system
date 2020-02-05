<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = ['title', 'description', 'deadline', 'quarter', 'link'];
    protected $dates = ['deadline'];

    public function campus()
    {
       return $this->belongsToMany('App\Campus')->withTimestamps()->withPivot('status');
    }
}
