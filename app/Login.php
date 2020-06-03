<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $table = 'logins';
    protected $fillable = [
        'id', 'user_id', 'gethostname'
    ];

    public function admins()
    {
        // primary key ,foreign key in admins table
        return $this->belongsTo('App\Admin','user_id');
    }

}
