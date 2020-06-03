<?php

    // ========================================= SITE ================================================
        Route::get('/home','HomeController@home');
        Route::get('/about','HomeController@about');
        Route::get('/admission-steps','HomeController@admissionSteps');
        Route::get('/admission','HomeController@admission');
        Route::get('/admission-step1','HomeController@admissionStep1');
        Route::get('/admission-step2','HomeController@admissionStep2');
        Route::get('/career','HomeController@career');
        Route::get('/admission/register','HomeController@register');
        Route::get('/admission/sent/{code}','HomeController@sent');
        Route::get('/admission/query/{applicationCode}','HomeController@query');
        Route::put('admission/follow_process/filter','HomeController@followProcessFilter')->name('site.processFilter');
        Route::get('/admission/query','HomeController@invalidQuery');
        Route::get('/contact','HomeController@contact');
    // ========================================= MAIN SITE ===========================================

    // store online register data
    Route::post('admission/online_register/store','\Admission\Http\Controllers\Online\OnlineRegisterController@store');


