<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Model\Setting;
use DB;
use File;

class SettingController extends Controller
{      
    public function set()
    {
    	return view('settingForms.setting',['title'=>trans('admin.settings')]);
    }
    private function updateSetting()
    {
        // validation
        $data = $this->validate(request(),[
            'siteNameArabic'    =>'required',
            'siteNameEnglish'   =>'required',
            'logo'              => 'image|mimes:jpg,jpeg,png|max:2048',
            'icon'              => 'mimes:ico',
        ],[
            'siteNameArabic.required'   =>trans('admin.siteNameArabicRequired'),
            'siteNameEnglish.required'  =>trans('admin.siteNameEnglishRequired'),
            'logo.image'                => trans('admin.logoImageValidate'),
            'logo.mimes'                => trans('admin.logoMimesValidate'),            
            'icon.mimes'                => trans('admin.iconMimesValidate'),
        ]);   
        $data = request()->except('_token','_method');
      
        if (request()->hasFile('logo'))
        {
            // remove old image
            $image_path = public_path("/images/website/".settingHelper()->logo); 
            // return dd($image_path);
            if(File::exists($image_path)) {
                File::delete($image_path);                
            }                  
            $logo = request('logo');
            $fileName = time().'-'.$logo->getClientOriginalName();
            $location = public_path('images/website');
            $logo->move($location,$fileName);
            $data['logo'] = $fileName;
        }          
        if (request()->hasFile('icon'))
        {
            // remove old image
            $image_path = public_path("/images/website/".settingHelper()->icon); 
            // return dd($image_path);
            if(File::exists($image_path)) {
                File::delete($image_path);                
            }                  
            $icon = request('icon');
            $fileName = time().'-'.$icon->getClientOriginalName();
            $location = public_path('images/website');
            $icon->move($location,$fileName);
            $data['icon'] = $fileName;
        }     
        unset($data["/admin/setting"]);    
        // update settings
        Setting::orderBy('id','desc')->update($data);
        alert()->success('', trans('msg.doneUpdate'));
    }
    public function setPost()
    {
        // Transaction
        DB::transaction(function () {
            $this->updateSetting();         
        });        
    	return redirect(aurl('setting'));
    }
}
