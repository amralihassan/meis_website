<?php
namespace Admission\Models;
use Illuminate\Database\Eloquent\Model;

class Academicyear extends Model
{
    protected $table = 'academicyears';
    protected $fillable = [
        'id',
        'academicYear',
        'startFrom',
        'endFrom',
        'user_id',
    ]; 
    public function admins()
    {        
        return $this->belongsTo('App\Admin','user_id')->withTrashed();;    	
    } 
}
