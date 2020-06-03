<?php
namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use Admission\Models\ApplicationCode;
use Staff\Models\Recruitment\Vacancy;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /*
     *   Online registration data will be saved in a different controller [Admission\Http\Controllers\OnlineRegisterController:method store]
     */
    public function home()
    {
        return view('front_end.pages.home');
    }

    public function about()
    {
        return view('front_end.pages.about');
    }

    public function contact()
    {
        return view('front_end.pages.contact');
    }

    public function admissionSteps()
    {
        return view('front_end.pages.admission.admissionSteps.admissionSteps');
    }

    public function admission()
    {
        return view('front_end.pages.admission.admissionSteps.admission');
    }

    public function admissionStep1()
    {
        return view('front_end.pages.admission.admissionSteps.admissionStep1');
    }

    public function admissionStep2()
    {
        return view('front_end.pages.admission.admissionSteps.admissionStep2');
    }

    public function career()
    {
        $vacancies = Vacancy::orderBy('id','desc')->where('jobStatus','Active')->get();

        return view('front_end.pages.career',['title'=>trans('staff::employee.vacancies'),'vacancies'=>$vacancies]);
    }

    public function register()
    {
        $divisions = DB::table('divisions')->get();
        $grades = DB::table('grades')->get();
        $academicYears = DB::table('academicyears')->get();
        return view('front_end.pages.admission.register',compact('divisions','grades','academicYears'));
    }

    public function query($applicationCode)
    {
        $onlineId = DB::table('applicationCodes')->where('applicationCode',$applicationCode)->first();
        if (!empty($onlineId)) {
            $data = DB::table('onlineAdmissionProcess')->where('onlineId',$onlineId->onlineId)->first();
            return view('front_end.pages.admission.query',['applicationCode'=>$applicationCode,'data'=>$data]);
        }else{
            // return redirect(url('/home'));
            return back()->with('error',trans('admission::admission.invalidApplicationCode'));
        }
    }

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


    public function invalidQuery()
    {
        return back()->with('error',trans('admission::admission.invalidApplicationCode'));
    }

    public function sent($code)
    {
        return view('front_end.pages.admission.sent',['code'=>$code]);
    }
}
