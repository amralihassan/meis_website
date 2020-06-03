<?php
    Route::get('admission/setting/divisions','DivisionController@index')->name('division.index');
    Route::post('admission/setting/divisions/store','DivisionController@store')->name('division.store');
    Route::get('admission/setting/divisions/edit/{id}','DivisionController@edit');
    Route::post('admission/setting/divisions/update/{id}','DivisionController@update');
    Route::post('admission/setting/divisions/destroy','DivisionController@destroy')->name('division.destroy');
    Route::get('get/divisions','DivisionController@getAllDivisions')->name('getDivisions');					    
    Route::put('get/divisions/selected','DivisionController@getAllDivisionsSelected')->name('getDivisions.selected');					



