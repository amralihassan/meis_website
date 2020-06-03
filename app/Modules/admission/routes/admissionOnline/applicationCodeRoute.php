<?php
Route::get('admission/online_register/application_codes','ApplicationCodeController@index')
    ->name('applicationCodes.index');
Route::post('admission/online_register/application_codes/store','ApplicationCodeController@storeApplicationCode')
    ->name('applicationCode.store');
Route::post('admission/online_register/application_codes/applicationCodeDestroy','ApplicationCodeController@applicationCodeDestroy')
    ->name('applicationCode.destroy');
Route::get('admission/print/application_code_form/{id}','ApplicationCodeController@printApplicationCodeForm');
