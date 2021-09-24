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
    </style>
@stop
@section('content')
    @include('smoney/admin/layouts/header')
    <!-- student - block - title -->
    <div class="banner">
        <div class='container'>
            <div class='logo-container'>
                <div class='logo-title'>Admin</div>
                <span>(Trang tài khoản nhà trường)</span>
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
                <h1>Thông tin tài khoản nhà trường</h1>
            </div>

           <div> 
                <div class="add-new">
                    <span>Thêm mới</span>
                    <i class="fas fa-plus-circle"></i>
                </div>
            </div>
            <!-- table -->
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Phone</th>
                        <th>Ảnh</th>
                        <th>Tên trường</th>
                        <th>Mã trường</th>
                        <th>Địa chỉ</th>
                        <th>Ngày tạo account</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="first blue">Bùi Hữu Dũng</td>
                        <td>
                            <div class="school-img" style="background: url('{{ asset('folder-university/ABCD/university_logo.png')  }}') no-repeat;">
                                </div>
                         </td>
                        <td>0123456789</td>
                        <td>Bắc Từ Liêm, Hà Nội</td>
                         <td>0123456789</td>
                        <td>Bắc Từ Liêm, Hà Nội</td>
                        <td>
                            <button type="button" class="btn-sm btn-block btn btn-outline-primary">
                                Chi tiết
                            </button>
                            <button type="button" class="btn-sm btn-block btn btn-danger">
                                Reset password
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="first blue">Bùi Hữu Dũng</td>
                        <td>
                            <div class="school-img" style="background: url('{{ asset('folder-university/ABCD/university_logo.png')  }}') no-repeat;">
                                </div>
                         </td>
                        <td>0123456789</td>
                        <td>Bắc Từ Liêm, Hà Nội</td>
                         <td>0123456789</td>
                        <td>Bắc Từ Liêm, Hà Nội</td>
                        <td>
                            <button type="button" class="btn-sm btn-block btn btn-outline-primary">
                                Chi tiết
                            </button>
                            <button type="button" class="btn-sm btn-block btn btn-danger">
                                Reset password
                            </button>
                        </td>
                    </tr>
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
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        document.getElementById('myChart').height = 200;
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Tất cả khoản vay', 'Khoản vay hiện tại ', 'Khoản vay chờ xử lý', 'Khoản vay bị từ chối ',
                    'Khoản vay đã trả'
                ],
                datasets: [{
                    label: 'Chi tiết các khoản vay',
                    data: [25, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        '#7068CC',
                        '#316FD3',
                        '#F8A20E',
                        '#E14C4C',
                        '#31B98C'
                    ],
                    borderColor: [
                        'rgba(47, 187, 153, 0.22)',
                        'rgba(47, 187, 153, 0.22)',
                        'rgba(47, 187, 153, 0.22)',
                        'rgba(47, 187, 153, 0.22)',
                        'rgba(47, 187, 153, 0.22)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        var containerHeight = document.getElementById('myChart').parentElement.clientHeight;
        var myChartHeight = document.getElementById('myChart').clientHeight;

        document.getElementById('myChart').style.marginTop = (containerHeight - myChartHeight) + 'px'

        var ctx2 = document.getElementById('myChart2').getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Tất cả khoản vay', 'Khoản vay hiện tại ', 'Khoản vay chờ xử lý', 'Khoản vay bị từ chối ',
                    'Khoản vay đã trả'
                ],
                datasets: [{
                    label: 'Chi tiết các khoản vay',
                    data: [25, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        '#7068CC',
                        '#316FD3',
                        '#F8A20E',
                        '#E14C4C',
                        '#31B98C'
                    ],
                    borderColor: [
                        'rgba(47, 187, 153, 0.22)',
                        'rgba(47, 187, 153, 0.22)',
                        'rgba(47, 187, 153, 0.22)',
                        'rgba(47, 187, 153, 0.22)',
                        'rgba(47, 187, 153, 0.22)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    title: {
                        display: false
                    }
                }
            },
        });
        // var containerHeight = document.getElementById('myChart').parentElement.clientHeight;
        // var myChartHeight = document.getElementById('myChart').clientHeight;

        // document.getElementById('myChart').style.marginTop = (containerHeight - myChartHeight) + 'px'
    </script>
    <script type="text/javascript" src="{{ asset('js/Smoney/Student/student.js') }}"></script>
@stop