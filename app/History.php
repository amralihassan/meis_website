<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'historys';
    protected $fillable = [
        'id', 'section', 'tableName','history','user_id','idCode','crud'
    ];
    public function admins()
    {
        //                                     primary key ,foreign key in admins table
        return $this->belongsTo('App\Admin','user_id');
    }
    
}
