<?php
	// ========================================= FORGET & RESET PASSWORD [AdminAuth] =================	
        Route::post('/forgot/password','AdminAuth@forgotPasswordPost');
        Route::get('/reset/password/{token}','AdminAuth@resetPassword');
        Route::post('/reset/password/{token}','AdminAuth@resetPasswordPost');
    // ========================================= END FORGET & RESET PASSWORD =========================    
