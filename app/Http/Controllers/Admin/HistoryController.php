<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use App\History;
use DataTables;
use DB;

use Illuminate\Http\Request;

class HistoryController extends Controller
{	
 	public function history()
 	{ 	            
        return view('history.appHistory',['title'=>trans("admin.history")]);
    }  
    public function eventLogFilter()
    {
                 // prepate date period
        $department = request('department');
        $crud       = request('crud');
        $username   = request('username');

        $data = DB::table('historys')->orderBy('updated_at','desc')
        ->join('admins', 'historys.user_id', '=', 'admins.id')    
        ->where('section',$department)
        ->where('crud',$crud)
        ->where('email',$username)            
        ->select('admins.name', 'historys.*')
        ->get();
         
        if (request()->ajax()) {           
            return Datatables::of($data)
                    ->addIndexColumn()                                                                     
                    ->make(true);         
   		 } 
     }    
}
