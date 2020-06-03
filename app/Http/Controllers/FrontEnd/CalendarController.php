<?php
namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use DB;
use Carbon;
use Calendar;
use Admission\Models\ApplicationCode;

class CalendarController extends Controller
{
    public $onlineId;
    // online register [admission]
        // go to page to set parent interview date and assessment test date
            public function setParentInterviewDate($applicationCode)
            {
                $onlineId = DB::table('applicationCodes')->where('applicationCode',request('applicationCode'))->first();

                $data = DB::table('onlineAdmissionProcess')->where('onlineId',$onlineId->onlineId)->first();

                // if the parent aleady set parents interview date, the system will automatic redirect to home page
                if (empty($data->parentsInterviewDate)) {
                    return view("front_end.pages.admission.calendar.admissionOnline.parentInterview",['applicationCode'=>$applicationCode]);
                }else{
                    return redirect(url('/admission/query/'.$applicationCode));
                }
            }

            public function setAssessmentTestDate($applicationCode)
            {
                $onlineId = DB::table('applicationCodes')->where('applicationCode',request('applicationCode'))->first();
                $data = DB::table('onlineAdmissionProcess')->where('onlineId',$onlineId->onlineId)->first();
                // if the parent aleady set assessment date, the system will automatic redirect to home page
                if (empty($data->assessmentTestDate)) {
                    return view("front_end.pages.admission.calendar.admissionOnline.assessmentTest",['applicationCode'=>$applicationCode]);
                }else{
                    return redirect(url('/admission/query/'.$applicationCode));
                }
            }

            public function set_reassessment_test_date($applicationCode)
            {
                $onlineId = DB::table('applicationCodes')->where('applicationCode',request('applicationCode'))->first();
                $data = DB::table('onlineAdmissionProcess')->where('onlineId',$onlineId->onlineId)->first();
                // if the parent aleady set reassessment date, the system will automatic redirect to home page
                if (empty($data->reAssessmentDate)) {
                    return view("front_end.pages.admission.calendar.admissionOnline.reassessmentTest",['applicationCode'=>$applicationCode]);
                }else{
                    return redirect(url('/admission/query/'.$applicationCode));
                }
            }

            public function set_installmentOne_date($applicationCode)
            {
                $onlineId = DB::table('applicationCodes')->where('applicationCode',request('applicationCode'))->first();
                $data = DB::table('onlineAdmissionProcess')->where('onlineId',$onlineId->onlineId)->first();
                // if the parent aleady set parents interview date, the system will automatic redirect to home page
                if (empty($data->installmentDate)) {
                    return view("front_end.pages.admission.calendar.admissionOnline.installmentOneDate",['applicationCode'=>$applicationCode]);
                }else{
                    return redirect(url('/admission/query/'.$applicationCode));
                }
            }
        // go to page to set parent interview date and assessment test date

        // insert parent interview date and assessment test date
            public function storeDateParentInterview()
            {
                DB::transaction(function () {
                    // validation
                    $this->validate(request(),[
                        // rules
                        'start_date'            => 'required',
                    ],[
                        // message
                        'start_date.required'   => trans('admission::validation.start_dateRequired'),
                    ]);
                    // check date
                    $today = \Carbon\Carbon::today()->format('Y-m-d');
                    if (request('start_date') < $today)
                    {
                        return back()->with('error','Invalid date, please select another date.');
                    }
                    // Check public holidays
                    if (request('module') != 'installmentOneDate') {
                        if ( $this->daysoff() == false) {
                            return back()->with('error','A day has been reserved for the official holiday .. Please specify another date.');
                        }
                        // work hours
                        if ($this->workHours() == 'early')
                        {
                            return back()->with('error','A date has been set before the school\'s working hours .. Make another date, taking into account school attendance and departure times.');
                        }elseif($this->workHours() == 'late')
                        {
                            return back()->with('error','A date has been set after the school\'s working hours .. Make another date, taking into account school attendance and departure times.');
                        }
                    }

                    // get application code data
                    $this->onlineId = DB::table('applicationCodes')->where('applicationCode',request('applicationCode'))->first();

                    // check available parent interview date
                        if (request('module') == 'parentInterview') {
                            $available = $this->checkAvailableDateForParentinterview();
                            if ($available == false) {
                                return back()->with('error','This date is reserved for another guardian .. Please specify another date');
                            }
                        }
                        if (request('module') == 'reassessmentTest') {
                            $available = $this->checkAvailableDateForReassessmentDate();
                            if ($available == false) {
                                return back()->with('error','This date is reserved for another guardian .. Please specify another date');
                            }
                        }
                        elseif(request('module') == 'installmentOneDate'){
                            // check allowed period
                            if (!$this->checkLastDueDate()) {
                                return back()->with('error','Payment date must be before the due date.');
                            }
                        }
                        else{
                            $available = $this->checkAvailableDateForAssessmentTest();
                            if ($available == false) {
                                return back()->with('error','This date is reserved for another applicant .. Please specify another date');
                            }
                        }
                    // end check available parent interview date

                    // save data
                    if ($this->onlineId != null) {
                        if (request('module') == 'parentInterview') {
                            // set parents interview date
                            DB::table('onlineAdmissionProcess')->where('onlineId',$this->onlineId->onlineId)->update(['parentsInterviewDate'=> request('start_date')]);
                        }
                        elseif (request('module') == 'installmentOneDate') {
                            // set parents interview date
                            DB::table('onlineAdmissionProcess')->where('onlineId',$this->onlineId->onlineId)->update(['installmentDate'=> request('start_date')]);

                        }
                        elseif (request('module') == 'reassessmentTest') {
                            // set parents interview date
                            DB::table('onlineAdmissionProcess')->where('onlineId',$this->onlineId->onlineId)->update(['reAssessmentDate'=> request('start_date')]);
                        }
                        else{
                            // set assessment test date
                            DB::table('onlineAdmissionProcess')->where('onlineId',$this->onlineId->onlineId)->update(['assessmentTestDate'=> request('start_date')]);
                        }

                        // insert parent interview date and assessment test date into calender
                        if (request('module') != 'installmentOneDate') {
                            $this->insertEventIntoCalender();
                        }

                    }
                });
                return back();
            }

            private function insertEventIntoCalender()
            {
                // get applicatn name
                $data = DB::table('onlineRegisters')->where('id',$this->onlineId->onlineId)->first();
                $end_date = new \Carbon\Carbon(request('start_date'));
                // save date to calender
                    $event = new Event;
                    $event->title = $data->applicantName . ' ' . $data->firstName . ' ' . $data->middleName;
                    $event->module = request('module').'/'.$this->onlineId->onlineId;
                    $event->start_date = request('start_date');
                    $event->end_date = $end_date->addMinutes(29);
                    $event->color = request('color');
                    $event->privacy = 'public';
                    $event->save();
                // save date to calender
            }

            private function checkAvailableDateForParentinterview()
            {
                // Requirements
                $startDate = new \Carbon\Carbon(request('start_date'));
                $endDate = new \Carbon\Carbon(request('start_date'));
                // duration parentInterview
                $durationParentinterview = DB::table('online_register_messages')->first()->durationParentInterview;
                // check avaiable date and time from calender
                    $startDates = DB::table('events')
                    ->where('module', 'like', '%parentInterview%')
                    ->whereBetween('start_date',[$startDate,$endDate->addMinutes($durationParentinterview-1)])
                    ->first();
                    $ednDates = DB::table('events')
                            ->where('module', 'like', '%parentInterview%')
                            ->whereBetween('end_date',[$startDate,$endDate->addMinutes($durationParentinterview)])
                            ->first();
                    if ($startDates == null && $ednDates == null) {
                        return true;
                    }
                // check avaiable date and time from calender
                return false;
            }

            private function checkAvailableDateForAssessmentTest()
            {
                // requirements
                $startDate = new \Carbon\Carbon(request('start_date'));
                $endDate = new \Carbon\Carbon(request('start_date'));
                $durationAssessmentTest = DB::table('online_register_messages')->first()->durationAssessmentTest;

                $startDates = DB::table('events')
                ->where('module', 'like', '%assessmentTest%')
                ->whereBetween('start_date',[$startDate,$endDate->addMinutes($durationAssessmentTest-1)])
                ->first();
                $ednDates = DB::table('events')
                        ->where('module', 'like', '%assessmentTest%')
                        ->whereBetween('end_date',[$startDate,$endDate->addMinutes($durationAssessmentTest)])
                        ->first();
                if ($startDates == null && $ednDates == null) {
                    return true;
                }
                return false;
            }

            private function checkAvailableDateForReassessmentDate()
            {
                // requirements
                $startDate = new \Carbon\Carbon(request('start_date'));
                $endDate = new \Carbon\Carbon(request('start_date'));
                $durationAssessmentTest = DB::table('online_register_messages')->first()->durationAssessmentTest;

                $startDates = DB::table('events')
                ->where('module', 'like', '%reassessmentTest%')
                ->whereBetween('start_date',[$startDate,$endDate->addMinutes($durationAssessmentTest-1)])
                ->first();
                $ednDates = DB::table('events')
                        ->where('module', 'like', '%reassessmentTest%')
                        ->whereBetween('end_date',[$startDate,$endDate->addMinutes($durationAssessmentTest)])
                        ->first();
                if ($startDates == null && $ednDates == null) {
                    return true;
                }
                return false;
            }

            private function checkLastDueDate()
            {
                $today = \Carbon\Carbon::today()->format('Y-m-d');
                $lastDueDate = DB::table('onlineAdmissionProcess')->where('onlineId',$this->onlineId->onlineId)->first()->lastDueDate;
                if (request('start_date') > $lastDueDate || request('start_date') < $today) {
                    return false;
                }else{
                    return true;
                }
            }

            private function daysoff()
            {
                $offDays = DB::table('online_register_messages')->first()->offDays;
                $offDays = explode(',',$offDays);
                // get day from parent interview date
                $startDate = new \Carbon\Carbon(request('start_date'));
                $day =  \Carbon\Carbon::parse($startDate)->format('l');
                if (in_array($day,$offDays)) {
                    return false;
                }
                return true;
            }

            private function workHours()
            {
                // Requirements
                $startDate = new \Carbon\Carbon(request('start_date'));
                $startTime = $startDate->format('H:i');
                $endDate = new \Carbon\Carbon(request('start_date'));
                $endTime = $endDate->format('H:i');

                if ($startTime < settingHelper()->openTime) {
                    return 'early';
                }
                if ($endTime >= settingHelper()->closeTime) {
                    return 'late';
                }
            }
        // insert parent interview date and assessment test date
    // online register [admission]
}
