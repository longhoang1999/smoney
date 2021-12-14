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
            @if($avatar == "")
                background-image: url('{{ asset('img-smoney/img-students/avatar-default.png')}}');
            @else
                background-image: url('{{ asset($avatar)}}');
            @endif
            background-repeat: no-repeat;
            background-size: cover;
        }
        .avatar-student{width: 3rem;}
        .avatar-student img{width: 100%}
    </style>
@stop
@section('content')
    @include('smoney/admin/layouts/header')
    <!-- student - block - title -->
    <div class="banner">
        <div class='container'>
            <div class='logo-container'>
                <div class='logo-title'>Admin</div>
                <span>(Trang tài khoản sinh viên)</span>
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
                <h1>Thông tin tài khoản sinh viên</h1>
            </div>

            <!-- <div> 
                <div class="add-new">
                    <span>Thêm mới</span>
                    <i class="fas fa-plus-circle"></i>
                </div>
            </div> -->
            <!-- table -->
            <table class="content-table" id="Table_Student">
                <thead>
                    <tr>
                        <th>Số diện thoại</th>
                        <th>Ảnh</th>
                        <th>Họ tên</th>
                        <th>Trường</th>
                        <th>Số khoản vay</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>


    <!-- back to top -->
    <div class="back_to_top">
        <i class="fas fa-angle-up"></i>
    </div>
@stop


@section('footer-js')
    <script type="text/javascript" src="{{ asset('datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('datatables/js/dataTables.bootstrap4.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('js/Smoney/Student/student.js') }}"></script>
    <script type="text/javascript">
        var $url_path = '{!! url('/') !!}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // bank
        var table = $('#Table_Student').DataTable({
            "columnDefs": [
                { className: "first blue", "targets": [ 0 ] },
                { className: "avatar-student", "targets": [ 1 ] }
            ],
            processing: true,
            serverSide: true,
            ajax: '{!! route('admin.showAllStudentTwo') !!}',
            order:[],
            columns: [
                { data: 'sdt_custom', name: 'sdt_custom' },
                { data: 'avatar', name: 'avatar' },
                { data: 'hoten', name: 'hoten' },
                { data: 'university', name: 'university'},
                { data: 'loanNumber', name: 'loanNumber' },       
            ]
        });
    </script>
@stop