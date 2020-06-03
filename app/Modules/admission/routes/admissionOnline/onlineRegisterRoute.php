<?php
    Route::get('admission/all/online_register','OnlineRegisterController@index')->name('onlineRegister.index');
    Route::get('admission/online_register/application/{id}','OnlineRegisterController@show');
    Route::post('admission/online_register/update/{id}','OnlineRegisterController@update');
    Route::get('admission/online_register/application/print/{id}','OnlineRegisterController@printApplication');
    Route::post('admission/online_register/destroy','OnlineRegisterController@destroy')->name('onlineRegister.destroy');
    Route::get('get/admission/applicantNames','OnlineRegisterController@getApplicants')->name('getApplicants');

