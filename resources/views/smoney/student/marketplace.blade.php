@extends('smoney/student/layouts/index')
@section('title')
    Marketplace
@parent
@stop
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/student.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/marketplace.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/jobinformation.css') }}">
@stop
@section('content')
@include('smoney/student/layouts/header')
<!-- student - block - content -->
<div class="content">
    <div class="content-banner">
        <div class="content-banner-image">
            <img src="{{asset('img-smoney/img-students/student-header-2.png')}}" alt="">
            <div class="content-banner-title">
                <div class="content-banner-title-icon">
                    <i class="fas fa-store"></i>
                </div>
                <div class="content-nammer-title-content">
                    Marketplace
                </div>
            </div>
        </div>
    </div>
    <div class="hot-deals">
        <div class="hot-deals-image">
            <img src="{{asset('img-smoney/img-students/hotdeals.svg')}}" alt="">
            <div class="hot-deals-image-content">
                <div class="hot-deals-title">
                    Ưu đãi hot
                </div>
                <div class="container hot-deals-content">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- last-content -->
                            <a href="#" class="last-content-top-left-content">
                                <div class="discount-avatar">
                                    <img src="{{ asset('img-smoney/img-students/bg-01.jpg')  }}" alt="">
                                </div>
                                <div class="discount-content">
                                    <p class="text-uppercase discount-title">
                                        Học tiếng anh trực tuyến
                                    </p>
                                    <span class="discount-author">British Council</span>

                                    <div class="discount-price mt-2">
                                        <span class="old-price">7.000.000 VND</span>
                                        <span class="new-price">3.500.000 VND</span>
                                    </div>
                                </div> 
                            </a>
                            <!-- /last-content -->
                        </div>
                        <div class="col-md-6">
                            <!-- last-content -->
                            <a href="#" class="last-content-top-left-content">
                                <div class="discount-avatar">
                                    <img src="{{ asset('img-smoney/img-students/bg-01.jpg')  }}" alt="">
                                </div>
                                <div class="discount-content">
                                    <p class="text-uppercase discount-title">
                                        Học tiếng anh trực tuyến
                                    </p>
                                    <span class="discount-author">British Council</span>

                                    <div class="discount-price mt-2">
                                        <span class="old-price">7.000.000 VND</span>
                                        <span class="new-price">3.500.000 VND</span>
                                    </div>
                                </div> 
                            </a>
                            <!-- /last-content -->
                        </div>
                        <div class="col-md-6">
                            <!-- last-content -->
                            <a href="#" class="last-content-top-left-content">
                                <div class="discount-avatar">
                                    <img src="{{ asset('img-smoney/img-students/bg-01.jpg')  }}" alt="">
                                </div>
                                <div class="discount-content">
                                    <p class="text-uppercase discount-title">
                                        Học tiếng anh trực tuyến
                                    </p>
                                    <span class="discount-author">British Council</span>

                                    <div class="discount-price mt-2">
                                        <span class="old-price">7.000.000 VND</span>
                                        <span class="new-price">3.500.000 VND</span>
                                    </div>
                                </div> 
                            </a>
                            <!-- /last-content -->
                        </div>
                        <div class="col-md-6">
                            <!-- last-content -->
                            <a href="#" class="last-content-top-left-content">
                                <div class="discount-avatar">
                                    <img src="{{ asset('img-smoney/img-students/bg-01.jpg')  }}" alt="">
                                </div>
                                <div class="discount-content">
                                    <p class="text-uppercase discount-title">
                                        Học tiếng anh trực tuyến
                                    </p>
                                    <span class="discount-author">British Council</span>

                                    <div class="discount-price mt-2">
                                        <span class="old-price">7.000.000 VND</span>
                                        <span class="new-price">3.500.000 VND</span>
                                    </div>
                                </div> 
                            </a>
                            <!-- /last-content -->
                        </div>
                        <div class="col-md-6">
                            <!-- last-content -->
                            <a href="#" class="last-content-top-left-content">
                                <div class="discount-avatar">
                                    <img src="{{ asset('img-smoney/img-students/bg-01.jpg')  }}" alt="">
                                </div>
                                <div class="discount-content">
                                    <p class="text-uppercase discount-title">
                                        Học tiếng anh trực tuyến
                                    </p>
                                    <span class="discount-author">British Council</span>

                                    <div class="discount-price mt-2">
                                        <span class="old-price">7.000.000 VND</span>
                                        <span class="new-price">3.500.000 VND</span>
                                    </div>
                                </div> 
                            </a>
                            <!-- /last-content -->
                        </div>
                        <div class="col-md-6">
                            <!-- last-content -->
                            <a href="#" class="last-content-top-left-content">
                                <div class="discount-avatar">
                                    <img src="{{ asset('img-smoney/img-students/bg-01.jpg')  }}" alt="">
                                </div>
                                <div class="discount-content">
                                    <p class="text-uppercase discount-title">
                                        Học tiếng anh trực tuyến
                                    </p>
                                    <span class="discount-author">British Council</span>

                                    <div class="discount-price mt-2">
                                        <span class="old-price">7.000.000 VND</span>
                                        <span class="new-price">3.500.000 VND</span>
                                    </div>
                                </div> 
                            </a>
                            <!-- /last-content -->
                        </div>
                    </div>
                </div>
                <div class="hot-deals-paging">
                    
                </div>
            </div>
        </div>
    </div>

    <div class="block-knowledge">
        <div class="block-knowledge-title">
            Kiến thức hữu ích
        </div>
        <div class="container block-knowledge-content">
            <div class="row">
                <div class="col-md-6">
                    <!-- last-content -->
                    <a href="#" class="last-content-top-right-content">
                        <div class="knowledge-avatar">
                            <img src="{{ asset('img-smoney/img-students/bg-01.jpg')  }}" alt="">
                        </div>
                        <div class="knowledge-content">
                            <p class="knowledge-title">
                                Donec id sem risus. Donec maximus sem ante. Vestibulum sit amet est non
                            </p>
                            <span class="knowledge-time">
                                <i class="far fa-clock"></i>
                                2 hours
                            </span>
                        </div> 
                    </a>
                    <!-- /last-content -->
                </div>
                <div class="col-md-6">
                    <!-- last-content -->
                    <a href="#" class="last-content-top-right-content">
                        <div class="knowledge-avatar">
                            <img src="{{ asset('img-smoney/img-students/bg-01.jpg')  }}" alt="">
                        </div>
                        <div class="knowledge-content">
                            <p class="knowledge-title">
                                Donec id sem risus. Donec maximus sem ante. Vestibulum sit amet est non
                            </p>
                            <span class="knowledge-time">
                                <i class="far fa-clock"></i>
                                2 hours
                            </span>
                        </div> 
                    </a>
                    <!-- /last-content -->
                </div>
                <div class="col-md-6">
                    <!-- last-content -->
                    <a href="#" class="last-content-top-right-content">
                        <div class="knowledge-avatar">
                            <img src="{{ asset('img-smoney/img-students/bg-01.jpg')  }}" alt="">
                        </div>
                        <div class="knowledge-content">
                            <p class="knowledge-title">
                                Donec id sem risus. Donec maximus sem ante. Vestibulum sit amet est non
                            </p>
                            <span class="knowledge-time">
                                <i class="far fa-clock"></i>
                                2 hours
                            </span>
                        </div> 
                    </a>
                    <!-- /last-content -->
                </div>
                <div class="col-md-6">
                    <!-- last-content -->
                    <a href="#" class="last-content-top-right-content">
                        <div class="knowledge-avatar">
                            <img src="{{ asset('img-smoney/img-students/bg-01.jpg')  }}" alt="">
                        </div>
                        <div class="knowledge-content">
                            <p class="knowledge-title">
                                Donec id sem risus. Donec maximus sem ante. Vestibulum sit amet est non
                            </p>
                            <span class="knowledge-time">
                                <i class="far fa-clock"></i>
                                2 hours
                            </span>
                        </div> 
                    </a>
                    <!-- /last-content -->
                </div>
                <div class="col-md-6">
                    <!-- last-content -->
                    <a href="#" class="last-content-top-right-content">
                        <div class="knowledge-avatar">
                            <img src="{{ asset('img-smoney/img-students/bg-01.jpg')  }}" alt="">
                        </div>
                        <div class="knowledge-content">
                            <p class="knowledge-title">
                                Donec id sem risus. Donec maximus sem ante. Vestibulum sit amet est non
                            </p>
                            <span class="knowledge-time">
                                <i class="far fa-clock"></i>
                                2 hours
                            </span>
                        </div> 
                    </a>
                    <!-- /last-content -->
                </div>
                <div class="col-md-6">
                    <!-- last-content -->
                    <a href="#" class="last-content-top-right-content">
                        <div class="knowledge-avatar">
                            <img src="{{ asset('img-smoney/img-students/bg-01.jpg')  }}" alt="">
                        </div>
                        <div class="knowledge-content">
                            <p class="knowledge-title">
                                Donec id sem risus. Donec maximus sem ante. Vestibulum sit amet est non
                            </p>
                            <span class="knowledge-time">
                                <i class="far fa-clock"></i>
                                2 hours
                            </span>
                        </div> 
                    </a>
                    <!-- /last-content -->
                </div>
            </div>
        </div>
        <!-- paging -->
        <div class="block-knowledge-paging">

        </div>
    </div>
    
    <div class="line"></div>
    
    <div class="block-entertain">
        <div class="block-entertain-title">
            Góc giải trí
        </div>
        <div class="container block-entertain-content">
            <div class="row">
                <!-- block - video - content -->
                <div class="middle-video-item col-md-6  col-lg-4 col-12 wow bounceInLeft" data-wow-duration="3s">
                    <a href="#" class="middle-img-shortcut">
                    </a>
                    <a href="#" class="middle-video-title">
                        Donec convallis urna enim, nec lacinia urna rutrum egestas.
                    </a>
                </div>
                <!-- /block - video - content -->
                <!-- block - video - content -->
                <div class="middle-video-item col-md-6  col-lg-4 col-12 wow bounceInLeft" data-wow-duration="3s">
                    <a href="#" class="middle-img-shortcut">
                    </a>
                    <a href="#" class="middle-video-title">
                        Donec convallis urna enim, nec lacinia urna rutrum egestas.
                    </a>
                </div>
                <!-- /block - video - content -->
                <!-- block - video - content -->
                <div class="middle-video-item col-md-6  col-lg-4 col-12 wow bounceInLeft" data-wow-duration="3s">
                    <a href="#" class="middle-img-shortcut">
                    </a>
                    <a href="#" class="middle-video-title">
                        Donec convallis urna enim, nec lacinia urna rutrum egestas.
                    </a>
                </div>
                <!-- /block - video - content -->
                <!-- block - video - content -->
                <div class="middle-video-item col-md-6  col-lg-4 col-12 wow bounceInLeft" data-wow-duration="3s">
                    <a href="#" class="middle-img-shortcut">
                    </a>
                    <a href="#" class="middle-video-title">
                        Donec convallis urna enim, nec lacinia urna rutrum egestas.
                    </a>
                </div>
                <!-- /block - video - content -->
                <!-- block - video - content -->
                <div class="middle-video-item col-md-6  col-lg-4 col-12 wow bounceInLeft" data-wow-duration="3s">
                    <a href="#" class="middle-img-shortcut">
                    </a>
                    <a href="#" class="middle-video-title">
                        Donec convallis urna enim, nec lacinia urna rutrum egestas.
                    </a>
                </div>
                <!-- /block - video - content -->
                <!-- block - video - content -->
                <div class="middle-video-item col-md-6  col-lg-4 col-12 wow bounceInLeft" data-wow-duration="3s">
                    <a href="#" class="middle-img-shortcut">
                    </a>
                    <a href="#" class="middle-video-title">
                        Donec convallis urna enim, nec lacinia urna rutrum egestas.
                    </a>
                </div>
                <!-- /block - video - content -->
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
@stop