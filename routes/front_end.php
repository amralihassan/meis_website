<?php
Route::get('/', function () {
    return redirect('/home');
});
Route::group(['namespace'=>'FrontEnd'],function(){
    // ========================================= SITE ================================================
        require 'front_end/site.php';

    // ========================================= EVENTS ==============================================
        require 'front_end/calendar.php';
});

