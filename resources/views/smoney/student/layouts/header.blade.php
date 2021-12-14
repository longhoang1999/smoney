<?php 
    use Carbon\Carbon;
    use App\Models\SmoneyModels\Student;
    use App\Models\SmoneyModels\NhaTruong;
    use App\Models\SmoneyModels\NganHang;

    Carbon::setLocale('vi');
    use App\Models\SmoneyModels\Notification;
    $findNo = Notification::where("no_id_to" , Auth::user()->tks_sotk)
            ->where("no_type_to", "2")
            ->orderBy('no_time', 'desc')
            ->take(15)
            ->get();
 ?>

<!-- Come back -->
<div id="header">
    <div class="come-back ">
        <div class="container">
            <div class="row justify-content-between px-3">
                <a href="{{ route('homepage.homepage_old') }}" class="link-homepage">
                    <i class="fas fa-long-arrow-alt-left"></i>
                    <span>Trang chủ Smoney</span>
                </a>
                <a href="#">
                    <span>Tải app</span>
                    <i class="fas fa-download"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- Header -->
    <header class="header">
        <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
                <!-- logo -->
                <a class="navbar-brand" href="{{ route('student.student') }}" id="header-logo">
                    <img src="{{ asset('img-smoney/img-students/logo.svg') }}" alt="" class="header-logo-item">
                    <div class="header-logo-name">
                        <img src="{{ asset('img-smoney/img-students/name-logo.svg') }}" alt="" class="header-logo-item">

                        <div class="tag-page-none header-logo-item-none">
                            <img src="{{ asset('img-smoney/img-students/tag-logo.svg') }}" alt="">
                            <span>STUDENT</span>
                        </div>
                    </div>
                    <div class="tag-page header-logo-item position">
                        <img src="{{ asset('img-smoney/img-students/tag-logo.svg') }}" alt="">
                        <span>STUDENT</span>
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse navbar-nav" id="navbarSupportedContent">
                    <!-- menu nav -->
                    <ul class="menu-nav navbar-nav">
                        <li class="menu-service nav-item">
                            <span class="link-service">Khoản vay <i class="fas fa-sort-down"></i></span>
                            <ul class="more-service">
                                <li>
                                    <a href="#">Example 1</a>
                                </li>
                                <li>
                                    <a href="#">Example 2</a>
                                </li>
                                <li>
                                    <a href="#">Example 3</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-service nav-item">
                            <span class="link-service">Việc làm <i class="fas fa-sort-down"></i></span>
                            <ul class="more-service">
                                <li>
                                    <a href="#">Example 1</a>
                                </li>
                                <li>
                                    <a href="#">Example 2</a>
                                </li>
                                <li>
                                    <a href="#">Example 3</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-service nav-item">
                            <a href="{{ route('student.marketplace') }}" id="nav-link">Marketplace</a>
                        </li>
                    </ul>
                    <div class="navbar-nav ml-lg-auto mr-lg-0 personal-info-nav">
                        <!-- notification -->
                        <div class="nav-notification nav-item">
                            <div class="icon-bell">
                                <i class="fas fa-bell"></i>
                                @for($i = 0; $i < count($findNo); $i++)
                                    <?php 
                                        if($findNo[$i]->no_check_read == "2"){
                                            echo '<div class="bell-danger"></div>';
                                            break;
                                        }
                                     ?>
                                @endfor
                            </div>
                            <!--  item-info | item-warning | item-danger -->
                            <div class="more-notification">
                                <p class="more-notification-title">Thông báo</p>
                                @foreach($findNo as $no)
                                    <?php 
                                        if($no->no_type_from == "1"){
                                            $sender = "Smoney";
                                        }else if($no->no_type_from == "2"){
                                            $sender = Student::where("_id", $no->no_id_from)
                                                        ->select("hoten")
                                                        ->first()
                                                        ->hoten;
                                        }else if($no->no_type_from == "3"){
                                            $sender = NhaTruong::where("nt_id", $no->no_id_from)
                                                        ->select("nt_ma")
                                                        ->first()
                                                        ->nt_ma;
                                        }else if($no->no_type_from == "4"){
                                            $sender = NganHang::where("nn_id", $no->no_id_from)
                                                        ->select("nn_ten")
                                                        ->first()
                                                        ->nn_ten;
                                        }else{
                                            $sender = "Không xác định";
                                        }
                                     ?>
                                    <div data-link="{{ url('/').'/'.$no->no_link }}"
                                         data-id="{{ $no->no_id }}" 
                                        class="item-notification {{ $no->no_type }}
                                    ">
                                        @if($no->no_check_read == "2")
                                            <div class="bell-danger-unread"></div>
                                        @endif
                                        <div class="notification-title">
                                            <img src="{{ asset('img-smoney/smoney.png') }}" alt="">
                                        </div>
                                        <div class="notification-content">
                                            <small>Từ: {{ $sender }}</small>
                                            <span>{{ $no->no_content }}</span>
                                            <small class="font-italic">
                                                <?php 
                                                    $notime = Carbon::parse($no->no_time) 
                                                ?>
                                                {{ $notime->diffForHumans(Carbon::now()) }} - 
                                                {{ date("h:i A d/m/Y", strtotime($no->no_time)) }}
                                            </small>
                                        </div>
                                    </div>
                                @endforeach
                                @if(count($findNo) == "0")
                                    <p class="font-italic">Bạn không có thông báo nào</p>
                                @endif
                            </div>
                        </div>
                        <!-- avatar user -->
                        <div class="information-user-avatar nav-item">
                            <div class="information-user">
                                <div class="info-avatar" 
                                    @if($avatar == "")
                                        style="background: url('{{ asset('img-smoney/img-students/avatar-default.png')}}')"
                                    @else
                                        style="background: url('{{ asset($avatar)  }}') no-repeat;" 
                                    @endif
                                >
                                </div>
                                <span class="name-user">
                                    <span>{{ $name }} </span>
                                    <i class="fas fa-sort-down"></i>
                                </span>
                            </div>
                            <div class="information-more">
                                <a href="{{ route('student.information') }}" class="item-information">
                                    Thông tin tài khoản
                                </a>
                                <a href="{{ route('student.applyLoan') }}" class="item-information">
                                    Hồ sơ khoản vay
                                </a>
                                <a href="{{ route('student.infoLoan') }}" class="item-information">
                                    Thông tin khoản vay
                                </a>
                                <a href="{{ route('student.paidLoan') }}" class="item-information">
                                    Thông tin đã thanh toán
                                </a>
                                <a href="{{ route('student.logout') }}" class="item-information">
                                    Đăng xuất
                                </a>
                            </div>
                        </div>
                    </div> 
                </div>
            </nav>
        </div>
    </header>
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var $url_path = '{!! url('/') !!}';

    $(".item-notification").click(function(){
        let link = $(this).data('link');
        let id = $(this).data('id');
        $.ajax({
            url:"{!! route('home.changeCheckRead') !!}",
            method: "POST",
            data:{
                "id": id
            },
            success:function(data)
            {
                console.log(data)
                if(data.trim() == "done")
                    location.replace(link);
                else
                    alert("Có lỗi trong quá trình thực hiện");
            }
        });
    })
</script> 