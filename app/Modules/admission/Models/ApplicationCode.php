<?php
namespace Admission\Models;
use Illuminate\Database\Eloquent\Model;

class ApplicationCode extends Model
{
    protected $table = 'applicationCodes';
    protected $fillable = [
        'id',
        'applicationCode',
        'onlineId',        
        'user_id',
    ]; 
    public function admins()
    {        
        return $this->belongsTo('App\Admin','user_id')->withTrashed(); 	
    }   
    public function onLineRegister()
    {
        return $this->belongsTo('\Admission\Models\OnlineRegister','onlineId');
    }
}
