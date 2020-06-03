<?php
	// ========================================= LANG ================================================	
        Route::get('lang/{lang}',function($lang){
            // check session lang and destroy session
            $data['preferredLanguage'] = $lang;

            if (adminAuth()->check()) {
                \App\Admin::where('id',authInfo()->id)->update($data);
            }
            
            session()->has('lang')?session()->forget('lang'):'';
            // set new session
            $lang == 'ar'?session()->put('lang','ar'):session()->put('lang','en');
            //return to previous page
            return back();
        });	
    // ========================================= END LANG ============================================   