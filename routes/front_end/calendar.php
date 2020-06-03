<?php
    // ========================================= EVENTS ==============================================
        // parent interview set date
        // get pages
        Route::get('admission/set_parent_interview_date/{applicationCode}','CalendarController@setParentInterviewDate');
        Route::get('admission/set_assessment_test_date/{applicationCode}','CalendarController@setAssessmentTestDate');
        Route::get('admission/set_reassessment_test_date/{applicationCode}','CalendarController@set_reassessment_test_date');
        Route::get('admission/set_installment_one_date/{applicationCode}','CalendarController@set_installmentone_date');

        // display all dates into calender
        Route::get('admission/events/parentInterview','CalendarController@allParentInterview')->name('parentInterview.all');
        Route::get('admission/events/assessmentTest','CalendarController@allAssessmentTests')->name('assessmentTest.all');
        // get pages
        // store all dates
        Route::post('set/parent/interview/store','CalendarController@storeDateParentInterview');
	// ========================================= END EVENTS ==========================================
