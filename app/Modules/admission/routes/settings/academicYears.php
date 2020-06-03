<?php
    Route::get('admission/setting/academicyears','AcademicyearController@index')->name('acadeimc.index');
    Route::post('admission/setting/academicyears/store','AcademicyearController@store')->name('acadeimc.store');
    Route::get('admission/setting/academicyears/edit/{id}','AcademicyearController@edit');
    Route::post('admission/setting/academicyears/update/{id}','AcademicyearController@update');
    Route::post('admission/setting/academicyears/destroy','AcademicyearController@destroy')->name('acadeimc.destroy');
    Route::get('get/academicyears','AcademicyearController@getAllAcademicyears')->name('getAcademicyears');					    
    Route::put('get/academicyears/selected','AcademicyearController@getAllacademicyearsSelected')->name('getAcademicyears.selected');					