<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use App\Admin;
// use DataTables;
use Illuminate\Http\Request;
use Validator;
use App\History;
use DB;
use File;

class AdminController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Admin::orderBy('id','desc')->get();
            return datatables($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                           $btn = '<div class="hidden-sm hidden-xs action-buttons">                            
                                        <a class="btn btn-xs btn-info" href="'.aurl('edit/'.$data->id).'">
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
        return view('admins.index',['title'=>trans("admin.usersAccounts")]);
    }  
    // insert new account using ajax code
    public function adminDataInsertAjax()
    {
        if (request()->ajax()) {
            // transaction
            DB::transaction(function () {
                // validation
                $this->validate(request(),[
                    // rules
                    'name'                  => 'required',
                    'email'                 => 'required|email|unique:admins,email',
                    'password'              => 'required',
                    'cPassword'             => 'required|same:password',
                ],[
                    // message
                    'name.required'          => trans('admin.fullNameRequired'),
                    'email.required'         => trans('admin.emailRequired'),
                    'email.unique'           => trans('admin.emailUnique'), 
                    'password.required'      => trans('admin.passwordRequired'),
                    'cPassword.required'     => trans('admin.passwordConfirmationRequired'),            
                    'cPassword.confirmed'    => trans('admin.passwordConfirmed'),            
                ]);        
                // save data
                $admins = new Admin;
                $admins->name               = request('name');
                $admins->email              = request('email');
                $admins->mobile             = request('mobile');
                $admins->job                = request('job');
                $admins->preferredLanguage  = request('preferredLanguage');
                $admins->status             = request('status');
                $admins->adminGroupId       = request('adminGroupId');
                $admins->password           = bcrypt(request('password'));        
                $admins->save();

                // History
                 $history = request('name') . ' was created as a new user';
                 History::create([
                     'section'      => 'IT',                     
                     'history'      => $history,
                     'user_id'      => authInfo()->id,
                     'tableName'    =>'admins',
                     'crud'         =>'Insert',
                     'idCode'       => $admins->email
                 ]);                    
            });  
        }
        return response(['status'=>true]);        
    }   
    public function edit($id)
    {
        $admin = Admin::find($id);
        return view('admins.edit',['title'=>trans('admin.editAdmin'),'admin'=>$admin]);
    }     
    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);        
        // validation
        $this->validate(request(),[
            // rules
            'name'                  => 'required',
        ],[
            // message
            'name.required'          => trans('admin.fullNameRequired'),
        ]);
        // save data
        
        $admin->name                = request('name');
        $admin->mobile              = request('mobile');
        $admin->job                 = request('job');
        $admin->preferredLanguage   = request('preferredLanguage');
        $admin->status              = request('status');        
        $admin->adminGroupId        = request('adminGroupId');        
        $admin->save();

        // History
        $history = request('name') . '\'s account, some data has been changed';
        History::create([
            'section'      => 'IT',                     
            'history'      => $history,
            'user_id'      => authInfo()->id,
            'tableName'    =>'admins',
            'crud'         =>'Update',
            'idCode'       => $admin->email
        ]);          
        alert()->success('', trans('msg.doneUpdate'));
        return redirect()->back();          
    }    
    public function deleteAdmins()
    {        
        if (request()->ajax()) {
            
            if (request()->has('id'))
            {
                foreach (request('id') as $id) {    
                    $admin = Admin::where('id',$id)->first();
                    // History
                    $history = 'User '. $admin->name .' has been deleted';
                    History::create([
                        'section'      => 'IT',                     
                        'history'      => $history,
                        'user_id'      => authInfo()->id,
                        'tableName'    =>'admins',
                        'crud'         =>'Delete',
                        'idCode'       => $admin->email
                    ]);  
                    Admin::destroy($id);
                }
            }
        }
        return response(['status'=>true]);                
    }    
    public function changePassword()
    {        
        $admin = Admin::find(authInfo()->id);
        return view('admins.changePassword',['title'=>trans('admin.changePassword'),'admin'=>$admin]);
    }
    public function updateChangePassword()
    {        
        // validation
        $this->validate(request(),[
            // rules
            'password'              => 'required',
            'cPassword'             => 'required|same:password',
        ],[
            // message
            'password.required'      => trans('admin.passwordRequired'),
            'cPassword.required'     => trans('admin.passwordConfirmationRequired'),            
            'cPassword.same'         => trans('admin.passwordConfirmed'),            
        ]);        
        // save data
        $admin = Admin::find(authInfo()->id);
        $admin->password   = bcrypt(request('password'));
        $admin->save();
      
        alert()->success('', trans('msg.updatePassword'));
        return back();            
    }  
    public function showProfile($id)
    {
        return view('admins.profile',['title'=>trans('admin.profile')]);
    }    
    public function updateProfile()
    {
        // validation
        $data = $this->validate(request(),[
            'imageProfile'              => 'image|mimes:jpg,jpeg,png|max:1024',
        ],[
            'imageProfile.image' => trans('admin.logoImageValidate'),
            'imageProfile.mimes' => trans('admin.logoMimesValidate'),
        ]);   
        $data = request()->except('_token','_method','/admin/admin/profile');

        if (request()->hasFile('imageProfile'))
        {
            // remove old image
            $image_path = public_path("/images/imagesProfile/".authInfo()->imageProfile); 
            // return dd($image_path);
            if(File::exists($image_path)) {
                File::delete($image_path);                
            }                  
            $imageProfile = request('imageProfile');
            $fileName = time().'-'.$imageProfile->getClientOriginalName();
            $location = public_path('images/imagesProfile');
            
            $imageProfile->move($location,$fileName);
            $data['imageProfile'] = $fileName;
        }  
         
        Admin::where('id',authInfo()->id)->update($data);
        session()->forget('lang');
        session()->put('lang',authInfo()->preferredLanguage);        
        alert()->success('', trans('msg.doneUpdate'));
        return back();
    }  
    public function logs()
    {
        return 'true';
    }
    // get all users
    public function getAdmins()
    {
        $output = "";
        $admins = Admin::where('status','enable')->get();   	        
        foreach ($admins as $data) {            
            $output .= ' <option value="'.$data->email.'">'.$data->name.'</option>';
        };
        return json_encode($output);  	   
    }    
}
