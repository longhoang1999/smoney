@extends('smoney/admin/layouts/index')
@section('title')
    Trang Admin
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
                <span>(Thông tin chung)</span>
            </div>
            <div class='w-100 mb-5'>
                <div class='d-flex justify-content-between my-3'>
                    <span class="summary-title-overal">Tài khoản trong hệ thống</span>
                    <!-- <div class="select">
                        <select name="cars" id="cars">
                            <option value="volvo">7 ngày gần đây</option>
                            <option value="saab">Saab</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                        </select>
                    </div> -->
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
                <h1>Tài khoản sinh viên</h1>
            </div>
            <!-- table -->
            <table class="content-table" id="Table_Student">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Họ tên</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Trường</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

          <div class="item">
            <div class="content-title">
                <h1>Tài khoản nhà trường</h1>
            </div>
            <!-- table -->
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Mã trường</th>
                        <th>Địa chỉ</th>
                        <th>Ngày đăng ký</th>
                   </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="first blue">Bùi Hữu Dũng</td>
                        <td>0123456</td>
                        <td>0123456789</td>
                        <td>Bắc Từ Liêm, Hà Nội</td>
                    </tr>
                    <tr>
                        <td class="first blue">Bùi Hữu Dũng</td>
                        <td>0123456</td>
                        <td>0123456789</td>
                        <td>Test covid 123</td>
                    </tr>
                    <tr>
                        <td class="first blue">Bùi Hữu Dũng</td>
                        <td>0123456</td>
                        <td>0123456789</td>
                        <td>Bắc Từ Liêm, Hà Nội</td>
                    </tr>
                    <tr>
                        <td class="first blue">Bùi Hữu Dũng</td>
                        <td>0123456</td>
                        <td>0123456789</td>
                        <td>Bắc Từ Liêm, Hà Nội</td>
                    </tr>
                    <tr>
                        <td class="first blue">Bùi Hữu Dũng</td>
                        <td>0123456</td>
                        <td>0123456789</td>
                        <td>Bắc Từ Liêm, Hà Nội</td>
                    </tr>
                </tbody>
            </table>
        </div>

         <div class="item">
            <div class="content-title">
                <h1>Tài khoản doanh nghiệp</h1>
            </div>
            <!-- table -->
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Mã trường</th>
                        <th>Địa chỉ</th>
                        <th>Ngày đăng ký</th>
                   </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="first blue">Bùi Hữu Dũng</td>
                        <td>0123456</td>
                        <td>0123456789</td>
                        <td>Bắc Từ Liêm, Hà Nội</td>
                    </tr>
                    <tr>
                        <td class="first blue">Bùi Hữu Dũng</td>
                        <td>0123456</td>
                        <td>0123456789</td>
                        <td>Test covid 123</td>
                    </tr>
                    <tr>
                        <td class="first blue">Bùi Hữu Dũng</td>
                        <td>0123456</td>
                        <td>0123456789</td>
                        <td>Bắc Từ Liêm, Hà Nội</td>
                    </tr>
                    <tr>
                        <td class="first blue">Bùi Hữu Dũng</td>
                        <td>0123456</td>
                        <td>0123456789</td>
                        <td>Bắc Từ Liêm, Hà Nội</td>
                    </tr>
                    <tr>
                        <td class="first blue">Bùi Hữu Dũng</td>
                        <td>0123456</td>
                        <td>0123456789</td>
                        <td>Bắc Từ Liêm, Hà Nội</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- paging -->
        

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
    <script type="text/javascript">
        var table = $('#Table_Student').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('admin.showAllStudent') !!}',
            order:[],
            columns: [
                    { data: 'stt', name: 'stt' },
                    { data: 'hoten', name: 'hoten' },
                    { data: 'sdt', name: 'sdt' },
                    { data: 'diachi', name: 'diachi' },
                    { data: 'university', name: 'university' }
                ]
            });
            table.on( 'draw.dt', function () {
                var PageInfo = $('#Table_Student').DataTable().page.info();
                table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                    cell.innerHTML = i + 1 + PageInfo.start;
                });
            });
    </script>
    <script type="text/javascript" src="{{ asset('js/Smoney/Student/student.js') }}"></script>
@stop