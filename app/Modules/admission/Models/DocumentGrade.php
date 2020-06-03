<?php

namespace Admission\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentGrade extends Model
{
    protected $table = 'document_grades';
    protected $fillable = [
        'id',
        'documentId',
        'gradeId',
        'user_id',
    ]; 
    public function admins()
    {        
        return $this->belongsTo('App\Admin','user_id')->withTrashed();;    	
    } 
    public function grade()
    {
        return $this->belongsTo('\Admission\Models\Grade','gradeId');
    }
}
