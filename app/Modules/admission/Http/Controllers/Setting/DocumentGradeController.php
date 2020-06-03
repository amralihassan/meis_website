<?php
    namespace Admission\Http\Controllers\Setting;
    use App\Http\Controllers\Controller;
    use Admission\Models\DocumentGrade;
    use DB;
    use DataTables;
    use Validator;
class DocumentGradeController extends controller
{
    public function index()
    {
        return view("admission::settings.documentsGrade.index",['title'=>trans('admission::admission.documentsGrade')]);
    }
    public function store()
    {
        if (request()->ajax()) {
            // transaction
            DB::transaction(function () {
                // validation
                $this->validate(request(),[
                    // rules
                    'gradeId'       => 'required',
                    'documentId'    => 'required'
                ],[
                    // message
                    'gradeId.required'      => trans('admission::validation.gradeIdRequired'),
                    'documentId.required'   => trans('admission::validation.documentIdNameRequired')
                ]);
                // save data
                foreach (request('gradeId') as $grade)
                {
                    foreach (request('documentId') as $document) {

                        $docGra = new DocumentGrade;
                        $docGra->gradeId        = $grade;
                        $docGra->documentId     = $document;
                        $docGra->user_id           = authInfo()->id;
                        $docGra->save();
                    }
                }


            });
        }
        return response(['status'=>true]);
    }
    public function filter()
    {
        if (request()->ajax()) {
            $data =DB::table('document_grades')
            ->join('grades','document_grades.gradeId','=','grades.Id')
            ->join('admission_documents','document_grades.documentId','=','admission_documents.Id')
            ->where('document_grades.gradeId',request('gradeId'))
            ->select('document_grades.*','grades.arGrade','grades.enGrade','admission_documents.arabicDocumentName',
            'admission_documents.englishDocumentName','admission_documents.registrationType')
            ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('check', function($data){
                           $btnCheck = '<label class="pos-rel">
                                        <input type="checkbox" class="ace" name="id[]" value="'.$data->id.'" />
                                        <span class="lbl"></span>
                                    </label>';
                            return $btnCheck;
                    })
                    ->addColumn('gradeName',function($data){
                        return session('lang') == 'ar'? $data->arGrade : $data->enGrade;
                    })
                    ->addColumn('documentName',function($data){
                        return session('lang') == 'ar'? $data->arabicDocumentName : $data->englishDocumentName;
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
                    ->rawColumns(['gradeName','check','documentName','registrationType'])
                    ->make(true);
        }
    }
    public function destroy()
    {
        if (request()->ajax()) {
            DB::transaction(function () {
                if (request()->has('id'))
                {
                    foreach (request('id') as $id) {
                        DocumentGrade::destroy($id);
                    }
                }
            });
        }
        return response(['status'=>true]);
    }
}
