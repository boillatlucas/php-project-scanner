<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $dates = ['analyzed'];

    public function logs()
    {
        return $this->hasMany('App\Log');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
