<?php
        // ================================= HISTROY =============================================
            // display all histroy 
            Route::get('history','HistoryController@history');
            Route::put('history/eventLogFilter','HistoryController@eventLogFilter')->name('eventLogFilter');            
        // ================================= END HISTROY =========================================         
