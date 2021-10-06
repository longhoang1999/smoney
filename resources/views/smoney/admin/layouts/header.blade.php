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
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}" id="header-logo">
                    <img src="{{ asset('img-smoney/img-students/logo.svg') }}" alt="" class="header-logo-item">
                    <div class="header-logo-name">
                        <img src="{{ asset('img-smoney/img-students/name-logo.svg') }}" alt="" class="header-logo-item">
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
                            <a href="#" id="nav-link">Quản lý nhà trường</a>
                        </li>
                        <li class="menu-service nav-item">
                            <a href="#" id="nav-link">Quản lý ngân hàng</a>
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
                            <div class="information-user" title="{{ $name }} - Admin Smoney">
                                <div class="info-avatar" 
                                    @if($avatar == "")
                                        style="background: url('{{ asset('img-smoney/img-students/logo.svg') }}')"
                                    @else
                                        style="background: url('{{ asset($avatar)  }}') no-repeat;" 
                                    @endif
                                >
                                </div>
                                <span class="name-user">
                                    <span>{{ $name }} - Admin Smoney</span>
                                    <i class="fas fa-sort-down"></i>
                                </span>
                            </div>
                            <div class="information-more">
                                <a href="{{ route('admin.dashboard') }}" class="item-information">
                                    Thông tin chung
                                </a>
                                <a href="{{ route('admin.adminSchool') }}" class="item-information">
                                    Quản lý nhà trường
                                </a>
                                <a href="{{ route('admin.bankAccount') }}" class="item-information">
                                    Quản lý ngân hàng
                                </a>
                                <a href="{{ route('admin.adminAccount') }}" class="item-information">
                                    Quản lý sinh viên
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