@extends('smoney/student/layouts/index')
@section('title')
    Các khoản vay sinh viên
@parent
@stop
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/student.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/student2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/preferential.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/studentLoan.css') }}">
<style>
    .banner{
        background: url('{{ asset("img-smoney/img-students/bg-title.png")  }}') no-repeat;
    }
    .block-infomation{
        background: url('{{ asset("img-smoney/img-students/hoavan-3.png")  }}') no-repeat;  
    }
    .image-avatar{
        @if($avatar == "")
            background: url('{{ asset("img-smoney/img-students/avatar-default.png")  }}') no-repeat;
        @else
            background: url('{{ asset($avatar)  }}') no-repeat;
        @endif
    }
    .banner,.block-infomation,.image-avatar{
        background-size: cover;
    }
</style>
@stop
@section('content')
@include('smoney/student/layouts/header')

<!-- student - block - title -->
<div class="banner">
    <div class="block-banner-title">
        Thông tin cơ bản sinh viên
    </div>
</div>

<!-- from student html -->
<div class="block-infomation">
    <div class="container-fuild">
        <div class="row">
            <div class="col-md-3">
                <div class="image-avatar">
                </div>
                <div class="block-update-image">
                    <form action="" enctype="multipart/form-data" class="forn-avatar">
                        <button class="open-select-file" type="button">Tải ảnh lên</button> 
                        <input id="file" type="file" class="hidden" accept="image/*" name="avatar">
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <p class="text-uppercase block-title">
                    Thông tin cá nhân
                    <small class="btn-open-change">Chỉnh sửa</small>
                </p>

                <!-- div notification -->
                @if ($errors->any())
                <div class="notification-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><span class="error">{{ $error }}</span></li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(Session::has('error'))
                <div class="notification-error">
                    <ul>
                        <li>
                            <span class="error">{{ Session::get('error') }}</span>
                        </li>
                    </ul>
                </div>
                @endif

                @if(Session::has('success'))
                <div class="notification-error">
                    <ul>
                        <li>
                            <span class="success">{{ Session::get('success') }}</span>
                        </li>
                    </ul>
                </div>
                @endif
                <!-- /div notification -->

                <form action="{{ route('student.updateInformation') }}" method="post">
                    @csrf
                    <div class="infomation-content">
                        <div class="infomation-content-left">
                            <div class="block-item">
                                <div class="block-item-title">
                                    <span>Họ và tên: </span>
                                </div>
                                <div class="block-item-content">
                                    <input type="text" value="{{ $name }}" readonly="" class="font-weight-bold" name="fullname" required="">
                                </div>
                            </div>
                            <div class="block-item">
                                <div class="block-item-title">
                                    <span>Số căn cước công dân: </span>
                                </div>
                                <div class="block-item-content">
                                    <input type="text" value="{{ $cccd }}" readonly="" class="font-weight-bold" name="cccd" 
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required="">
                                </div>
                            </div>
                            <div class="block-item">
                                <div class="block-item-title">
                                    <span>Ngày sinh: </span>
                                </div>
                                <div class="block-item-content">
                                    <input type="date" value="{{ $ngaysinh }}" readonly="" class="font-weight-bold" name="date" required="">
                                </div>
                            </div>
                            <div class="block-item">
                                <div class="block-item-title">
                                    <span>Giới tính: </span>
                                </div>
                                <div class="block-item-content">
                                    <select name="gender" id="selecct-gender" disabled="" class="font-weight-bold font-italic">
                                        <option value="" hidden="">--  Giới tính</option>
                                        <option
                                            @if($gender == 'Nam')
                                                selected
                                            @endif
                                        value="Nam">Nam</option>
                                        <option 
                                            @if($gender == 'Nữ')
                                                selected
                                            @endif
                                        value="Nữ">Nữ</option>
                                        <option 
                                            @if($gender == 'Khác')
                                                selected
                                            @endif
                                        value="Khác">Khác</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-light mt-3 btn-submit-form" type="submit">Xác nhận chỉnh sửa</button>
                        </div>
                        <div class="infomation-content-rigit">
                            <div class="block-item">
                                <div class="block-item-title">
                                    <span>Số điện thoại: </span>
                                </div>
                                <div class="block-item-content">
                                    <input type="text" value="{{ $phone }}" readonly="" class="font-weight-bold not-change">
                                </div>
                            </div>
                            <div class="block-item">
                                <div class="block-item-title">
                                    <span>Email: </span>
                                </div>
                                <div class="block-item-content">
                                    <input type="email" value="{{ $email }}" readonly="" class="font-weight-bold" name="email" required="">
                                </div>
                            </div>
                            <div class="block-item">
                                <div class="block-item-title">
                                    <span>Địa chỉ: </span>
                                </div>
                                <div class="block-item-content">
                                    <input type="text" value="{{ $address }}" readonly="" class="font-weight-bold" name="address">
                                </div>
                            </div>
                            <div class="block-item">
                                <div class="block-item-title">
                                    <span>Số tài khoản: </span>
                                </div>
                                <div class="block-item-content">
                                    <input type="text" value="{{ $sotk }}" readonly="" class="font-weight-bold" name="stk" 
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="line"></div>
            <div class="col-md-6">
                <div class="block-infomation-university">
                    <p class="text-uppercase block-title">Thông tin cơ sở đào tạo</p>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Trường đại học: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" value="Trường Đại Học ABC" readonly="" class="font-weight-bold">
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Mã sinh viên: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" value="17103100124" readonly="" class="font-weight-bold">
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Chuyên ngành: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" value="Công Nghệ Thông Tin" readonly="" class="font-weight-bold">
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Lớp hành chính: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" value="ĐHTI11A2" readonly="" class="font-weight-bold">
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Loại chương trình đào tạo: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" value="Chính quy đợt 1" readonly="" class="font-weight-bold">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="block-infomation-university">
                    <p class="text-uppercase block-title">Thông tin người bảo trợ</p>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Họ tên: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" value="Nguyễn Văn A" readonly="" class="font-weight-bold">
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Số điện thoại: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" value="0123456789" readonly="" class="font-weight-bold">
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Căn cước công dân: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" value="142922188" readonly="" class="font-weight-bold">
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Giới tinh: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" value="Nam" readonly="" class="font-weight-bold">
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Số tài khoản: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" value="098765432123" readonly="" class="font-weight-bold">
                        </div>
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
<script type="text/javascript" src="{{ asset('js/Smoney/Student/studentLoan.js') }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".hidden").change(function(){
        var file_data = $('#file').prop('files')[0];
        var type = file_data.type;
        var match = ["image/gif", "image/png", "image/jpg","image/jpeg"];
        if (match.includes(type)) {
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
                url: "{!! route('student.changeAvatar') !!}",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                method: "POST",
                success: function (data) {
                    if(data['status'] == 'success'){
                        $(".image-avatar").css("background",`url(${data['linkImg']}) no-repeat`);
                        $(".image-avatar").css("background-size","cover");
                        $(".info-avatar").css("background",`url(${data['linkImg']}) no-repeat`);
                        $(".info-avatar").css("background-size","cover");
                    }
                }
            });
        }else {
            alert("Chỉ được upload file ảnh");
            $('#file').val('');
        }
    })
</script>
@stop