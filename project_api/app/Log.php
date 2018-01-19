<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function log_type()
    {
        return $this->belongsTo('App\LogType');
    }

    public function logs_lines()
    {
        return $this->hasMany('App\LogLine');
    }

}
