<?php
    // Route::get('/','SmoneyControllers\HomeController@homePage')->name('homepage.homepage');
    Route::get('/','SmoneyControllers\HomeController@homePage_old')->name('homepage.homepage_old');
    Route::get('login','SmoneyControllers\HomeController@login')->name('homepage.login');
    
    Route::get('student-page','SmoneyControllers\StudentController@studentPage')->name('student.student');

    Route::post('register','SmoneyControllers\StudentController@postRegister')->name('student.register');
    Route::post('post-login','SmoneyControllers\StudentController@postLogin')->name('student.login');
?>





