@extends('smoney/student/layouts/index')
@section('title')
    Khoản vay ưu đãi
@parent
@stop
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/student.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/preferential.css') }}">
<style>
    .banner{
        background-image: url('{{asset("img-smoney/img-students/student-header-2.png")}}');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: bottom;
    }
</style>
@stop
@section('content')
@include('smoney/student/layouts/header')
<!-- student - block - title -->
<div class="banner">
    <div class="banner-title">
        <div class="banner-title-icon">
            <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="nammer-title-content">
            Các khoản vay ưu đãi
        </div>
    </div>
</div>

<!-- student - block - content -->
<div class="content">
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
                <td>Ngân hàng Techcomback</td>
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
                <td>Ngân hàng VPBank</td>
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
                <td>Ngân hàng VPBank</td>
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
                <td>Ngân hàng Techcomback</td>
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