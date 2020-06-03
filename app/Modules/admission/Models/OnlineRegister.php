<?php
namespace Admission\Models;
use Illuminate\Database\Eloquent\Model;

class OnlineRegister extends Model
{
    protected $table = 'onlineRegisters';

    protected $fillable = [
        'id',
        'firstName',
        'middleName',
        'lastName',
        'familyName',
        'fatherIdNumber',
        'fatherMobile',
        'homePhone',
        'fatherFacebookAccount',
        'fatherJob',
        'fatherQualification',
        'fatherEmail',
        'fatherNationality',
        'maritalStatus',
        'fatherReligion',
        'fatherAddress',
        'motherName',
        'motherFacebookAccount',
        'motherIdNumber',
        'motherMobile',
        'motherJob',
        'motherQualification',
        'motherEmail',
        'motherNationality',        
        'motherReligion',
        'motherAddress',
        'applicantName',
        'applicantGender',
        'nativeLanguage',
        'secondLanguage',
        'dob',
        'yy',
        'mm',
        'dd',
        'applicantNationality',
        'applicantReligion',
        'devisionId',
        'nextGradeId',
        'nextAcademicYearId',        
        'meetRepresentative',
        'AcceptanceAcknowledgment',
        'recognition',
        'educationRights',
        'registrationType',
        'fromSchool',
        'transferReason',
        'firstNameEn',
        'middleNameEn',
        'lastNameEn',
        'familyNameEn',
        'applicantNameEn',
        'code'
    ]; 
    public function admins()
    {        
        return $this->belongsTo('App\Admin','user_id')->withTrashed();;    	
    }   
    public function grades()
    {        
        return $this->belongsTo('Admission\Models\Grade','nextGradeId');    	
    } 
    public function divisions()
    {        
        return $this->belongsTo('Admission\Models\Division','devisionId');    	
    }       
    public function academicyears()
    {        
        return $this->belongsTo('Admission\Models\Academicyear','nextAcademicYearId');    	
    }    
    public function onlineadmissions()
    {
        return $this->hasOne('\Admission\Models\OnlineAdmissinProcess','onlineId');
    }
    public function applicationCode()
    {
        return $this->hasOne('\Admission\Models\ApplicationCode','onlineId');
    }
}
