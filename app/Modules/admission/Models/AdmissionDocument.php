<?php

namespace Admission\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionDocument extends Model
{
    protected $table = 'admission_documents';
    protected $fillable = [
        'id',
        'arabicDocumentName',
        'englishDocumentName',
        'registrationType',
        'notes',
        'sort',
        'user_id',
    ]; 
    public function admins()
    {        
        return $this->belongsTo('App\Admin','user_id')->withTrashed();;    	
    } 
}
