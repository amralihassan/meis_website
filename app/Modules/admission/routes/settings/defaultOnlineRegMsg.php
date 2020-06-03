<?php
Route::get('admission/setting/default/online_register_messages','DefaultOnlinrRegMsg@updateMessagesPage')->name('onlineRegister.defaultMessages');
Route::post('admission/setting/default/online_register_messages/update','DefaultOnlinrRegMsg@updateMessages');