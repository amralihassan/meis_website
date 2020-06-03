<?php
    namespace Admission\Http\Controllers\Setting;
    use App\Http\Controllers\Controller;
    use Admission\Models\AdmissionDocument;
    use DB;
    use DataTables;
    use Validator;

class AdmissionDocumentController extends controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = AdmissionDocument::orderBy('sort','asc')->get();            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                           $btn = '<div class="hidden-sm hidden-xs action-buttons">                            
                                        <a class="btn btn-xs btn-info" href="'.url('admission/setting/admissionDocument/edit/'.$data->id).'">
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
                    ->addColumn('registrationType',function($data){
                        $registrationType = '';
                        $type = explode(',',$data->registrationType);
                        for ($i=0; $i <count($type) ; $i++) { 
                            $registrationType .= preg_match('/\bnew\b/', $type[$i]) != 0 ?trans('admission::admission.statusNew') .' ':'';
                            $registrationType .= preg_match('/\btransfer\b/', $type[$i]) != 0 ?trans('admission::admission.statusTransfer') .' ':'';
                            $registrationType .= preg_match('/\breturning\b/', $type[$i]) != 0 ?trans('admission::admission.statusReturning') .' ':'';
                            $registrationType .= preg_match('/\barrival\b/', $type[$i]) != 0 ?trans('admission::admission.statusArrival') :'';
                        }
                        return  $registrationType;
                    })                                      
                    ->rawColumns(['action','check','registrationType'])
                    ->make(true);
        }   
        return view('admission::settings.admissionDocuments.index',['title'=>trans('admission::admission.admissionDocuments')]);
    }
    public function store()
    {
        if (request()->ajax()) {
            // transaction
            DB::transaction(function () {
                // validation
                $this->validate(request(),[
                    // rules
                    'arabicDocumentName'    => 'required',
                    'englishDocumentName'   => 'required',                    
                    'registrationType'   => 'required',                    
                    'sort'          	    => 'numeric',
                ],[
                    // message
                    'arabicDocumentName.required'    => trans('admission::validation.arabicDocumentNameRequired'),
                    'englishDocumentName.required'   => trans('admission::validation.englishDocumentNameRequired'),
                    'registrationType.required'   => trans('admission::validation.registrationTypeRequired'),
                    'sort.numeric'  		         => trans('admission::validation.sortNumeric'),
                ]);        
                // save data
                $doc = new AdmissionDocument;
                $doc->arabicDocumentName    = request('arabicDocumentName');
                $doc->englishDocumentName   = request('englishDocumentName');
                $doc->registrationType      = implode(",",request('registrationType'));
                $doc->notes                 = request('notes');
                $doc->sort                  = request('sort');
                $doc->user_id               = authInfo()->id;
                $doc->save();
            });  
        }
        return response(['status'=>true]);			
    }
    public function edit($id)
    {
        $doc = AdmissionDocument::find($id);
        return view('admission::settings.admissionDocuments.edit',['title'=>trans("admission::admission.editAdmissionDocument"),'doc'=>$doc]);
    }
    public function update($id)
    {
        DB::transaction(function () {
            $doc = AdmissionDocument::find(Request()->segment(5));
            // validation
            $this->validate(request(),[
                // rules
                'arabicDocumentName'    => 'required',
                'englishDocumentName'   => 'required',                    
                'sort'          	    => 'numeric',
            ],[
                // message
                'arabicDocumentName.required'    => trans('admission::validation.arabicDocumentNameRequired'),
                'englishDocumentName.required'   => trans('admission::validation.englishDocumentNameRequired'),
                'registrationType.required'      => trans('admission::validation.registrationTypeRequired'),
                'sort.numeric'  		         => trans('admission::validation.sortNumeric'),
            ]);       
            // save data
            $doc->arabicDocumentName    = request('arabicDocumentName');
            $doc->englishDocumentName   = request('englishDocumentName');
            $doc->registrationType      = implode(",",request('registrationType'));
            $doc->notes                 = request('notes');
            $doc->sort                  = request('sort');
            $doc->user_id               = authInfo()->id;
            $doc->save();
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
                        AdmissionDocument::destroy($id);						
                    }
                }
            });             
        }
        return response(['status'=>true]);        
    }
    public function getAllAdmissionDocument()
    {
        $output = "";
        $docs = AdmissionDocument::all();   	        
        $output .='<option value="">'.trans('admission::admission.selectDocument').'</option>';        
        foreach ($docs as $doc) {
            $documentName = session('lang')=='en'?$doc->englishDocumentName:$doc->arabicDocumentName;
            $output .= ' <option value="'.$doc->id.'">'.$documentName.'</option>';
        };
        return json_encode($output);  	         
    }     
    public function getAllAdmissionDocumentsSelected()
    {
        $id = request()->get('docId');
        $output = "";
        $docs = AdmissionDocument::all(); 
        $output .='<option value="">'.trans('admission::admission.selectDocument').'</option>';  
        foreach ($docs as $doc) {
            $selected = $doc->id == $id?"selected":"";
            $documentName = session('lang')=='en'?$doc->englishDocumentName:$doc->arabicDocumentName;
            $output .= ' <option '.$selected.' value="'.$doc->id.'">'.$documentName.'</option>';
        };	            
        return json_encode($output);            
    }     
}