<?php
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    // ========================================= CONFIGURATIONS ======================================
		Config::set('auth.defaults.guard','admin');
		Config::set('auth.defaults.passwords','users');
    // ========================================= END CONFIGURATIONS ==================================

	// ========================================= LOGIN ===============================================
        require 'admin/login.php';
	// ========================================= FORGET & RESET PASSWORD [AdminAuth] =================
        require 'admin/resetPassword.php';
	// ========================================= LANG ================================================
        require 'admin/lang.php';

    Route::group(['middleware'=>'admin'],function(){
        // ================================= LOGOUT ==============================================
            require 'admin/logout.php';
        // ================================= START SETTING CONTROLLER ROUTES [SettingController]==
            require 'admin/websiteSetting.php';
        // ================================= ADMIN USERS [AdminController] =======================
            require 'admin/adminUser.php';
        // ================================= HISTROY =============================================
            require 'admin/history.php';
        // ================================= USER NOTIFICATION ===================================
            require 'admin/notification.php';
        // ================================= MODULES ============================================
            require 'admin/modules.php';

    });
});
