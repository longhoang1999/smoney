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
    Route::get('test3',function() {
        return view('smoney/student/test');
    });

    // 
    // Route::get('/','SmoneyControllers\HomeController@homePage')->name('homepage.homepage');
    Route::get('change-language/{language}', 'SmoneyControllers\HomeController@changeLanguage')->name('user.change-language');
    Route::get('login','SmoneyControllers\HomeController@login')->name('homepage.login');
    Route::get('get-register','SmoneyControllers\HomeController@register')->name('homepage.getRegister');
    Route::post('register','SmoneyControllers\StudentController@postRegister')->name('student.register');
    Route::post('post-login','SmoneyControllers\StudentController@postLogin')->name('student.login');
    Route::get('logout','SmoneyControllers\HomeController@logout')->name('student.logout');
    
    // forgot pass
    Route::post('search-phone','SmoneyControllers\StudentController@searchPhone')->name('student.searchPhone');
    Route::post('send-mail','SmoneyControllers\StudentController@sendMailForgot')->name('student.sendMail');
    Route::get('forgot-pass/{phone}/{key}','SmoneyControllers\StudentController@forgotPass')->name('student.forgotPass');
    Route::post('change-pass/{key}','SmoneyControllers\StudentController@changePass')->name('student.changePass');
    // find address
    
    Route::post('load-all-city','SmoneyControllers\HomeController@loadAllCity')->name('student.loadAllCity');
    Route::post('find-district','SmoneyControllers\HomeController@findDistrict')->name('student.findDistrict');
    Route::post('find-Ward','SmoneyControllers\HomeController@findWard')->name('student.findWard');
    // success device
    Route::post('success-device','SmoneyControllers\StudentController@successDevice')->name('student.successDevice');
    
    
    Route::group(
        ['middleware' => ['cookieUserLogged','language'] ],
        function(){
            Route::get('/','SmoneyControllers\HomeController@homePage_old')->name('homepage.homepage_old');
        }
    );

    Route::group(
        ['middleware' => ['cookieUserLogged','userLogin'] ],
        function(){
            Route::get('student-page','SmoneyControllers\StudentController@studentPage')->name('student.student');
            // treo
            Route::get('preferential-loans','SmoneyControllers\StudentController@preferential')->name('student.preferential');
            // treo
            Route::get('student-loan','SmoneyControllers\StudentController@studentLoan')->name('student.studentLoan');
            // treo
            Route::get('apply-loan','SmoneyControllers\LoanController@applyLoan')->name('student.applyLoan');
            // treo
            Route::get('job-information','SmoneyControllers\HomeController@jobInformation')->name('student.jobInformation');
            // treo
            Route::get('marketplace','SmoneyControllers\HomeController@marketplace')->name('student.marketplace');
            


            Route::get('student-information','SmoneyControllers\StudentController@studentInformation')->name('student.information');
            Route::post('student-changeavatar','SmoneyControllers\StudentController@changeAvatar')->name('student.changeAvatar');
            Route::post('student-update-information','SmoneyControllers\StudentController@updateInformation')->name('student.updateInformation');
            Route::get('loan-request','SmoneyControllers\LoanController@loanRequest')->name('student.loanRequest');
            Route::get('load-timeline', 'SmoneyControllers\LoanController@loadTimeline')->name('student.loadTimeline');
            Route::post('up-file-point', 'SmoneyControllers\LoanController@upFilePoint')->name('student.upFilePoint');
            Route::get('student.deleteImgPoint', 'SmoneyControllers\LoanController@deleteImgPoint')->name('student.deleteImgPoint');
            
            //==============================================================================
            Route::get('school-dashboard', 'SmoneyControllers\UniversityController@schoolDashboard')->name('schhool.schoolDashboard');

        }
    );
?>





