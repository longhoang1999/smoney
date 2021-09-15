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
<link rel="stylesheet" href="{{ asset('cropperjs/croppie.css') }}">
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
            <div class="col-md-3 block-avatar">
                <div class="image-avatar">
                </div>
                <div class="block-update-image">
                    <form action="" enctype="multipart/form-data" class="forn-avatar">
                        <button class="open-select-file" type="button">Tải ảnh lên</button> 
                        <input id="file" type="file" class="hidden" accept="image/*" name="avatar">
                    </form>
                </div>
            </div>
            <div class="col-md-9 div-block">
                <p class="text-uppercase block-title">
                    Thông tin cá nhân
                    <small class="btn-open-change mr-4" data-toggle="modal" data-target="#changeInforModel">Chỉnh sửa thông tin</small>
                    <small class="btn-open-change" data-toggle="modal" data-target="#changePassModel">Đổi mật khẩu</small>
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
                <div class="infomation-content">
                    <div class="infomation-content-left">
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Họ và tên: </span>
                            </div>
                            <div class="block-item-content">
                                <p>{{ $name }}</p>
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Email: </span>
                            </div>
                            <div class="block-item-content">
                                <p>{{ $email }}</p>
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Số căn cước công dân: </span>
                            </div>
                            <div class="block-item-content">
                                <p>{{ $cccd }}</p>
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Ngày sinh: </span>
                            </div>
                            <div class="block-item-content">
                                <p>{{ date("d/m/Y", strtotime($ngaysinh)) }}</p>
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Giới tính: </span>
                            </div>
                            <div class="block-item-content">
                                <p>{{ $gender }}</p>
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Số tài khoản: </span>
                            </div>
                            <div class="block-item-content not-flex">
                                @foreach($sotk as $value)
                                    <p>{{ $value }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="infomation-content-rigit">
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Số điện thoại:</span>
                            </div>
                            <div class="block-item-content">
                                <p>{{ $phone }}</p>
                            </div>
                        </div>

                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Số điện thoại khác:</span>
                            </div>
                            <div class="block-item-content not-flex">
                                @foreach($otherSdt as $value)
                                    <p>{{ $value }}</p>
                                @endforeach
                            </div>
                        </div>

                        <div class="block-item">
                            <div class="block-item-title">  
                                <span>Địa chỉ thường chú: </span>
                            </div>
                            <div class="block-item-content not-flex">
                                <p>{{ $addressString }}</p>
                            </div>
                        </div>

                        <div class="block-item">
                            <div class="block-item-title">  
                                <span>Nơi ở hiện tại: </span>
                            </div>
                            <div class="block-item-content not-flex">
                                <p>{{ $addressNowString }}</p>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>

            <!-- Trường -->
            <div class="line"></div>
            <div class="row justify-content-between" style="width: 100%;">
                <div class="col-md-12 div-block">
                    <div class="block-infomation-university">
                        <p class="text-uppercase block-title">
                            Thông tin cơ sở đào tạo
                            <ins class="ml-3 add-education-facility">Chỉnh sửa</ins>
                        </p>
                        <div class="block-numberic">
                            <div class="number mr-5">1</div>
                            <button type="button" class="btn btn-sm btn-light ">Chỉnh sửa</button>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Tên cơ sở: </span>
                            </div>
                            <div class="block-item-content">
                                <p>Trường Đại Học ABC</p>
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Mã sinh viên: </span>
                            </div>
                            <div class="block-item-content">
                                <p>17103100124</p>
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Chuyên ngành: </span>
                            </div>
                            <div class="block-item-content">
                                <p>Công Nghệ Thông Tin</p>
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Lớp hành chính: </span>
                            </div>
                            <div class="block-item-content">
                                <p>ĐHTI11A2</p>
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Loại chương trình đào tạo: </span>
                            </div>
                            <div class="block-item-content">
                                <p>Chính quy đợt 1</p>
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Email sinh viên do trường cung cấp: </span>
                            </div>
                            <div class="block-item-content">
                                <p>abc@dneti.edu.vn</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ================== -->
                <div class="line"></div>
                <!-- ================== -->
                <div class="col-md-12 div-block">
                    <div class="block-infomation-university">
                        <p class="text-uppercase block-title">
                            Thông tin người bảo trợ
                            <ins class="ml-3 add-family">Thêm mới</ins>
                        </p>
                        <div class="block-numberic">
                            <div class="number mr-5">1</div>
                            <button type="button" class="btn btn-sm btn-light ">Chỉnh sửa</button>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Họ tên: </span>
                            </div>
                            <div class="block-item-content">
                                <p>Nguyễn Văn A</p>
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Số điện thoại: </span>
                            </div>
                            <div class="block-item-content">
                                <p>0123456789</p>
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Số căn cước công dân: </span>
                            </div>
                            <div class="block-item-content">
                                <p>142922188</p>
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Giới tinh: </span>
                            </div>
                            <div class="block-item-content">
                                <p>Nam</p>
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Số tài khoản: </span>
                            </div>
                            <div class="block-item-content">
                                <p>098765432123</p>
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Quan hệ với sinh viên: </span>
                            </div>
                            <div class="block-item-content">
                                <p>Bố ruột</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- add trường -->
<div id="edit-info" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="education-facilities-new">
                <form method="post">
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Tên cơ sở: </span>
                        </div>
                        <div class="block-item-content">
                            <select id="select_ward" class="font-weight-bold">
                                <option value="">Đại học Công nghệ - DHQGHN</option>
                                <option value="">Đại học Kinh tế - DHQGHN</option>
                                <option value="">Đại học Công nghiệp Hà Nội</option>
                                <option value="">Đại học Thương mại</option>
                            </select>
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Mã sinh viên: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" class="font-weight-bold">
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Chuyên ngành: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" class="font-weight-bold">
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Lớp hành chính: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" class="font-weight-bold">
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Loại chương trình đào tạo: </span>
                        </div>
                        <div class="block-item-content">
                            <select id="select_ward" class="font-weight-bold">
                                <option value="">Chính quy</option>
                                <option value="">Không chính quy</option>
                            </select>
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Email sinh viên do trường cung cấp: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" class="font-weight-bold">
                        </div>
                    </div>
                    <button class="btn btn-sm btn-light mt-3" type="submit">Thêm cơ sở đào
                        tạo</button>
                </form>
            </div>
            <div class="family-info">
                <form method="post">
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Họ tên: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" class="font-weight-bold">
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Số điện thoại: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" class="font-weight-bold">
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Số căn cước công dân: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" class="font-weight-bold">
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Số tài khoản: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" class="font-weight-bold">
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Quan hệ với sinh viên: </span>
                        </div>
                        <div class="block-item-content">
                            <select id="select_ward" class="font-weight-bold">
                                <option value="">Mẹ ruột</option>
                                <option value="">Bố ruột</option>
                            </select>
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Email sinh viên do trường cung cấp: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" class="font-weight-bold">
                        </div>
                    </div>
                    <button class="btn btn-sm btn-light mt-3" type="submit">Thêm cơ sở đào
                        tạo</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- crop image -->
<div id="uploadimageModal" class="modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chỉnh sửa hình ảnh trước khi tải</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div id="image_demo" style="width:100%; margin-top:30px"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success crop_image">Upload Ảnh</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
            </div>
        </div>
    </div>
</div> 
<!-- Đổi mật khẩu -->
<div class="modal fade" id="changePassModel" tabindex="-1" role="dialog" aria-labelledby="changePassModelLable" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePassModelLable">Đổi mật khẩu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('student.studentChangepass') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="container-fuild">
                        <div class="row mb-3">
                            <div class="col-md-5">Nhập mật khẩu cũ</div>
                            <div class="col-md-7">
                                <input type="password" class="form-control" placeholder="Mật khẩu cũ (tối thiểu 8 ký tự)" required="" name="oldPass">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5">Nhập mật khẩu mới</div>
                            <div class="col-md-7">
                                <input type="password" class="form-control" placeholder="Mật khẩu mới (tối thiểu 8 ký tự)" required="" name="newPass">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5">Nhập lại mật khẩu mới</div>
                            <div class="col-md-7">
                                <input type="password" class="form-control" placeholder="Mật khẩu mới (tối thiểu 8 ký tự)" required="" name="confirmPass">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Xác nhận đổi mật khẩu</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Chỉnh sửa thông tin cá nhân -->
<div class="modal fade" id="changeInforModel" tabindex="-1" role="dialog" aria-labelledby="changeInforModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeInforModelLabel">Chỉnh sửa thông tin cá nhân của bạn</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form action="{{ route('student.updateInformation') }}" method="post" class="form-change-info">
                    @csrf
                    <div class="container-fuild">
                        <!-- Họ và tên -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <span class="font-weight-bold">Họ và tên:</span>
                            </div>
                            <div class="col-md-8">
                                <input type="text" value="{{ $name }}" name="fullname" required="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <small class="font-italic text-danger">Lưu ý: Nếu muốn sửa địa chỉ email bạn phải xác nhận thay đổi email trong hòm thư email cũ của bạn</small>
                            </div>
                        </div>
                        <!-- Email -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <span class="font-weight-bold">Email:</span>
                            </div>
                            <div class="col-md-8">
                                <input type="email" value="{{ $email }}" name="email" required="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <small class="font-italic text-danger">Lưu ý: Số điện thoại chính là điều kiện để bạn login vào hệ thống</small>
                            </div>
                        </div>
                        <!-- Main Phone -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <span class="font-weight-bold">Số điện thoại chính:</span>
                            </div>
                            <div class="col-md-8">
                                <input type="text" value="{{ $phone }}" name="phone" 
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                            </div>
                        </div>

                        <!-- Số căn cước công dân -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <span class="font-weight-bold">Số căn cước công dân:</span>
                            </div>
                            <div class="col-md-8">
                                <input type="text" value="{{ $cccd }}" name="cccd" 
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required="">
                            </div>
                        </div>

                        <!-- Ngày sinh -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <span class="font-weight-bold">Ngày sinh:</span>
                            </div>
                            <div class="col-md-8">
                                <input type="date" value="{{ $ngaysinh }}" name="date" required="">
                            </div>
                        </div>

                        <!-- Giới tính -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <span class="font-weight-bold">Giới tính:</span>
                            </div>
                            <div class="col-md-8">
                                <select name="gender" id="selecct-gender">
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

                        <!-- Số tài khoản -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <span class="font-weight-bold">Số tài khoản:</span>
                                <div class="btn-plus btn-plus-stk">
                                    Thêm mới
                                    <i class="fas fa-plus"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="parent-input-stk">
                                    @foreach($sotk as $value)
                                        <input type="text" value="{{ $value }}" name="stk[]" >
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Other Phone -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <span class="font-weight-bold">Số điện thoại khác:</span>
                                <div class="btn-plus btn-plus-other">
                                    Thêm mới
                                    <i class="fas fa-plus"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="parent-input-other">
                                    @foreach($otherSdt as $value)
                                        <input type="text" name="otherPhone[]" value="{{ $value }}" 
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <!-- Address -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <span class="font-weight-bold">Địa chỉ thường chú:</span>
                            </div>
                            <div class="col-md-8">
                                <p class="font-italic">Địa chỉ thường chú cũ: <span class="text-info">{{ $addressString }}</span></p>
                                <button class="btn btn-sm btn-info btn-fix-address" type="button">Sửa</button>
                                <div class="choose-address">
                                    <select name="select_province" id="select_province" class="font-weight-bold">
                                        <option hidden="" value="">Thành phố / Tỉnh</option>
                                        @foreach($province_address as $value)
                                            <option value="{{ $value->provinceid  }}">{{ $value->type }} {{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    <select name="select_district" id="select_district" class="font-weight-bold">
                                        <option hidden="" value="">Quận / Huyện</option>
                                    </select>
                                    <select name="select_ward" id="select_ward" class="font-weight-bold">
                                        <option hidden="" value="">Phường / Xã</option>
                                    </select>
                                    <input type="text" name="number_house" id="input-number-house" placeholder="Số nhà, đường (thôn, xóm)">
                                </div>
                            </div>
                        </div>

                        <!-- Address Now -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <span class="font-weight-bold">Nơi ở hiện tại:</span>
                            </div>
                            <div class="col-md-8">
                                <p class="font-italic">Nơi ở hiện tại cũ: <span class="text-info">{{ $addressNowString }}</span></p>
                                <button class="btn btn-sm btn-info btn-fix-addressNow" type="button">Sửa</button>
                                <div class="choose-address-now">
                                    <select name="select_provinceNow" id="select_province-now" class="font-weight-bold">
                                        <option hidden="" value="">Thành phố / Tỉnh</option>
                                        @foreach($province_address as $value)
                                            <option value="{{ $value->provinceid  }}">{{ $value->type }} {{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    <select name="select_districtNow" id="select_district-now" class="font-weight-bold">
                                        <option hidden="" value="">Quận / Huyện</option>
                                    </select>
                                    <select name="select_wardNow" id="select_ward-now" class="font-weight-bold">
                                        <option hidden="" value="">Phường / Xã</option>
                                    </select>
                                    <input type="text" name="numberHouseNow" id="inputNumberHouseNow" placeholder="Số nhà, đường (thôn, xóm)">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="modal-footer">
                <button class="btn btn-primary btn-submit-form" type="button">Xác nhận chỉnh sửa</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
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
<script type="text/javascript" src="{{ asset('cropperjs/croppie.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/Smoney/Student/student.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/Smoney/Student/studentLoan.js') }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $image_crop = $('#image_demo').croppie({
        enableExif: true,
        viewport: {
            width:250,
            height:250,
            type:'circle' //square
        },
        boundary:{
            width:500,
            height:350
        }
    });

    $('.hidden').on('change', function(){
        var reader = new FileReader();
        reader.onload = function (event) {
            $image_crop.croppie('bind', {
                url: event.target.result
            }).then(function(){
                console.log('jQuery bind complete');
            });
        }
        reader.readAsDataURL(this.files[0]);
        $('#uploadimageModal').modal('show');
    });

    $('.crop_image').click(function(event){
        $image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function(response){
            $.ajax({
                url:"{!! route('student.changeAvatar') !!}",
                method: "POST",
                data:{"image": response},
                success:function(data)
                {
                    if(data['status'] == 'success'){
                        $('#uploadimageModal').modal('hide');
                        $(".image-avatar").css("background",`url(${data['linkImg']}) no-repeat`);
                        $(".image-avatar").css("background-size","cover");
                        $(".info-avatar").css("background",`url(${data['linkImg']}) no-repeat`);
                        $(".info-avatar").css("background-size","cover");
                    }
                }
            });
        })
    });

        
    // $(".hidden").change(function(){
    //     var file_data = $('#file').prop('files')[0];
    //     var type = file_data.type;
    //     var match = ["image/gif", "image/png", "image/jpg","image/jpeg"];
    //     if (match.includes(type)) {
    //         var form_data = new FormData();
    //         form_data.append('file', file_data);
    //         $.ajax({
    //             url: "{!! route('student.changeAvatar') !!}",
    //             cache: false,
    //             contentType: false,
    //             processData: false,
    //             data: form_data,
    //             method: "POST",
    //             success: function (data) {
    //                 if(data['status'] == 'success'){
    //                     $(".image-avatar").css("background",`url(${data['linkImg']}) no-repeat`);
    //                     $(".image-avatar").css("background-size","cover");
    //                     $(".info-avatar").css("background",`url(${data['linkImg']}) no-repeat`);
    //                     $(".info-avatar").css("background-size","cover");
    //                 }
    //             }
    //         });
    //     }else {
    //         alert("Chỉ được upload file ảnh");
    //         $('#file').val('');
    //     }
    // })
    

    //  select address
    $("#select_province").change(function() {
        $.ajax({
            method: "POST",
            url: "{!! route('student.findDistrict') !!}",
            data: {'provinceID': $(this).val()},
            success: function(data)
            {
                if(data['status'] === "success")
                {
                    let district = data['district_address'];
                    $("#select_district").empty();
                    $("#select_district").append('<option hidden="" value="">Quận / Huyện</option>');
                    district.forEach((item, index) => {
                        $("#select_district").append(`<option value="${item['districtid']}">${item['type']} ${item['name']}</option>`);
                    })
                }
            }
        });
    })
    $("#select_district").change(function() {
        $.ajax({
            method: "POST",
            url: "{!! route('student.findWard') !!}",
            data: {'districtID': $(this).val()},
            success: function(data)
            {
                if(data['status'] === "success")
                {
                    let ward = data['ward_address'];
                    $("#select_ward").empty();
                    $("#select_ward").append('<option hidden="" value="">Phường / Xã</option>');
                    ward.forEach((item, index) => {
                        $("#select_ward").append(`<option value="${item['wardid']}">${item['type']} ${item['name']}</option>`);
                    })
                }
            }
        });
    })
    // address now
    $("#select_province-now").change(function() {
        $.ajax({
            method: "POST",
            url: "{!! route('student.findDistrict') !!}",
            data: {'provinceID': $(this).val()},
            success: function(data)
            {
                if(data['status'] === "success")
                {
                    let district = data['district_address'];
                    $("#select_district-now").empty();
                    $("#select_district-now").append('<option hidden="" value="">Quận / Huyện</option>');
                    district.forEach((item, index) => {
                        $("#select_district-now").append(`<option value="${item['districtid']}">${item['type']} ${item['name']}</option>`);
                    })
                }
            }
        });
    })
    $("#select_district-now").change(function() {
        $.ajax({
            method: "POST",
            url: "{!! route('student.findWard') !!}",
            data: {'districtID': $(this).val()},
            success: function(data)
            {
                if(data['status'] === "success")
                {
                    let ward = data['ward_address'];
                    $("#select_ward-now").empty();
                    $("#select_ward-now").append('<option hidden="" value="">Phường / Xã</option>');
                    ward.forEach((item, index) => {
                        $("#select_ward-now").append(`<option value="${item['wardid']}">${item['type']} ${item['name']}</option>`);
                    })
                }
            }
        });
    })

    //Đây nữa
    $('.add-education-facility').click(function() {
        $('#edit-info').modal('show');
        $('.education-facilities-new').show();
        $('.family-info').hide();
    });

    $('.add-family').click(function() {
        $('#edit-info').modal('show');
        $('.family-info').show();
        $('.education-facilities-new').hide();
    });
</script>
@stop