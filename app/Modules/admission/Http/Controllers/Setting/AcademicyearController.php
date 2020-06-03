<?php
    namespace Admission\Http\Controllers\Setting;
    use App\Http\Controllers\Controller;
    use Admission\Models\Academicyear;
    use DB;
    use DataTables;
    use Validator;

class AcademicyearController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Academicyear::orderBy('endFrom','asc')->get();            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                           $btn = '<div class="hidden-sm hidden-xs action-buttons">                            
                                        <a class="btn btn-xs btn-info" href="'.url('admission/setting/academicyears/edit/'.$data->id).'">
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
                    ->rawColumns(['action','check'])
                    ->make(true);
        }      
        return view('admission::settings.academicyears.index',['title'=>trans("admission::admission.academicYears")]);		
    }
    public function store()
    {
        if (request()->ajax()) {
            // transaction
            DB::transaction(function () {
                // validation
                $this->validate(request(),[
                    // rules
                    'academicYear'      => 'required',
                    'startFrom'         => 'required',
                    'endFrom'          	=> 'required',
                ],[
                    // message
                    'academicYear.required'   => trans('admission::validation.academicYearRequired'),
                    'startFrom.required'      => trans('admission::validation.startFromRequired'),
                    'endFrom.numeric'  	      => trans('admission::validation.endFromNumeric'),
                ]);        
                // save data
                $academicyears = new Academicyear;
                $academicyears->academicYear        = request('academicYear');
                $academicyears->startFrom           = request('startFrom');
                $academicyears->endFrom             = request('endFrom');
                $academicyears->user_id             = authInfo()->id;
                $academicyears->save();
            });  
        }
        return response(['status'=>true]);			
    }
    public function edit($id)
    {
        $academicyear = Academicyear::find($id);
        return view('admission::settings.academicyears.edit',['title'=>trans("admission::admission.editAcademicyears"),'academicyear'=>$academicyear]);
    }
    public function update($id)
    {
        DB::transaction(function () {
            $academicyears = Academicyear::find(Request()->segment(5));
            // validation
            $this->validate(request(),[
                // rules
                'academicYear'      => 'required',
                'startFrom'         => 'required',
                'endFrom'          	=> 'required',
            ],[
                // message
                'academicYear.required'   => trans('admission::validation.academicYearRequired'),
                'startFrom.required'      => trans('admission::validation.startFromRequired'),
                'endFrom.numeric'  	      => trans('admission::validation.endFromNumeric'),
            ]);          
            // save data
            $academicyears->academicYear        = request('academicYear');
            $academicyears->startFrom           = request('startFrom');
            $academicyears->endFrom             = request('endFrom');
            $academicyears->user_id             = authInfo()->id;
            $academicyears->save();
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
                        Academicyear::destroy($id);						
                    }
                }
            });             
        }
        return response(['status'=>true]);        
    }
    public function getAllAcademicyears()
    {
        $output = "";
        $academicyears = Academicyear::all();   	        
        $output .='<option value="">'.trans('admission::admission.selectAcademicyear').'</option>';        
        foreach ($academicyears as $academicyear) {
            $output .= ' <option value="'.$academicyear->id.'">'.$academicyear->academicYear.'</option>';
        };
        return json_encode($output);  	         
    }
    public function getAllAcademicyearsSelected()
    {
        $id = request()->get('gradeId');
        $output = "";
        $academicyears = Academicyear::all();
        $output .='<option value="">'.trans('admission::admission.selectAcademicyear').'</option>';  
        foreach ($academicyears as $academicyear) {
            $selected = $academicyear->id == $id?"selected":"";
            $output .= ' <option value="'.$academicyear->id.'">'.$academicyear->academicYear.'</option>';
        };	            
        return json_encode($output);            
    }    
}