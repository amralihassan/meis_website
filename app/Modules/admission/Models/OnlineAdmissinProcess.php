<?php
namespace Admission\Models;
use Illuminate\Database\Eloquent\Model;

class OnlineAdmissinProcess extends Model
{
    protected $table = 'onlineAdmissionProcess';
    protected $fillable = [
        'id',
        'onlineId',
        'paid',
        'receviedCode',
        'parentInterview',
        'acceptInterview',
        'openAssessment',
        'assessmentResult',
        'parentsInterviewDate',
        'assessmentTestDate',
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
        'installmentDate',
        'lastDueDate',
        'installmentStatus',
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
    public function onlineRegister()
    {
        return $this->belongsTo('\Admission\Models\OnlineRegister','onlineId');
    }
}
