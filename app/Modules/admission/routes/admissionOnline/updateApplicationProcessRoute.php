<?php
Route::get('admission/online_register/process_page','ApplicationCodeController@getUpdatePage')->name('applicationCodes.update');
Route::get('admission/online_register/process_page/update/p/{id}','ApplicationCodeController@updateProcessPage');
Route::post('admission/online_register/process/update/{id}','ApplicationCodeController@updateProcess');


