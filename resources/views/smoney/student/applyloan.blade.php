@extends('smoney/student/layouts/index')
@section('title')
    Student Page
@parent
@stop
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/preferential.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/student.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/applyloan.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/index.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Homepage/responsive_footer.css') }}">

<style>
    
</style>
@stop
@section('content')
@include('smoney/student/layouts/header')
<div class="main">
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <!-- 1 -->
        <div class="apply-loan">
            <div class="apply-loan-title">
                <h4>Đăng ký khoản vay</h4>
            </div>
            <div class="apply-loan-content">
                <div class="apply-loan-content-left">
                    <div class="top">
                        <div class="top-line-left">
                            <div class="line"></div>
                        </div> 
                        <div class="top-line-number">
                            <div class="number">1</div>
                        </div>
                        <div class="top-line-right">
                            <div class="line"></div>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="bottom-group">
                            <label for="input-money">Số tiền cần vay</label>
                            <input type="number" id="input-money">
                        </div>
                        <div class="bottom-group">
                            <label for="select-purpose">Mục đích vay</label>
                            <select name="" id="select-purpose">
                                <option hidden="" value=""></option>
                                <option>ABC</option>
                                <option>DEF</option>
                            </select>
                        </div>
                        <div class="bottom-group">
                            <label for="select-loan-time">Thời gian vay</label>
                            <select name="" id="select-loan-time">
                                <option hidden="" value=""></option>
                                <option>ABC</option>
                                <option>DEF</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="apply-loan-content-right">
                    <img src="{{ asset('img-smoney/img-students/applyforloan.svg') }}" alt="">
                </div>
            </div>
        </div>
        <!-- 2 -->
        <div class="loan-of-bank">
            <div class="top">
                <div class="top-line-left">
                    <div class="line"></div>
                </div> 
                <div class="top-line-number">
                    <div class="number">2</div>
                </div>
                <div class="top-line-right">
                    <div class="line"></div>
                </div>
            </div>
            <div class="loan-of-bank-title">
                <h4>Các khoản vay của ngân hàng</h4>
            </div>
            <div class="loan-of-bank-table">
                <table class="content-table">
                    <thead>
                        <tr>
                            <th>Sản phẩm vay</th>
                            <th>Lãy xuất(năm)</th>
                            <th>Vay tối đa</th>
                            <th>Khả năng thành công</th>
                            <th>Đăng ký</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="first">
                                <img src="{{ asset('img-smoney/img-students/vietcombank-loan.svg') }}" alt="">
                                <span>Vay tiêu dùng cá nhân</span>
                            </td>
                            <td>11,5%</td>
                            <td>25.000.000 VNĐ</td>
                            <td>50%</td>
                            <td>
                                <a href="#" class="link-top">
                                    Đăng ký vay ngay
                                </a>
                                <a href="#" class="link-below">
                                    Liên hệ tư vấn 
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="first">
                                <img src="{{ asset('img-smoney/img-students/vietcombank-loan.svg') }}" alt="">
                                <span>Vay tiêu dùng cá nhân</span>
                            </td>
                            <td>11,5%</td>
                            <td>25.000.000 VNĐ</td>
                            <td>50%</td>
                            <td>
                                <a href="#" class="link-top">
                                    Đăng ký vay ngay
                                </a>
                                <a href="#" class="link-below">
                                    Liên hệ tư vấn 
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="first">
                                <img src="{{ asset('img-smoney/img-students/vietcombank-loan.svg') }}" alt="">
                                <span>Vay tiêu dùng cá nhân</span>
                            </td>
                            <td>11,5%</td>
                            <td>25.000.000 VNĐ</td>
                            <td>50%</td>
                            <td>
                                <a href="#" class="link-top">
                                    Đăng ký vay ngay
                                </a>
                                <a href="#" class="link-below">
                                    Liên hệ tư vấn 
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- paging -->
            <div class="paging">
                
            </div>
        </div>
        <!-- 3 -->
        <div class="form-bottom">
            <div class="top">
                <div class="top-line-left">
                    <div class="line"></div>
                </div> 
                <div class="top-line-number">
                    <div class="number">3</div>
                </div>
                <div class="top-line-right">
                    <div class="line"></div>
                </div>
            </div>
            <div class="form-bottom-content">
                <div class="bottom-content-block">
                    <label for="input-point">Điểm trung bình hiện tại</label>
                    <input type="text" id="input-point">
                </div>
                <div class="bottom-content-block">
                    <label>File bảng điểm đính kèm</label>
                    <div class="bottom-content-block-file">
                        <div class="open-input-file">Tải file đính kèm</div>
                        <input type="file" id="input-file">
                    </div>
                </div>
            </div>
            <div class="rules">
                <p class="rules-title">
                    <input type="checkbox" id="rules-checkbox">
                    <label for="rules-checkbox" class="mb-0">
                        Tôi đã đọc và đồng ý với &nbsp;
                    </label>
                    <span class="open-block-rules" data-toggle="modal" data-target="#modalRules">Điều khoản sử dụng phầm mềm</span>
                </p>
            </div>
            <div class="block-submit">
                <button type="submit" class="submit-form">
                    Gửi yêu cầu
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="modalRules" tabindex="-1" role="dialog" aria-labelledby="modalRulesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRulesLabel">Điều khoản sử dụng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus ullamcorper sagittis. Nulla facilisi. Cras euismod placerat lorem sed fringilla. Praesent nec volutpat est. Phasellus sed velit auctor, dapibus ante id, volutpat magna. in hendrerit diam vehicula. Maecenas pharetra, ante sit amet euismod auctor, purus lectus auctor neque, eget accumsan eros felis et dui. Nulla dapibus finibus massa sit amet dapibus. Sed molestie vitae quam et efficitur.

                Mauris id commodo est. Proin venenatis, libero sed porttitor efficitur, purus urna euismod sapien, eu ullamcorper quam odio vel lorem. Etiam egestas varius augue, et vestibulum justo porttitor eget. Phasellus eleifend risus ipsum, id pulvinar tellus sodales et. Curabitur varius congue ipsum, quis porta magna efficitur nec.
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
<script type="text/javascript" src="{{ asset('js/Smoney/Student/applyloan.js') }}"></script>
@stop