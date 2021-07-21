@extends('smoney/student/layouts/index')
@section('title')
    Các khoản vay sinh viên
@parent
@stop
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/student.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/student2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/preferential.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/studentLoan.css') }}">
<style>
    .banner{
        background: url('{{ asset("img-smoney/img-students/bg-title.png")  }}');
        background-repeat: no-repeat;
        background-size: cover;
    }
    .loan-nearly-slide{
        background: url('{{ asset("img-smoney/img-students/hoavan-2.png")  }}');
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
@stop
@section('content')
@include('smoney/student/layouts/header')
<!-- student - block - title -->
<div class="banner">
    <div class="block-banner-title">
        Các khoản vay sinh viên
    </div>
</div>

<!-- from student html -->
<div class="loan-nearly-slide">
    <div class="icon-left">
        <i class="fas fa-chevron-left"></i>
    </div>
    <div class="loan-nearly-slide-content">
        <!--  a div content -->
        <div class="content-block-parents">
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
        <div class="content-block-parents">
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
        <div class="content-block-parents">
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
        <div class="content-block-parents">
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
        <div class="content-block-parents">
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
        <div class="content-block-parents">
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
        <div class="content-block-parents">
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
        <div class="content-block-parents">
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
        <div class="content-block-parents">
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
    <div class="icon-right">
        <i class="fas fa-chevron-right"></i>
    </div>
</div>
<!-- student - block - content -->
<div class="content">
    <h3>Các khoản vay Ngân hàng cung cấp</h3>
    <div class="content-title">
        <ul>
            <li id="selected-item">Tất cả</li>
            <li>Học phí</li>
            <li>Thuê nhà</li>
            <li>Tiêu dùng</li>
        </ul>
    </div>
    <!-- table -->
    <table class="content-table">
        <thead>
            <tr>
                <th>Mục đích vay</th>
                <th>Số tiền vay được</th>
                <th>Kì hạn vay</th>
                <th>Nhà trường</th>
                <th>Bên cho vay</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="first blue">Học phí</td>
                <td>15.000.000đ</td>
                <td>12 tháng</td>
                <td>Trường ĐHQG HN</td>
                <td>
                    <span>Ngân hàng Techcomback</span>
                    <br>
                    <small class="detail-back-favors">* Ưu đãi 12 tháng không lãi xuất</small>
                </td>
                <td>
                    <a href="#">
                        Vay ngay
                    </a>
                </td>
            </tr>
            <tr>
                <td class="first orange">Thuê nhà</td>
                <td>12.000.000đ</td>
                <td>6 tháng</td>
                <td>Trường ĐHQG HN</td>
                <td>
                    <span>Ngân hàng VPBank</span>
                    <br>
                    <small class="detail-back-favors">* Ưu đãi 40%</small>
                </td>
                <td>
                    <a href="#">
                        Vay ngay
                    </a>
                </td>
            </tr>
            <tr>
                <td class="first lightblue">Tiêu dùng</td>
                <td>3.000.000đ</td>
                <td>6 tháng</td>
                <td>Trường ĐHQG HN</td>
                <td>
                    <span>Ngân hàng VPBank</span>
                    <br>
                    <small class="detail-back-favors">* Kèm theo khoản vay khác ưu đãi 30%</small>
                </td>
                <td>
                    <a href="#">
                        Vay ngay
                    </a>
                </td>
            </tr>
            <tr>
                <td class="first blue">Học phí</td>
                <td>15.000.000đ</td>
                <td>12 tháng</td>
                <td>Trường ĐHQG HN</td>
                <td>
                    <span>Ngân hàng Techcomback</span>
                    <br>
                    <small class="detail-back-favors">* Ưu đãi 12 tháng không lãi xuất</small>
                </td>
                <td>
                    <a href="#">
                        Vay ngay
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
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