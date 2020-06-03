<?php
    namespace Admission\Http\Controllers\Setting;
    use App\Http\Controllers\Controller;
    use Admission\Models\Division;
    use DB;
    use DataTables;
    use Validator;

class DivisionController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Division::orderBy('sort','asc')->get();            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                           $btn = '<div class="hidden-sm hidden-xs action-buttons">                            
                                        <a class="btn btn-xs btn-info" href="'.url('admission/setting/divisions/edit/'.$data->id).'">
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
        return view('admission::settings.divisions.index',['title'=>trans("admission::admission.divisions")]);		
    }
    public function store()
    {
        if (request()->ajax()) {
            // transaction
            DB::transaction(function () {
                // validation
                $this->validate(request(),[
                    // rules
                    'arDevision'         => 'required',
                    'enDevision'         => 'required',
                    'sort'          	 => 'numeric',
                ],[
                    // message
                    'arDevision.required'   => trans('admission::validation.arDevisionRequired'),
                    'enDevision.required'   => trans('admission::validation.enDevisionRequired'),
                    'sort.numeric'  		=> trans('admission::validation.sortNumeric'),
                ]);        
                // save data
                $devision = new Division;
                $devision->arDevision    = request('arDevision');
                $devision->enDevision    = request('enDevision');
                $devision->sort          = request('sort');
                $devision->user_id       = authInfo()->id;
                $devision->save();
            });  
        }
        return response(['status'=>true]);			
    }
    public function edit($id)
    {
        $devision = Division::find($id);
        return view('admission::settings.divisions.edit',['title'=>trans("admission::admission.editDevision"),'devision'=>$devision]);
    }
    public function update($id)
    {
        DB::transaction(function () {
            $devision = Division::find(Request()->segment(5));
            // validation
            $this->validate(request(),[
                // rules
                'arDevision'         => 'required',
                'enDevision'         => 'required',
                'sort'          	 => 'numeric',
            ],[
                // message
                'arDevision.required'   => trans('admission::validation.arDevisionRequired'),
                'enDevision.required'   => trans('admission::validation.enDevisionRequired'),
                'sort.numeric'  		=> trans('admission::validation.sortNumeric'),
            ]);        
            // save data
            $devision->arDevision    = request('arDevision');
            $devision->enDevision    = request('enDevision');
            $devision->sort          = request('sort');
            $devision->user_id       = authInfo()->id;
            $devision->save();
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
                        Division::destroy($id);						
                    }
                }
            });             
        }
        return response(['status'=>true]);        
    }
    public function getAllDivisions()
    {
        $output = "";
        $divisions = Division::all();   	        
        $output .='<option value="">'.trans('admission::admission.selectDivision').'</option>';        
        foreach ($divisions as $division) {
            $divisionName = session('lang')=='en'?$division->enDevision:$division->arDevision;
            $output .= ' <option value="'.$division->id.'">'.$divisionName.'</option>';
        };
        return json_encode($output);  	         
    }  
    public function getAllDivisionsForSite()
    {
        $output = "";
        $divisions = Division::all();   	        
        $output .='<option value="">'.trans('admission::admission.selectDivision').'</option>';        
        foreach ($divisions as $division) {            
            $output .= ' <option value="'.$division->id.'">'.$division->enDevision.' '.$division->arDevision.'</option>';
        };
        return json_encode($output);  	         
    }      
    public function getAllDivisionsSelected()
    {
        $id = request()->get('divisionId');
        $output = "";
        $divisions = Division::all(); 
        $output .='<option value="">'.trans('admission::admission.selectDivision').'</option>';  
        foreach ($divisions as $division) {
            $selected = $division->id == $id?"selected":"";
            $divisionName = session('lang')=='en'?$division->enDevision:$division->arDevision;	            
            $output .= ' <option '.$selected.' value="'.$division->id.'">'.$divisionName.'</option>';
        };	            
        return json_encode($output);            
    } 
}