@extends('smoney/student/layouts/index')
@section('title')
    Khoản vay ưu đãi
@parent
@stop
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/student.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/preferential.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/jobinformation.css') }}">
<style>
    .banner{
        background-image: url('{{asset("img-smoney/img-students/student-header-2.png")}}');
        background-repeat: no-repeat;
        background-size: contain;
    }
</style>
@stop
@section('content')
@include('smoney/student/layouts/header')
<!-- student - block - title -->
<div class="banner">
    <div class="banner-title">
        <div class="banner-title-icon">
            <i class="fas fa-briefcase"></i>
        </div>
        <div class="nammer-title-content">
            Thông tin việc làm
        </div>
    </div>
</div>

<!-- student - block - content -->
<div class="content">
    <div class="job-block-banner">
        <img src="{{ asset('img-smoney/img-students/job.svg') }}" alt="">
    </div>
    <div class="content-title">
        <ul>
            <li id="selected-item">Tất cả</li>
            <li>Full time</li>
            <li>Partime</li>
        </ul>
    </div>
    <div class="container job-block-content">
        <div class="row">
            <!-- job-content  -->
            <div class="col-md-12 col-lg-6 wow slideInLeft" data-wow-duration="1.5s">
                <div class="job-content">
                    <div class="job-content-img">
                        <img src="img-smoney/img-students/scots.png" alt="">
                    </div>
                    <div class="job-content-detail">
                        <p class="job-content-detail-title">
                            Nhân viên tư vấn tuyển sinh (Sales)
                        </p>
                        <span class="job-content-detail-address">
                            Công ty CP Scots English VietNam | 
                            <span>Fulltime</span>
                        </span>
                        <span class="job-content-detail-price">
                            <span>15.000.000 VND</span> - <span>25.000.000 VND</span>
                        </span>
                        <a href="#" class="job-content-detail-link">
                            <span>Chi tiết</span>&nbsp;&nbsp;&nbsp;
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </a>
                    </div>
                </div>
            </div>
             <!-- /job-content  -->
             <!-- job-content  -->
            <div class="col-md-12 col-lg-6 wow slideInRight" data-wow-duration="1.5s">
                <div class="job-content">
                    <div class="job-content-img">
                        <img src="{{ asset('img-smoney/img-students/scots.png') }}" alt="">
                    </div>
                    <div class="job-content-detail">
                        <p class="job-content-detail-title">
                            Nhân viên tư vấn tuyển sinh (Sales)
                        </p>
                        <span class="job-content-detail-address">
                            Công ty CP Scots English VietNam | 
                            <span>Fulltime</span>
                        </span>
                        <span class="job-content-detail-price">
                            <span>15.000.000 VND</span> - <span>25.000.000 VND</span>
                        </span>
                        <a href="#" class="job-content-detail-link">
                            <span>Chi tiết</span>&nbsp;&nbsp;&nbsp;
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </a>
                    </div>
                </div>
            </div>
             <!-- /job-content  -->
             <!-- job-content  -->
            <div class="col-md-12 col-lg-6 wow slideInLeft" data-wow-duration="1.5s">
                <div class="job-content">
                    <div class="job-content-img">
                        <img src="{{ asset('img-smoney/img-students/scots.png') }}" alt="">
                    </div>
                    <div class="job-content-detail">
                        <p class="job-content-detail-title">
                            Nhân viên tư vấn tuyển sinh (Sales)
                        </p>
                        <span class="job-content-detail-address">
                            Công ty CP Scots English VietNam | 
                            <span>Fulltime</span>
                        </span>
                        <span class="job-content-detail-price">
                            <span>15.000.000 VND</span> - <span>25.000.000 VND</span>
                        </span>
                        <a href="#" class="job-content-detail-link">
                            <span>Chi tiết</span>&nbsp;&nbsp;&nbsp;
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </a>
                    </div>
                </div>
            </div>
             <!-- /job-content  -->
             <!-- job-content  -->
            <div class="col-md-12 col-lg-6 wow slideInRight" data-wow-duration="1.5s">
                <div class="job-content">
                    <div class="job-content-img">
                        <img src="{{ asset('img-smoney/img-students/scots.png') }}" alt="">
                    </div>
                    <div class="job-content-detail">
                        <p class="job-content-detail-title">
                            Nhân viên tư vấn tuyển sinh (Sales)
                        </p>
                        <span class="job-content-detail-address">
                            Công ty CP Scots English VietNam | 
                            <span>Fulltime</span>
                        </span>
                        <span class="job-content-detail-price">
                            <span>15.000.000 VND</span> - <span>25.000.000 VND</span>
                        </span>
                        <a href="#" class="job-content-detail-link">
                            <span>Chi tiết</span>&nbsp;&nbsp;&nbsp;
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </a>
                    </div>
                </div>
            </div>
             <!-- /job-content  -->
             <!-- job-content  -->
            <div class="col-md-12 col-lg-6 wow slideInLeft" data-wow-duration="1.5s">
                <div class="job-content">
                    <div class="job-content-img">
                        <img src="img-smoney/img-students/scots.png" alt="">
                    </div>
                    <div class="job-content-detail">
                        <p class="job-content-detail-title">
                            Nhân viên tư vấn tuyển sinh (Sales)
                        </p>
                        <span class="job-content-detail-address">
                            Công ty CP Scots English VietNam | 
                            <span>Fulltime</span>
                        </span>
                        <span class="job-content-detail-price">
                            <span>15.000.000 VND</span> - <span>25.000.000 VND</span>
                        </span>
                        <a href="#" class="job-content-detail-link">
                            <span>Chi tiết</span>&nbsp;&nbsp;&nbsp;
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </a>
                    </div>
                </div>
            </div>
             <!-- /job-content  -->
             <!-- job-content  -->
            <div class="col-md-12 col-lg-6 wow slideInRight" data-wow-duration="1.5s">
                <div class="job-content">
                    <div class="job-content-img">
                        <img src="{{ asset('img-smoney/img-students/scots.png') }}" alt="">
                    </div>
                    <div class="job-content-detail">
                        <p class="job-content-detail-title">
                            Nhân viên tư vấn tuyển sinh (Sales)
                        </p>
                        <span class="job-content-detail-address">
                            Công ty CP Scots English VietNam | 
                            <span>Fulltime</span>
                        </span>
                        <span class="job-content-detail-price">
                            <span>15.000.000 VND</span> - <span>25.000.000 VND</span>
                        </span>
                        <a href="#" class="job-content-detail-link">
                            <span>Chi tiết</span>&nbsp;&nbsp;&nbsp;
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </a>
                    </div>
                </div>
            </div>
             <!-- /job-content  -->
             <!-- job-content  -->
            <div class="col-md-12 col-lg-6 wow slideInLeft" data-wow-duration="1.5s">
                <div class="job-content">
                    <div class="job-content-img">
                        <img src="{{ asset('img-smoney/img-students/scots.png') }}" alt="">
                    </div>
                    <div class="job-content-detail">
                        <p class="job-content-detail-title">
                            Nhân viên tư vấn tuyển sinh (Sales)
                        </p>
                        <span class="job-content-detail-address">
                            Công ty CP Scots English VietNam | 
                            <span>Fulltime</span>
                        </span>
                        <span class="job-content-detail-price">
                            <span>15.000.000 VND</span> - <span>25.000.000 VND</span>
                        </span>
                        <a href="#" class="job-content-detail-link">
                            <span>Chi tiết</span>&nbsp;&nbsp;&nbsp;
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </a>
                    </div>
                </div>
            </div>
             <!-- /job-content  -->
             <!-- job-content  -->
            <div class="col-md-12 col-lg-6 wow slideInRight" data-wow-duration="1.5s">
                <div class="job-content">
                    <div class="job-content-img">
                        <img src="{{ asset('img-smoney/img-students/scots.png') }}" alt="">
                    </div>
                    <div class="job-content-detail">
                        <p class="job-content-detail-title">
                            Nhân viên tư vấn tuyển sinh (Sales)
                        </p>
                        <span class="job-content-detail-address">
                            Công ty CP Scots English VietNam | 
                            <span>Fulltime</span>
                        </span>
                        <span class="job-content-detail-price">
                            <span>15.000.000 VND</span> - <span>25.000.000 VND</span>
                        </span>
                        <a href="#" class="job-content-detail-link">
                            <span>Chi tiết</span>&nbsp;&nbsp;&nbsp;
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </a>
                    </div>
                </div>
            </div>
             <!-- /job-content  -->
        </div>
    </div>
    <!-- paging -->
    <div class="paging">

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