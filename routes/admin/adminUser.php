<?php
        // ================================= ADMIN USERS [AdminController] =======================   
            Route::get('/admins','AdminController@index')->name('admin.index');
            Route::post('admin/insert/new', 'AdminController@adminDataInsertAjax')->name('ajaxdata.admins');
            
            // GET EDIT PAGE
            Route::get('/edit/{id}','AdminController@edit');
            // UPDATE
            Route::post('/admin/update/{id}','AdminController@update');
            // DELETE MULTI RECORD
            Route::post('admin/delete', 'AdminController@deleteAdmins')->name('ajaxdata.deleteAdmins');            
            // UPDATE PROFILE
            Route::get('show_profile/{id}','AdminController@showProfile');
            Route::post('admin/profile','AdminController@updateProfile');		
            // RESET PASSWORD FOR ADMIN USER
            Route::get('change/password','AdminController@changePassword');
            Route::post('update/password','AdminController@updateChangePassword');	
            // GET ALL ADMINS
            Route::get('get/all','AdminController@getAdmins')->name('getAdmins');            
        // ================================= END ADMIN USERS ====================================  