<?php
        // ================================= USER NOTIFICATION ===================================
            Route::get('all/user/notification','NotificationController@userNotifications')->name('user.notifications');
            Route::get('view/all','NotificationController@viewNotifications')->name('view.notifications');
            Route::get('delete/all','NotificationController@delete')->name('delete.notifications');
            Route::get('read/all','NotificationController@markAsRead')->name('read.notifications');
            Route::post('add/notification','NotificationController@addNotification');
        // ================================= END USER NOTIFICATION ===============================   
        