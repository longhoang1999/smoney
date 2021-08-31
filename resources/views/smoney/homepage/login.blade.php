<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Smoney</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-5.14.0-web/css/all.css') }}">
    <link rel="shortcut icon" href="{{ asset('img-smoney/smoney.png') }}">
    <link rel="stylesheet" href="{{ asset('css/Smoney/Homepage/login.css') }}">
    <style>
        @font-face {
            font-family: smoneyFont;
            src: url("{{ asset('font/AvertaStdCY_Regular_3.otf')  }}");
        }
        *{
            font-family: smoneyFont;
        }
   </style>
</head>
<body>
    <div class="main-content">
        <!-- div error -->
        @if ($errors->any())
        <div class="notification-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><span>{{ $error }}</span></li>
                @endforeach
            </ul>
        </div>
        <script type="text/javascript" src="{{ asset('js/Smoney/Homepage/error.js') }}"></script>
        @endif

        @if(Session::has('error'))
        <div class="notification-error">
            <ul>
                <li><span>{!! Session::get('error') !!}</span></li>
            </ul>
        </div>
        <script type="text/javascript" src="{{ asset('js/Smoney/Homepage/error.js') }}"></script>
        @endif
        <!-- /div error -->

        <div class="background-left main-content-item">
            <img src="{{ asset('img-smoney/login/login-left.svg') }}" alt="">
        </div>
        <div class="main-body main-content-item">
            <div class="block-logo">
                <a href="{{ route('homepage.homepage_old') }}">
                    <img src="{{ asset('img-smoney/login/logo-login-page.svg') }}" alt="">
                </a>
            </div>
            <div class="block-main">
                <!-- forgot pass -->
                <div class="block-forgot">
                    <p class="title">Quên mật khẩu?</p>
                    <form action="{{ route('student.searchPhone') }}" method="post" class="form-forgot">
                        <!-- phone -->
                        <div class="enter-phone enter-parent">
                            <span class="enter-phone-title enter-title">Nhập số điện thoại của bạn</span>
                            <input type="text" class="enter-phone-input enter-input" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required name="phone" autocomplete="off">
                            <div class="enter-phone-icon enter-icon ">
                                <i class="icon-tick fas fa-check"></i>
                                <i class="icon-times fas fa-times"></i>
                            </div>                        
                        </div>
                        <!-- btn submit -->
                        <button class="btn-submit btn-full-width" type="submit">
                            <span>Tìm tài khoản</span>
                            <div class="btn-icon">
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </div>
                        </button>
                    </form>
                    <!-- tab login -->
                    <div class="tab-login tab-login-2">
                        <span>Đã có tài khoản?  &nbsp;</span>
                        <span class="tab-login-now-2">Đăng nhập ngay</span>
                    </div>
                </div>
                <!-- login -->
                <div class="block-login">
                    <p class="title">
                        Đăng nhập
                    </p>
                    <form action="{{ route('student.login') }}" class="login-form" method="post">
                        @csrf
                        <!-- phone -->
                        <div class="enter-phone enter-parent">
                            <span class="enter-phone-title enter-title">Số điện thoại</span>
                            <input type="text" class="enter-phone-input enter-input" 
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required
                                name="phone" autocomplete="off" 
                            >
                            <div class="enter-phone-icon enter-icon ">
                                <i class="icon-tick fas fa-check"></i>
                                <i class="icon-times fas fa-times"></i>
                            </div>                        
                        </div>
                        <!-- password -->
                        <div class="enter-password enter-parent">
                            <span class="enter-password-title enter-title">Mật khẩu</span>
                            <input type="password" class="enter-password-input enter-input" minlength="8" maxlength="32" required name="password" autocomplete="off"> 
                            <div class="enter-password-icon enter-icon">
                                <i class="icon-open-eye fas fa-eye"></i>
                                <i class="icon-close-eye fas fa-eye-slash"></i>
                            </div>
                        </div>
                        <!-- forgot pass -->
                        <span class="forgot-pass">
                            Quên mật khẩu?
                        </span>
                        <div class="error-responsive-phone"></div>
                        <!-- btn submit -->
                        <div class="block-btn-submit">
                            <button class="btn-submit" type="submit">
                                <span>Đăng nhập</span>
                                <div class="btn-icon">
                                    <i class="fas fa-long-arrow-alt-right"></i>
                                </div>
                            </button>
                            @if(Session::has('action') && Session::get('action')=="modalOpen")
                                <button class="btn-submit btn-verifyfi" type="button" data-toggle="modal" data-target="#verifiDevice">
                                    <span>Xác thực</span>
                                    <div class="btn-icon">
                                        <i class="fas fa-laptop-house"></i>
                                    </div>
                                </button>
                            @endif
                        </div>
                    </form>
                    <div class="tab-register">
                        <span>Đăng ký tài khoản</span>
                    </div>
                </div>


                <!-- register -->
                <div class="block-register">
                    <p class="title">
                        Đăng ký tài khoản
                    </p>
                    <form action="{{ route('student.register') }}" class="register-form" method="post">
                        @csrf
                        <!-- full name -->
                        <div class="register-fullname register-parent">
                            <label for="input-fullname" class="register-label">Họ và tên</label>                    
                            <input type="text" class="register-input" id="input-fullname" name="fullname" required="" autocomplete="off">
                        </div>
                        <!-- phone -->
                        <div class="register-phone register-parent">
                            <label for="input-phone" class="register-label">Số điện thoại</label>                    
                            <input type="text" class="register-input" id="input-phone" name="phone"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                required="" 
                                autocomplete="off"
                            >
                        </div>
                        <!-- email -->
                        <div class="register-email register-parent">
                            <label for="input-email" class="register-label">Email</label>                    
                            <input type="email" class="register-input" id="input-email" name="email" autocomplete="off">
                        </div>
                        <!-- address -->
                        <div class="register-address register-parent">
                            <label for="input-address" class="register-label">Địa chỉ</label>
                            <div class="block_select_address">
                                <select id="select_province">
                                    <option hidden="" value="">Thành phố / Tỉnh</option>
                                    @foreach($province_address as $value)
                                        <option value="{{ $value->provinceid  }}">{{ $value->type }} {{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <select id="select_district">
                                    <option hidden="" value="">Quận / Huyện</option>
                                </select>
                                <select id="select_ward">
                                    <option hidden="" value="">Phường / Xã</option>
                                </select>
                            </div>
                            <input type="text" class="register-input" id="input-address" name="address" autocomplete="off">
                        </div>
                        <!-- password -->
                        <div class="register-password register-parent">
                            <label for="input-password" class="register-label">Mật khẩu</label>                    
                            <input type="password" class="register-input" id="input-password" name="password" required="" autocomplete="off" minlength="8" maxlength="32">
                            <div class="register-tick">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                        <!--confirm password -->
                        <div class="register-confirm register-parent">
                            <label for="input-confirm" class="register-label register-label-longtext">Nhập lại mật khẩu</label>                    
                            <input type="password" class="register-input" id="input-confirm" name="confirm" required="" autocomplete="off" minlength="8" maxlength="32">
                            <div class="register-tick">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                    
                        <!-- rules -->
                        <div class="rules">
                            <p class="rules-title">
                                <input type="checkbox" id="rules-checkbox">
                                <label for="rules-checkbox" class="mb-0">
                                    Tôi đã đọc và đồng ý với &nbsp;
                                </label>
                                <span class="open-block-rules">Điều khoản sử dụng phầm mềm</span>
                            </p>
                        </div>
                        <!-- btn submit -->
                        <button class="btn-submit" type="submit">
                            <span>Đăng ký tài khoản</span>
                            <div class="btn-icon">
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </div>
                        </button>
                    </form>
                    <!-- tab login -->
                    <div class="tab-login">
                        <span>Đã có tài khoản?  &nbsp;</span>
                        <span class="tab-login-now">Đăng nhập ngay</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="background-right main-content-item">
            <img src="{{ asset('img-smoney/login/loginright.svg') }}" alt="">
        </div>
        <!-- block rules -->
        <div class="block-rules">
            <div class="block-rules-header">
                <div class="block-rules-header-icon">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="block-rules-title">Điều khoản sử dụng</div>
            <div class="block-rules-content">
                Smoney được phép sử dụng các thông tin do người dùng đăng ký để thực hiện tất cả các hoạt động liên quan nhằm kết nối giữa người đi vay và người cho vay.
                <br><br>
                Smoney có quyền thay đổi các quy định sử dụng phần mềm mà không cần báo trước và không cần sự chấp thuận của người dùng. Các thay đổi và hiệu lực áp dụng của các thay đổi sẽ được công bố bằng hình thức mà Smoney cho là phù hợp.
                <br><br>
                Đơn đăng ký này cùng các điều kiện, điều khoản điều kiện tạo nên một hợp đồng pháp lý giữa tôi và Smoney.
                <br><br>
                Bằng việc tích vào ô đồng ý đăng ký tài khoản trên Smoney, tôi xác nhận đã nhận, đã đọc, hiểu rõ và đồng ý với các điều khoản và điều kiện trên.”
            </div>
        </div>
    </div>
    <!-- modal -->
    <div class="modal fade" id="UserInfomodal"   role="dialog" aria-labelledby="UserInfomodalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="UserInfomodalLabel">Thông tin tài khoản của bạn</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="text-info font-italic mb-2 font-weight-bold">Bạn có thể xác nhận tài khoản của bạn thông qua số điện thoại hoặc email bạn đã đăng ký!</h6>
                    <div class="container-fuild">
                        <div class="row">
                            <!-- full name -->
                            <div class="col-md-4 mb-2">
                                <span class="font-weight-bold">Họ và tên: </span>
                            </div>
                            <div class="col-md-7 mb-2">
                                <span class="nameUserApi"></span>
                            </div>
                            <div class="col-md-1"></div>
                            <!-- phone -->
                            <div class="col-md-4 mb-2">
                                <span class="font-weight-bold">Số điện thoại: </span>
                            </div>
                            <div class="col-md-7 mb-2">
                                <span class="namePhoneApi"></span>
                            </div>
                            <div class="col-md-1 send-verified-phone mb-2">
                                <i class="fas fa-paper-plane"></i>
                            </div>
                            <!-- email -->
                            <div class="col-md-4 mb-2">
                                <span class="font-weight-bold">Email: </span>
                            </div>
                            <div class="col-md-7 mb-2">
                                <span class="nameEmailApi"></span>
                            </div>
                            <div class="send-verified-email col-md-1 mb-2">
                                <i class="fas fa-paper-plane"></i>
                            </div>
                        </div>
                    </div>
                    <div class="sendEmailSuccess">
                        <p class="font-weight-bold text-success mb-1 mt-2">Gửi Email xác thực thành công!</p>
                        <span>Hãy truy cập Email của bạn để xác thực tài khoản, sau đó làm theo các bước hướng dẫn để lấy lại mật khẩu tài khoản của bạn</span>
                    </div>
                    <div class="sendEmailFail">
                        <p class="font-weight-bold text-danger mb-1 mt-2">Gửi Email xác thực thất bại!</p>
                        <span>Chúng tôi không thể gửi Email xác thực đến Email của bạn. Vui lòng liên hệ: số điện thoại <span class="font-italic text-info">012345678</span> hoặc email: <span class="font-italic text-info">abc@gmail.com</span> để được hỗ trợ</span>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- can't find phone -->
    <div class="modal fade" id="CantFindPhone"   role="dialog" aria-labelledby="CantFindPhoneLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CantFindPhoneLabel">Thông báo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="text-danger font-italic font-weight-bold">Số điện thoại của bạn chưa được đăng ký trong hệ thống</h6>
                </div>
            </div>
        </div>
    </div>

    @if(Session::has('action') && Session::get('action')=="modalOpen")
    <!-- modal verifi device -->
    <div class="modal fade" id="verifiDevice" tabindex="-1" role="dialog" aria-labelledby="verifiDeviceLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifiDeviceLabel">Thông báo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('student.successDevice') }}" method="post">
                    <div class="modal-body">
                        <h4 class="text-danger">Chúng tôi nhận thấy bạn đăng nhập trên một thiết bị lạ: </h4>
                        <span>Vui lòng nhập mã xác nhận được gửi đến email của bạn</span>
                            @csrf
                            <input type="text" class="form-control" placeholder="mã xác thực" name="key">
                            <input type="hidden" name="idUser" value="{{ Session::get('userID') }}">
                            <input type="hidden" name="phone" value="{{ Session::get('phone') }}">
                            <input type="hidden" name="passwordEncrypt" value="{{ Session::get('passwordEncrypt') }}">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-info" type="submit">Xác thực</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    <!-- /modal verifi device -->
    <!-- js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/Smoney/Homepage/login.js') }}"></script>
    <script type="text/javascript">
        @if(Session::has('action') && Session::get('action')=="modalOpen")
            $("#verifiDevice").modal("show");
        @endif
        @if(isset($mode) && $mode == 'register')
            autoClickRegister();
        @endif



        var sdt,email;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".form-forgot").submit(function(e) {
            e.preventDefault();
            let form = $(this);
            let url = form.attr('action');
            let method = form.attr('method');
            $.ajax({
                method: method,
                url: url,
                data: {'phone': $(this).find(".enter-input").val()},
                success: function(data)
                {
                    if(data['status'] == 'success'){
                        $(".nameUserApi").text(data['name']);
                        $(".namePhoneApi").text(data['sdt']);
                        $(".nameEmailApi").text(data['email']);
                        $("#UserInfomodal").modal("show");
                        sdt = data['sdt'];
                        email = data['email'];
                    }
                    if(data['status'] == 'fail'){
                        $("#CantFindPhone").modal("show");
                    }
                }
            });
        });
        $(".send-verified-email").click(function(){
            $.ajax({
                method: "POST",
                url: "{!! route('student.sendMail') !!}",
                data: {'sdt':sdt,'email': email},
                success: function(data)
                {
                    if(data['status'] == 'success'){
                        setTimeout(function(){
                            $(".send-verified-email").empty();
                            $(".send-verified-email").append('<i class="fas fa-check"></i>');
                            $(".send-verified-email").css("background","#ffbd01");
                            $(".send-verified-email").unbind( "click");
                            $(".sendEmailFail").slideUp();
                            $(".sendEmailSuccess").slideDown();
                        },2000)
                    }
                    if(data['status'] == 'fail'){
                        setTimeout(function(){
                            $(".send-verified-email").empty();
                            $(".send-verified-email").append('<i class="fas fa-check"></i>');
                            $(".send-verified-email").css("background","#ffbd01");
                            $(".send-verified-email").unbind( "click");
                            $(".sendEmailSuccess").slideUp();
                            $(".sendEmailFail").slideDown();
                        },2000)
                    }
                }
            });
        });
        $('#UserInfomodal').on('hidden.bs.modal', function (e) {
            let checkSendMail = $(".send-verified-email i");
            if(!checkSendMail.hasClass("fa-paper-plane")){
                location.reload();
            }            
        })

        //  select address
        $("#select_province").change(function() {
            $.ajax({
                method: "POST",
                url: "{!! route('student.findDistrict') !!}",
                data: {'provinceID': $(this).val()},
                success: function(data)
                {
                    if(data['status'] === "success")
                    {
                        let district = data['district_address'];
                        $("#select_district").empty();
                        $("#select_district").append('<option hidden="" value="">Quận / Huyện</option>');
                        district.forEach((item, index) => {
                            $("#select_district").append(`<option value="${item['districtid']}">${item['type']} ${item['name']}</option>`);
                        })
                    }
                }
            });
        })
        $("#select_district").change(function() {
            $.ajax({
                method: "POST",
                url: "{!! route('student.findWard') !!}",
                data: {'districtID': $(this).val()},
                success: function(data)
                {
                    if(data['status'] === "success")
                    {
                        let ward = data['ward_address'];
                        $("#select_ward").empty();
                        $("#select_ward").append('<option hidden="" value="">Phường / Xã</option>');
                        ward.forEach((item, index) => {
                            $("#select_ward").append(`<option value="${item['wardid']}">${item['type']} ${item['name']}</option>`);
                        })
                    }
                }
            });
        })
        $("#select_ward").change(function() {
            let fullAddress = 
            `${$("#select_ward option:selected").text()} - ${$("#select_district option:selected").text()} - ${$("#select_province option:selected").text()}`;
            $("#input-address").val(fullAddress);
        })
    </script>

</body>
</html>