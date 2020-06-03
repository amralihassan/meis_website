<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $fillable = [
         'title',
         'module',
         'color',
         'start_date',
         'end_date',
         'privacy',
         'user_id',
    ];
    public function admins()
    {        
        return $this->belongsTo('App\Admin','user_id');
    }
}
