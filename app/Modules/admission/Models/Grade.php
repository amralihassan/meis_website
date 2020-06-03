<?php
namespace Admission\Models;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = 'grades';
    protected $fillable = [
        'id',
        'arGrade',
        'enGrade',        
        'arGradeParent',
        'enGradeParent',
        'fromAgeYears',
        'fromAgeMonth',
        'toAgeYears',
        'toAgeMonth',
        'sort',
        'user_id',
    ]; 
    public function admins()
    {        
        return $this->belongsTo('App\Admin','user_id')->withTrashed();;    	
    } 
}
