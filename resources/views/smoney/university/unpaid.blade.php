@extends('smoney/university/layouts/index')
@section('title')
    Trang Trường
@parent
@stop
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/University/university.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/University/dashboard.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" 
integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" 
crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .banner-2{
        background: url('{{ asset("img-smoney/university/cccc.png")  }}');
        background-repeat: no-repeat;
        background-size: cover;
    }
    .loan-nearly-slide{
        background: url('{{ asset("img-smoney/img-students/hoavan-2.png")  }}');
        background-repeat: no-repeat;
        background-size: cover;
    }
    .logo{
      background-image: url('{{asset("img-smoney/university/university_logo.png")}}');
        background-repeat: no-repeat;
        background-size: contain;
    }
</style>
@stop
@section('content')
@include('smoney/university/layouts/header')
<!-- student - block - title -->
<div class="banner-2">
    <div class="block-banner-title">
        Khoản vay chưa thanh toán
    </div>
</div>

<!-- student - block - content -->
<div class="content">
    <div class="content-title">
       <h1>Các khoản vay chưa thanh toán</h1>
    </div>
    <!-- table -->
    <table class="content-table">
        <thead>
            <tr>
                <th>Họ tên</th>
                <th>Mã sinh viên</th>
                <th>Khoản vay</th>
                <th>Phải trả</th>
                <th>Kì hạn</th>
                <th>Trạng thái</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="first blue">
                    Bùi Hữu Dũng
                </td>
                <td>123456</td>
                <td>5,000,000 VNĐ</td>
                <td>5,000,000 VNĐ</td>
                <td>12 tháng</td>
                <td><div class='tag tag-orange'>
                        Đã chưa thanh toán
                    </div></td>
                <td>
                    <a href=#><div class='tag tag-border-blue'>
                        Chi tiết
                    </div></a>
                </td>
            </tr>
            <tr>
                <td class="first blue">
                    Bùi Hữu Dũng
                </td>
                <td>123456</td>
                <td>5,000,000 VNĐ</td>
                <td>5,000,000 VNĐ</td>
                <td>12 tháng</td>
                <td><div class='tag tag-orange'>
                        Đã chưa thanh toán
                    </div></td>
                <td>
                    <a href=#><div class='tag tag-border-blue'>
                        Chi tiết
                    </div></a>
                </td>
            </tr>
            <tr>
                <td class="first blue">
                    Bùi Hữu Dũng
                </td>
                <td>123456</td>
                <td>5,000,000 VNĐ</td>
                <td>5,000,000 VNĐ</td>
                <td>12 tháng</td>
                <td><div class='tag tag-orange'>
                        Đã chưa thanh toán
                    </div></td>
                <td>
                    <a href=#><div class='tag tag-border-blue'>
                        Chi tiết
                    </div></a>
                </td>
            </tr>
            <tr>
                <td class="first blue">
                    Bùi Hữu Dũng
                </td>
                <td>123456</td>
                <td>5,000,000 VNĐ</td>
                <td>5,000,000 VNĐ</td>
                <td>12 tháng</td>
                <td><div class='tag tag-orange'>
                        Đã chưa thanh toán
                    </div></td>
                <td>
                    <a href=#><div class='tag tag-border-blue'>
                        Chi tiết
                    </div></a>
                </td>
            </tr>
            <tr>
                <td class="first blue">
                    Bùi Hữu Dũng
                </td>
                <td>123456</td>
                <td>5,000,000 VNĐ</td>
                <td>5,000,000 VNĐ</td>
                <td>12 tháng</td>
                <td><div class='tag tag-orange'>
                        Đã chưa thanh toán
                    </div></td>
                <td>
                    <a href=#><div class='tag tag-border-blue'>
                        Chi tiết
                    </div></a>
                </td>
            </tr>
            <tr>
                <td class="first blue">
                    Bùi Hữu Dũng
                </td>
                <td>123456</td>
                <td>5,000,000 VNĐ</td>
                <td>5,000,000 VNĐ</td>
                <td>12 tháng</td>
                <td><div class='tag tag-orange'>
                        Đã chưa thanh toán
                    </div></td>
                <td>
                    <a href=#><div class='tag tag-border-blue'>
                        Chi tiết
                    </div></a>
                </td>
            </tr>
            <tr>
                <td class="first blue">
                    Bùi Hữu Dũng
                </td>
                <td>123456</td>
                <td>5,000,000 VNĐ</td>
                <td>5,000,000 VNĐ</td>
                <td>12 tháng</td>
                <td><div class='tag tag-orange'>
                        Đã chưa thanh toán
                    </div></td>
                <td>
                    <a href=#><div class='tag tag-border-blue'>
                        Chi tiết
                    </div></a>
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