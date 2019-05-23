<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = 
    [
        'title','description','category','num_persons','region','address','start_date','final_date','cost','deadline','owner_id','job_id','status',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function responds()
    {
        return $this->hasMany(Respond::class, 'job_id');
    }
}
