<?php
namespace Admission\Http\Controllers\Setting;
use App\Http\Controllers\Controller;
use Admission\Models\AssessmentLink;
use DB;
use DataTables;
use Validator;

class AssessmentLinkController extends controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = AssessmentLink::orderBy('id','desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $btn = '<div class="hidden-sm hidden-xs action-buttons">
                                        <a class="btn btn-xs btn-info" href="'.url('admission/setting/assessment_links/edit/'.$data->id).'">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>
                                    </div>';
                    return $btn;
                })
                ->addColumn('check', function($data){
                    $btnCheck = '<label class="pos-rel">
                                        <input type="checkbox" class="ace" name="id[]" value="'.$data->id.'" />
                                        <span class="lbl"></span>
                                    </label>';
                    return $btnCheck;
                })
                ->addColumn('assessment_links',function($data){
                    return '<a target="_blank" href="'.$data->linkAddress.'">'.$data->testName.'</a>';
                })
                ->addColumn('grade',function($data){
                    return session('lang')=='ar'?$data->grade->arGrade:$data->grade->enGrade;
                })
                ->addColumn('status',function($data){
                    $status = '';
                    switch ($data->status){
                        case 'Active':
                            $status = trans('admission::admission.active');
                        break;
                        default:
                            $status = trans('admission::admission.inActive');
                    }
                    return $status;
                })
                ->addColumn('testType',function($data){
                    $status = '';
                    switch ($data->testType){
                        case 'assessment':
                            $status = trans('admission::admission.assessment');
                            break;
                        default:
                            $status = trans('admission::admission.reassessment');
                    }
                    return $status;
                })
                ->addColumn('divisionsId',function($data){
                    $divisions = DB::table('divisions')->get();
                    $divisionType = '';
                    $type = explode(',',$data->divisionsId);
                    foreach($divisions as $div)
                    {
                        for ($i=0; $i <count($type) ; $i++) {
                            $divisionType .= preg_match('/\b'.$div->id.'\b/', $type[$i]) != 0 ?session('lang')=='ar'?
                                '<span class="label label-lg label-blue">'.$div->arDevision.'</span>':'<span class="label label-lg">'.$div->enDevision.'</span>' .' ':' ';
                        }
                    }
                    return  $divisionType;
                })
                ->rawColumns(['action','check','assessment_links','grade','divisionsId','status','testType'])
                ->make(true);
        }

        return view('admission::settings.assessmentLink.index',['title'=>trans("admission::admission.assessmentLinksSetting")]);
    }

    public function filter()
    {
        if (request()->ajax()) {
            $data = AssessmentLink::orderBy('testName','asc')->where('gradeId',request('gradeId'))->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $btn = '<div class="hidden-sm hidden-xs action-buttons">
                                        <a class="btn btn-xs btn-info" href="'.url('admission/setting/assessment_links/edit/'.$data->id).'">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>
                                    </div>';
                    return $btn;
                })
                ->addColumn('check', function($data){
                    $btnCheck = '<label class="pos-rel">
                                        <input type="checkbox" class="ace" name="id[]" value="'.$data->id.'" />
                                        <span class="lbl"></span>
                                    </label>';
                    return $btnCheck;
                })
                ->addColumn('assessment_links',function($data){
                    return '<a target="_blank" href="'.$data->linkAddress.'">'.$data->testName.'</a>';
                })
                ->addColumn('grade',function($data){
                    return session('lang')=='ar'?$data->grade->arGrade:$data->grade->enGrade;
                })
                ->addColumn('status',function($data){
                    $status = '';
                    switch ($data->status){
                        case 'Active':
                            $status = trans('admission::admission.active');
                            break;
                        default:
                            $status = trans('admission::admission.inActive');
                    }
                    return $status;
                })
                ->addColumn('testType',function($data){
                    $status = '';
                    switch ($data->testType){
                        case 'assessment':
                            $status = trans('admission::admission.assessment');
                            break;
                        default:
                            $status = trans('admission::admission.reassessment');
                    }
                    return $status;
                })
                ->addColumn('divisionsId',function($data){
                    $divisions = DB::table('divisions')->get();
                    $divisionType = '';
                    $type = explode(',',$data->divisionsId);
                    foreach($divisions as $div)
                    {
                        for ($i=0; $i <count($type) ; $i++) {
                            $divisionType .= preg_match('/\b'.$div->id.'\b/', $type[$i]) != 0 ?session('lang')=='ar'?
                                '<span class="label label-lg label-blue">'.$div->arDevision.'</span>':'<span class="label label-lg">'.$div->enDevision.'</span>' .' ':' ';
                        }
                    }
                    return  $divisionType;
                })
                ->rawColumns(['action','check','assessment_links','grade','divisionsId','status','testType'])
                ->make(true);
        }

        return view('admission::settings.assessmentLink.index',['title'=>trans("admission::admission.assessmentLinksSetting")]);
    }

    private function getRules()
    {
        return [
            'testName'          => 'required',
            'linkAddress'       => 'required',
            'divisionsId'       => 'required',
            'gradeId'           => 'required',
            'testType'          => 'required',
        ];
    }

    private function getMessages()
    {
        return [
            'testName.required'         => trans('admission::validation.testNameRequired'),
            'linkAddress.required'      => trans('admission::validation.linkAddressRequired'),
            'divisionsId.required'      => trans('admission::validation.divisionsIdRequired'),
            'gradeId.required'          => trans('admission::validation.gradeIdRequired'),
            'testType.required'         => trans('admission::validation.testTypeRequired'),
        ];
    }

    public function store()
    {
        if (request()->ajax()) {
            // transaction
            DB::transaction(function () {
                $rules = $this->getRules();
                $messages = $this->getMessages();
                // validation
                $this->validate(request(),$rules,$messages);
                // save data

                $link = new AssessmentLink;
                $link->testName      = request('testName');
                $link->linkAddress   = request('linkAddress');
                $link->divisionsId   = implode(",",request('divisionsId'));
                $link->status        = request('status');
                $link->notes         = request('notes');
                $link->gradeId       = request('gradeId');
                $link->testType      = request('testType');
                $link->user_id       = authInfo()->id;
                $link->save();
            });
        }
        return response(['status'=>true]);
    }

    public function edit($id)
    {
        $link = AssessmentLink::find($id);
        $divisions = DB::table('divisions')->get();
        return view('admission::settings.assessmentLink.edit',['title'=>trans("admission::admission.editAssessmentLink"),'link'=>$link,'divisions'=>$divisions]);
    }

    public function update($id)
    {
        DB::transaction(function () {
            $link = AssessmentLink::find(Request()->segment(5));

            $rules = $this->getRules();
            $messages = $this->getMessages();
            // validation
            $this->validate(request(),$rules,$messages);
            // save data
            $link->testName      = request('testName');
            $link->linkAddress   = request('linkAddress');
            $link->divisionsId   = implode(",",request('divisionsId'));
            $link->status        = request('status');
            $link->notes         = request('notes');
            $link->gradeId       = request('gradeId');
            $link->testType      = request('testType');
            $link->user_id       = authInfo()->id;
            $link->save();
        });
        alert('',trans('msg.doneUpdate'));
        return back();
    }

    public function destroy()
    {
        if (request()->ajax()) {
            DB::transaction(function () {
                if (request()->has('id'))
                {
                    foreach (request('id') as $id) {
                        AssessmentLink::destroy($id);
                    }
                }
            });
        }
        return response(['status'=>true]);
    }
}
