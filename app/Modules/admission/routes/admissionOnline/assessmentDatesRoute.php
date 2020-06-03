<?php
// assessment date
Route::get('admission/online_register/assessment_test_calender','ApplicationCodeController@assessmentTestCalender')
    ->name('online.openAssessment');
Route::put('admission/online_register/assessment_test_calender/filter','ApplicationCodeController@assessmentTestCalenderFilter')
    ->name('openAssessment.filter');
