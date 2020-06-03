<?php
$moduleName = basename(dirname(__DIR__));
/**
 * Since Laravel 5.2 the StartSession middleware has been moved from the global $middleware list to the
 * web middleware group in App\Http\Kernel.php. That means that if you need
 * session access for your routes you can use that middleware group
 */
Route::namespace(getNamespaceController($moduleName))->middleware(['web','admin','lang'])->group(function() use($moduleName){
    Route::namespace('Online')->group(function(){
        require 'admissionOnline/onlineRegisterRoute.php';
        require 'admissionOnline/applicationCodeRoute.php';
        require 'admissionOnline/followRoute.php';
        require 'admissionOnline/updateApplicationProcessRoute.php';
        require 'admissionOnline/parentDatesRoute.php';
        require 'admissionOnline/assessmentDatesRoute.php';
        require 'admissionOnline/reAssessmentDatesRoute.php';
        });
        require 'settings/settingsPageRoute.php'; // get admission settings page
        // settings routes
        Route::namespace('Setting')->group(function(){
                require 'settings/divisions.php';
                require 'settings/grades.php';
                require 'settings/academicYears.php';
                require 'settings/defaultOnlineRegMsg.php';
                require 'settings/admissionDocument.php';
                require 'settings/documentsGrade.php';
                require 'settings/assessmentLinkRoute.php';
        });
});
