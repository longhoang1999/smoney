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
                <a class="navbar-brand" href="{{ route('bank.bankDashboard') }}" id="header-logo">
                    <img src="{{ asset('img-smoney/img-students/logo.svg') }}" alt="" class="header-logo-item">
                    <div class="header-logo-name">
                        <img src="{{ asset('img-smoney/img-students/name-logo.svg') }}" alt=""
                            class="header-logo-item">

                        <div class="tag-page-none header-logo-item-none">
                            <img src="{{ asset('img-smoney/img-students/tag-logo.svg') }}" alt="">
                            <span>LENDER</span>
                        </div>
                    </div>
                    <div class="tag-page header-logo-item position">
                        <div class='img'>
                            <span>LENDER</span>
                        </div>
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
                            <a href="#" id="nav-link">Thông tin chung</a>
                        </li>
                        <li class="menu-service nav-item">
                            <span class="link-service">Thông tin khoản vay<i class="fas fa-sort-down"></i></span>
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
                            <a href="#" id="nav-link">Lịch sử khoản vay</a>
                        </li>
                        <li class="menu-service nav-item">
                            <a href="#" id="nav-link">Thông tin việc làm</a>
                        </li>
                    </ul>
                    <div class="navbar-nav ml-lg-auto mr-lg-0 personal-info-nav">
                        <!-- notification -->
                        <div class="nav-notification nav-item">
                            <div class="icon-bell">
                                <i class="fas fa-bell"></i>
                                <div class="bell-danger"></div>
                            </div>
                            <div class="more-notification">
                                <a href="#" class="item-notification">
                                    Khoản vay 20.000.000đ đến hạn thanh toán
                                </a>
                                <a href="#" class="item-notification">
                                    Khoản vay 20.000.000đ đến hạn thanh toán
                                </a>
                            </div>
                        </div>
                        <!-- avatar user -->
                        <div class="information-user-avatar nav-item">
                            <div class="information-user" title="{{ $name }}">
                                <div class="info-avatar" 
                                @if ($avatar == '')
                                    style="background: url('{{ asset('img-smoney/img-students/avatar-default.png')}}')"
                                @else
                                    style="background: url('{{ asset($avatar) }}') no-repeat;"
                                @endif
                                    >
                                </div>
                                <span class="name-user">
                                    <span>{{ $name }}</span>
                                    <i class="fas fa-sort-down"></i>
                                </span>
                            </div>
                            <div class="information-more">
                                <a href="{{ route('bank.schoolinfo') }}" class="item-information">
                                    Thông tin nhà trường
                                </a>
                                <a href="{{ route('bank.loanwait') }}" class="item-information">
                                    Khoản vay chờ xử lý
                                </a>
                                <a href="{{ route('bank.feedBackLoanStudent') }}" class="item-information">
                                    Phản hồi đề xuất
                                </a>
                                <a href="{{ route('bank.loaninfo') }}" class="item-information">
                                    Thông tin khoản vay
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
