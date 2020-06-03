<?php
    namespace Admission\Http\Controllers\Setting;
    use App\Http\Controllers\Controller;
    use Admission\Models\OnlineRegisterMessages;
    use DB;

class DefaultOnlinrRegMsg extends Controller
{
    public function updateMessagesPage()
    {
        $msg = OnlineRegisterMessages::first();
        return view('admission::settings.onlineRegDefaultMsg.defaultMsg',
        ['title'=>trans('admission::admission.defaultOnlineRegisterMsgs'),'msg'=>$msg]);
    }
    public function updateMessages()
    {
        DB::transaction(function () {
            $data = request()->except('_token','_method','/admission/setting/default/online_register_messages/update');
            // update settings
            // convert array [offDays] to string
            $data['offDays'] = implode(",",request('offDays'));
            OnlineRegisterMessages::orderBy('id','desc')->update($data);          
        });         
        alert()->success('', trans('msg.doneUpdate')); 
        return back();  
    }
}