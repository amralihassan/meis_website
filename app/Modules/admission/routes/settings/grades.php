<?php
    Route::get('admission/setting/grades','GradeController@index')->name('grade.index');
    Route::post('admission/setting/grades/store','GradeController@store')->name('grade.store');
    Route::get('admission/setting/grades/edit/{id}','GradeController@edit');
    Route::post('admission/setting/grades/update/{id}','GradeController@update');
    Route::post('admission/setting/grades/destroy','GradeController@destroy')->name('grade.destroy');
    Route::get('get/grades','GradeController@getAllGrades')->name('getGrades');					
    Route::put('get/grades/selected','GradeController@getAllGradesSelected')->name('getGrades.selected');					