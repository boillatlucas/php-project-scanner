<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogLine extends Model
{
    protected $table = 'log_lines';

    public function log()
    {
        return $this->belongsTo('App\Log');
    }
}
