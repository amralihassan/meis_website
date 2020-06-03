<?php

Route::get('admission/setting/assessment_links', 'AssessmentLinkController@index')->name('assessmentLink.index');
Route::put('admission/setting/assessment_links/filter', 'AssessmentLinkController@filter')->name('assessmentGrade.filter');
Route::post('admission/setting/assessment_links/store', 'AssessmentLinkController@store')->name('assessmentLink.store');
Route::get('admission/setting/assessment_links/edit/{id}', 'AssessmentLinkController@edit');
Route::post('admission/setting/assessment_links/update/{id}', 'AssessmentLinkController@update');
Route::post('admission/setting/assessment_links/destroy', 'AssessmentLinkController@destroy')->name('assessmentLink.destroy');
