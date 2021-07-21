<?php
    use App\Models\SmoneyModels\Student;

    // Route::get('see-all',function() {
    //     $all = Student::get();
    //     foreach($all as $al){
    //         echo $al->_id."<br>";
    //     }
    // });
    // Route::get('remove',function(){
    //     $all = Student::get();
    //     foreach($all as $al){
    //         $al->delete();
    //     }
    //     echo "cc";
    // });
    // 
    // Route::get('/','SmoneyControllers\HomeController@homePage')->name('homepage.homepage');
    Route::get('/','SmoneyControllers\HomeController@homePage_old')->name('homepage.homepage_old');
    Route::get('login','SmoneyControllers\HomeController@login')->name('homepage.login');
    
    Route::post('register','SmoneyControllers\StudentController@postRegister')->name('student.register');
    Route::post('post-login','SmoneyControllers\StudentController@postLogin')->name('student.login');
    Route::get('logout','SmoneyControllers\StudentController@logout')->name('student.logout');
    
    // forgot pass
    Route::post('search-phone','SmoneyControllers\StudentController@searchPhone')->name('student.searchPhone');
    Route::post('send-mail','SmoneyControllers\StudentController@sendMailForgot')->name('student.sendMail');
    Route::get('forgot-pass/{phone}/{key}','SmoneyControllers\StudentController@forgotPass')->name('student.forgotPass');
    Route::post('change-pass/{key}','SmoneyControllers\StudentController@changePass')->name('student.changePass');

    Route::group(
        ['middleware' => ['userLogin'] ],
        function(){
            Route::get('student-page','SmoneyControllers\StudentController@studentPage')->name('student.student');
            Route::get('preferential-loans','SmoneyControllers\StudentController@preferential')->name('student.preferential');
            Route::get('student-loan','SmoneyControllers\StudentController@studentLoan')->name('student.studentLoan');
            Route::get('student-information','SmoneyControllers\StudentController@studentInformation')->name('student.information');
            Route::post('student-changeavatar','SmoneyControllers\StudentController@changeAvatar')->name('student.changeAvatar');
            Route::post('student-update-nformation','SmoneyControllers\StudentController@updateInformation')->name('student.updateInformation');
            
        }
    );
?>





