<?php
    use App\Models\SmoneyModels\Student;

    Route::get('see-all',function() {
        $all = Student::get();
        echo json_encode($all);
    });
    Route::get('remove',function(){
        $all = Student::get();
        foreach($all as $al){
            $al->delete();
        }
        echo "cc";
    });
    Route::get('removeLog',function(){
        \Cookie::queue(\Cookie::forget('tokenLog'));
    });
    Route::get('test2','SmoneyControllers\HomeController@test2');
    // 
    // Route::get('/','SmoneyControllers\HomeController@homePage')->name('homepage.homepage');
    Route::get('login','SmoneyControllers\HomeController@login')->name('homepage.login');
    
    Route::post('register','SmoneyControllers\StudentController@postRegister')->name('student.register');
    Route::post('post-login','SmoneyControllers\StudentController@postLogin')->name('student.login');
    Route::get('logout','SmoneyControllers\HomeController@logout')->name('student.logout');
    
    // forgot pass
    Route::post('search-phone','SmoneyControllers\StudentController@searchPhone')->name('student.searchPhone');
    Route::post('send-mail','SmoneyControllers\StudentController@sendMailForgot')->name('student.sendMail');
    Route::get('forgot-pass/{phone}/{key}','SmoneyControllers\StudentController@forgotPass')->name('student.forgotPass');
    Route::post('change-pass/{key}','SmoneyControllers\StudentController@changePass')->name('student.changePass');
    // find address
    Route::post('find-district','SmoneyControllers\HomeController@findDistrict')->name('student.findDistrict');
    Route::post('find-Ward','SmoneyControllers\HomeController@findWard')->name('student.findWard');
    // success device
    Route::get('success-device/{userid}/{key}/{log_ip_address}/{log_device_name}/{phone}/{password}/{checkDeviceCookie}','SmoneyControllers\StudentController@successDevice')->name('student.successDevice');
    
    
    Route::group(
        ['middleware' => ['cookieUserLogged'] ],
        function(){
            Route::get('/','SmoneyControllers\HomeController@homePage_old')->name('homepage.homepage_old');
        }
    );

    Route::group(
        ['middleware' => ['userLogin','cookieUserLogged'] ],
        function(){
            Route::get('student-page','SmoneyControllers\StudentController@studentPage')->name('student.student');
            // treo
            Route::get('preferential-loans','SmoneyControllers\StudentController@preferential')->name('student.preferential');
            // treo
            Route::get('student-loan','SmoneyControllers\StudentController@studentLoan')->name('student.studentLoan');
            // // treo
            // Route::get('student-loan','SmoneyControllers\StudentController@studentLoan')->name('student.studentLoan');


            Route::get('student-information','SmoneyControllers\StudentController@studentInformation')->name('student.information');
            Route::post('student-changeavatar','SmoneyControllers\StudentController@changeAvatar')->name('student.changeAvatar');
            Route::post('student-update-information','SmoneyControllers\StudentController@updateInformation')->name('student.updateInformation');
            
        }
    );
?>





