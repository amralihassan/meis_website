<?php
    namespace Admission\Http\Controllers\Online;
    use App\Http\Controllers\Controller;
    use Admission\Models\OnlineRegister;
    use Admission\Models\OnlineAdmissinProcess;
    use Admission\Models\ApplicationCode;
    use DB;
    use DataTables;
    use Validator;
    use Carbon;

class ApplicationCodeController extends Controller
{
    public $onlineId;
    public $fromDate;
    public $toDate;

    public function __construct()
    {
        $this->fromDate = request()->has('fromDate')?new \Carbon\Carbon(request('fromDate')):'';
        $this->toDate = request()->has('toDate')?new \Carbon\Carbon(request('toDate')):'';
    }

    public function index()
    {
        if (request()->ajax()) {
            $data = DB::table('onlineRegisters')
                    ->join('applicationCodes','onlineRegisters.id','=','applicationCodes.onlineId')
                    ->join('grades','onlineRegisters.nextGradeId','=','grades.id')
                    ->join('academicyears','onlineRegisters.nextAcademicYearId','=','academicyears.id')
                    ->select('onlineRegisters.*','applicationCodes.applicationCode','applicationCodes.id as codeId','applicationCodes.created_at as codeCreate_at','grades.arGrade','grades.enGrade','academicyears.academicYear')
                    ->orderBy('applicationCodes.id','desc')
                    ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('check', function($data){
                        $btnCheck = '<label class="pos-rel">
                                         <input type="checkbox" class="ace" name="id[]" value="'.$data->codeId.'" />
                                         <span class="lbl"></span>
                                     </label>';
                         return $btnCheck;
                    })
                    ->addColumn('applicationDate',function($data){
                        return \Carbon\Carbon::parse( $data->created_at)->format('M d Y');
                    })
                    ->addColumn('codeCreate_at',function($data){
                        return \Carbon\Carbon::parse( $data->codeCreate_at)->format('M d Y, D h:m ');
                    })
                    ->addColumn('applicantName',function($data){
                        return $data->applicantName .' '. $data->firstName .' ' .$data->middleName .' ' .$data->lastName .' ' .$data->familyName ;
                    })
                    ->addColumn('nextGrade',function($data){
                        return session('lang')=='ar'?$data->arGrade:$data->enGrade ;
                    })
                    ->addColumn('action', function($data){
                        $btn = '<div class="hidden-sm hidden-xs action-buttons">
                                     <a target="_blank" class="btn btn-xs btn-info" href="'.url('admission/print/application_code_form/'.$data->id).'">
                                         '.trans('admission::admission.printApplicationCodeForm').'
                                     </a>
                                 </div>
                                 ';
                         return $btn;
                    })
                    ->rawColumns(['check','applicationDate','applicantName','nextGrade','action','codeCreate_at'])
                    ->make(true);
        }
        return view('admission::online.applicationCode.index',['title'=>trans('admission::admission.onlineRegister')]);
    }

    // create application code for online register
    public function storeApplicationCode()
    {
        if (request()->ajax()) {
            // transaction
            DB::transaction(function () {
                // validation
                $this->validate(request(),[
                    // rules
                    'onlineId'              => 'required|unique:applicationCodes,onlineId',
                ],[
                    // message
                    'onlineId.required'         => trans('admission::validation.applicantIdRequired'),
                    'onlineId.unique'         => trans('admission::validation.applicantIdUnique'),
                ]);

                // save data
                // store application code
                $this->saveApplicationCode();
                // default messages for online register
                $defaultMsg = DB::table('online_register_messages')->first();
                // store admission process
                $this->saveAdmissionProcess($defaultMsg);
            });

        }
        return response(['status'=>true]);
    }

    // store application code
    private function saveApplicationCode()
    {
        $appCode = new ApplicationCode;
        $appCode->onlineId              = request('onlineId');
        $appCode->applicationCode       = date('y').date('m').request('onlineId').trim(strtolower(str_random(6)));
        $appCode->user_id               = authInfo()->id;
        $appCode->save();
    }

    private function saveAdmissionProcess($defaultMsg)
    {
        $process = new onlineAdmissinProcess;
        $process->onlineId                          = request('onlineId');
        $process->paid                              = 'False';
        $process->receviedCode                      = 'False';
        $process->parentInterview                   = 'No';
        $process->acceptInterview                   = 'Not Define';
        $process->openAssessment                    = 'No';
        $process->assessmentResult                  = 'Not Define';
        $process->defaultPaid                       = $defaultMsg->defaultPaid;
        $process->paidText                          = $defaultMsg->paidText;
        $process->defaultParentInterview            = $defaultMsg->defaultParentInterview;
        $process->parentInterviewBeforeSetDate      = $defaultMsg->parentInterviewBeforeSetDate;
        $process->parentInterviewSetDate            = $defaultMsg->parentInterviewSetDate;
        $process->parentAfterInterview              = $defaultMsg->parentAfterInterview;
        $process->parentInterviewRejected           = $defaultMsg->parentInterviewRejected;
        $process->parentInterviewAccepted           = $defaultMsg->parentInterviewAccepted;
        $process->defaultOpenAssessment             = $defaultMsg->defaultOpenAssessment;
        $process->assessmentBeforeSetDate           = $defaultMsg->assessmentBeforeSetDate;
        $process->assessmentSetDate                 = $defaultMsg->assessmentSetDate;
        $process->afterAssessment                   = $defaultMsg->afterAssessment;
        $process->assessmentRejected                = $defaultMsg->assessmentRejected;
        $process->assessmentAccepted                = $defaultMsg->assessmentAccepted;
        //
        $process->reAssessmentMode                  = 'False';
        $process->reAssessmentStatus                = 'False';
        $process->reAssessmentResult                = 'Not Define';
        $process->beforeSetReassessmentDate         = $defaultMsg->beforeSetReassessmentDate;
        $process->afterSetReassessmentDate          = $defaultMsg->afterSetReassessmentDate;
        $process->afterReassessmentDone             = $defaultMsg->afterReassessmentDone;
        $process->reAssessmentRejected              = $defaultMsg->reAssessmentRejected;
        $process->reAssessmentAccepeted             = $defaultMsg->reAssessmentAccepeted;


        $process->defaultInstallmentMsg             = $defaultMsg->defaultInstallmentMsg;
        $process->installmentAfterResultMsg         = $defaultMsg->installmentAfterResultMsg;
        $process->installmentAfterSetDateMsg        = $defaultMsg->installmentAfterSetDateMsg;
        $process->installmentAfterPaiedMsg          = $defaultMsg->installmentAfterPaiedMsg;
        $process->user_id                           = authInfo()->id;
        $process->save();
    }

    // remove application code
    public function applicationCodeDestroy()
    {
        if (request()->ajax()) {
            if (request()->has('id'))
            {
                DB::transaction(function () {
                    $onlineId = ApplicationCode::find(request('id'))->first()->onlineId;
                    // remove application process
                    DB::table('onlineAdmissionProcess')->where('onlineId',$onlineId)->delete();
                    // remove application code
                    $this->removeParentInterviewDateFromCalendar($onlineId);
                    $this->removeAssessmentTestDateFromCalendar($onlineId);
                    ApplicationCode::destroy(request('id'));
                });
            }
        }
        return response(['status'=>true]);
    }

    // get page for follow online register process
    public function followProcess()
    {
        return view('admission::online.follow.followProcess',['title'=>trans('admission::admission.followApplicationProcess')]);
    }

    // pages calender for parent interview and assessment test for online register
    // parent interview
        public function parentInterviewCalender()
        {
            if (request()->ajax()) {
                $data = DB::table('onlineAdmissionProcess')
                    ->join('onlineRegisters','onlineRegisters.id','=','onlineAdmissionProcess.onlineId')
                    ->join('grades','onlineRegisters.nextGradeId','=','grades.id')
                    ->join('academicyears','onlineRegisters.nextAcademicYearId','=','academicyears.id')
                    ->join('applicationCodes','onlineRegisters.id','=','applicationCodes.onlineId')
                    ->select('onlineAdmissionProcess.*','applicationCodes.applicationCode','applicationCodes.id as codeId',
                    'applicationCodes.created_at as codeCreate_at','grades.arGrade','grades.enGrade',
                    'onlineRegisters.applicantName','onlineRegisters.firstName','onlineRegisters.middleName','onlineRegisters.lastName','onlineRegisters.familyName',
                    'academicyears.academicYear')
                    ->where('insertMode','parent')
                    ->orderBy('parentsInterviewDate','desc')
                    ->get();
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('check', function($data){
                            $btnCheck = '<label class="pos-rel">
                                             <input type="checkbox" class="ace" name="id[]" value="'.$data->codeId.'" />
                                             <span class="lbl"></span>
                                         </label>';
                             return $btnCheck;
                        })
                        ->addColumn('applicantName',function($data){
                            return $data->applicantName .' '. $data->firstName .' ' .$data->middleName .' ' .$data->lastName .' ' .$data->familyName ;
                        })
                        ->addColumn('grade',function($data){
                            return session('lang')=='ar'?$data->arGrade:$data->enGrade ;
                        })
                        ->addColumn('parentInterview', function($data){
                            $color = '';
                            $lang = '';
                            switch ($data->parentInterview) {
                                case 'Yes':
                                    $color = 'label-green';
                                    $lang  = trans('admission::admission.yes');
                                    break;
                                default:
                                    $color = 'label-red';
                                    $lang  = trans('admission::admission.no');
                                    break;
                            }
                            $btn =  '<span class="label label-lg '. $color .'">'. $lang.'</span>';
                            return $btn;
                        })
                        ->addColumn('parentInterviewDate',function($data){
                            return  !empty($data->parentsInterviewDate)?\Carbon\Carbon::parse( $data->parentsInterviewDate)->isoFormat('MMMM Do YYYY, h:m a'):$data->parentsInterviewDate;
                        })
                        ->rawColumns(['check','applicantName','applicationCode','grade','academicYear','parentInterviewDate','parentInterview'])
                        ->make(true);
            }
            return view('admission::online.calendar.parentInterviewCalender',['title'=>trans('admission::admission.parentInterviewCalender')]);
        }

        public function parentInterviewCalenderFilter()
        {
            if (request()->ajax()) {
                $from = $this->fromDate->format('Y-m-d H:i:s');
                $to = $this->toDate->format('Y-m-d H:i:s');
                $data = DB::table('onlineAdmissionProcess')
                    ->join('onlineRegisters','onlineRegisters.id','=','onlineAdmissionProcess.onlineId')
                    ->join('grades','onlineRegisters.nextGradeId','=','grades.id')
                    ->join('academicyears','onlineRegisters.nextAcademicYearId','=','academicyears.id')
                    ->join('applicationCodes','onlineRegisters.id','=','applicationCodes.onlineId')
                    ->select('onlineAdmissionProcess.*','applicationCodes.applicationCode','applicationCodes.id as codeId',
                    'applicationCodes.created_at as codeCreate_at','grades.arGrade','grades.enGrade',
                    'onlineRegisters.applicantName','onlineRegisters.firstName','onlineRegisters.middleName','onlineRegisters.lastName',
                    'onlineRegisters.familyName','academicyears.academicYear')
                    ->orderBy('applicationCodes.id','desc')
                    ->where('insertMode','parent')
                    ->orderBy('parentsInterviewDate','desc')
                    ->whereBetween('parentsInterviewDate',[$from,$to])
                    ->get();

                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('check', function($data){
                            $btnCheck = '<label class="pos-rel">
                                             <input type="checkbox" class="ace" name="id[]" value="'.$data->codeId.'" />
                                             <span class="lbl"></span>
                                         </label>';
                             return $btnCheck;
                        })
                        ->addColumn('applicantName',function($data){
                            return $data->applicantName .' '. $data->firstName .' ' .$data->middleName .' ' .$data->lastName .' ' .$data->familyName ;
                        })
                        ->addColumn('grade',function($data){
                            return session('lang')=='ar'?$data->arGrade:$data->enGrade ;
                        })
                        ->addColumn('parentsInterviewDate',function($data){
                            return  !empty($data->parentsInterviewDate)?\Carbon\Carbon::parse( $data->parentsInterviewDate)->isoFormat('MMMM Do YYYY, h:m a'):$data->parentsInterviewDate;
                        })
                        ->addColumn('parentInterview', function($data){
                            $color = '';
                            $lang = '';
                            switch ($data->parentInterview) {
                                case 'Yes':
                                    $color = 'label-green';
                                    $lang  = trans('admission::admission.yes');
                                    break;
                                default:
                                    $color = 'label-red';
                                    $lang  = trans('admission::admission.no');
                                    break;
                            }
                            $btn =  '<span class="label label-lg '. $color .'">'. $lang.'</span>';
                            return $btn;
                        })
                        ->rawColumns(['check','applicantName','applicationCode','grade','academicYear','parentsInterviewDate','parentInterview'])
                        ->make(true);
            }
        }
    // assessment test
        public function assessmentTestCalender()
        {
            if (request()->ajax()) {
                $data = DB::table('onlineAdmissionProcess')
                    ->join('onlineRegisters','onlineRegisters.id','=','onlineAdmissionProcess.onlineId')
                    ->join('grades','onlineRegisters.nextGradeId','=','grades.id')
                    ->join('academicyears','onlineRegisters.nextAcademicYearId','=','academicyears.id')
                    ->join('applicationCodes','onlineRegisters.id','=','applicationCodes.onlineId')
                    ->select('onlineAdmissionProcess.*','applicationCodes.applicationCode','applicationCodes.id as codeId',
                    'applicationCodes.created_at as codeCreate_at','grades.arGrade','grades.enGrade',
                    'onlineRegisters.applicantName','onlineRegisters.firstName','onlineRegisters.middleName','onlineRegisters.lastName','onlineRegisters.familyName',
                    'academicyears.academicYear')
                    ->where('insertMode','parent')
                    ->orderBy('assessmentTestDate','desc')
                    ->get();
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('check', function($data){
                            $btnCheck = '<label class="pos-rel">
                                             <input type="checkbox" class="ace" name="id[]" value="'.$data->codeId.'" />
                                             <span class="lbl"></span>
                                         </label>';
                             return $btnCheck;
                        })
                        ->addColumn('applicantName',function($data){
                            return $data->applicantName .' '. $data->firstName .' ' .$data->middleName .' ' .$data->lastName .' ' .$data->familyName ;
                        })
                        ->addColumn('grade',function($data){
                            return session('lang')=='ar'?$data->arGrade:$data->enGrade ;
                        })
                        ->addColumn('openAssessment', function($data){
                            $color = '';
                            $lang = '';
                            switch ($data->openAssessment) {
                                case 'Yes':
                                    $color = 'label-green';
                                    $lang  = trans('admission::admission.yes');
                                    break;
                                default:
                                    $color = 'label-red';
                                    $lang  = trans('admission::admission.no');
                                    break;
                            }
                            $btn =  '<span class="label label-lg '. $color .'">'. $lang.'</span>';
                            return $btn;
                        })
                        ->addColumn('assessmentTestDate',function($data){
                            return  !empty($data->assessmentTestDate)?\Carbon\Carbon::parse( $data->assessmentTestDate)->isoFormat('MMMM Do YYYY, h:m a'):$data->assessmentTestDate;
                        })
                        ->rawColumns(['check','applicantName','applicationCode','grade','academicYear','assessmentTestDate','openAssessment'])
                        ->make(true);
            }
            return view('admission::online.calendar.assessmentTestCalender',['title'=>trans('admission::admission.assessmentTestCalender')]);
        }

        public function assessmentTestCalenderFilter()
        {
            if (request()->ajax()) {
                $from = $this->fromDate->format('Y-m-d H:i:s');
                $to = $this->toDate->format('Y-m-d H:i:s');
                $data = DB::table('onlineAdmissionProcess')
                    ->join('onlineRegisters','onlineRegisters.id','=','onlineAdmissionProcess.onlineId')
                    ->join('grades','onlineRegisters.nextGradeId','=','grades.id')
                    ->join('academicyears','onlineRegisters.nextAcademicYearId','=','academicyears.id')
                    ->join('applicationCodes','onlineRegisters.id','=','applicationCodes.onlineId')
                    ->select('onlineAdmissionProcess.*','applicationCodes.applicationCode','applicationCodes.id as codeId',
                    'applicationCodes.created_at as codeCreate_at','grades.arGrade','grades.enGrade',
                    'onlineRegisters.applicantName','onlineRegisters.firstName','onlineRegisters.middleName','onlineRegisters.lastName',
                    'onlineRegisters.familyName','academicyears.academicYear')
                    ->orderBy('assessmentTestDate','desc')
                    ->where('insertMode','parent')
                    ->whereBetween('assessmentTestDate',[$from,$to])
                    ->get();

                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('check', function($data){
                            $btnCheck = '<label class="pos-rel">
                                             <input type="checkbox" class="ace" name="id[]" value="'.$data->codeId.'" />
                                             <span class="lbl"></span>
                                         </label>';
                             return $btnCheck;
                        })
                        ->addColumn('applicantName',function($data){
                            return $data->applicantName .' '. $data->firstName .' ' .$data->middleName .' ' .$data->lastName .' ' .$data->familyName ;
                        })
                        ->addColumn('grade',function($data){
                            return session('lang')=='ar'?$data->arGrade:$data->enGrade ;
                        })
                        ->addColumn('assessmentTestDate',function($data){
                            return  !empty($data->assessmentTestDate)?\Carbon\Carbon::parse( $data->assessmentTestDate)->isoFormat('MMMM Do YYYY, h:m a'):$data->assessmentTestDate;
                        })
                        ->addColumn('openAssessment', function($data){
                            $color = '';
                            $lang = '';
                            switch ($data->openAssessment) {
                                case 'Yes':
                                    $color = 'label-green';
                                    $lang  = trans('admission::admission.yes');
                                    break;
                                default:
                                    $color = 'label-red';
                                    $lang  = trans('admission::admission.no');
                                    break;
                            }
                            $btn =  '<span class="label label-lg '. $color .'">'. $lang.'</span>';
                            return $btn;
                        })
                        ->rawColumns(['check','applicantName','applicationCode','grade','academicYear','assessmentTestDate','openAssessment'])
                        ->make(true);
            }
        }
//        reassessment test
        public function reassessmentTestCalender()
        {
            if (request()->ajax()) {
                $data = DB::table('onlineAdmissionProcess')
                    ->join('onlineRegisters','onlineRegisters.id','=','onlineAdmissionProcess.onlineId')
                    ->join('grades','onlineRegisters.nextGradeId','=','grades.id')
                    ->join('academicyears','onlineRegisters.nextAcademicYearId','=','academicyears.id')
                    ->join('applicationCodes','onlineRegisters.id','=','applicationCodes.onlineId')
                    ->select('onlineAdmissionProcess.*','applicationCodes.applicationCode','applicationCodes.id as codeId',
                        'applicationCodes.created_at as codeCreate_at','grades.arGrade','grades.enGrade',
                        'onlineRegisters.applicantName','onlineRegisters.firstName','onlineRegisters.middleName','onlineRegisters.lastName','onlineRegisters.familyName',
                        'academicyears.academicYear')
                    ->where('insertMode','parent')
                    ->orderBy('reAssessmentDate','desc')
                    ->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('check', function($data){
                        $btnCheck = '<label class="pos-rel">
                                             <input type="checkbox" class="ace" name="id[]" value="'.$data->codeId.'" />
                                             <span class="lbl"></span>
                                         </label>';
                        return $btnCheck;
                    })
                    ->addColumn('applicantName',function($data){
                        return $data->applicantName .' '. $data->firstName .' ' .$data->middleName .' ' .$data->lastName .' ' .$data->familyName ;
                    })
                    ->addColumn('grade',function($data){
                        return session('lang')=='ar'?$data->arGrade:$data->enGrade ;
                    })
                    ->addColumn('reAssessmentMode', function($data){
                        $color = '';
                        $lang = '';
                        switch ($data->reAssessmentMode) {
                            case 'True':
                                $color = 'label-green';
                                $lang  = trans('admission::admission.yes');
                                break;
                            default:
                                $color = 'label-red';
                                $lang  = trans('admission::admission.no');
                                break;
                        }
                        $btn =  '<span class="label label-lg '. $color .'">'. $lang.'</span>';
                        return $btn;
                    })
                    ->addColumn('reAssessmentDate',function($data){
                        return  !empty($data->reAssessmentDate)?\Carbon\Carbon::parse( $data->reAssessmentDate)->isoFormat('MMMM Do YYYY, h:m a'):$data->reAssessmentDate;
                    })
                    ->rawColumns(['check','applicantName','applicationCode','grade','academicYear','reAssessmentDate','reAssessmentMode'])
                    ->make(true);
            }
            return view('admission::online.calendar.reassessmentTestCalender',['title'=>trans('admission::admission.reAssessmentTestCalender')]);
        }

        public function reassessmentTestCalenderFilter()
        {
            if (request()->ajax()) {
                $from = $this->fromDate->format('Y-m-d H:i:s');
                $to = $this->toDate->format('Y-m-d H:i:s');
                $data = DB::table('onlineAdmissionProcess')
                    ->join('onlineRegisters','onlineRegisters.id','=','onlineAdmissionProcess.onlineId')
                    ->join('grades','onlineRegisters.nextGradeId','=','grades.id')
                    ->join('academicyears','onlineRegisters.nextAcademicYearId','=','academicyears.id')
                    ->join('applicationCodes','onlineRegisters.id','=','applicationCodes.onlineId')
                    ->select('onlineAdmissionProcess.*','applicationCodes.applicationCode','applicationCodes.id as codeId',
                        'applicationCodes.created_at as codeCreate_at','grades.arGrade','grades.enGrade',
                        'onlineRegisters.applicantName','onlineRegisters.firstName','onlineRegisters.middleName','onlineRegisters.lastName',
                        'onlineRegisters.familyName','academicyears.academicYear')
                    ->orderBy('assessmentTestDate','desc')
                    ->where('insertMode','parent')
                    ->whereBetween('assessmentTestDate',[$from,$to])
                    ->get();

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('check', function($data){
                        $btnCheck = '<label class="pos-rel">
                                             <input type="checkbox" class="ace" name="id[]" value="'.$data->codeId.'" />
                                             <span class="lbl"></span>
                                         </label>';
                        return $btnCheck;
                    })
                    ->addColumn('applicantName',function($data){
                        return $data->applicantName .' '. $data->firstName .' ' .$data->middleName .' ' .$data->lastName .' ' .$data->familyName ;
                    })
                    ->addColumn('grade',function($data){
                        return session('lang')=='ar'?$data->arGrade:$data->enGrade ;
                    })
                    ->addColumn('reAssessmentDate',function($data){
                        return  !empty($data->reAssessmentDate)?\Carbon\Carbon::parse( $data->reAssessmentDate)->isoFormat('MMMM Do YYYY, h:m a'):$data->reAssessmentDate;
                    })

                    ->addColumn('reAssessmentMode', function($data){
                        $color = '';
                        $lang = '';
                        switch ($data->reAssessmentMode) {
                            case 'True':
                                $color = 'label-green';
                                $lang  = trans('admission::admission.yes');
                                break;
                            default:
                                $color = 'label-red';
                                $lang  = trans('admission::admission.no');
                                break;
                        }
                        $btn =  '<span class="label label-lg '. $color .'">'. $lang.'</span>';
                        return $btn;
                    })
                    ->rawColumns(['check','applicantName','applicationCode','grade','academicYear','reAssessmentDate','reAssessmentMode'])
                    ->make(true);
            }
        }

    // pages calender for parent interview and assessment test for online register

    public function followProcessFilter()
    {
        if (request()->ajax()) {
            $onlineId = ApplicationCode::where('applicationCode',request('applicationCode'))->first();
            if (!empty($onlineId->onlineId)) {
                $data['data'] = $this->onlineAdmissionData($onlineId->onlineId);
                $processData = $this->onlineAdmissionData($onlineId->onlineId);
                // all process data for applicant

                // applicant full name
                $data['applicantName'] = (session('lang')=='ar')?
                    $processData->applicantName .' ' .$processData->firstName.' ' .$processData->middleName.' ' .$processData->lastName.' ' .
                    $processData->familyName:$processData->applicantNameEn .' ' .$processData->firstNameEn.' ' . $processData->middleNameEn.' ' .
                    $processData->lastNameEn.' ' .$processData->familyNameEn;

                // assessment and reassessment links
                $date = \Carbon\Carbon::now();
                $today = $date->format('Y-m-d H:i:s');
                // test duration
                $period = DB::table('online_register_messages')->first()->durationAssessmentTest;

                $time = new \Carbon\Carbon($processData->assessmentTestDate);
                $endTime = $time->addMinute($period)->format('Y-m-d H:i:s');

                // assessment
                if($processData->assessmentTestDate != null && $processData->openAssessment == 'No')
                {
                    if($today >= $processData->assessmentTestDate && $today <= $endTime)
                    {
                        $data['assessmentLink'] =  $this->getAssessmentLink((int)$processData->devisionId,$processData->nextGradeId) ;
                    }else{
                        $data['assessmentLink'] =  '';
                    }
                }

                // reassessment
                if($processData->reAssessmentDate != null && $processData->reAssessmentStatus == 'False')
                {
                    if($today >= $processData->reAssessmentDate && $today <= $endTime)
                    {
                        $data['reassessmentLink'] =  $this->getReAssessmentLink((int)$processData->devisionId,$processData->nextGradeId) ;
                    }else{
                        $data['reassessmentLink'] =  '';
                    }
                }
                return response()->json($data);
            }
        }
    }

    private function onlineAdmissionData($onlineId)
    {
        return DB::table('onlineAdmissionProcess')
            ->join('onlineRegisters','onlineAdmissionProcess.onlineId','=','onlineRegisters.id')
            ->select('onlineAdmissionProcess.*','onlineRegisters.firstName','onlineRegisters.middleName','onlineRegisters.lastName'
                ,'onlineRegisters.familyName','onlineRegisters.firstNameEn','onlineRegisters.middleNameEn','onlineRegisters.lastNameEn'
                ,'onlineRegisters.familyNameEn','onlineRegisters.applicantName','onlineRegisters.applicantNameEn','onlineRegisters.devisionId',
                'onlineRegisters.nextGradeId')
            ->where('insertMode','parent')
            ->where('onlineAdmissionProcess.onlineId',$onlineId)->first();
    }

    private function getAssessmentLink($divisionId,$gradeId)
    {
        $assessmentLinkQuery = DB::table('assessment_links')->where('testType','assessment')->where('status','Active')
            ->where('divisionsId',$divisionId)
            ->where('gradeId',$gradeId)->get();

        $assessmentLink = '';
        if(count($assessmentLinkQuery) != 0)
        {
            $assessmentLink .= '<h6>'.trans('admission::admission.assessmentTestLink').' : ';
            foreach ($assessmentLinkQuery as $link)
            {
                $assessmentLink .= '[ <a target="_blank" href="'.$link->linkAddress.'">'.$link->testName.'</a> ] ';
            }
            $assessmentLink .= '</h6>';
        }else{
            return  '<h6 style="color:red">'. trans('admission::admission.noAssessmentDetected').'</h6>';
        }
        return $assessmentLink;
    }

    private function getReAssessmentLink($divisionId,$gradeId)
        {
            $reassessmentLinkQuery = DB::table('assessment_links')->where('testType','reassessment')->where('status','Active')
                ->where('divisionsId',$divisionId)
                ->where('gradeId',$gradeId)->get();

            $reassessmentLink = '';
            if(count($reassessmentLinkQuery) != 0)
            {
                $reassessmentLink .= '<h6>'.trans('admission::admission.reassessmentTestLink').' : ';
                foreach ($reassessmentLinkQuery as $link)
                {
                    $reassessmentLink .= '[ <a target="_blank" href="'.$link->linkAddress.'">'.$link->testName.'</a> ] ';
                }
                $reassessmentLink .= '</h6>';
            }else{
                return  '<h6 style="color:red">'. trans('admission::admission.noReassessmentDetected').'</h6>';
            }
            return $reassessmentLink;
        }

    public function getRequiredAdmissionDocument()
    {
        $onlineId = request('onlineId');
        $applicantData = OnlineRegister::find($onlineId);
        $data = DB::table('admission_documents')
        ->join('document_grades','admission_documents.id','=','document_grades.documentId')
        ->select('admission_documents.*','document_grades.gradeid')
        ->where('document_grades.gradeid',$applicantData->nextGradeId)
        ->where('admission_documents.registrationType','like','%'.$applicantData->registrationType.'%')
        ->get();

        $output = "";
        foreach ($data as $row) {
            $admissionDocumentName = session('lang')=='en'?$row->englishDocumentName :$row->arabicDocumentName;
            $output .= ' <li>'.$admissionDocumentName.'. ' . $row->notes.'</li>';
        };
        return json_encode($output);
    }

    // get page admission process for parent on website
    public function getUpdatePage()
    {
        if (request()->ajax()) {
            $data = DB::table('onlineAdmissionProcess')
                ->join('onlineRegisters','onlineRegisters.id','=','onlineAdmissionProcess.onlineId')
                ->join('grades','onlineRegisters.nextGradeId','=','grades.id')
                ->join('academicyears','onlineRegisters.nextAcademicYearId','=','academicyears.id')
                ->join('applicationCodes','onlineRegisters.id','=','applicationCodes.onlineId')
                ->select('onlineAdmissionProcess.*','applicationCodes.applicationCode','applicationCodes.id as codeId',
                    'applicationCodes.created_at as codeCreate_at','grades.arGrade','grades.enGrade',
                    'onlineRegisters.applicantName','onlineRegisters.firstName','onlineRegisters.middleName','onlineRegisters.lastName','onlineRegisters.familyName',
                    'academicyears.academicYear')
                ->where('insertMode','parent')
                ->orderBy('applicationCodes.id','desc')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('check', function($data){
                    $btnCheck = '<label class="pos-rel">
                                    <input type="checkbox" class="ace" name="id[]" value="'.$data->codeId.'" />
                                    <span class="lbl"></span>
                                </label>';
                    return $btnCheck;
                })
                ->addColumn('applicantName',function($data){
                    return $data->applicantName .' '. $data->firstName .' ' .$data->middleName .' ' .$data->lastName .' ' .$data->familyName ;
                })
                ->addColumn('nextGrade',function($data){
                    return session('lang')=='ar'?$data->arGrade:$data->enGrade ;
                })
                ->addColumn('action', function($data){
                    $btn = '<a class="btn btn-xs btn-info" href="'.url('admission/online_register/process_page/update/p/'.$data->id).'">
                                '.trans('admission::admission.updateProcess').'
                            </a>';
                    return $btn;
                })
                ->rawColumns(['check','applicantName','nextGrade','action'])
                ->make(true);
        }
       return view('admission::online.follow.updatePage',['title'=>trans('admission::admission.updateApplicationProcess')]);
    }

    public function updateProcessPage($id)
    {
        $processStatus = DB::table('onlineAdmissionProcess')
        ->join('onlineRegisters','onlineRegisters.id','=','onlineAdmissionProcess.onlineId')
        ->join('applicationCodes','onlineRegisters.id','=','applicationCodes.onlineId')
        ->select('onlineAdmissionProcess.*','applicationCodes.applicationCode',
            'onlineRegisters.applicantName','onlineRegisters.firstName','onlineRegisters.middleName','onlineRegisters.lastName','onlineRegisters.familyName')
        ->orderBy('onlineAdmissionProcess.id','desc')
        ->first();
       return view('admission::online.follow.updateApplicationProcess',['title'=>trans('admission::admission.updateApplicationProcess'),'processStatus'=>$processStatus]);
    }

    // admission employee update applicant admission process
    public function updateProcess($id)
    {
        DB::transaction(function () {
            $process = onlineAdmissinProcess::find(Request()->segment(5));
            $this->onlineId = $process->onlineId;

            // save data
            $process->paid                              = request('paid');
            $process->receviedCode                      = request('receviedCode');
            $process->parentInterview                   = request('parentInterview');
            $process->acceptInterview                   = request('acceptInterview');
            // if parent interview rejected => will delete assessment test date
            if (request('acceptInterview') != 'Accept') {
                // remove assessment test date
                $this->removeAssessmentTestDateFromCalendar($this->onlineId); // remove from calendar
                $process->assessmentTestDate            = null;

                // remove installment one date
                $this->removeInstallmentOneDateFromCalendar($this->onlineId); // remove from calendar
                $process->installmentDate               = null;
                // remove last due date
                $process->lastDueDate                   = null;
            }
            $process->openAssessment                    = request('openAssessment');
            $process->assessmentResult                  = request('assessmentResult');
            // set last due date
            if (request('assessmentResult') == 'Accept' || request('reAssessmentResult') == 'Accept') {
                $allowedDays                            = DB::table('online_register_messages')->first()->allowedDays;
                $process->lastDueDate                   = \Carbon\Carbon::now()->addDays($allowedDays);
            }else{
                $process->lastDueDate                   = null;
                $process->installmentDate               = null;
            }
            $process->defaultPaid                       = request('defaultPaid');
            $process->paidText                          = request('paidText');
            $process->defaultParentInterview            = request('defaultParentInterview');
            $process->parentInterviewSetDate            = request('parentInterviewSetDate');
            $process->parentInterviewBeforeSetDate      = request('parentInterviewBeforeSetDate');
            $process->parentAfterInterview              = request('parentAfterInterview');
            $process->parentInterviewRejected           = request('parentInterviewRejected');
            $process->parentInterviewAccepted           = request('parentInterviewAccepted');
            $process->defaultOpenAssessment             = request('defaultOpenAssessment');
            $process->assessmentBeforeSetDate           = request('assessmentBeforeSetDate');
            $process->assessmentSetDate                 = request('assessmentSetDate');
            $process->afterAssessment                   = request('afterAssessment');
            $process->assessmentRejected                = request('assessmentRejected');
            $process->assessmentAccepted                = request('assessmentAccepted');
            $process->defaultInstallmentMsg             = request('defaultInstallmentMsg');
            $process->installmentAfterResultMsg         = request('installmentAfterResultMsg');
            $process->installmentAfterSetDateMsg        = request('installmentAfterSetDateMsg');
            $process->installmentAfterPaiedMsg          = request('installmentAfterPaiedMsg');
            $process->reAssessmentMode                  = request('reAssessmentMode');
            $process->reAssessmentStatus                = request('reAssessmentStatus');
            $process->reAssessmentResult                = request('reAssessmentResult');
            $process->beforeSetReassessmentDate         = request('beforeSetReassessmentDate');
            $process->afterSetReassessmentDate          = request('afterSetReassessmentDate');
            $process->afterReassessmentDone             = request('afterReassessmentDone');
            $process->reAssessmentRejected              = request('reAssessmentRejected');
            $process->reAssessmentAccepeted             = request('reAssessmentAccepeted');
            $process->user_id                           = authInfo()->id;
            if (request('parentsInterviewDate') != 'True') {
                $process->parentsInterviewDate  = null;
                $this->removeParentInterviewDateFromCalendar($this->onlineId);
            }
            if (request('assessmentTestDate') != 'True') {
                $this->removeAssessmentTestDateFromCalendar($this->onlineId);
                $process->assessmentTestDate  = null;
            }
            if (request('reAssessmentDate') != 'True') {
                $this->removeReAssessmentTestDateFromCalendar($this->onlineId);
                $process->reAssessmentDate  = null;
            }
            $process->save();
        });
        alert('',trans('msg.doneUpdate'));
        return back();
    }

    public function printApplicationCodeForm($id)
    {
        $data = DB::table('onlineRegisters')
        ->join('applicationCodes','onlineRegisters.id','=','applicationCodes.onlineId')
        ->join('grades','onlineRegisters.nextGradeId','=','grades.id')
        ->join('academicyears','onlineRegisters.nextAcademicYearId','=','academicyears.id')
        ->select('onlineRegisters.*','applicationCodes.applicationCode','applicationCodes.id as codeId',
        'applicationCodes.created_at as codeCreate_at','grades.arGrade','grades.enGrade','academicyears.academicYear')
        ->orderBy('applicationCodes.id','desc')
        ->where('insertMode','parent')
        ->where('onlineRegisters.id',$id)
        ->first();
        return view('admission::online.applicationCode.printApplicationCode',['title'=>'title','data'=>$data]);
    }

    // update calender after remove parent interview date or assessment test date
        private function removeParentInterviewDateFromCalendar($onlineId)
        {
            DB::table('events')->where('module','parentInterview'.'/'.$onlineId)->delete();
        }

        private function removeAssessmentTestDateFromCalendar($onlineId)
        {
            DB::table('events')->where('module','assessmentTest'.'/'.$onlineId)->delete();
        }

        private function removeReAssessmentTestDateFromCalendar($onlineId)
        {
            DB::table('events')->where('module','reassessmentTest'.'/'.$onlineId)->delete();
        }

        private function removeInstallmentOneDateFromCalendar($onlineId)
        {
            DB::table('events')->where('module','installmentOne'.'/'.$onlineId)->delete();
        }
    // update calender after remove parent interview date or assessment test date

}
