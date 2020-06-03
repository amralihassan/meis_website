<?php
if (!function_exists('aurl')) {
    function aurl($url=null)
    {
        return url('admin/'.$url);
    }
}
if (!function_exists('userInfo')) {
    function userInfo()
    {
		$userId = authInfo()->id;
        return DB::table('employee_view')->where('accountId',$userId)->first();
    }
}
if (!function_exists('staffURL')) {
    function staffURL($url=null)
    {
        return url('staff/'.$url);
    }
}
// page direction
if (!function_exists('dirPage')) {
	function dirPage()
	{
		if (session()->has('lang')) {
			if (session('lang')=='ar') {
				return 'rtl';
			}else{
				return 'ltr';
			}
		}
		else{
			return 'ltr';
		}
	}
}
// get setting information
if (!function_exists('settingHelper')) {
	function settingHelper()
	{
		return \App\Model\Setting::orderBy('id','desc')->first();
	}
}
if (!function_exists('adminAuth')) {
	function adminAuth()
	{
		return auth()->guard('admin');
	}
}
if (!function_exists('authInfo')) {
	function authInfo()
	{
		if (adminAuth()->check()) {
			$id = adminAuth()->user()->id;
			$userInfo = \App\Admin::where('id',$id)->first();
			return $userInfo;
		}
	}
}
// page language
if (!function_exists('lang')) {
	function lang()
	{
		if (session()->has('lang')) {
			return session('lang');
		}
		else{
			if (adminAuth()->check()) {
				session()->put('lang',authInfo()->preferredLanguage);
			}

			return session('lang');
		}
	}
}
// get employee info by attendance id
if (!function_exists('getEmployeeInfo')) {
    function getEmployeeInfo($empId)
    {
        return DB::table('employee_view')->where('id',$empId)->first();
    }
}
// get employee info by attendance id
if (!function_exists('notification')) {
    function notification($employeeId,$data)
    {
//		$notification = $data;
//		$user = \App\Admin::find(getEmployeeInfo($employeeId)->accountId);
//		if ($user != null) {
//			$user->notify(new \App\Notifications\SystemNotification($notification));
//		}
    }
}
if (!function_exists('convertToHoursMins')) {
	function convertToHoursMins($time, $format = '%02d:%02d') {
		if ($time < 1) {
			return;
		}
		$hours = floor($time / 60);
		$minutes = ($time % 60);
		return sprintf($format, $hours, $minutes);
	}
}
