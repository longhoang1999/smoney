<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi mật khẩu | Smoney</title>
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
                <li><span>{{ Session::get('error') }}</span></li>
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
                <img src="{{ asset('img-smoney/login/logo-login-page.svg') }}" alt="">
            </div>
            <div class="block-main">
                <!-- login -->
                <div class="block-login">
                    <p class="title">
                        Đổi mật khẩu
                    </p>
                    <form action="{{ route('student.changePass',$key) }}" class="login-form" method="post">
                        @csrf
                        <!-- phone -->
                        <div class="enter-phone enter-parent">
                            <span class="enter-phone-title enter-title enter-title-fly">Số điện thoại</span>
                            <input type="text" class="enter-phone-input enter-input" 
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required readonly="" 
                                name="phone" value="{{ $phone }}" 
                                style="background: #2140a0;opacity: .8;" 
                            >
                            <div class="enter-phone-icon enter-icon ">
                                <i class="icon-tick fas fa-check"></i>
                                <i class="icon-times fas fa-times"></i>
                            </div>                        
                        </div>
                        <!-- password -->
                        <div class="enter-password enter-parent">
                            <span class="enter-password-title enter-title">Mật khẩu mới</span>
                            <input type="password" class="enter-password-input enter-input" minlength="8" maxlength="32" required name="password"> 
                            <div class="enter-password-icon enter-icon">
                                <i class="icon-open-eye fas fa-eye"></i>
                                <i class="icon-close-eye fas fa-eye-slash"></i>
                            </div>
                        </div>
                        <!-- password -->
                        <div class="enter-password-comfirm enter-parent">
                            <span class="enter-password-comfirm-title enter-title">Xác nhận mật khẩu mới</span>
                            <input type="password" class="enter-password-comfirm-input enter-input" minlength="8" maxlength="32" required name="comfirm"> 
                            <div class="enter-password-icon enter-icon">
                                <i class="icon-open-eye fas fa-eye"></i>
                                <i class="icon-close-eye fas fa-eye-slash"></i>
                            </div>
                        </div>

                        <div class="error-responsive-phone"></div>
                        <!-- btn submit -->
                        <button class="btn-submit" type="submit">
                            <span>Đổi mật khẩu</span>
                            <div class="btn-icon">
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="background-right main-content-item">
            <img src="{{ asset('img-smoney/login/loginright.svg') }}" alt="">
        </div>
    </div>

    <!-- js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/Smoney/Homepage/login.js') }}"></script>
</body>
</html>