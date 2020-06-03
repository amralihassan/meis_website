<?php
    namespace Admission\Http\Controllers\Setting;
    use App\Http\Controllers\Controller;
    use Admission\Models\Grade;
    use DB;
    use DataTables;
    use Validator;

class GradeController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Grade::orderBy('sort','asc')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                           $btn = '<div class="hidden-sm hidden-xs action-buttons">
                                        <a class="btn btn-xs btn-info" href="'.url('admission/setting/grades/edit/'.$data->id).'">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>
                                    </div>';
                            return $btn;
                    })
                    ->addcolumn('ageAdmission',function($data){
                        return  $data->fromAgeYears .' ' . trans('admission::admission.years') .' '
                         . $data->fromAgemonth .' ' . trans('admission::admission.months');
                    })
                    ->addcolumn('stopAdmission',function($data){
                        return  $data->toAgeYears .' ' . trans('admission::admission.years') .' '
                         . $data->toAgeMonth .' ' . trans('admission::admission.months');
                    })
                    ->addColumn('check', function($data){
                           $btnCheck = '<label class="pos-rel">
                                        <input type="checkbox" class="ace" name="id[]" value="'.$data->id.'" />
                                        <span class="lbl"></span>
                                    </label>';
                            return $btnCheck;
                    })
                    ->rawColumns(['action','check','ageAdmission','stopAdmission'])
                    ->make(true);
        }
        return view('admission::settings.grades.index',['title'=>trans("admission::admission.grades")]);
    }
    public function store()
    {
        if (request()->ajax()) {
            // transaction
            DB::transaction(function () {
                // validation
                $this->validate(request(),[
                    // rules
                    'arGrade'           => 'required',
                    'enGrade'           => 'required',
                    'arGradeParent'     => 'required',
                    'enGradeParent'     => 'required',
                    'fromAgeYears'      => 'required',
                    'fromAgeMonth'      => 'required',
                    'toAgeYears'        => 'required',
                    'toAgeMonth'        => 'required',
                    'sort'          	=> 'numeric',
                ],[
                    // message
                    'arGrade.required'          => trans('admission::validation.arGradeRequired'),
                    'enGrade.required'          => trans('admission::validation.enGradeRequired'),
                    'arGradeParent.required'    => trans('admission::validation.arGradeParentRequired'),
                    'enGradeParent.required'    => trans('admission::validation.enGradeParentRequired'),
                    'fromAgeYears.required'     => trans('admission::validation.fromAgeRequired'),
                    'fromAgeMonth.required'     => trans('admission::validation.fromAgeRequired'),
                    'toAgeYears.required'       => trans('admission::validation.toAgeRequired'),
                    'toAgeMonth.required'       => trans('admission::validation.toAgeRequired'),
                    'sort.numeric'  	        => trans('admission::validation.sortNumeric'),
                ]);
                // save data
                $grade = new Grade;
                $grade->arGrade         = request('arGrade');
                $grade->enGrade         = request('enGrade');
                $grade->arGradeParent   = request('arGradeParent');
                $grade->enGradeParent   = request('enGradeParent');
                $grade->fromAgeYears    = request('fromAgeYears');
                $grade->fromAgeMonth    = request('fromAgeMonth');
                $grade->toAgeYears      = request('toAgeYears');
                $grade->toAgeMonth      = request('toAgeMonth');
                $grade->sort            = request('sort');
                $grade->user_id         = authInfo()->id;
                $grade->save();
            });
        }
        return response(['status'=>true]);
    }
    public function edit($id)
    {
        $grade = Grade::find($id);
        return view('admission::settings.grades.edit',['title'=>trans("admission::admission.editGrade"),'grade'=>$grade]);
    }

    public function update($id)
    {
        DB::transaction(function () {
            $grade = Grade::find(Request()->segment(5));
            // validation
            $this->validate(request(),[
                // rules
                'arGrade'           => 'required',
                'enGrade'           => 'required',
                'arGradeParent'     => 'required',
                'enGradeParent'     => 'required',
                'fromAgeYears'      => 'required',
                'fromAgeMonth'      => 'required',
                'toAgeYears'        => 'required',
                'toAgeMonth'        => 'required',
                'sort'          	=> 'numeric',
            ],[
                // message
                'arGrade.required'          => trans('admission::validation.arGradeRequired'),
                'enGrade.required'          => trans('admission::validation.enGradeRequired'),
                'arGradeParent.required'    => trans('admission::validation.arGradeParentRequired'),
                'enGradeParent.required'    => trans('admission::validation.enGradeParentRequired'),
                'fromAgeYears.required'     => trans('admission::validation.fromAgeRequired'),
                'fromAgeMonth.required'     => trans('admission::validation.fromAgeRequired'),
                'toAgeYears.required'       => trans('admission::validation.toAgeRequired'),
                'toAgeMonth.required'       => trans('admission::validation.toAgeRequired'),
                'sort.numeric'  	        => trans('admission::validation.sortNumeric'),
            ]);
            // save data
            $grade->arGrade         = request('arGrade');
            $grade->enGrade         = request('enGrade');
            $grade->arGradeParent   = request('arGradeParent');
            $grade->enGradeParent   = request('enGradeParent');
            $grade->fromAgeYears    = request('fromAgeYears');
            $grade->fromAgeMonth    = request('fromAgeMonth');
            $grade->toAgeYears      = request('toAgeYears');
            $grade->toAgeMonth      = request('toAgeMonth');
            $grade->sort            = request('sort');
            $grade->user_id         = authInfo()->id;
            $grade->save();
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
                        Grade::destroy($id);
                    }
                }
            });
        }
        return response(['status'=>true]);
    }

    public function getAllgrades()
    {
        $output = "";
        $grades = Grade::all();
        $output .='<option value="">'.trans('admission::admission.selectGrade').'</option>';
        foreach ($grades as $grade) {
            $gradeName = session('lang')=='ar'?$grade->arGrade:$grade->enGrade;
            $output .= ' <option value="'.$grade->id.'">'.$gradeName.'</option>';
        };
        return json_encode($output);
    }
    public function getAllGradesSelected()
    {
        $id = request()->get('gradeId');
        $output = "";
        $grades = Grade::all();
        $output .='<option value="">'.trans('admission::admission.selectGrade').'</option>';
        foreach ($grades as $grade) {
            $selected = $grade->id == $id?"selected":"";
            $gradeName = session('lang')=='ar'?$grade->arGrade:$grade->enGrade;
            $output .= ' <option '.$selected.' value="'.$grade->id.'">'.$gradeName.'</option>';
        };
        return json_encode($output);
    }
    public function getAllgradesForSite()
    {
        $output = "";
        $grades = Grade::all();
        $output .='<option value="">'.trans('admission::admission.selectGrade').'</option>';
        foreach ($grades as $grade) {
            $output .= ' <option value="'.$grade->id.'">'.$grade->enGradeParent.' '.$grade->arGradeParent.'</option>';
        };
        return json_encode($output);
    }
}
