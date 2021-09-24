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
    // not found
    Route::get('not-found', function(){
        return view("404");
    })->name('notFound'); 
    
    
    Route::group(
        ['middleware' => ['cookieUserLogged','language'] ],
        function(){
            Route::get('/','SmoneyControllers\HomeController@homePage_old')->name('homepage.homepage_old');
        }
    );

    Route::group(
        ['middleware' => ['cookieUserLogged','userLogin','studentLogin'] ],
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
            
            Route::post('student-changepass','SmoneyControllers\StudentController@studentChangepass')->name('student.studentChangepass');
            Route::get('student-information','SmoneyControllers\StudentController@studentInformation')->name('student.information');
            Route::post('student-changeavatar','SmoneyControllers\StudentController@changeAvatar')->name('student.changeAvatar');
            Route::post('student-update-information','SmoneyControllers\StudentController@updateInformation')->name('student.updateInformation');

            
            Route::get('loan-request/{id_nn}','SmoneyControllers\LoanController@loanRequest')->name('student.loanRequest');
            Route::get('load-timeline', 'SmoneyControllers\LoanController@loadTimeline')->name('student.loadTimeline');
            Route::get('load-timeline-pre', 'SmoneyControllers\LoanController@loadTimelinePre')->name('student.loadTimelinePre');
            
            Route::post('up-file-point', 'SmoneyControllers\LoanController@upFilePoint')->name('student.upFilePoint');
            Route::get('delete-img-point', 'SmoneyControllers\LoanController@deleteImgPoint')->name('student.deleteImgPoint');
            Route::get('complete-profile/{idHS}','SmoneyControllers\LoanController@completeProfile')->name('student.completeProfile');

            Route::post('add-infor-university', 'SmoneyControllers\StudentController@addUniversity')->name('student.addUniversity');
            Route::post('edit-infor-university/{id}', 'SmoneyControllers\StudentController@editUniversity')->name('student.editUniversity');
            Route::get('delete-infor-university/{id}','SmoneyControllers\StudentController@deleteUniversity')->name('student.deleteUniversity');

            Route::post('add-parent', 'SmoneyControllers\StudentController@addParents')->name('student.addParents');
            Route::post('edit-parent/{id}', 'SmoneyControllers\StudentController@editParents')->name('student.editParents');
            Route::get('delete-infor-parent/{id}','SmoneyControllers\StudentController@deleteParent')->name('student.deleteParent');
            
            Route::post('fix-job-status', 'SmoneyControllers\StudentController@jobStatus')->name('student.jobStatus');

            Route::post('refress-info', 'SmoneyControllers\StudentController@refressInfo')->name('student.refressInfo');
            Route::get('get-info-hoso', 'SmoneyControllers\LoanController@getInfoHoso')->name('student.getInfoHoso');
            
        }
    );
    Route::group(
        ['middleware' => ['cookieUserLogged','userLogin','universityLogin'] ],
        function(){
            //==============================================================================
            Route::get('school-dashboard', 'SmoneyControllers\UniversityController@schoolDashboard')->name('schhool.schoolDashboard');
            Route::get('school-workinfor', 'SmoneyControllers\UniversityController@workinfor')->name('schhool.workinfor');
            Route::get('school-overdue', 'SmoneyControllers\UniversityController@overdue')->name('schhool.overdue');
            Route::get('school-paid', 'SmoneyControllers\UniversityController@paid')->name('schhool.paid');
            Route::get('school-unpaid', 'SmoneyControllers\UniversityController@unpaid')->name('schhool.unpaid');
            Route::get('school-pending', 'SmoneyControllers\UniversityController@pending')->name('schhool.pending'); 


            // // // /
            Route::get('school-loan-detail', 'SmoneyControllers\UniversityController@loanDetail')->name('school.loanDetail');
        }
    );
    Route::group(
        ['middleware' => ['cookieUserLogged','userLogin','bankLogin'] ],
        function(){
            //==============================================================================
            Route::get('bank-dashboard', 'SmoneyControllers\BankController@bankDashboard')->name('bank.bankDashboard');
            Route::get('bank-school-info', 'SmoneyControllers\BankController@schoolinfo')->name('bank.schoolinfo');
            Route::get('bank-loan-info', 'SmoneyControllers\BankController@loaninfo')->name('bank.loaninfo');
        }
    );

    Route::group(
        ['middleware' => ['cookieUserLogged','userLogin','adminLogin'] ],
        function(){
            //==============================================================================
            Route::get('testadmin', function() {
                echo "ccc";
            });
            Route::get('admin', 'SmoneyControllers\AdminController@dashboard')->name('admin.dashboard'); 
            Route::get('admin-school', 'SmoneyControllers\AdminController@school')->name('admin.adminSchool'); 
            Route::get('admin-account', 'SmoneyControllers\AdminController@account')->name('admin.adminAccount'); 
            Route::get('admin-bank', 'SmoneyControllers\AdminController@bank')->name('admin.bankAccount');
            Route::get('show-all-student', 'SmoneyControllers\AdminController@showAllStudent')->name('admin.showAllStudent');
            
        }
    );

?>





