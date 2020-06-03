<?php
// parent interview date
Route::get('admission/online_register/parent_interview_calender','ApplicationCodeController@parentInterviewCalender')
    ->name('online.parentInterview');
Route::put('admission/online_register/parent_interview_calender/filter','ApplicationCodeController@parentInterviewCalenderFilter')
    ->name('online.filter');
