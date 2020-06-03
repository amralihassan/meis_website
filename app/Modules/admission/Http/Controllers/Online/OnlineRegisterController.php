<?php
    namespace Admission\Http\Controllers\Online;
    use App\Http\Controllers\Controller;
    use Admission\Models\OnlineRegister;
    use DB;
    use DataTables;
    use Validator;
    use DateTime;
    use Carbon;

class OnlineRegisterController extends Controller
{
    public $code ;
    public $yy ;
    public $mm ;
    public $dd ;
    public $dob;
    public function index()
    {
        if (request()->ajax()) {
            $data = OnlineRegister::orderBy('id','desc')->where('insertMode','parent')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('check', function($data){
                        $btnCheck = '<label class="pos-rel">
                                         <input type="checkbox" class="ace" name="id[]" value="'.$data->id.'" />
                                         <span class="lbl"></span>
                                     </label>';
                         return $btnCheck;
                    })
                    ->addColumn('applicationDate',function($data){
                        return \Carbon\Carbon::parse( $data->created_at)->format('M d Y, D h:m ');
                    })
                    ->addColumn('fatherFullName',function($data){
                        return $data->firstName .' ' .$data->middleName .' ' .$data->lastName .' ' .$data->familyName ;
                    })
                    ->addColumn('nextGrade',function($data){
                        return session('lang')=='ar'?$data->grades->arGrade:$data->grades->enGrade ;
                    })
                    ->addColumn('academicYear',function($data){
                        return $data->academicyears->academicYear ;
                    })
                    ->addColumn('action', function($data){
                        $btn = '<div class="hidden-sm hidden-xs action-buttons">
                                     <a class="btn btn-xs btn-info" href="'.url('admission/online_register/application/'.$data->id).'">
                                         <i class="ace-icon fa fa-eye bigger-130"></i>
                                     </a>
                                 </div>
                                 ';
                         return $btn;
                    })

                    ->rawColumns(['check','applicationDate','fatherFullName','nextGrade','academicYear','action'])
                    ->make(true);
        }
        return view('admission::online.onlineRegister.index',['title'=>trans('admission::admission.onlineRegister')]);
    }

    private function getRules()
    {
        return [
            // rules
            // father information
            'firstName'                         => 'required',
            'middleName'                        => 'required',
            'lastName'                          => 'required',
            'familyName'                        => 'required',
            'fatherIdNumber'                    => 'required',
            'fatherMobile'                      => 'required',
            'maritalStatus'                     => 'required',
            'fatherReligion'                    => 'required',
            'fatherNationality'                 => 'required',
            'fatherQualification'               => 'required',
            'fatherBlockNo'                     => 'required',
            'fatherStreetName'                  => 'required',
            'fatherArea'                        => 'required',
            'fatherGovernorate'                 => 'required',
            // mother information
            'motherName'                        => 'required',
            'motherIdNumber'                    => 'required',
            'motherMobile'                      => 'required',
            'motherNationality'                 => 'required',
            'motherReligion'                    => 'required',
            'motherBlockNo'                     => 'required',
            'motherStreetName'                  => 'required',
            'motherArea'                        => 'required',
            'motherGovernorate'                 => 'required',
            // applicant information
            'applicantName'                     => 'required',
            'applicantGender'                   => 'required',
            'nativeLanguage'                    => 'required',
            'secondLanguage'                    => 'required',
            'devisionId'                        => 'required',
            'nextGradeId'                       => 'required',
            'nextAcademicYearId'                => 'required',
            'dd'                                => 'required',
            'mm'                                => 'required',
            'yy'                                => 'required',
            'applicantNationality'              => 'required',
            'applicantReligion'                 => 'required',
            // other information
            'AcceptanceAcknowledgment'          => 'required',
            'recognition'                       => 'required',
            'educationRights'                   => 'required',
            'meetRepresentative'                => 'required'
        ];
    }

    private function getMessages()
    {
        return [
            // message
            'firstName.required'            => 'The first name is required يجب ادخال الاسم الاول',
            'middleName.required'           => 'Father name is required يجب ادخال اسم الاب',
            'lastName.required'             => 'Grand name is required يجب ادخال اسم الجد ',
            'familyName.required'           => 'Family name is required يجب ادخال اللقب',
            'fatherIdNumber.required'       => 'National id is required يجب ادخال الرقم القومي او جواز السفر للاب',
            'fatherMobile.required'         => 'Mobile number is required يجب ادخال رقم موبايل الاب',
            'maritalStatus.required'        => 'Social status is required يجب ادخال الحالة الاجتماعية',
            'fatherReligion.required'       => 'Religion is required يجب تحديد ديانة الاب',
            'fatherNationality.required'    => 'Nationality is required يجب تحديد جنسية الاب',
            'fatherQualification.required'  => 'Qualification is required يجب ادخال مؤهل الاب',
            'fatherBlockNo.required'        => 'Real estate number is required يجب ادخال رقم العقار',
            'fatherStreetName.required'     => 'Qualification is required يجب ادخال اسم الشارع',
            'fatherArea.required'           => 'Street name is required يجب ادخال المدينة / الحي',
            'fatherGovernorate.required'    => 'Governorate name is required يجب ادخال المحافظة',

            'motherName.required'           => 'Full name is required يجب ادخال اسم الام ثلاثي',
            'motherIdNumber.required'       => 'National id is required يجب ادخال الرقم القومي او جواز السفر للام',
            'motherMobile.required'         => 'Mobile number is required يجب ادخال رقم موبايل الام',
            'motherNationality.required'    => 'Nationality is required يجب تحديد جنسية الام',
            'motherReligion.required'       => 'Religion is required يجب تحديد ديانة الام',
            'motherBlockNo.required'        => 'Real estate number is required يجب ادخال رقم العقار',
            'motherStreetName.required'     => 'Qualification is required يجب ادخال اسم الشارع',
            'motherArea.required'           => 'Street name is required يجب ادخال المدينة / الحي',
            'motherGovernorate.required'    => 'Governorate name is required يجب ادخال المحافظة',

            'applicantName.required'        => 'ِApplicant\'s name is required يجب ادخال اسم المتقدم',
            'applicantGender.required'      => 'ِApplicant\'s gender is required يجب تحديد نوع المتقدم',
            'nativeLanguage.required'       => 'ِApplicant\'s native language is required يجب تحديد اللغة الاولي للمتقدم',
            'secondLanguage.required'       => 'ِApplicant\'s second language is required يجب تحديد اللغة الثانية للمتقدم',
            'devisionId.required'           => 'ِApplicant\'s division is required يجب اختيار القسم المراد الالتحاق به',
            'nextGradeId.required'          => 'ِApplicant\'s grade is required يجب اختيار المرحلة المراد الالتحاق بها',
            'nextAcademicYearId.required'   => 'ِApplicant\'s academic year is required يجب اختيار العام الدراسي المراد الالتحاق به',
            'dd.required'                   => 'The applicant\'s birthday must be entered يجب ادخال يوم ميلاد المتقدم',
            'mm.required'                   => 'The applicant\'s birth month must be entered يجب ادخال شهر الميلاد للمتقدم',
            'yy.required'                   => 'The applicant\'s birth month must be entered يجب ادخال سنة الميلاد للمتقدم',
            'applicantNationality.required' => 'ِApplicant\'s nationality is required يجب تحديد جنسية المتقدم',
            'applicantReligion.required'    => 'The applicant’s birth year must be entered يجب تحديد ديانة المتقدم',

            'AcceptanceAcknowledgment.required' => 'The approval of the data must be approved يجب الموافقة على اقرار صحة البيانات',
            'recognition.required'              => 'Please specify how did you know the school يرجى تحديد كيف عرفت المدرسة',
            'educationRights.required'          => 'The educational mandate must be specified يجب تحديد الولاية التعليمية',
            'meetRepresentative.required'       => 'يجب تحديد الوقت المناسب لمقابلة ممثل المدرسة It is important to specify the appropriate time to meet the school representative'
        ];
    }

    public function store()
    {
        $rules      = $this->getRules();
        $messages   = $this->getMessages();
        $this->validate(request(),$rules,$messages);
        $this->dob = Carbon\Carbon::create( request('yy'),request('mm'), request('dd') , 0, 0, 0);
        // check valid grade and age
        if ($this->checkAgeAndGrade() == 'older') {
            $error = 'The age of the  applied student is older than the admission age of the stage - سن الطالب المتقدم اكبر من سن قبول المرحلة';
            return back()->with('error',$error)->withInput();;
        }

        if ($this->checkAgeAndGrade() == 'smaller') {
            $error = 'The age of the applied student is younger than the admission age of the stage - سن الطالب المتقدم اصغر من سن قبول المرحلة';
            return back()->with('error',$error)->withInput();;
        }

        if ($this->yy == 0) {
            return back()->with('error','Invalid date of birth of the applicant')->withInput();
        }

        DB::transaction(function () {
            // create code
            $this->code = date('m').str_random(8);

            // save data
            $online = new OnlineRegister;

            $online->firstName              = trim(request('firstName'));
            $online->middleName             = trim(request('middleName'));
            $online->lastName               = trim(request('lastName'));
            $online->familyName             = trim(request('familyName'));
            $online->firstNameEn            = trim(ucfirst(request('firstNameEn')));
            $online->middleNameEn           = trim(ucfirst(request('middleNameEn')));
            $online->lastNameEn             = trim(ucfirst(request('lastNameEn')));
            $online->familyNameEn           = trim(ucfirst(request('familyNameEn')));
            $online->fatherIdNumber         = request('fatherIdNumber');
            $online->fatherMobile           = request('fatherMobile');
            $online->homePhone              = request('homePhone');
            $online->fatherFacebookAccount  = request('fatherFacebookAccount');
            $online->fatherJob              = request('fatherJob');
            $online->fatherQualification    = request('fatherQualification');
            $online->fatherEmail            = request('fatherEmail');
            $online->fatherNationality      = request('fatherNationality');
            $online->maritalStatus          = request('maritalStatus');
            $online->fatherReligion         = request('fatherReligion');
            $online->fatherBlockNo          = request('fatherBlockNo');
            $online->fatherStreetName       = request('fatherStreetName');
            $online->fatherArea             = request('fatherArea');
            $online->fatherGovernorate      = request('fatherGovernorate');
            $online->motherName             = request('motherName');
            $online->motherFacebookAccount  = request('motherFacebookAccount');
            $online->motherIdNumber         = request('motherIdNumber');
            $online->motherMobile           = request('motherMobile');
            $online->motherJob              = request('motherJob');
            $online->motherQualification    = request('motherQualification');
            $online->motherEmail            = request('motherEmail');
            $online->motherNationality      = request('motherNationality');
            $online->motherReligion         = request('motherReligion');
            $online->motherArea             = request('motherArea');
            $online->motherBlockNo          = request('motherBlockNo');
            $online->motherStreetName       = request('motherStreetName');
            $online->motherGovernorate      = request('motherGovernorate');
            $online->applicantName          = request('applicantName');
            $online->applicantNameEn        = trim(ucfirst(request('applicantNameEn')));
            $online->applicantGender        = request('applicantGender');
            $online->nativeLanguage         = request('nativeLanguage');
            $online->secondLanguage         = request('secondLanguage');
            $online->dob                    = $this->dob;
            $online->yy                     = $this->yy;
            $online->mm                     = $this->mm;
            $online->dd                     = $this->dd;
            $online->applicantNationality   = request('applicantNationality');
            $online->applicantReligion      = request('applicantReligion');
            $online->devisionId             = request('devisionId');
            $online->nextGradeId            = request('nextGradeId');
            $online->nextAcademicYearId     = request('nextAcademicYearId');
            $online->meetRepresentative     = request('meetRepresentative');
            $online->AcceptanceAcknowledgment = request('AcceptanceAcknowledgment');
            $online->recognition            = request('recognition');
            $online->educationRights        = request('educationRights');
            $online->registrationType       = 'new';
            $online->insertMode             = 'parent';
            $online->fromSchool             = request('fromSchool');
            $online->transferReason         = request('transferReason');
            $online->code                   = $this->code;
            $online->save();

        });

        return redirect('/admission/sent/'.$this->code);
    }
    // delete
    public function destroy()
    {
        if (request()->ajax()) {
            if (request()->has('id'))
            {
                OnlineRegister::destroy(request('id'));
            }
        }
        return response(['status'=>true]);
    }

    public function show($id)
    {
        $online = OnlineRegister::find($id);
        return view('admission::online.onlineRegister.show',['title'=>trans('admission::admission.applicantData'),'online'=>$online]);
    }

    public function update($id)
    {
        $online = OnlineRegister::find($id);
        $online->registrationType = request('registrationType');
        $online->save();
        return back();
    }

    public function printApplication($id)
    {
        $online = OnlineRegister::find($id);
        return view('admission::online.onlineRegister.print',['title'=>trans('admission::admission.applicationForm'),'online'=>$online]);
    }

    public function getApplicants()
    {
        $output = "";
        $applications = DB::table('onlineRegisters')->orderBy('applicantName','asc')->where('insertMode','parent')->get();
        $output .='<option value="">'.trans('admission::admission.applicantName').'</option>';
        foreach ($applications as $applicationId) {
            $applicantName =  $applicationId->applicantName .' '. $applicationId->firstName .' ' .$applicationId->middleName .' ' .$applicationId->lastName .' ' .$applicationId->familyName ;
            $output .= ' <option value="'.$applicationId->id.'">'.$applicantName.'</option>';
        };
        return json_encode($output);
    }

    private function calcutateAge(){
        // dob
        $dob = date("Y-m-d",strtotime($this->dob));
        $dobObject = new DateTime($dob);
        // 1-10 + year
        $startFrom = DB::table('academicyears')->where('id',request('nextAcademicYearId'))->first()->startFrom;
        $now = new \Carbon\Carbon($startFrom);
        $thisYear   = $now->year;
        $nowObject = Carbon\Carbon::create( $thisYear,10, 1 , 0, 0, 0);
        $diff = $dobObject->diff($nowObject);
        $this->yy = $diff->y;
        $this->mm = $diff->m;
        $this->dd = $diff->d;
    }

    private function checkAgeAndGrade()
    {
        $result = 'done';
        //  calculate age
        $this->calcutateAge();
        $gradeData = DB::table('grades')->where('id',request('nextGradeId'))->first();

        if (($this->yy != 0 && $this->yy > $gradeData->toAgeYears  && $this->mm > $gradeData->toAgeMonth) ||($this->yy != 0 && $this->yy == $gradeData->toAgeYears  && $this->mm > $gradeData->toAgeMonth) ) {

            $result = 'older';
        }
        if (($this->yy != 0 && $this->yy < $gradeData->fromAgeYears && $this->mm < $gradeData->fromAgemonth) || ($this->yy != 0 && $this->yy == $gradeData->fromAgeYears && $this->mm > $gradeData->fromAgemonth))   {

            $result = 'smaller';
        }
        return $result;
    }
}
