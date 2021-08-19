@extends('smoney/student/layouts/index')
@section('title')
    Yêu cầu khoản vay
@parent
@stop
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/student.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/tabbular.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/animate/animate.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/jquery.circliful.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/owl_carousel/css/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/owl_carousel/css/owl.theme.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/index.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/studentResponsive.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Homepage/responsive_footer.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/test4.css') }}">
<link href="{{ asset('dropzone/css/dropzone.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
<style>
    .square-select::before{
      content: '';
      background: url('{{ asset("img-smoney/home-page/tick.png")  }}') no-repeat;
      background-size: cover;
    }
    .headroom--pinned{
        transform: translateY(-100%) !important;
    }
    .headroom--top{
        transform: translateY(0%) !important;
    }
</style>
@stop
@section('content')
@include('smoney/student/layouts/header')

<!-- information user -->
<div class="information">
    <div class="row" style="margin-top: 7.5rem;">
        <div class="col-12 text-center block-top-info">
            <div class="main-avatar" 
                @if($avatar == "")
                    style="background: url('{{ asset('img-smoney/img-students/avatar-default.png')  }}')"
                @else
                    style="background: url('{{ asset($avatar)  }}')"
                @endif
            >
            </div>
            <div class="main-content">
                <span>{{ $name }}</span>
            </div>
            <a href="#" class="user-page">(Trang cá nhân)</a>
        </div>
    </div>
</div>
<div class="block-main">
    <div class="block-main-left">
        <div class="block-timeline">
            <ul class="timeline">
                <li class="timeline-one active">
                    <span>Thông tin khoản vay</span>
                </li>
                <div class="line"></div>
                <li class="timeline-two">
                    <span>Thông tin cá nhân</span>
                </li>
                <div class="line"></div>
                <li class="timeline-three">
                    <span>Cơ sở đào tạo</span>  
                </li>
                <div class="line"></div>
                <li class="timeline-four">
                    <span>Việc làm</span>
                </li>
                <div class="line"></div>
                <li class="timeline-five">
                    <span>Tùy chọn khác (nếu có)</span>
                </li>
                <div class="line"></div>
                <li class="timeline-six">
                    <span>Điều khoản Smoney</span>
                </li>
          </ul>
        </div>
        <div class="block-save">
            <span class="main-nottop-title-detail">Bạn có thể lưu lại hồ sơ và hoàn thiện sau!</span>
            <div class="save-file">
                <span class="mr-1">Lưu lại hồ sơ</span>
                <i class="fas fa-save"></i>
            </div>
        </div>
    </div>
    <!--  main -->
    <!-- include here -->
    <div class="main">
    </div>
</div>

<div class="modal fade" id="modalNotExist" tabindex="-1" role="dialog" aria-labelledby="modalNotExistLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNotExistLabel">Bạn khai báo thiếu thông tin!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>     
            </div>
            <div class="modal-body">
                <p class="text-danger">Bạn nhập thiếu trường "<span class="font-italic text-info notExistContent"></span>"</p>
            </div>
        </div>
    </div>
</div>



<!-- back to top -->
<div class="back_to_top">
    <i class="fas fa-angle-up"></i>
</div>
@stop


@section('footer-js')
<script type="text/javascript" src="{{ asset('js/Smoney/Student/student.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/frontend/jquery.circliful.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/wow/js/wow.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/frontend/carousel.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/frontend/index.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
<script type="text/javascript">
    var maHS = null, sent = null;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:"{!! route('student.loadTimeline') !!}",
        method: "GET",
         data:{"page": "thongtinkhoanvay1"},
        // data:{"page": "thongtincanhan1"},
        // data:{"page": "thongtincanhan2"},
        // data:{"page": "thongtincuchu1"},
        // data:{"page": "thongtincuchu2"},
        // data:{"page": "thongtincuchu3"},
        // data:{"page": "cosodaotao1"},
        // data:{"page": "cosodaotao2"},
        // data:{"page": "cosodaotao3"},
        // data:{"page": "cosodaotao4"},
        // data:{"page": "vieclam1"},
        // data:{"page": "vieclam2"},
        // data:{"page": "vieclam3"},
        // data:{"page": "vieclam4"},
        // data:{"page": "option1"},
        // data:{"page": "option2"},
        // data:{"page": "option3"},
        // data:{"page": "option4"},
        // data:{"page": "otherpage1"},
        // data:{"page": "tag1"},
        // data:{"page": "notification1"},
        // data:{"page": "vote1"},
        // data:{"page": "confirm1"},
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data);
        }
    });

    $(".main").on('click','.square-item',function() {
      if($(this).hasClass("square-select")){
        $(this).removeClass("square-select");
        $(this).parent().parent().find("input[type='hidden']").val("");
      }else{
        let ul = $(this).parent();
        let allLi = ul.find(".square-item");
        allLi.removeClass("square-select");
        $(this).addClass("square-select");
        // add input hidden
        $(this).parent().parent().find("input[type='hidden']").val($(this).data("value"))
      }
    })

    window.addEventListener("scroll", function() {
        var elementTarget = document.getElementById("header");
        if (window.scrollY > 0) {
            $(".block-top-info").slideUp();
        }else{
            $(".block-top-info").slideDown();
        }
    });
    // ngăn tải lại trang
    window.addEventListener('beforeunload', function (e) {
        e.preventDefault(); 
        if(sent == null){
            if(maHS == null)
                delete e['returnValue'];
            else
                e.returnValue = '';
        }else{
            delete e['returnValue'];
        }
    });

    $(".save-file").click(function() {
        if(maHS != null){
            $.ajax({
                url:"{!! route('student.loadTimeline') !!}",
                method: "GET",
                data:{
                    "pagepresent" : "savedRequest",
                    "data" : maHS
                },
                success:function(data)
                {
                  alert("Thông tin của bạn đã được lưu!");
                  sent = "true";
                  location.replace("{{ route('student.student') }}");
                }
            });
        }else{
            alert("Bạn chưa hoàn thành thông tin!");
        }
    })

    function scrollToMain(){
        $(window).scrollTop($('.main').offset().top - 20);
    }
</script>
@stop