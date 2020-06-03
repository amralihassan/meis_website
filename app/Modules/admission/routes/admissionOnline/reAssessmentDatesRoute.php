<?php
// assessment date
Route::get('admission/online_register/reassessment_test_calender','ApplicationCodeController@reassessmentTestCalender')
    ->name('online.openReassessment');
Route::put('admission/online_register/reassessment_test_calender/filter','ApplicationCodeController@reassessmentTestCalenderFilter')
    ->name('openReassessment.filter');
