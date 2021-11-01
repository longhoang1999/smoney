<?php
    use App\Models\SmoneyModels\Student;
    use App\Models\SmoneyModels\HoSoKhoanVay;
    use App\Models\SmoneyModels\SinhVienHoSo;
    Route::get("HoSoKhoanVay",function(){
        $all = HoSoKhoanVay::get();
        echo json_encode($all);
    });
    Route::get("SinhVienHoSo",function(){
        $all = SinhVienHoSo::get();
        echo json_encode($all);
    });
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
    Route::get('remove-id/{id}',function($id){
        $all = Student::where("_id",$id)->first();
        $all->delete();
        echo "cc";
    });
    Route::get('removeLog',function(){
        \Cookie::queue(\Cookie::forget('tokenLog'));
    });
    Route::get('test2','SmoneyControllers\HomeController@test2');
    Route::get('test3',function() {
        return view('smoney/student/test');
    });

    // SocialNetwork
    Route::get("/getInfo-facebook/{social}","SmoneyControllers\SocialNetworkController@getInfor")->name("getInforFB");
    Route::get("/checkInfo-facebook/{social}","SmoneyControllers\SocialNetworkController@checkInfor")->name("checkInfor");

    Route::get("/getInfo-google/{social}","SmoneyControllers\SocialNetworkController@getInfor")->name("getInforFB");
    Route::get("/checkInfo-google/{social}","SmoneyControllers\SocialNetworkController@checkInfor")->name("checkInfor");


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

            
            Route::get('loan-request','SmoneyControllers\LoanController@loanRequest')->name('student.loanRequest');
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
            Route::get('deleteHoSo/{idHS}', 'SmoneyControllers\LoanController@deleteHoSo')->name('student.deleteHoSo');
            Route::get('confirm-delete/{idHS}', 'SmoneyControllers\LoanController@confirmDelete')->name('student.confirmDelete');
            Route::get('send-mail-comfirm-loan', 'SmoneyControllers\StudentController@sendMailConfirm')->name('student.sendMailConfirm');
            Route::post('confirm-loan/{idHS}/{idBank}', 'SmoneyControllers\LoanController@confirmLoan')->name('student.confirmLoan');
            
            Route::get('info-loan','SmoneyControllers\StudentLoanController@infoLoan')->name('student.infoLoan');
            Route::get('loan-of-pass','SmoneyControllers\StudentLoanController@LoanOfPass')->name('student.LoanOfPass');
            Route::get('student-modal-loan-normal', 'SmoneyControllers\StudentLoanController@getModalLoanNormal')->name('student.getModalLoanNormal');
            Route::get('student-modal-loan-coming-end', 'SmoneyControllers\StudentLoanController@LoanOfBankComeEnd')->name('student.LoanOfBankComeEnd');
            Route::get('student-modal-loan-out-date', 'SmoneyControllers\StudentLoanController@LoanOfBankOutDate')->name('student.LoanOfBankOutDate');

            Route::post('save-id-back-request', 'SmoneyControllers\LoanController@SaveIDBankRequest')->name('student.SaveIDBankRequest');
            Route::get('paid-loan','SmoneyControllers\StudentLoanController@paidLoan')->name('student.paidLoan');
            Route::get('loan-of-paid','SmoneyControllers\StudentLoanController@LoanOfPaid')->name('student.LoanOfPaid');
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
            Route::get('school-approved-profile', 'SmoneyControllers\UniversityController@approvedProfile')->name('schhool.approvedProfile'); 


            // // // /
            Route::get('school-loan-detail', 'SmoneyControllers\UniversityController@loanDetail')->name('school.loanDetail');
            Route::get('loan-of-uni-wait', 'SmoneyControllers\UniversityController@LoanOfUniWait')->name('school.LoanOfUniWait');
            Route::get('get-modal-loan', 'SmoneyControllers\UniversityController@getModalLoan')->name('school.getModalLoan');
            Route::post('feet-back-loan/{idHS}', 'SmoneyControllers\UniversityController@feetbackLoan')->name('school.feetbackLoan');

            Route::get('loan-info-approved-profile', 'SmoneyControllers\UniversityController@infoApprovedProfile')->name('school.infoApprovedProfile');
        }
    );
    Route::group(
        ['middleware' => ['cookieUserLogged','userLogin','bankLogin'] ],
        function(){
            //==============================================================================
            Route::get('bank-dashboard', 'SmoneyControllers\BankController@bankDashboard')->name('bank.bankDashboard');
            Route::get('bank-school-info', 'SmoneyControllers\BankController@schoolinfo')->name('bank.schoolinfo');
            Route::get('bank-loan-info', 'SmoneyControllers\BankController@loaninfo')->name('bank.loaninfo');
            Route::get('bank-loan-wait', 'SmoneyControllers\BankController@loanwait')->name('bank.loanwait');
            Route::get('bank-loan-wait-data', 'SmoneyControllers\BankController@LoanOfBankWait')->name('bank.LoanOfBankWait');
            Route::get('bank-get-modal-loan', 'SmoneyControllers\BankController@getModalLoan')->name('bank.getModalLoan');
            Route::post('bank-refuse-loan', 'SmoneyControllers\BankController@refuseWaitLoan')->name('bank.refuseWaitLoan');
            Route::post('bank-pass-loan', 'SmoneyControllers\BankController@passWaitLoan')->name('bank.passWaitLoan');
            Route::get('feed-back-loan-student', 'SmoneyControllers\BankController@feedBackLoanStudent')->name('bank.feedBackLoanStudent');
            Route::get('feed-back-loan-data', 'SmoneyControllers\BankController@FeedBackLoanData')->name('bank.FeedBackLoanData');
            Route::get('modal-loan-feed-back', 'SmoneyControllers\BankController@modalLoanFeedBack')->name('bank.modalLoanFeedBack');
            Route::post('modal-loan-success', 'SmoneyControllers\BankController@modalLoanSuccess')->name('bank.modalLoanSuccess');
            Route::get('loan-of-bank-pass', 'SmoneyControllers\BankController@LoanOfBankPass')->name('bank.LoanOfBankPass');
            Route::get('loan-pass-id-uni/{idUni}', 'SmoneyControllers\BankController@LoanOfBankPassUni')->name('bank.LoanOfBankPassUni');
            Route::get('get-modal-loan-normal', 'SmoneyControllers\BankController@getModalLoanNormal')->name('bank.getModalLoanNormal');
            Route::get('loan-coming-end', 'SmoneyControllers\BankController@LoanOfBankComeEnd')->name('bank.LoanOfBankComeEnd');
            Route::post('loan-comfirm-pay', 'SmoneyControllers\BankController@LoanComfirmPay')->name('bank.LoanComfirmPay');
            Route::get('loan-coming-end-idUni/{idUni}', 'SmoneyControllers\BankController@LoanComingEndUni')->name('bank.LoanComingEndUni');
            Route::get('loan-out-date', 'SmoneyControllers\BankController@LoanOfBankOutDate')->name('bank.LoanOfBankOutDate');
            Route::post('loan-pay-out-date', 'SmoneyControllers\BankController@LoanPayOutDate')->name('bank.LoanPayOutDate');
            Route::get('bank-loan-paid', 'SmoneyControllers\BankController@loanpaid')->name('bank.loanpaid');
            Route::get('loan-out-date-idUni/{idUni}', 'SmoneyControllers\BankController@LoanOutDateUni')->name('bank.LoanOutDateUni');
            Route::get('list-loan-paid', 'SmoneyControllers\BankController@ListLoanPaid')->name('bank.ListLoanPaid');
            Route::get('list-loan-paid-idUni/{idUni}', 'SmoneyControllers\BankController@ListLoanPaidUni')->name('bank.ListLoanPaidUni');
            
        }
    );

    Route::group(
        ['middleware' => ['cookieUserLogged','userLogin','adminLogin'] ],
        function(){
            //==============================================================================
            Route::get('admin', 'SmoneyControllers\AdminController@dashboard')->name('admin.dashboard'); 
            Route::get('admin-school', 'SmoneyControllers\AdminController@school')->name('admin.adminSchool'); 
            Route::get('admin-account', 'SmoneyControllers\AdminController@account')->name('admin.adminAccount'); 
            Route::get('admin-bank', 'SmoneyControllers\AdminController@bank')->name('admin.bankAccount');
            Route::get('show-all-student', 'SmoneyControllers\AdminController@showAllStudent')->name('admin.showAllStudent');
            Route::get('show-all-university', 'SmoneyControllers\AdminController@showAlluniversity')->name('admin.showAlluniversity');
            Route::get('show-all-bank', 'SmoneyControllers\AdminController@showAllbank')->name('admin.showAllbank');
            Route::get('get-uni-info', 'SmoneyControllers\AdminController@getUniInfo')->name('admin.getUniInfo');

            Route::post('fixUni/{idUni}', 'SmoneyControllers\AdminController@fixUniInfo')->name('admin.fixUniInfo');
            Route::get('resetPass/{idUni}', 'SmoneyControllers\AdminController@resetPass')->name('admin.resetPass');
            Route::post('add-new-uni', 'SmoneyControllers\AdminController@addNewUni')->name('admin.addNewUni');
            
            Route::get('resetPassBank/{idBank}', 'SmoneyControllers\AdminController@resetPassBank')->name('admin.resetPassBank');
            Route::get('get-bank-info', 'SmoneyControllers\AdminController@getBankInfo')->name('admin.getBankInfo');
            Route::post('fixBank/{idBank}', 'SmoneyControllers\AdminController@fixBankInfo')->name('admin.fixBankInfo');
            Route::post('add-new-bank', 'SmoneyControllers\AdminController@addNewBank')->name('admin.addNewBank');
        }
    );

    Route::get('see-info-hs-check-position/{idHS}', 
        'SmoneyControllers\PositionController@seeHS')->name('checkPosition.seeHS');

?>





