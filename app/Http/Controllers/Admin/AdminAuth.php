<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Admin;
use App\Login;
use DB;
use Carbon\Carbon;
use Mail;
use App\Mail\AdminResetPassword;

class AdminAuth extends Controller
{
    // check login
    public function login()
    {
        // check login session
        if (session()->has('login') == true) {
            return redirect(aurl());
        }else{
            return view('loginForms.login');
        }    	
    }
    // do login
    public function doLogin()
    {
        $this->validate(request(), [
            'email'   => 'required|email',
            'password' => 'required'
        ]); 
        $rememberme = request('rememberme')==1 ?true:false; 
        if (adminAuth()->attempt(['email'=>request('email'),'password'=>request('password')],$rememberme)) {
            session()->put('login',true);
            // check session for lang
            if (!session()->has('lang')) {
                session()->put('lang',authInfo()->preferredLanguage);   
            }

            return redirect('admin');
        }
        // Login using email and password        
        switch (request('domainRole')) {
            case 'staff':
                if (adminAuth()->attempt(['email'=>request('email'),'password'=>request('password')],$rememberme)) {
                    session()->put('login',true);
                    // check session for lang
                    if (!session()->has('lang')) {
                        session()->put('lang',authInfo()->preferredLanguage);   
                    }
                    // add to logins table
                    Login::create([
                        'user_id' => authInfo()->id,
                        'gethostname' => request('gethostname'),
                    ]);
                    return redirect('admin');
                }
                else
                {
                    // send message to user with invalid username or password
                    session()->flash('error',trans('admin.incorrectInformationLogin'));
                    return redirect(aurl('login'));
                }
                break;
            case 'teacher':
                if (auth()->guard('web')->attempt(['email'=>request('email'),'password'=>request('password')],$rememberme)) {
                    session()->put('login',true);

                    return redirect('teacher');
                }
                else
                {
                    // send message to user with invalid username or password
                    session()->flash('error',trans('admin.incorrectInformationLogin'));
                    return redirect(aurl('login'));
                }
            case 'parent':
                session()->flash('error',trans('admin.systemUnderDevelopment'));
                return redirect(aurl('login'));                          
            default:
                session()->flash('error',trans('admin.systemUnderDevelopment'));
                return redirect(aurl('login'));
                break;
        }

    }    
    // logout
    public function logout()
    {
    	adminAuth()->logout(); // logout
        session()->forget('login'); // delete login session
        // session()->forget('lang'); // delete login session
    	return redirect(aurl('login')); //go to login page
    }    
    public function forgotPasswordPost()
    {

        // check email for admin user
        $admin = Admin::where('email',request('email'))->first();

        if (!empty($admin)) {

            // create token throw laravel framework and add admin
            $token = app('auth.password.broker')->createToken($admin);
            // Insert data in password_resets table
            $data = DB::table('password_resets')->insert([
                'email'      =>$admin->email,
                'token'     =>$token,
                'created_at' =>Carbon::now(),
            ]);
            // use mailable AdminResetPassword to send data
            Mail::to($admin->email)
                    ->send(new AdminResetPassword(['data'=>$admin,'token'=>$token]));
            // send message to user with message sent to your email
            session()->flash('success',trans('admin.linkResetPassword'));

            return back();
        }
        else
        {
            session()->flash('error',trans('admin.invalidEmail'));
        }
        return back();
    }    
    public function resetPassword($token)
    {
        // search in password_resets table for token
        $checkToken = DB::table('password_resets')
        ->where('token',$token)
        ->where('created_at','>',Carbon::now()->subHours(2))->first();
        // if ok
        if (!empty($checkToken)) {
            // show page to user to create new password
            return view('loginForms.resetPassword')->with('data',$checkToken);
        }
        else
        {
            return redirect(aurl('forgot/password'));
        }
    }  
    public function resetPasswordPost($token)
    {        
        // validation
        // will back to page automatically 
        $this->validate(request(),[
            // rules
            'password'              => 'required',
            'passwordConfirmation'  => 'required|same:password',
        ],[
            // message
            'password.required'                 => trans('admin.passwordRequired'),
            'passwordConfirmation.required'     => trans('admin.passwordConfirmationRequired'),            
            'passwordConfirmation.confirmed'    => trans('admin.passwordConfirmed'),            
        ]);
        // make sure the time between send token to user and active less than 2 hours 
        $checkToken = DB::table('password_resets')
        ->where('token',$token)
        ->where('created_at','>',Carbon::now()->subHours(2))->first();
        // if ok
        if (!empty($checkToken)) {
            // update password
            $admin = Admin::where('email',$checkToken->email)
            ->update([
                'password' => bcrypt(request('password')),
            ]);
            // delete from password_resets
            DB::table('password_resets')->where('token',$token)->delete();
            // login
            if (adminAuth()->attempt(['email'=>request('email'),'password'=>request('password')])) {
                 session()->put('login',true);
	            // check session for lang
	            if (!session()->has('lang')) {
	                session()->put('lang',authInfo()->preferredLanguage);   
	            }                 
                 return redirect('admin');
            }         
        }
        else
        {
            return redirect(aurl('forgot/password'));
        }           
    }  
    public function accessDenied()
    {
        return view('loginForms.accessDenied',['title'=>trans('admin.accessDenied')]);
    }   
}
