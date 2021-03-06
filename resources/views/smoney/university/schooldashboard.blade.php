@extends('smoney/university/layouts/index')
@section('title')
    Trang Trường
    @parent
@stop
@section('header_styles')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/University/university.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/University/dashboard.css') }}">
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
    @include('smoney/university/layouts/header')
    <!-- student - block - title -->
    <div class="banner">
        <div class='container'>
            <div class='logo-container'>
                <div class="logo"></div>
                <div class='logo-title'>{{ $name }}</div>
            </div>
            <div class='w-100 mb-5'>
                <div class='d-flex justify-content-between my-3'>
                    <span class="summary-title-overal">Tổng quan các khoản vay</span>
                    <div class="select">
                        <select name="cars" id="cars">
                            <option value="volvo">7 ngày gần đây</option>
                            <option value="saab">Saab</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                        </select>
                    </div>
                </div>
                <div class='summary-row'>
                    <div class='summary-container col-3'>
                        <div class='summary-background summary-items line-blue py-2 px-4'>
                            <div class="summary-top">
                                <div class="summary-title ">Khoản vay hiện tại</div>
                                <div class="summary-value">2 Khoản</div>
                            </div>
                            <div class="summary-bottom positive"><i class="fas fa-chevron-up"></i> 16%</div>
                        </div>
                    </div>
                    <div class='summary-container col-3'>
                        <div class='summary-background summary-items line-orange'>
                            <div class="summary-top">
                                <div class="summary-title ">Khoản vay chờ xử lý</div>
                                <div class="summary-value">2 Khoản</div>
                            </div>
                            <div class="summary-bottom negative"><i class="fas fa-chevron-down"></i> 16%</div>
                        </div>
                    </div>
                    <div class='summary-container col-3'>
                        <div class='summary-background summary-items line-red'>
                            <div class="summary-top">
                                <div class="summary-title ">Khoản vay bị từ chối</div>
                                <div class="summary-value">2 Khoản</div>
                            </div>
                            <div class="summary-bottom positive"><i class="fas fa-chevron-up"></i> 16%</div>
                        </div>
                    </div>
                    <div class='summary-container col-3'>
                        <div class='summary-background summary-items line-green'>
                            <div class="summary-top">
                                <div class="summary-title ">Khoản vay đã trả hết</div>
                                <div class="summary-value negative">2 Khoản</div>
                            </div>
                            <div class="summary-bottom negative"><i class="fas fa-chevron-down"></i> 16%</div>
                        </div>
                    </div>
                </div>
            </div>

            <hr />

            <div class='row mt-5'>
                <div class='chart-container col-6'>
                    <div class='summary-background py-3 px-4'>
                        <div class='d-flex justify-content-between'>
                            <span class="summary-title-overal color-black">Chi tiết các khoản vay</span>
                            <div class="select">
                                <select name="cars" id="cars">
                                    <option value="volvo">7 ngày gần đây</option>
                                    <option value="saab">Saab</option>
                                    <option value="mercedes">Mercedes</option>
                                    <option value="audi">Audi</option>
                                </select>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="myChart" height="100% !important"></canvas>
                        </div>
                    </div>
                </div>
                <div class='chart-container col-6'>
                    <div class='summary-background  py-3 px-4'>
                        <div class='d-flex justify-content-between'>
                            <span class="summary-title-overal color-black">Chi tiết các khoản vay</span>
                            <div class="select">
                                <select name="cars" id="cars">
                                    <option value="volvo">7 ngày gần đây</option>
                                    <option value="saab">Saab</option>
                                    <option value="mercedes">Mercedes</option>
                                    <option value="audi">Audi</option>
                                </select>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>
                </div>
            </div>
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
                    <th>Họ tên</th>
                    <th>Mã sinh viên</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Ngày tạo</th>
                    <th>Trạng thái</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="first blue">Bùi Hữu Dũng</td>
                    <td>0123456</td>
                    <td>0123456789</td>
                    <td>Bắc Từ Liêm, Hà Nội</td>
                    <td>01/01/2021</td>
                    <td>
                        <div class='tag tag-green'>
                            Đã xác minh
                        </div>
                    </td>
                    <td class="d-flex justify-content-around  actions">
                        <a href="#"><span>Chi tiết</span></a>
                        <a href="#"><span>Thông báo</span></a>
                    </td>
                </tr>
                <tr>
                    <td class="first blue">Bùi Hữu Dũng</td>
                    <td>0123456</td>
                    <td>0123456789</td>
                    <td>Bắc Từ Liêm, Hà Nội</td>
                    <td>01/01/2021</td>
                    <td>
                        <div class='tag tag-green'>
                            Đã xác minh
                        </div>
                    </td>
                    <td class="d-flex justify-content-around  actions">
                        <a href="#"><span>Chi tiết</span></a>
                        <a href="#"><span>Thông báo</span></a>
                    </td>
                </tr>
                <tr>
                    <td class="first blue">Bùi Hữu Dũng</td>
                    <td>0123456</td>
                    <td>0123456789</td>
                    <td>Bắc Từ Liêm, Hà Nội</td>
                    <td>01/01/2021</td>
                    <td>
                        <div class='tag tag-green'>
                            Đã xác minh
                        </div>
                    </td>
                    <td class="d-flex justify-content-around  actions">
                        <a href="#"><span>Chi tiết</span></a>
                        <a href="#"><span>Thông báo</span></a>
                    </td>
                </tr>
                <tr>
                    <td class="first blue">Bùi Hữu Dũng</td>
                    <td>0123456</td>
                    <td>0123456789</td>
                    <td>Bắc Từ Liêm, Hà Nội</td>
                    <td>01/01/2021</td>
                    <td>
                        <div class='tag tag-green'>
                            Đã xác minh
                        </div>
                    </td>
                    <td class="d-flex justify-content-around  actions">
                        <a href="#"><span>Chi tiết</span></a>
                        <a href="#"><span>Thông báo</span></a>
                    </td>
                </tr>
                <tr>
                    <td class="first blue">Bùi Hữu Dũng</td>
                    <td>0123456</td>
                    <td>0123456789</td>
                    <td>Bắc Từ Liêm, Hà Nội</td>
                    <td>01/01/2021</td>
                    <td>
                        <div class='tag tag-green'>
                            Đã xác minh
                        </div>
                    </td>
                    <td class="d-flex justify-content-around  actions">
                        <a href="#"><span>Chi tiết</span></a>
                        <a href="#"><span>Thông báo</span></a>
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
