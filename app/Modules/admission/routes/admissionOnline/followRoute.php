<?php
Route::get('admission/online_register/follow_process','ApplicationCodeController@followProcess')
    ->name('followProcess.index');
Route::put('admission/follow_process/get/filter','ApplicationCodeController@followProcessFilter')
    ->name('followProcess.filter');
Route::put('admission/follow_process/getRequiredAdmissionDocument','ApplicationCodeController@getRequiredAdmissionDocument')
    ->name('getRequiredDocument.byOnlineId');
