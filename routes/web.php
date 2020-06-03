<?php

    Auth::routes();

	// ========================================= LANG ================================================
        Route::get('lang/{lang}',function($lang){
            session()->has('lang')?session()->forget('lang'):'';
            // set new session
            $lang == 'ar'?session()->put('lang','ar'):session()->put('lang','en');
            //return to previous page
            return back();
        });
    // ========================================= END LANG ============================================
