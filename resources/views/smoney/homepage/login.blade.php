<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login | Smoney</title>
   <link rel="shortcut icon" href="{{ asset('img-smoney/smoney.png') }}">
<!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
   <link rel="stylesheet" href="{{ asset('css/Smoney/Homepage/login.css') }}">
   <style>
      @font-face {
         font-family: smoneyFont;
         src: url("{{ asset('font/AvertaStdCY_Regular_3.otf')  }}");
      }
      body,div, span, a, p ,h1, h2, h3, h4, h5, h6,li{
         font-family: smoneyFont !important;
      }
      /*.box,{
         background-image: url("{{ asset('img-smoney/Ellipse 3.png')  }}");
         background-size: cover;
         background-position: top;
         background-repeat: no-repeat;
      }*/
   </style>


</head>
<body>
   @if ($errors->any())
   <div class="error-notification">
      <ul>
         @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
         @endforeach
      </ul>
   </div>
   @endif

   <div class="materialContainer">
      <div class="box">
         <div class="title">ĐĂNG NHẬP</div>
         <form action="{{ route('student.login') }}" method="post">
            @csrf
            <div class="input">
               <label for="input-phone">Số điện thoại</label>
               <input type="text" name="phone" id="input-phone">
               <span class="spin"></span>
            </div>

            <div class="input">
               <label for="input-pass">Mật khẩu</label>
               <input type="password" name="password" id="input-pass">
               <span class="spin"></span>
            </div>

            <div class="button login">
               <button type="submit">
                  <span>Đăng nhập</span> <i class="fa fa-check"></i>
               </button>
            </div>
         </form>

         <a href="#" class="pass-forgot">Quên mật khẩu?</a>

      </div>

      <div class="overbox">
         <div class="material-button alt-2"><span class="shape"></span></div>

         <div class="title">ĐĂNG KÝ</div>

         <form action="{{ route('student.register') }}" method="post">
            @csrf
            <div class="input">
               <label for="input-register-fullname">Họ và tên</label>
               <input type="text" name="fullname" id="input-register-fullname">
               <span class="spin"></span>
            </div>

            <div class="input">
               <label for="input-register-phone">Số điện thoại</label>
               <input type="text" name="phone" id="input-register-phone">
               <span class="spin"></span>
            </div>

            <div class="input">
               <label for="input-register-password">Mật khẩu</label>
               <input type="password" name="password" id="input-register-password" minlength="8" maxlength="32">
               <span class="spin"></span>
            </div>
            <div class="button">
               <button type="submit">
                  <span>Đăng ký</span>
               </button>
            </div>
         </form>
      </div>
   </div>



   <!-- js -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

   <script type="text/javascript">
      $(function() {
         $(".input input").focus(function() {

            $(this).parent(".input").each(function() {
               $("label", this).css({
                  "line-height": "18px",
                  "font-size": "18px",
                  "font-weight": "100",
                  "top": "0px"
               })
               $(".spin", this).css({
                  "width": "100%"
               })
            });
         }).blur(function() {
            $(".spin").css({
               "width": "0px"
            })
            if ($(this).val() == "") {
               $(this).parent(".input").each(function() {
                  $("label", this).css({
                     "line-height": "60px",
                     "font-size": "24px",
                     "font-weight": "300",
                     "top": "10px"
                  })
               });

            }
         });

         $(".button").click(function(e) {
            var pX = e.pageX,
               pY = e.pageY,
               oX = parseInt($(this).offset().left),
               oY = parseInt($(this).offset().top);

            $(this).append('<span class="click-efect x-' + oX + ' y-' + oY + '" style="margin-left:' + (pX - oX) + 'px;margin-top:' + (pY - oY) + 'px;"></span>')
            $('.x-' + oX + '.y-' + oY + '').animate({
               "width": "500px",
               "height": "500px",
               "top": "-250px",
               "left": "-250px",

            }, 600);
            $("button", this).addClass('active');
         })

         $(".alt-2").click(function() {
            if (!$(this).hasClass('material-button')) {
               $(".shape").css({
                  "width": "100%",
                  "height": "100%",
                  "transform": "rotate(0deg)"
               })

               setTimeout(function() {
                  $(".overbox").css({
                     "overflow": "initial"
                  })
               }, 600)

               $(this).animate({
                  "width": "140px",
                  "height": "140px"
               }, 500, function() {
                  $(".box").removeClass("back");

                  $(this).removeClass('active')
               });

               $(".overbox .title").fadeOut(300);
               $(".overbox .input").fadeOut(300);
               $(".overbox .button").fadeOut(300);

               $(".alt-2").addClass('material-buton');
            }

         })

         $(".material-button").click(function() {

            if ($(this).hasClass('material-button')) {
               setTimeout(function() {
                  $(".overbox").css({
                     "overflow": "hidden"
                  })
                  $(".box").addClass("back");
               }, 200)
               $(this).addClass('active').animate({
                  "width": "700px",
                  "height": "700px"
               });

               setTimeout(function() {
                  $(".shape").css({
                     "width": "50%",
                     "height": "50%",
                     "transform": "rotate(45deg)"
                  })

                  $(".overbox .title").fadeIn(300);
                  $(".overbox .input").fadeIn(300);
                  $(".overbox .button").fadeIn(300);
               }, 700)

               $(this).removeClass('material-button');

            }

            if ($(".alt-2").hasClass('material-buton')) {
               $(".alt-2").removeClass('material-buton');
               $(".alt-2").addClass('material-button');
            }

         });

      });
   </script>
</body>
</html>