<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Smoney</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-5.14.0-web/css/all.css') }}">
    <link rel="shortcut icon" href="{{ asset('img-smoney/smoney.png') }}">
    <link rel="stylesheet" href="{{ asset('css/Smoney/Homepage/login.css') }}">
    <style>
        @font-face {
            font-family: smoneyFont;
            src: url("{{ asset('font/AvertaStdCY_Regular_3.otf') }}");
        }

        * {
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

        @if (Session::has('error'))
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
                    <p class="title">Qu??n m???t kh???u?</p>
                    <form action="{{ route('student.searchPhone') }}" method="post" class="form-forgot">
                        <!-- phone -->
                        <div class="enter-phone enter-parent">
                            <span class="enter-phone-title enter-title">Nh???p s??? ??i???n tho???i c???a b???n</span>
                            <input type="text" class="enter-phone-input enter-input"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                required name="phone" autocomplete="off">
                            <div class="enter-phone-icon enter-icon ">
                                <i class="icon-tick fas fa-check"></i>
                                <i class="icon-times fas fa-times"></i>
                            </div>
                        </div>
                        <!-- btn submit -->
                        <button class="btn-submit btn-full-width" type="submit">
                            <span>T??m t??i kho???n</span>
                            <div class="btn-icon">
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </div>
                        </button>
                    </form>
                    <!-- tab login -->
                    <div class="tab-login tab-login-2">
                        <span>???? c?? t??i kho???n? &nbsp;</span>
                        <span class="tab-login-now-2">????ng nh???p ngay</span>
                    </div>
                </div>
                <!-- login -->
                <div class="block-login">
                    <p class="title">
                        ????ng nh???p
                    </p>
                    <form action="{{ route('student.login') }}" class="login-form" method="post">
                        @csrf
                        <!-- phone -->
                        <div class="enter-phone enter-parent">
                            <span class="enter-phone-title enter-title">S??? ??i???n tho???i</span>
                            <input type="text" class="enter-phone-input enter-input"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                required name="phone" autocomplete="off">
                            <div class="enter-phone-icon enter-icon ">
                                <i class="icon-tick fas fa-check"></i>
                                <i class="icon-times fas fa-times"></i>
                            </div>
                        </div>
                        <!-- password -->
                        <div class="enter-password enter-parent">
                            <span class="enter-password-title enter-title">M???t kh???u</span>
                            <input type="password" class="enter-password-input enter-input" minlength="8" maxlength="32"
                                required name="password" autocomplete="off">
                            <div class="enter-password-icon enter-icon">
                                <i class="icon-open-eye fas fa-eye"></i>
                                <i class="icon-close-eye fas fa-eye-slash"></i>
                            </div>
                        </div>
                        <!-- forgot pass -->
                        <span class="forgot-pass">
                            Qu??n m???t kh???u?
                        </span>
                        <div class="error-responsive-phone"></div>
                        <!-- btn submit -->
                        <div class="block-btn-submit">
                            <button class="btn-submit" type="submit">
                                <span>????ng nh???p</span>
                                <div class="btn-icon">
                                    <i class="fas fa-long-arrow-alt-right"></i>
                                </div>
                            </button>
                            @if (Session::has('action') && Session::get('action') == 'modalOpen')
                                <button class="btn-submit btn-verifyfi" type="button" data-toggle="modal"
                                    data-target="#verifiDevice">
                                    <span>X??c th???c</span>
                                    <div class="btn-icon">
                                        <i class="fas fa-laptop-house"></i>
                                    </div>
                                </button>
                            @endif
                        </div>
                    </form>
                    <a class="login-by-fb" href="{{url('/getInfo-facebook/facebook')}}">
                        <i class="fab fa-facebook-square"></i>
                        <span>????ng nh???p b???ng facebook</span>
                    </a>
                    <a class="login-by-google" href="{{url('/getInfo-google/google')}}">
                        <i class="fab fa-google"></i>
                        <span>????ng nh???p b???ng google</span>
                    </a>
                    <div class="tab-register">
                        <span>????ng k?? t??i kho???n</span>
                    </div>
                </div>


                <!-- register -->
                <div class="block-register">
                    <p class="title">
                        ????ng k?? t??i kho???n
                    </p>
                    <form action="{{ route('student.register') }}" class="register-form" method="post">
                        @csrf
                        <!-- full name -->
                        <div class="register-fullname register-parent">
                            <label for="input-fullname" class="register-label">H??? v?? t??n</label>
                            <input type="text" class="register-input" id="input-fullname" name="fullname" required=""
                                autocomplete="off">
                        </div>
                        <!-- phone -->
                        <div class="register-phone register-parent">
                            <label for="input-phone" class="register-label">S??? ??i???n tho???i</label>
                            <input type="text" class="register-input" id="input-phone" name="phone"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                required="" autocomplete="off">
                        </div>
                        <!-- email -->
                        <div class="register-email register-parent">
                            <label for="input-email" class="register-label">Email</label>
                            <input type="email" class="register-input" id="input-email" name="email" autocomplete="off">
                        </div>
                        <!-- address -->
                        <!-- <div class="register-address register-parent">
                            <label for="input-address" class="register-label">?????a ch???</label>
                            <div class="block_select_address">
                                <select id="select_province">
                                    <option hidden="" value="">Th??nh ph??? / T???nh</option>
                                    @foreach ($province_address as $value)
                                        <option value="{{ $value->provinceid }}">{{ $value->type }}
                                            {{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <select id="select_district">
                                    <option hidden="" value="">Qu???n / Huy???n</option>
                                </select>
                                <select id="select_ward">
                                    <option hidden="" value="">Ph?????ng / X??</option>
                                </select>
                            </div>
                            <input type="text" class="register-input" id="input-address" name="address"
                                autocomplete="off">
                        </div> -->
                        <!-- password -->
                        <div class="register-password register-parent">
                            <label for="input-password" class="register-label">M???t kh???u</label>
                            <input type="password" class="register-input" id="input-password" name="password"
                                required="" autocomplete="off" minlength="8" maxlength="32">
                            <div class="register-tick">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                        <!--confirm password -->
                        <div class="register-confirm register-parent">
                            <label for="input-confirm" class="register-label register-label-longtext">Nh???p l???i m???t
                                kh???u</label>
                            <input type="password" class="register-input" id="input-confirm" name="confirm" required=""
                                autocomplete="off" minlength="8" maxlength="32">
                            <div class="register-tick">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>

                        <!-- rules -->
                        <div class="rules">
                            <p class="rules-title">
                                <input type="checkbox" id="rules-checkbox">
                                <label for="rules-checkbox" class="mb-0">
                                    T??i ???? ?????c v?? ?????ng ?? v???i &nbsp;
                                </label>
                                <span class="open-block-rules">??i???u kho???n s??? d???ng ph???m m???m</span>
                            </p>
                        </div>
                        <!-- btn submit -->
                        <button class="btn-submit" type="submit">
                            <span>????ng k?? t??i kho???n</span>
                            <div class="btn-icon">
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </div>
                        </button>
                    </form>
                    <!-- tab login -->
                    <div class="tab-login">
                        <span>???? c?? t??i kho???n? &nbsp;</span>
                        <span class="tab-login-now">????ng nh???p ngay</span>
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
            <div class="block-rules-title">??i???u kho???n s??? d???ng</div>
            <div class="block-rules-content">
                Smoney ???????c ph??p s??? d???ng c??c th??ng tin do ng?????i d??ng ????ng k?? ????? th???c hi???n t???t c??? c??c ho???t ?????ng li??n quan
                nh???m k???t n???i gi???a ng?????i ??i vay v?? ng?????i cho vay.
                <br><br>
                Smoney c?? quy???n thay ?????i c??c quy ?????nh s??? d???ng ph???n m???m m?? kh??ng c???n b??o tr?????c v?? kh??ng c???n s??? ch???p thu???n
                c???a ng?????i d??ng. C??c thay ?????i v?? hi???u l???c ??p d???ng c???a c??c thay ?????i s??? ???????c c??ng b??? b???ng h??nh th???c m??
                Smoney cho l?? ph?? h???p.
                <br><br>
                ????n ????ng k?? n??y c??ng c??c ??i???u ki???n, ??i???u kho???n ??i???u ki???n t???o n??n m???t h???p ?????ng ph??p l?? gi???a t??i v??
                Smoney.
                <br><br>
                B???ng vi???c t??ch v??o ?? ?????ng ?? ????ng k?? t??i kho???n tr??n Smoney, t??i x??c nh???n ???? nh???n, ???? ?????c, hi???u r?? v?? ?????ng
                ?? v???i c??c ??i???u kho???n v?? ??i???u ki???n tr??n.???
            </div>
        </div>
    </div>
    <!-- modal -->
    <div class="modal fade" id="UserInfomodal" role="dialog" aria-labelledby="UserInfomodalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="UserInfomodalLabel">Th??ng tin t??i kho???n c???a b???n</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="text-info font-italic mb-2 font-weight-bold">B???n c?? th??? x??c nh???n t??i kho???n c???a b???n th??ng
                        qua s??? ??i???n tho???i ho???c email b???n ???? ????ng k??!</h6>
                    <div class="container-fuild">
                        <div class="row">
                            <!-- full name -->
                            <div class="col-md-4 mb-2">
                                <span class="font-weight-bold">H??? v?? t??n: </span>
                            </div>
                            <div class="col-md-7 mb-2">
                                <span class="nameUserApi"></span>
                            </div>
                            <div class="col-md-1"></div>
                            <!-- phone -->
                            <div class="col-md-4 mb-2">
                                <span class="font-weight-bold">S??? ??i???n tho???i: </span>
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
                        <p class="font-weight-bold text-success mb-1 mt-2">G???i Email x??c th???c th??nh c??ng!</p>
                        <span>H??y truy c???p Email c???a b???n ????? x??c th???c t??i kho???n, sau ???? l??m theo c??c b?????c h?????ng d???n ?????
                            l???y l???i m???t kh???u t??i kho???n c???a b???n</span>
                    </div>
                    <div class="sendEmailFail">
                        <p class="font-weight-bold text-danger mb-1 mt-2">G???i Email x??c th???c th???t b???i!</p>
                        <span>Ch??ng t??i kh??ng th??? g???i Email x??c th???c ?????n Email c???a b???n. Vui l??ng li??n h???: s??? ??i???n tho???i
                            <span class="font-italic text-info">012345678</span> ho???c email: <span
                                class="font-italic text-info">abc@gmail.com</span> ????? ???????c h??? tr???</span>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- can't find phone -->
    <div class="modal fade" id="CantFindPhone" role="dialog" aria-labelledby="CantFindPhoneLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CantFindPhoneLabel">Th??ng b??o</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="text-danger font-italic font-weight-bold">S??? ??i???n tho???i c???a b???n ch??a ???????c ????ng k?? trong
                        h??? th???ng</h6>
                </div>
            </div>
        </div>
    </div>

    @if (Session::has('action') && Session::get('action') == 'modalOpen')
        <!-- modal verifi device -->
        <div class="modal fade" id="verifiDevice" tabindex="-1" role="dialog" aria-labelledby="verifiDeviceLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verifiDeviceLabel">Th??ng b??o</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('student.successDevice') }}" method="post">
                        <div class="modal-body">
                            <h4 class="text-danger">Ch??ng t??i nh???n th???y b???n ????ng nh???p tr??n m???t thi???t b??? l???: </h4>
                            <span>Vui l??ng nh???p m?? x??c nh???n ???????c g???i ?????n email c???a b???n</span>
                            @csrf
                            <input type="text" class="form-control" placeholder="m?? x??c th???c" name="key">
                            <input type="hidden" name="idUser" value="{{ Session::get('userID') }}">
                            <input type="hidden" name="phone" value="{{ Session::get('phone') }}">
                            <input type="hidden" name="passwordEncrypt"
                                value="{{ Session::get('passwordEncrypt') }}">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-info" type="submit">X??c th???c</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    <!-- /modal verifi device -->
    <!-- js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="{{ asset('js/Smoney/Homepage/login.js') }}"></script>
    <script type="text/javascript">
        @if (Session::has('action') && Session::get('action') == 'modalOpen')
            $("#verifiDevice").modal("show");
        @endif
        @if (isset($mode) && $mode == 'register')
            autoClickRegister();
        @endif



        var sdt, email;
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
                data: {
                    'phone': $(this).find(".enter-input").val()
                },
                success: function(data) {
                    if (data['status'] == 'success') {
                        $(".nameUserApi").text(data['name']);
                        $(".namePhoneApi").text(data['sdt']);
                        $(".nameEmailApi").text(data['email']);
                        $("#UserInfomodal").modal("show");
                        sdt = data['sdt'];
                        email = data['email'];
                    }
                    if (data['status'] == 'fail') {
                        $("#CantFindPhone").modal("show");
                    }
                }
            });
        });
        $(".send-verified-email").click(function() {
            $.ajax({
                method: "POST",
                url: "{!! route('student.sendMail') !!}",
                data: {
                    'sdt': sdt,
                    'email': email
                },
                success: function(data) {
                    if (data['status'] == 'success') {
                        setTimeout(function() {
                            $(".send-verified-email").empty();
                            $(".send-verified-email").append('<i class="fas fa-check"></i>');
                            $(".send-verified-email").css("background", "#ffbd01");
                            $(".send-verified-email").unbind("click");
                            $(".sendEmailFail").slideUp();
                            $(".sendEmailSuccess").slideDown();
                        }, 2000)
                    }
                    if (data['status'] == 'fail') {
                        setTimeout(function() {
                            $(".send-verified-email").empty();
                            $(".send-verified-email").append('<i class="fas fa-check"></i>');
                            $(".send-verified-email").css("background", "#ffbd01");
                            $(".send-verified-email").unbind("click");
                            $(".sendEmailSuccess").slideUp();
                            $(".sendEmailFail").slideDown();
                        }, 2000)
                    }
                }
            });
        });
        $('#UserInfomodal').on('hidden.bs.modal', function(e) {
            let checkSendMail = $(".send-verified-email i");
            if (!checkSendMail.hasClass("fa-paper-plane")) {
                location.reload();
            }
        })

        //  select address
        $("#select_province").change(function() {
            $.ajax({
                method: "POST",
                url: "{!! route('student.findDistrict') !!}",
                data: {
                    'provinceID': $(this).val()
                },
                success: function(data) {
                    if (data['status'] === "success") {
                        let district = data['district_address'];
                        $("#select_district").empty();
                        $("#select_district").append(
                        '<option hidden="" value="">Qu???n / Huy???n</option>');
                        district.forEach((item, index) => {
                            $("#select_district").append(
                                `<option value="${item['districtid']}">${item['type']} ${item['name']}</option>`
                                );
                        })
                    }
                }
            });
        })
        $("#select_district").change(function() {
            $.ajax({
                method: "POST",
                url: "{!! route('student.findWard') !!}",
                data: {
                    'districtID': $(this).val()
                },
                success: function(data) {
                    if (data['status'] === "success") {
                        let ward = data['ward_address'];
                        $("#select_ward").empty();
                        $("#select_ward").append('<option hidden="" value="">Ph?????ng / X??</option>');
                        ward.forEach((item, index) => {
                            $("#select_ward").append(
                                `<option value="${item['wardid']}">${item['type']} ${item['name']}</option>`
                                );
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
