<?php
    Route::get('admission/setting/admissionDocument','AdmissionDocumentController@index')->name('admissionDocument.index');
    Route::post('admission/setting/admissionDocument/store','AdmissionDocumentController@store')->name('admissionDocument.store');
    Route::get('admission/setting/admissionDocument/edit/{id}','AdmissionDocumentController@edit');
    Route::post('admission/setting/admissionDocument/update/{id}','AdmissionDocumentController@update');
    Route::post('admission/setting/admissionDocument/destroy','AdmissionDocumentController@destroy')->name('admissionDocument.destroy');
    Route::get('get/admissionDocument','AdmissionDocumentController@getAlladmissionDocument')->name('getAdmissionDocuments');					    
    Route::put('get/admissionDocument/selected','AdmissionDocumentController@getAlladmissionDocumentSelected')->name('getAdmissionDocuments.selected');					