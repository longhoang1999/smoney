@extends('smoney/admin/layouts/index')
@section('title')
    Trang Trường
    @parent
@stop
@section('header_styles')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Admin/admin.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Admin/index.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .banner {
            background-image: url('{{ asset('img-smoney/university/school-dashboard-banner.png') }}');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: bottom;
        }
        .logo {
            background-image: url('http://dungxbuif-localhost:8888/Smoney/public/folder-university/ABCD/university_logo.png');
            background-repeat: no-repeat;
            background-size: cover;
            margin-bottom: 3rem;
        }
        
    </style>
@stop
@section('content')
    @include('smoney/admin/layouts/header')
    <!-- student - block - title -->
    <div class="banner">
        <div class='container'>
            <div class='logo-container'>
                <div class='logo-title'>Admin</div>
                <span>(Trang tài khoản)</span>
            </div>
            <div class='w-100 mb-5'>
                <div class='d-flex justify-content-between my-3'>
                    <span class="summary-title-overal">Tài khoản trong hệ thống</span>
                </div>
                <div class='summary-row'>
                    <div class='summary-container col-4'>
                        <div class='summary-background summary-items line-blue py-2 px-4'>
                            <div class="summary-top">
                                <div class="summary-title ">Tổng số tài khoản sinh viên</div>
                                <div class="summary-value">11 Tài khoản</div>
                            </div>
                            <div class="summary-bottom positive"><i class="fas fa-chevron-up"></i> 16%</div>
                            <img src="{{ asset('img-smoney/admin/adminStudent.png') }}" alt="">
                        </div>
                    </div>
                    <div class='summary-container col-4'>
                        <div class='summary-background summary-items line-orange'>
                            <div class="summary-top">
                                <div class="summary-title ">Tổng số tài khoản nhà trường</div>
                                <div class="summary-value">12 Tài khoản</div>
                            </div>
                            <div class="summary-bottom negative"><i class="fas fa-chevron-down"></i> 16%</div>
                            <img src="{{ asset('img-smoney/admin/adminUni.png') }}" alt="">
                        </div>
                    </div>
                  
                    <div class='summary-container col-4'>
                        <div class='summary-background summary-items line-green'>
                            <div class="summary-top">
                                <div class="summary-title ">Tổng số tài khoản ngân hàng</div>
                                <div class="summary-value negative">22 Khoản</div>
                            </div>
                            <div class="summary-bottom negative"><i class="fas fa-chevron-down"></i> 16%</div>
                            <img src="{{ asset('img-smoney/admin/adminBank.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- student - block - content -->
    <div class="content">
        <div class="item">
            <div class="content-title">
                <h1>Cập nhật tài khoản</h1>
            </div>

           <hr class="w-80">
            <!-- table -->
            <div class="update-wraper w-80">
                <form class="form-update row w-80 p-5">
                   <div class="row justify-content-between col-12">
                        <div class="col-4">
                            <div class="update-title">Ảnh hiện tại</div>
                            <div class="logo"></div>
                        </div>
                        <div class="col-8">
                            <div class="update-title">Cập nhật ảnh đại diện</div>
                            <div class="preview-img"></div>
                        </div>
                   </div>

                   <div class="form-group  row col-12">
                        <label for="staticEmail" class="col-form-label col-2">Email</label>
                        <div class="col-4">
                            <input type="text" class="form-control" id="staticEmail" value="">
                        </div>

                        <label for="staticEmail" class="col-form-label col-2">Email</label>
                        <div class="col-4">
                            <input type="text" class="form-control" id="staticEmail" value="">
                        </div>
                  </div>

                  <div class="form-group  row col-12">
                        <label for="staticEmail" class="col-form-label col-2">Email</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="staticEmail" value="">
                        </div>
                  </div>

                  <div class="form-group  row col-12">
                        <label for="staticEmail" class="col-form-label col-2">Email</label>
                        <div class="col-4">
                            <input type="text" class="form-control" id="staticEmail" value="">
                        </div>

                        <label for="staticEmail" class="col-form-label col-2">Email</label>
                        <div class="col-4">
                            <input type="text" class="form-control" id="staticEmail" value="">
                        </div>
                  </div>

                  <div class="form-group  row col-12">
                        <label for="staticEmail" class="col-form-label col-2">Email</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="staticEmail" value="">
                        </div>
                  </div>

                  <div class="form-group  row col-12">
                        <label for="staticEmail" class="col-form-label col-2">Email</label>
                        <div class="col-4">
                            <input type="text" class="form-control" id="staticEmail" value="">
                        </div>

                        <label for="staticEmail" class="col-form-label col-2">Email</label>
                        <div class="col-4">
                            <input type="text" class="form-control" id="staticEmail" value="">
                        </div>
                  </div>

                  <div class="group-btn">
                      <button class="btn btn-outline-primary">Hủy</button>
                      <button class="btn btn-success">Cập nhật</button>
                  </div>
                </form>
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