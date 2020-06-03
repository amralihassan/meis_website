<?php
/**
 * Notification system controller
 * This controller is responsible for retrive all notification 
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use DB;

class NotificationController extends Controller
{   
    public function userNotifications(){
        if (request()->ajax()) {
            $output = '';
            $count = '';
            $countTitle = '';
            $notifications = '';
            $view = '';

            // count notification
                if(auth()->user()->unreadNotifications->count() != 0){
                    $count = '<i class="ace-icon fa fa-bell icon-animated-bell"></i>
                    <span class="badge badge-important"> '.auth()->user()->unreadNotifications->count().'</span>';
                }else{
                    $count = '<i class="ace-icon fa fa-bell icon-animated-bell"></i>
                    <span class="badge badge-important"></span>';
                }
            // count notification

            // count notification in title
                $countTitle = '<i class="ace-icon fa fa-exclamation-triangle"></i>
                '.auth()->user()->unreadNotifications->count().' '.trans('admin.notifications') ;
            // count notification in title

            // notifications
            
                foreach (auth()->user()->notifications as $notification) {  
                    $read = $notification->read_at==null?'<i class="btn btn-xs btn-danger fa fa-eye"></i>':'<i class=" btn btn-xs btn-success fa fa-check"></i>';                                       
                    $notifications .= '<li>
                                        <a href="#">
                                            '.$read.'
                                            '.$notification->data["data"].'</br>
                                            '.$notification->created_at->addHour(2)->locale('ar')->isoFormat(' dddd, Do MMMM  YYYY, h:mm').'
                                        </a>
                                    </li>';
                }
            // notifications
           
            // view
                if (auth()->user()->unreadNotifications->count() != 0) {
                    $view = '<a href="'.route('view.notifications').'">
                            '. trans('admin.viewAll') .'                        
                            </a>';
                }else{                    
                    $view = '<a href="'.route('view.notifications').'">
                    '. trans('admin.noNotifications') .'                        
                    </a>';
                }  
            // view

            $data['count']          = $count;
            $data['countTitle']     = $countTitle;
            $data['notifications']  = $notifications;
            $data['view']           = $view;
            
            return response()->json($data);
        }
    }

    public function viewNotifications()
    {
        return view('layouts.notifications.view',['title'=>trans('admin.notifications')]);
    }

    public function delete()
    {
        auth()->user()->notifications()->delete();
        return back();
    }
    public function markAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back();        
    }
    public function addNotification()
    {
        if (request()->has('empId') && request()->has('notification')) {
            if (request('empId') != null && request('notification') != '') {
                foreach (request('empId') as $empId ) {
                   //  notification                               
                   $data['data'] = request('notification');                                                                       
                   notification($empId,$data);     
                }
            }
        }
        return back();
    }
}