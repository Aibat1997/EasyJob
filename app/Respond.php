<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respond extends Model
{
    protected $guarded = [];
    
    public function jobs()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
