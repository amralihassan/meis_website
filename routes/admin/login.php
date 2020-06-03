<?php	// ========================================= LOGIN ===============================================
    Route::get('/',function(){
            if (session()->has('login')) {
                if (adminAuth()->check()) {
                    return redirect('admin/admission/');
                }
                else{
                    return view('loginForms.login');
                }
            }
            else
            {
                return view('loginForms.login');
            }
        });
    // ========================================= END LOGIN ===========================================
    // ========================================= LOGIN [AdminAuth] ===================================
        // GET LOGIN PAGE
        Route::get('/login','AdminAuth@login');
        // CHECK EMAIL AND PASSWORD
        Route::post('/login','AdminAuth@doLogin');
        // ACCESS DENIED VIEW
        Route::get('accessdenied','AdminAuth@accessDenied');
    // ========================================= END LOGIN ===========================================
