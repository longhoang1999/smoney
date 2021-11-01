@extends('smoney/student/layouts/index')
@section('title')
    Student Page
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

<style>
    .information{
        background: url("{{ asset('img-smoney/img-students/Vector.png')  }}") no-repeat;
        background-size: 100%  80%;
        background-position: top;
    }
    .loan-nearly{
        background: url("{{ asset('img-smoney/img-students/hoavan.png')  }}") no-repeat;
    }
    .last-content-top{
        background: url("{{ asset('img-smoney/img-students/bg-discount.png')  }}") no-repeat;
    }
    .discount-avatar,.knowledge-avatar{
        background: url("{{ asset('img-smoney/img-students/bg-01.jpg')  }}") no-repeat;
    }
    .loan-nearly,.last-content-top,.discount-avatar,.knowledge-avatar{
        background-size: cover;
        background-position: top;
    }
</style>
@stop
@section('content')
@include('smoney/student/layouts/header')

<!-- information user -->
<div class="information">
    <div class="row" style="margin-top: 7.5rem;">
        <div class="col-12 text-center my-5">
            <div class="main-avatar" 
                @if($avatar == "")
                    style="background: url('{{ asset('img-smoney/img-students/avatar-default.png')  }}')"
                @else
                    style="background: url('{{ asset($avatar)  }}')"
                @endif
                ></div>
            <div class="main-content">
                <span>Xin chào,</span>
                <span>{{ $name }}</span>
            </div>
            <a href="#" class="user-page">(Trang cá nhân)</a>
        </div>
    </div>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-4 col-lg-4 col-12 mb-2 wow fadeInUp" data-wow-duration="3s">
                <div class="main-infomation" style="
                background-image: url('{{asset('img-smoney/img-students/dashboard_1.png')}}');background-repeat: no-repeat;background-size: cover;">
                    <span class="main-infomation-dollar">
                        <i class="fas fa-dollar-sign"></i>
                    </span> 
                    <span class="main-infomation-title">
                        Tổng số tiền đã vay
                    </span>
                    <p class="main-infomation-content">
                        <span>25,000,000</span> VNĐ
                    </p>
                    <span class="main-infomation-more-infor">
                        Tăng <span>40%</span> so với tháng trước
                    </span>
                </div>
            </div>

            <div class="col-md-4 col-lg-4 col-12 mb-2 wow fadeInDown" data-wow-duration="3s">
                <div class="main-infomation" style="
                background-image: url('{{asset('img-smoney/img-students/dashboard_2.png')}}');background-repeat: no-repeat;background-size: cover;">
                    <span class="main-infomation-icon">
                        <i class="fas fa-sync-alt"></i>
                    </span> 
                    <span class="main-infomation-title">
                        Số tiền đã trả
                    </span>
                    <p class="main-infomation-content">
                        <span>5,000,000</span> VNĐ
                    </p>
                    <span class="main-infomation-more-infor">
                        Chiếm <span>20%</span> tổng số khoản vay
                    </span>
                </div>
            </div>

            <div class="col-md-4 col-lg-4 col-12 mb-2 wow fadeInUp" data-wow-duration="3s">
                <div class="main-infomation" style="
                background-image: url('{{asset('img-smoney/img-students/dashboard_3.png')}}');background-repeat: no-repeat;background-size: cover;">
                    <span class="main-infomation-icon">
                        <i class="fas fa-briefcase"></i>
                    </span> 
                    <span class="main-infomation-title">
                        Các việc làm đã nộp hồ sơ
                    </span>
                    <p class="main-infomation-content">
                        <span>5</span> việc làm
                    </p>
                    <span class="main-infomation-more-infor">
                        <span>2</span> việc làm bị từ chối
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <hr class="my-5">
</div>
<!-- loan request -->
<div class="container">
    <div class="loan-request">
        <div class="loan-request-title">
            <span class="title-icon">
                <i class="fas fa-dollar-sign"></i>
            </span>
            <span class="title-main">Yêu cầu một khoản vay</span>
            <span class="title-main-small">(Bạn cần xác thực thông tin các nhân để đủ điều kiện vay tiền)</span>
        </div>
        <div class="loan-request-selection row">
            <div class="col-md-6 col-sm-6 col-12 col-lg-3 my-1 px-2 profile wow fadeInLeft" data-wow-duration="3s">
                <input type="text" class="input-selection bg-gray w-100" disabled value="Sinh viên: Nguyễn Trung Hiếu">
            </div>
            <div class="col-md-6 col-sm-6 col-12 col-lg-3 my-1 px-2 profile wow fadeInUp" data-wow-duration="3s">
                <input type="text" class="input-selection bg-gray w-100" disabled value="Trường: ĐHQG Hà Nội">
            </div>
            <div class="col-md-6 col-sm-6 col-12 col-lg-3 my-1 px-2 profile wow fadeInDown" data-wow-duration="3s">
                <input type="text" class="input-selection bg-gray w-100" disabled value="Lớp: K56">
            </div>
            <div class="col-md-6 col-sm-6 col-12 col-lg-3 my-1 px-2 profile wow fadeInRight" data-wow-duration="3s">
                <input type="text" class="input-selection bg-gray w-100" disabled value="Mã SV: 1479579">
            </div>
            <div class="col-md-6 col-sm-6 col-12 col-lg-3 my-1 px-2 profile wow fadeInLeft" data-wow-duration="3s">
                <select name="" class="input-selection w-100">
                <option value="" hidden>Mục đích vay</option>
                <option value="abc">Abc</option>
                <option value="def">Def</option>
            </select>
            </div>
            <div class="col-md-6 col-sm-6 col-12 col-lg-3 my-1 px-2 profile wow fadeInUp" data-wow-duration="3s">
                <select name="" class="input-selection w-100">
                <option value="" hidden>Số tiền vay</option>
                <option value="abc">Abc</option>
                <option value="def">Def</option>
            </select>
            </div>
            <div class="col-md-6 col-sm-6 col-12 col-lg-3 my-1 px-2 profile wow fadeInDown" data-wow-duration="3s">
                <select name="" class="input-selection w-100">
                <option value="" hidden>Kì hạn thanh toán</option>
                <option value="abc">Abc</option>
                <option value= "def">Def</option>
            </select>
            </div>
            <div class="col-md-6 col-sm-6 col-12 col-lg-3 my-1 px-2 profile wow fadeInRight" data-wow-duration="3s">
                 <div class="input-selection w-100">
                <span class="add-file-title">Giấy tờ xác minh (nếu có)</span>
                <div class="add-file-btn">Browse</div>
                <input type="file" accept="image/*" class="add-file-input">
            </div>
            </div>
           
            <div class="btn-send-loan-request">
                Tìm kiếm ngân hàng
            </div>
        </div>


        <div class="loan-choose-company">
            <table class="table-loan-choose-company">
                <thead>
                    <tr>
                        <th class="table-header" colspan="6">Bạn hãy chọn ngân hàng gửi hồ sơ (tối đa 3 ngân hàng)</th>
                    </tr>
                    <tr>
                        <th class="table-header">Sản phẩm</th>
                        <th class="table-header">Lãi suât (năm)</th>
                        <th class="table-header">Vay tối đa</th>
                        <th class="table-header">Khả năng thành công</th>
                        <th class="table-header">Tư vấn</th>
                        <th class="table-header">Chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bankAll as $value)
                    <tr data-id="{{ $value->nn_id }}">
                        <td class="table-content">
                            <img src="{{ asset($value->nn_avatar) }}" alt="" width="100" class="mb-2">
                            <br>
                            <span class="introduce_credit mb-3">
                                Vay tiền với {{ $value->nn_ten }}
                            </span>
                            <div class="votes_credit">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <div class="comment_credit mt-2 mb-1">
                                <a href="#">3 nhận xét</a>
                            </div>
                        </td>
                        <td class="table-content">
                            <span class="percent-credit font-weight-bold">19,92%</span>
                            <br>
                            <span class="content-credit">
                                109405 người đã đăng ký (áp dụng từ 07/06/2021)
                            </span>
                        </td>
                        <td class="table-content">
                            <span class="font-weight-bold">30 Triệu</span>
                        </td> 
                        <td class="table-content">
                            <span class="font-weight-bold">50%</span>
                        </td>
                        <td class="table-content">
                            <a href="#" class="btn-contact">Liên hệ tư vấn</a>
                        </td>
                        <td class="table-content">
                            <button class="btn-choose">
                                <i class="far fa-check-circle"></i>
                                Chọn
                            </button>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td class="table-content" colspan="6">
                            <button class="btn-apply-for-loan">
                                <i class="fab fa-leanpub"></i>
                                Đăng ký vay
                            </button>
                            <a href="#" class="link-apply-for-loan" hidden=""></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
    
<!-- nearly loan -->
<div class="loan-nearly">
    <div class="loan-nearly-title">
        <span class="nearly-title-icon">
            <i class="fas fa-dollar-sign"></i>
        </span>
        <p class="nearly-title">Các khoản vay gần nhất</p>  
    </div>
    <div class="loan-nearly-banner">
        <img src="{{ asset('img-smoney/img-students/loan-banner.svg') }}" alt="">
    </div>
    <div class="loan-nearly-slide">
        <div class="icon-left">
            <i class="fas fa-chevron-left"></i>
        </div>
        <div class="loan-nearly-slide-content container">
            <div class="row">
                <!--  a div content -->
            <div class="content-block-parents col-md-6  col-lg-4 col-12 wow bounceInLeft" data-wow-duration="3s">
                <div class="content-block">
                    <div class="content-block-title">
                        <span>Tiền học phí</span>
                        <i class="fas fa-book-reader"></i>
                    </div>
                    <div class="content-block-money">
                        <span>Số tiền</span>
                        <p class="number-monney">120.000.000 VND</p>
                    </div>
                    <div class="content-block-information">
                        <div class="information-top">
                            <div class="information-top-left">
                                <span>Kì hạn vay:</span>
                                <span>12 tháng</span>
                            </div>
                            <div class="information-top-right">
                                <span>Thời gian yêu cầu:</span>
                                <span>2021-02-22 10:28:32</span>
                            </div>
                        </div>
                        <div class="information-bottom">
                            <div class="information-bottom-left">
                                <span>Nhà trường:</span>
                                <div class="block-status block-status-confirm">Đã duyệt</div>
                            </div>
                            <div class="information-bottom-right">
                                <span>Bên cho vay:</span>
                                <div class="block-status block-status-confirm">Đã duyệt</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  /a div content -->
            <!--  a div content -->
            <div class="content-block-parents col-md-6  col-lg-4 col-12 wow bounceInLeft" data-wow-duration="3s">
                <div class="content-block">
                    <div class="content-block-title">
                        <span>Tiền học phí</span>
                        <i class="fas fa-book-reader"></i>
                    </div>
                    <div class="content-block-money">
                        <span>Số tiền</span>
                        <p class="number-monney">120.000.000 VND</p>
                    </div>
                    <div class="content-block-information">
                        <div class="information-top">
                            <div class="information-top-left">
                                <span>Kì hạn vay:</span>
                                <span>12 tháng</span>
                            </div>
                            <div class="information-top-right">
                                <span>Thời gian yêu cầu:</span>
                                <span>2021-02-22 10:28:32</span>
                            </div>
                        </div>
                        <div class="information-bottom">
                            <div class="information-bottom-left">
                                <span>Nhà trường:</span>
                                <div class="block-status block-status-confirm">Đã duyệt</div>
                            </div>
                            <div class="information-bottom-right">
                                <span>Bên cho vay:</span>
                                <div class="block-status block-status-warning">Đang chờ</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  /a div content -->
            <!--  a div content -->
            <div class="content-block-parents col-md-6  col-lg-4 col-12 wow bounceInLeft" data-wow-duration="3s">
                <div class="content-block">
                    <div class="content-block-title">
                        <span>Tiền học phí</span>
                        <i class="fas fa-book-reader"></i>
                    </div>
                    <div class="content-block-money">
                        <span>Số tiền</span>
                        <p class="number-monney">120.000.000 VND</p>
                    </div>
                    <div class="content-block-information">
                        <div class="information-top">
                            <div class="information-top-left">
                                <span>Kì hạn vay:</span>
                                <span>12 tháng</span>
                            </div>
                            <div class="information-top-right">
                                <span>Thời gian yêu cầu:</span>
                                <span>2021-02-22 10:28:32</span>
                            </div>
                        </div>
                        <div class="information-bottom">
                            <div class="information-bottom-left">
                                <span>Nhà trường:</span>
                                <div class="block-status block-status-confirm">Đã duyệt</div>
                            </div>
                            <div class="information-bottom-right">
                                <span>Bên cho vay:</span>
                                <div class="block-status block-status-danger">Từ chối</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  /a div content -->    
            <!--  a div content -->
            <div class="content-block-parents col-md-6  col-lg-4 col-12 wow bounceInRight" data-wow-duration="3s">
                <div class="content-block">
                    <div class="content-block-title">
                        <span>Tiền học phí</span>
                        <i class="fas fa-book-reader"></i>
                    </div>
                    <div class="content-block-money">
                        <span>Số tiền</span>
                        <p class="number-monney">120.000.000 VND</p>
                    </div>
                    <div class="content-block-information">
                        <div class="information-top">
                            <div class="information-top-left">
                                <span>Kì hạn vay:</span>
                                <span>12 tháng</span>
                            </div>
                            <div class="information-top-right">
                                <span>Thời gian yêu cầu:</span>
                                <span>2021-02-22 10:28:32</span>
                            </div>
                        </div>
                        <div class="information-bottom">
                            <div class="information-bottom-left">
                                <span>Nhà trường:</span>
                                <div class="block-status block-status-confirm">Đã duyệt</div>
                            </div>
                            <div class="information-bottom-right">
                                <span>Bên cho vay:</span>
                                <div class="block-status block-status-danger">Từ chối</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  /a div content -->  
            <!--  a div content -->
            <div class="content-block-parents col-md-6  col-lg-4 col-12 wow bounceInRight" data-wow-duration="3s">
                <div class="content-block">
                    <div class="content-block-title">
                        <span>Tiền học phí</span>
                        <i class="fas fa-book-reader"></i>
                    </div>
                    <div class="content-block-money">
                        <span>Số tiền</span>
                        <p class="number-monney">120.000.000 VND</p>
                    </div>
                    <div class="content-block-information">
                        <div class="information-top">
                            <div class="information-top-left">
                                <span>Kì hạn vay:</span>
                                <span>12 tháng</span>
                            </div>
                            <div class="information-top-right">
                                <span>Thời gian yêu cầu:</span>
                                <span>2021-02-22 10:28:32</span>
                            </div>
                        </div>
                        <div class="information-bottom">
                            <div class="information-bottom-left">
                                <span>Nhà trường:</span>
                                <div class="block-status block-status-confirm">Đã duyệt</div>
                            </div>
                            <div class="information-bottom-right">
                                <span>Bên cho vay:</span>
                                <div class="block-status block-status-danger">Từ chối</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  /a div content -->  
            <!--  a div content -->
            <div class="content-block-parents col-md-6  col-lg-4 col-12 wow bounceInRight" data-wow-duration="3s">
                <div class="content-block">
                    <div class="content-block-title">
                        <span>Tiền học phí</span>
                        <i class="fas fa-book-reader"></i>
                    </div>
                    <div class="content-block-money">
                        <span>Số tiền</span>
                        <p class="number-monney">120.000.000 VND</p>
                    </div>
                    <div class="content-block-information">
                        <div class="information-top">
                            <div class="information-top-left">
                                <span>Kì hạn vay:</span>
                                <span>12 tháng</span>
                            </div>
                            <div class="information-top-right">
                                <span>Thời gian yêu cầu:</span>
                                <span>2021-02-22 10:28:32</span>
                            </div>
                        </div>
                        <div class="information-bottom">
                            <div class="information-bottom-left">
                                <span>Nhà trường:</span>
                                <div class="block-status block-status-confirm">Đã duyệt</div>
                            </div>
                            <div class="information-bottom-right">
                                <span>Bên cho vay:</span>
                                <div class="block-status block-status-danger">Từ chối</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  /a div content -->  
            </div>
        </div>
        <div class="icon-right">
            <i class="fas fa-chevron-right"></i>
        </div>
    </div>
    <a href="{{ route('student.studentLoan') }}" class="btn-see-all-loan">
        Xem tất cả các khoản vay
    </a>
</div>
<!-- job -->
<div class="job-block">
    <div class="job-block-title">
        <span class="job-title-icon">
            <i class="fas fa-briefcase"></i>
        </span>
        <p class="job-title">Việc làm</p>  
    </div>
    <div class="job-block-banner">
        <img src="{{ asset('img-smoney/img-students/job.svg') }}" alt="">
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
        </div>
    </div>
    <a href="{{ route('student.jobInformation') }}" class="btn-see-all-job">
        Xem tất cả việc làm
    </a>
</div>
<!-- last content -->
<div class="last-content">
    <div class="last-content-top">
        <div class="container">
            <div class="row">
                <div class="last-content-top-left col-xs-12 col-sm-12  col-md-12 col-lg-6 wow fadeInLeft" data-wow-duration="3s">
                    <p class="last-content-top-left-title">Ưu đãi hot</p>
                    <!-- last-content-top-left-content -->
                    <a href="#" class="last-content-top-left-content">
                        <div class="discount-avatar">
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
                    <!-- /last-content-top-left-content -->
                    <!-- last-content-top-left-content -->
                    <a href="#" class="last-content-top-left-content">
                        <div class="discount-avatar">
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
                    <!-- /last-content-top-left-content -->
                    <!-- last-content-top-left-content -->
                    <a href="#" class="last-content-top-left-content">
                        <div class="discount-avatar">
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
                    <!-- /last-content-top-left-content -->
                    <a href="{{ route('student.marketplace') }}" class="btn-see-all-discount">
                        Xem tất cả
                    </a>
                </div>
                <div class="last-content-top-right col-xs-12 col-sm-12 col-md-12 col-lg-6 wow fadeInRight" data-wow-duration="3s">
                    <p class="last-content-top-right-title">Kiến thức hữu ích</p>
                    <!-- last-content-top-right-content -->
                    <a href="#" class="last-content-top-right-content">
                        <div class="knowledge-avatar">
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
                    <!-- /last-content-top-right-content -->
                    <!-- last-content-top-right-content -->
                    <a href="#" class="last-content-top-right-content">
                        <div class="knowledge-avatar">
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
                    <!-- /last-content-top-right-content -->
                    <!-- last-content-top-right-content -->
                    <a href="#" class="last-content-top-right-content">
                        <div class="knowledge-avatar">
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
                    <!-- /last-content-top-right-content -->
                    <a href="{{ route('student.marketplace') }}" class="btn-see-all-knowledge">
                        Xem tất cả
                    </a>
                </div>
            </div>
        </div>
        
    </div>
    <div class="last-content-bottom">
        <div class="last-content-bottom-title">
            <span class="video-icon">
                <i class="fas fa-video"></i>
            </span>
            <p class="video-title">Video</p>
        </div>
        <div class="last-content-bottom-content">
            <div class="last-content-bottom-arr-left">
                <i class="fas fa-chevron-left"></i>
            </div>
            <div class="last-content-bottom-middle container">
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
                <div class="middle-video-item col-md-6  col-lg-4 col-12 wow bounceIn" data-wow-duration="3s">
                    <a href="#" class="middle-img-shortcut">
                    </a>
                    <a href="#" class="middle-video-title">
                        Donec convallis urna enim, nec lacinia urna rutrum egestas.
                    </a>
                </div>
                <!-- /block - video - content -->
                <!-- block - video - content -->
                <div class="middle-video-item col-md-6  col-lg-4 col-12 wow bounceInRight" data-wow-duration="3s">
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
                <div class="middle-video-item col-md-6  col-lg-4 col-12 wow bounceIn" data-wow-duration="3s">
                    <a href="#" class="middle-img-shortcut">
                    </a>
                    <a href="#" class="middle-video-title">
                        Donec convallis urna enim, nec lacinia urna rutrum egestas.
                    </a>
                </div>
                <!-- /block - video - content -->
                <!-- block - video - content -->
                <div class="middle-video-item col-md-6  col-lg-4 col-12 wow bounceInRightfhead" data-wow-duration="3s">
                    <a href="#" class="middle-img-shortcut">
                    </a>
                    <a href="#" class="middle-video-title">
                        Donec convallis urna enim, nec lacinia urna rutrum egestas.
                    </a>
                </div>
                <!-- /block - video - content -->
              </div>
            </div>
            <div class="last-content-bottom-arr-right">
                <i class="fas fa-chevron-right"></i>
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
<script type="text/javascript">
    var $url_path = '{!! url('/') !!}';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script type="text/javascript" src="{{ asset('js/Smoney/Student/student.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/frontend/jquery.circliful.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/wow/js/wow.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/frontend/carousel.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/frontend/index.js') }}"></script>
@stop