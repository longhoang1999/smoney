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
        .banner-2 {
            background: url('{{ asset('img-smoney/university/aaa.png') }}');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .loan-nearly-slide {
            background: url('{{ asset('img-smoney/img-students/hoavan-2.png') }}');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .logo {
            background-image: url('{{ asset('img-smoney/university/university_logo.png') }}');
            background-repeat: no-repeat;
            background-size: contain;
        }

        .content .container,
        .modal-content {
            background: #e7eff8;
        }

        .edit {
            color: #0b5ac3;
            cursor: pointer;
        }

        .edit:hover {
            text-decoration: underline;
        }

        .item-row span {
            display: inline-block
        }

        .item-title {
            width: 40%;
            font-size: 1.25rem
        }

        .item-content {
            font-weight: 700;
        }

    </style>
@stop
@section('content')
    @include('smoney/university/layouts/header')
    <!-- student - block - title -->
    <div class="banner-2">
        <div class="block-banner-title">
            Chi tiết khoản vay
        </div>
    </div>

    <!-- student - block - content -->
    <div class="content">
        <div class="content-title">
            <h1>Chi tiết khoản vay</h1>
        </div>
        <div class="container p-5">
            <div class="segment-container">

                <div class="d-flex justify-content-between align-items-end">
                    <h2>Thông tin khoản vay</h2>
                    <span class="edit" onclick="editHandleClick('ttkv');">Chỉnh sửa</span>
                </div>
                <div class="segment-content">
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Số tiền yêu cầu vay:
                        </span>
                        <span class="item-content">20,000,000 VNĐ</span>
                    </div>
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Mục đích vay:
                        </span>
                        <span class="item-content">Đóng học phí</span>
                    </div>
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Kì hạn khai báo:
                        </span>
                        <span class="item-content"> 6 tháng</span>
                    </div>
                </div>
            </div>
            <div class="segment-container mt-5">
                <hr>
                <div class="d-flex justify-content-between align-items-end">
                    <h2>Thông tin cá nhân</h2>
                    <span class="edit" onclick="editHandleClick('ttcn');">Chỉnh sửa</span>
                </div>
                <div class="segment-content">
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Họ tên:
                        </span>
                        <span class="item-content"> 6 tháng</span>
                    </div>
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Số điện thoại chính:
                        </span>
                        <span class="item-content"> 6 tháng</span>
                    </div>
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Số căn cước công dân:
                        </span>
                        <span class="item-content"> 6 tháng</span>
                    </div>
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Ngày sinh:
                        </span>
                        <span class="item-content"> 6 tháng</span>
                    </div>
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Email:
                        </span>
                        <span class="item-content"> 6 tháng</span>
                    </div>
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Giới tinh:
                        </span>
                        <span class="item-content"> 6 tháng</span>
                    </div>
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Số tài khoản:
                        </span>
                        <span class="item-content"> 6 tháng</span>
                    </div>
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Số điện thoại khác:
                        </span>
                        <span class="item-content"> 6 tháng</span>
                    </div>
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Nơi bạn đang sống:
                        </span>
                        <span class="item-content"> 6 tháng</span>
                    </div>
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Địa chỉ thường chú:
                        </span>
                        <span class="item-content"> 6 tháng</span>
                    </div>
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Địa chỉ tạm chú:
                        </span>
                        <span class="item-content"> 6 tháng</span>
                    </div>
                </div>
            </div>
            <div class="segment-container mt-5">
                <hr>
                <div class="d-flex justify-content-between align-items-end">
                    <h2>Thông tin cơ sở đào tạo</h2>
                    <span class="edit" onclick="editHandleClick('ttcsdt');">Chỉnh sửa</span>
                </div>
                <div class="segment-content">
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Bạn học tại trường
                        </span>
                        <span class="item-content">20,000,000 VNĐ</span>
                    </div>
                </div>
            </div>
            <div class="segment-container mt-5">
                <hr>
                <div class="d-flex justify-content-between align-items-end">
                    <h2>Thông tin việc làm</h2>
                    <span class="edit" onclick="editHandleClick('ttvl');">Chỉnh sửa</span>
                </div>
                <div class="segment-content">
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Tình trạng việc làm:
                        </span>
                        <span class="item-content">20,000,000 VNĐ</span>
                    </div>
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Thời gian làm việc:
                        </span>
                        <span class="item-content">Đóng học phí</span>
                    </div>
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Tên cơ sở làm việc:
                        </span>
                        <span class="item-content"> 6 tháng</span>
                    </div>
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Đại chỉ làm việc:
                        </span>
                        <span class="item-content"> 6 tháng</span>
                    </div>
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Mức lương TB/tháng:
                        </span>
                        <span class="item-content"> 6 tháng</span>
                    </div>
                </div>
            </div>
            <div class="segment-container mt-5">
                <hr>
                <div class="d-flex justify-content-between align-items-end">
                    <h2>Tùy chọn</h2>
                    <span class="edit" onclick="editHandleClick('tc');">Chỉnh sửa</span>
                </div>
                <div class="segment-content">
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Câu lạc bộ, đoàn thể của trường:
                        </span>
                        <span class="item-content">20,000,000 VNĐ</span>
                    </div>
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Thông tin người bảo trợ:
                        </span>
                        <span class="item-content">Đóng học phí</span>
                    </div>
                </div>
            </div>
            <div class="segment-container mt-5">
                <hr>
                <div class="d-flex justify-content-between align-items-end">
                    <h2>Điều khoản</h2>
                    <span class="edit" onclick="editHandleClick('dk');">Chỉnh sửa</span>
                </div>
                <div class="segment-content">
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Cổng thông tin liên lạc:
                        </span>
                        <span class="item-content">20,000,000 VNĐ</span>
                    </div>
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Ý kiến của bạn:
                        </span>
                        <span class="item-content">Đóng học phí</span>
                    </div>
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Số đánh giá:
                        </span>
                        <span class="item-content"> 6 tháng</span>
                    </div>
                    <div class="item-row mt-2">
                        <span class="item-title">
                            Điều khoản:
                        </span>
                        <span class="item-content">Chưa chấp nhận điều khoản sử dụng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="edit-info" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Thông tin khoản vay</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="segment-container p-3 segment-modal modal-ttkv">
                    <div class="segment-content">
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Số tiền yêu cầu vay:
                            </span>
                            <input type="text" class="font-weight-bold">
                        </div>
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Mục đích vay:
                            </span>
                            <input type="text" class="font-weight-bold">
                        </div>
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Kì hạn khai báo:
                            </span>
                            <input type="text" class="font-weight-bold">
                        </div>
                    </div>
                </div>
                <div class="segment-container p-3 segment-modal modal-ttcn">

                    <div class="segment-content">
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Họ tên:
                            </span>
                            <input type="text" class="font-weight-bold">
                        </div>
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Số điện thoại chính:
                            </span>
                            <input type="text" class="font-weight-bold">
                        </div>
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Số căn cước công dân:
                            </span>
                            <input type="text" class="font-weight-bold">
                        </div>
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Ngày sinh:
                            </span>
                            <input type="text" class="font-weight-bold">
                        </div>
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Email:
                            </span>
                            <input type="text" class="font-weight-bold">
                        </div>
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Giới tinh:
                            </span>
                            <input type="text" class="font-weight-bold">
                        </div>
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Số tài khoản:
                            </span>
                            <input type="text" class="font-weight-bold">
                        </div>
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Số điện thoại khác:
                            </span>
                            <input type="text" class="font-weight-bold">
                        </div>
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Nơi bạn đang sống:
                            </span>
                            <input type="text" class="font-weight-bold">
                        </div>
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Địa chỉ thường chú:
                            </span>
                            <input type="text" class="font-weight-bold">
                        </div>
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Địa chỉ tạm chú:
                            </span>
                            <input type="text" class="font-weight-bold">
                        </div>
                    </div>
                </div>
                <div class="segment-container p-3 segment-modal modal-ttcsdt">

                    <div class="segment-content">
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Bạn học tại trường
                            </span>
                            <input type="text" class="font-weight-bold">
                        </div>
                    </div>
                </div>
                <div class="segment-container p-3 segment-modal modal-ttvl">

                    <div class="segment-content">
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Tình trạng việc làm:
                            </span>
                            <span class="item-content">20,000,000 VNĐ</span>
                        </div>
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Thời gian làm việc:
                            </span>
                            <span class="item-content">Đóng học phí</span>
                        </div>
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Tên cơ sở làm việc:
                            </span>
                            <span class="item-content"> 6 tháng</span>
                        </div>
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Đại chỉ làm việc:
                            </span>
                            <span class="item-content"> 6 tháng</span>
                        </div>
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Mức lương TB/tháng:
                            </span>
                            <span class="item-content"> 6 tháng</span>
                        </div>
                    </div>
                </div>
                <div class="segment-container p-3 segment-modal modal-tc">
                    <div class="segment-content">
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Câu lạc bộ, đoàn thể của trường:
                            </span>
                            <input type="text" class="font-weight-bold">
                        </div>
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Thông tin người bảo trợ:
                            </span>
                            <input type="text" class="font-weight-bold">
                        </div>
                    </div>
                </div>
                <div class="segment-container p-3 segment-modal modal-dk">
                    <div class="segment-content">
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Cổng thông tin liên lạc:
                            </span>
                            <input type="text" class="font-weight-bold">
                        </div>
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Ý kiến của bạn:
                            </span>
                            <input type="text" class="font-weight-bold">
                        </div>
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Số đánh giá:
                            </span>
                            <input type="text" class="font-weight-bold">
                        </div>
                        <div class="item-row mt-2">
                            <span class="item-title">
                                Điều khoản:
                            </span>
                            <input type="text" class="font-weight-bold">
                        </div>
                    </div>
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
    <script type="text/javascript" src="{{ asset('js/Smoney/Student/student.js') }}"></script>
    <script>
        function editHandleClick(type) {
            $('#edit-info').modal('show');
            $('.segment-modal').hide();
            $(`.modal-${type}`).show();

            switch (type) {
                case 'ttkv':
                    $('.modal-header h2').text('Thông tin khoản vay')
                    break;
                case 'ttcn':
                    $('.modal-header h2').text('Thông tin cá nhân')
                    break;
                case 'ttcsdt':
                    $('.modal-header h2').text('Thông tin cơ sở đào tạo')
                    break;
                case 'ttvl':
                    $('.modal-header h2').text('Thông tin việc làm')
                    break;
                case 'tc':
                    $('.modal-header h2').text('Tùy chọn')
                    break;
                case 'dk':
                    $('.modal-header h2').text('Điều khoản')
                    break;
                default:
                    break;
            }
        }
    </script>
@stop
