<?php
    Route::get('admission/setting/documentsGrade','DocumentGradeController@index')->name('documentsGrade.index');
    Route::put('admission/setting/documentsGrade/filter','DocumentGradeController@filter')->name('documentsGrade.filter');
    Route::post('admission/setting/documentsGrade/store','DocumentGradeController@store')->name('documentsGrade.store');    
    Route::post('admission/setting/documentsGrade/destroy','DocumentGradeController@destroy')->name('documentsGrade.destroy');    