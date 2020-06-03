<?php
namespace Admission\Models;
use Illuminate\Database\Eloquent\Model;

class OnlineRegisterMessages extends Model
{
    protected $table = 'online_register_messages';
    protected $fillable = [
        'durationParentInterview',
        'durationAssessmentTest',
        'offDays',
        'defaultPaid',
        'paidText',
        'defaultParentInterview',
        'parentInterviewBeforeSetDate',
        'parentInterviewSetDate',
        'parentAfterInterview',
        'parentInterviewRejected',
        'parentInterviewAccepted',
        'defaultOpenAssessment',
        'assessmentBeforeSetDate',
        'assessmentSetDate',
        'afterAssessment',
        'assessmentRejected',
        'assessmentAccepted',
        'parentInterviewDuration',
        'assessmentTestDuration',
        'allowedDays',
        'defaultInstallmentMsg',
        'installmentAfterResultMsg',
        'installmentAfterSetDateMsg',
        'installmentAfterPaiedMsg',
        'reAssessmentDate',
        'reAssessmentMode',
        'reAssessmentStatus',
        'reAssessmentResult',
        'beforeSetReassessmentDate',
        'afterSetReassessmentDate',
        'afterReassessmentDone',
        'reAssessmentRejected',
        'reAssessmentAccepeted',
        'user_id',
    ]; 
    public function admins()
    {        
        return $this->belongsTo('App\Admin','user_id')->withTrashed();;    	
    } 
}
