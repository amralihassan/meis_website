<?php
    Route::get('admission/settings  ',function(){
        return view('admission::settings.settingPage',['title'=>trans('admission::admission.admissionSetting')]);
    });