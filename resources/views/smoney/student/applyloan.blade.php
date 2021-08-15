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
        background: url('{{ asset("img-smoney/img-students/bg-title.png")  }}');
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
        Thông tin việc làm
    </div>
</div>

<!-- student - block - content -->
<div class="content">
    <div class="content-title">
       <h1>Danh sách sinh viên đăng ký</h1>
    </div>
    <!-- table -->
    <table class="content-table">
        <thead>
            <tr>
                <th>Tiêu đề</th>
                <th>Người gửi</th>
                <th>Ngày gửi yêu cầu</th>
                <th>Lần sửa gần nhất</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="first blue">
                    Đơn xin việc gia sư
                </td>
                <td>Bùi Hữu Dũng</td>
                <td>01-01-2021 07:00:00</td>
                <td>01-01-2021 07:00:00</td>
                <td>01/01/2021</td>
                <td>
                    <a href=#><div class='tag tag-border-blue'>
                        Chi tiết
                    </div></a>
                </td>
            </tr>
            <tr>
                <td class="first blue">
                    Đơn xin việc gia sư
                </td>
                <td>Bùi Hữu Dũng</td>
                <td>01-01-2021 07:00:00</td>
                <td>01-01-2021 07:00:00</td>
                <td>01/01/2021</td>
                <td>
                    <a href=#><div class='tag tag-border-blue'>
                        Chi tiết
                    </div></a>
                </td>
            </tr>
            <tr>
                <td class="first blue">
                    Đơn xin việc gia sư
                </td>
                <td>Bùi Hữu Dũng</td>
                <td>01-01-2021 07:00:00</td>
                <td>01-01-2021 07:00:00</td>
                <td>01/01/2021</td>
                <td>
                    <a href=#><div class='tag tag-border-blue'>
                        Chi tiết
                    </div></a>
                </td>
            </tr>
            <tr>
                <td class="first blue">
                    Đơn xin việc gia sư
                </td>
                <td>Bùi Hữu Dũng</td>
                <td>01-01-2021 07:00:00</td>
                <td>01-01-2021 07:00:00</td>
                <td>01/01/2021</td>
                <td>
                    <a href=#><div class='tag tag-border-blue'>
                        Chi tiết
                    </div></a>
                </td>
            </tr>
            <tr>
                <td class="first blue">
                    Đơn xin việc gia sư
                </td>
                <td>Bùi Hữu Dũng</td>
                <td>01-01-2021 07:00:00</td>
                <td>01-01-2021 07:00:00</td>
                <td>01/01/2021</td>
                <td>
                    <a href=#><div class='tag tag-border-blue'>
                        Chi tiết
                    </div></a>
                </td>
            </tr>
            <tr>
                <td class="first blue">
                    Đơn xin việc gia sư
                </td>
                <td>Bùi Hữu Dũng</td>
                <td>01-01-2021 07:00:00</td>
                <td>01-01-2021 07:00:00</td>
                <td>01/01/2021</td>
                <td>
                    <a href=#><div class='tag tag-border-blue'>
                        Chi tiết
                    </div></a>
                </td>
            </tr>
            <tr>
                <td class="first blue">
                    Đơn xin việc gia sư
                </td>
                <td>Bùi Hữu Dũng</td>
                <td>01-01-2021 07:00:00</td>
                <td>01-01-2021 07:00:00</td>
                <td>01/01/2021</td>
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