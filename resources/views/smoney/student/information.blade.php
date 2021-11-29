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
<link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}">
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('css/Smoney/Student/custom-information.css') }}" rel="stylesheet" />
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
            <div class="col-md-9 div-block mt-0">
                <div class="block-title">
                    <p class="text-uppercase text-primary m-0">Thông tin cá nhân</p>
                    <div class="btn-title">
                        <button type="button" class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#changeInforModel">
                            <i class="fas fa-pen"></i>
                            Chỉnh sửa
                        </button>

                        <button type="button" class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#changePassModel">
                            Đổi mật khẩu
                        </button>
                    </div>
                </div>

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
                    <table>
                        <tr>
                            <td>
                                <span>Họ và tên</span>
                            </td>
                            <td>
                                <span>{{ $name }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Email</span>
                            </td>
                            <td>
                                <span>{{ $email }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Số căn cước công dân</span>
                            </td>
                            <td>
                                <span>{{ $cccd }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Ngày sinh</span>
                            </td>
                            <td>
                                <span>{{ date("d/m/Y", strtotime($ngaysinh)) }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Giới tính</span>
                            </td>
                            <td>
                                <span>{{ $gender }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Số tài khoản</span>
                            </td>
                            <td>
                                @if($sotk != null)
                                    @foreach($sotk as $value)
                                        <span>{{ $value }}</span>
                                    @endforeach
                                @else
                                    <span>Trống</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Số điện thoại</span>
                            </td>
                            <td>
                                <span>{{ $phone }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Số điện thoại khác</span>
                            </td>
                            <td>
                                @if($otherSdt != null)
                                    @foreach($otherSdt as $value)
                                        <span>{{ $value }}</span>
                                    @endforeach
                                @else
                                    <span>Trống</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Địa chỉ thường chú</span>
                            </td>
                            <td>
                                <span>{{ $addressString }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Nơi ở hiện tại</span>
                            </td>
                            <td>
                                <span>{{ $addressNowString }}</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Trường -->
            <!-- <div class="line"></div> -->
            <div class="row justify-content-between" style="width: 100%;">
                <div class="col-md-12 div-block">
                    <div class="block-title">
                        <p class="text-uppercase text-primary m-0">Thông tin cơ sở đào tạo</p>
                        <div class="btn-title">
                            <button type="button" class="btn btn-outline-success mr-2 add-education-facility">
                                <i class="fas fa-plus-circle"></i>
                                Thêm mới
                            </button>
                        </div>
                    </div>

                    @if($university != null)
                    @foreach($university as $value)
                        <div class="infomation-content">
                            <div class="block-name-uni">
                                <div class="block-name-uni-left">
                                    <p>{{ $value["index"] }}. {{ $value['name'] }}</p>
                                </div>
                            </div>
                            <table class="mb-0">
                                <tr>
                                    <td>
                                        <span>Mã sinh viên</span>
                                    </td>
                                    <td>
                                        <span>{{ $value['studentCode'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Chuyên ngành</span>
                                    </td>
                                    <td>
                                        <span>{{ $value['specialized'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Lớp hành chính</span>
                                    </td>
                                    <td>
                                        <span>{{ $value['nameClass'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Loại chương trình đào tạo</span>
                                    </td>
                                    <td>
                                        <span>{{ $value['typeProgram'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Email sinh viên do trường cung cấp</span>
                                    </td>
                                    <td>
                                        <span>{{ $value['emailStudent'] }}</span>
                                    </td>
                                </tr>
                            </table>
                            <div class="block-btn-uni mb-4">
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#editUni_{{ $value['index'] }}">
                                    <i class="fas fa-pen"></i>
                                    Chỉnh sửa
                                </button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteUniModel" data-id="{{ $value['id'] }}" data-name="{{ $value['name'] }}">
                                    Xóa
                                </button>
                            </div>
                        </div>
                    @endforeach
                    @else
                        <div class="block-item">
                            <span class="font-italic text-primary">============ Bạn chưa khai báo thông tin về cơ sở đào tạo mà bạn theo học ============</span>
                        </div>
                    @endif
                </div>

                <!-- ================== -->
                <!-- <div class="line"></div> -->
                <!-- ================== -->

                <div class="col-md-12 div-block">
                    <div class="block-title">
                        <p class="text-uppercase text-primary m-0">Thông tin người bảo trợ</p>
                        <div class="btn-title">
                            <button type="button" class="btn btn-outline-success mr-2 add-family">
                                <i class="fas fa-plus-circle"></i>
                                Thêm mới
                            </button>
                        </div>
                    </div>

                    @if($parents != null)
                    @for($i = 0; $i < count($parents); $i++)
                        <div class="infomation-content">
                            <div class="block-name-uni">
                                <div class="block-name-uni-left">
                                    <p>{{ $i + 1 }}. {{ $parents[$i]["fullname"] }}</p>
                                </div>
                            </div>
                            <table class="mb-0">
                                <tr>
                                    <td>
                                        <span>Số điện thoại</span>
                                    </td>
                                    <td>
                                        <span>{{ $parents[$i]["phone"] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Số căn cước công dân</span>
                                    </td>
                                    <td>
                                        <span>{{ $parents[$i]["cccd"] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Giới tính</span>
                                    </td>
                                    <td>
                                        <span>{{ $parents[$i]["gender"] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Số tài khoản</span>
                                    </td>
                                    <td>
                                        <span>{{ $parents[$i]["stk"] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Quan hệ với sinh viên</span>
                                    </td>
                                    <td>
                                        <span>{{ $parents[$i]["relationship"] }}</span>
                                    </td>
                                </tr>
                            </table>
                            <div class="block-btn-uni mb-4">
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#editParent_{{ $i }}">
                                    <i class="fas fa-pen"></i>
                                    Chỉnh sửa
                                </button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteParentModal" data-id="{{ $i }}" data-name="{{ $parents[$i]['fullname'] }}">
                                    Xóa
                                </button>
                            </div>
                        </div>
                    @endfor
                    @else
                        <div class="block-item">
                            <span class="font-italic text-primary">============ Bạn chưa khai báo thông tin về người bảo trợ của bạn ============</span>
                        </div>
                    @endif
                </div>

                <!-- ================== -->
                <!-- <div class="line"></div> -->
                <!-- ================== -->

                <div class="col-md-12 div-block">
                    <div class="block-title">
                        <p class="text-uppercase text-primary m-0">Thông tin việc làm của bạn</p>
                        <div class="btn-title">
                            <button type="button" class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#fixInforJob">
                                <i class="fas fa-pen"></i>
                                Chỉnh sửa
                            </button>
                        </div>
                    </div>

                    @if($yourjob != null)
                        <div class="infomation-content">
                            <table>
                                <tr>
                                    <td>
                                        <span>Tình trạng việc làm của bạn</span>
                                    </td>
                                    <td>
                                        <span>
                                            @if($yourjob['jobstatus'] == "1")
                                                Đang đi làm thuê
                                            @elseif($yourjob['jobstatus'] == "2")
                                                Tự kinh doanh
                                            @elseif($yourjob['jobstatus'] == "3")
                                                Không đi làm
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Thời gian bạn làm việc</span>
                                    </td>
                                    <td>
                                        @if($yourjob['jobstatus'] != "3")
                                            @if($yourjob['timeJob']  == "1")
                                                <span>Fulltime</span>
                                            @elseif($yourjob['timeJob']  == "2")
                                                <span>Parttime</span>
                                            @elseif($yourjob['timeJob']  == "3")
                                                <span>Fieldtrip</span>
                                            @endif
                                        @else
                                            <span class="font-italic">Trống - do bạn không đi làm</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Tên cơ sở bạn làm việc</span>
                                    </td>
                                    <td>
                                        <span>
                                            @if($yourjob['jobstatus'] != "3")
                                                <span>{{ $yourjob['nameCompany'] }}</span>
                                            @else
                                                <span class="font-italic">Trống - do bạn không đi làm</span>
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Địa chỉ nơi bạn làm việc</span>
                                    </td>
                                    <td>
                                        @if($yourjob['jobstatus'] != "3")
                                            <span>{{ $yourjob['addressCompany'] }}</span>
                                        @else
                                            <span class="font-italic">Trống - do bạn không đi làm</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Chia sẻ mức lương trung bình của bạn</span>
                                    </td>
                                    <td>
                                        @if($yourjob['jobstatus'] != "3")
                                            <span>
                                                {{ number_format($yourjob['money']) }} VNĐ
                                            </span>
                                        @else
                                            <span class="font-italic">Trống - do bạn không đi làm</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @else
                        <div class="block-item">
                            <span class="font-italic text-primary">=============Bạn chưa cập nhật nội dung việc làm với hệ thống==============</span>
                        </div>
                    @endif
                </div>
                <!-- ================== -->
            </div>
        </div>
    </div>
</div>

<!-- fix your job -->
<div class="modal fade" id="fixInforJob" tabindex="-1" role="dialog" aria-labelledby="fixInforJobLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fixInforJobLabel">Chỉnh sửa thông tin việc làm của bạn</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('student.jobStatus') }}" method="post">
                @csrf
                <div class="modal-body container">
                    <div class="row mb-4">
                        <div class="col-md-5">
                            Tình trạng việc làm của bạn:
                        </div>
                        <div class="col-md-7">
                            <select name="jobstatus" id="jobstatus">
                                @if($yourjob != null)
                                    <option value="1"
                                        @if($yourjob['jobstatus'] == "1")
                                            selected="" 
                                        @endif
                                    >Đang đi làm thuê</option>

                                    <option value="2"
                                        @if($yourjob['jobstatus'] == "2")
                                            selected="" 
                                        @endif
                                    >Tự kinh doanh</option>

                                    <option value="3"
                                        @if($yourjob['jobstatus'] == "3")
                                            selected="" 
                                        @endif
                                    >Không đi làm</option>
                                @else
                                    <option value="1">Đang làm thuê</option>
                                    <option value="2">Tự kinh doanh</option>
                                    <option value="3">Không đi làm</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="for-jobstatus">
                        <div class="row mb-4">
                            <div class="col-md-5">
                                Thời gian làm việc của bạn:
                            </div>
                            <div class="col-md-7">
                                <select name="timeJob">
                                    @if($yourjob != null)
                                        <option value="1"
                                            @if($yourjob['timeJob'] == "1")
                                                selected="" 
                                            @endif
                                        >Fulltime</option>

                                        <option value="2"
                                            @if($yourjob['timeJob'] == "2")
                                                selected="" 
                                            @endif
                                        >Parttime</option>

                                        <option value="3"
                                            @if($yourjob['timeJob'] == "3")
                                                selected="" 
                                            @endif
                                        >Fieldtrip</option>
                                    @else
                                        <option value="1">Fulltime</option>
                                        <option value="2">Parttime</option>
                                        <option value="3">Fieldtrip</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-5">
                                Tên cơ sở bạn làm việc:
                            </div>
                            <div class="col-md-7">
                                @if($yourjob != null)
                                    <input type="text" name="nameCompany" value="{{ $yourjob['nameCompany'] }}">
                                @else
                                    <input type="text" name="nameCompany">
                                @endif
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-5">
                                Địa chỉ nơi bạn làm việc:
                            </div>
                            <div class="col-md-7">
                                @if($yourjob != null)
                                    <input type="text" name="addressCompany" value="{{ $yourjob['addressCompany'] }}">
                                @else
                                    <input type="text" name="addressCompany">
                                @endif
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                Chia sẻ mức lương trung bình của bạn:
                            </div>
                            <div class="col-md-12">
                                <!-- số tiền -->
                                <div class="range">
                                    <div class="form-group range__value">
                                        <span class="show-money"></span>    
                                        <div class="range__value_control">
                                            <div class="plus">
                                                <i class="fas fa-sort-up"></i>
                                            </div>
                                            <div class="sub">
                                                <i class="fas fa-sort-down"></i>
                                            </div>
                                        </div>         
                                    </div>
                                    <div class="form-group range__slider">
                                        <div class="range__slider_child">
                                            <span class="money-from">1 triệu</span>
                                            <input type="range" step="50000" name="money">
                                            <span class="money-to">20 triệu</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Số tiền -->

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- add trường -->
<div id="edit-info" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="edit-info-header">Thêm một cơ sở đào tạo mới</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="education-facilities-new">
                <form method="post" action="{{ route('student.addUniversity') }}">
                    @csrf
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Tên cơ sở: </span>
                        </div>
                        <div class="block-item-content">
                            <select class="font-weight-bold" name="idUni">
                                @if($university != null)
                                    @foreach($allUni as $value)
                                        @if(in_array($value->nt_id, $uniAr))
                                            <option disabled="">{{ $value->nt_ten }}</option>
                                        @else
                                            <option value="{{ $value->nt_id }}">{{ $value->nt_ten }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach($allUni as $value)
                                        <option value="{{ $value->nt_id }}">{{ $value->nt_ten }}</option>
                                    @endforeach
                                @endif  
                            </select>
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Mã sinh viên: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" class="font-weight-bold" required="" name="studentCode">
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Chuyên ngành: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" class="font-weight-bold" name="specialized" required="">
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Lớp hành chính: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" class="font-weight-bold" name="nameClass" required="">
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Loại chương trình đào tạo: </span>
                        </div>
                        <div class="block-item-content">
                            <select class="font-weight-bold" name="typeProgram">
                                <option value="Chính quy">Chính quy</option>
                                <option value="Không chính quy">Không chính quy</option>
                            </select>
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Email sinh viên do trường cung cấp: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="email" class="font-weight-bold" name="emailStudent">
                        </div>
                    </div>
                    <div class="block-btn-center">
                        <button class="btn btn-primary mt-3" type="submit">Thêm cơ sở đào tạo</button>
                    </div>
                </form>
            </div>
            <div class="family-info">
                <form method="post" action="{{ route('student.addParents') }}">
                    @csrf
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Họ tên: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" required="" name="fullname">
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Số điện thoại: </span>
                        </div>
                        <div class="block-item-content">
                            <input name="phone" type="text" required="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Số căn cước công dân: </span>
                        </div>
                        <div class="block-item-content">
                            <input name="cccd" type="text" required="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Giới tính: </span>
                        </div>
                        <div class="block-item-content">
                            <select name="gender">
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                                <option value="Khác">Khác</option>
                            </select>
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Số tài khoản: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" name="stk">
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="block-item-title">
                            <span>Quan hệ với sinh viên: </span>
                        </div>
                        <div class="block-item-content">
                            <input type="text" required="" name="relationship">
                        </div>
                    </div>
                    <div class="block-btn-center">
                        <button class="btn btn-primary mt-3" type="submit">Thêm thông tin người bảo trợ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Chỉnh sửa nhà trường -->
@if($university != null)
@foreach($university as $value)
    <div class="modal fade edit-university" id="editUni_{{ $value['index'] }}" tabindex="-1" role="dialog" aria-labelledby="editUni_{{ $value['index'] }}_Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUni_{{ $value['index'] }}_Label">Chỉnh sửa thông tin cơ sở đào tạo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('student.editUniversity',$value['id']) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    Tên cơ sở:
                                </div>
                                <div class="col-md-6">
                                    <select name="idUni">
                                        @foreach($allUni as $uni)
                                            @if($value["id"] == $uni->nt_id)
                                                <option selected="" value="{{ $uni->nt_id }}">{{ $uni->nt_ten }}</option>
                                            @elseif(in_array($uni->nt_id, $uniAr))
                                                <option disabled="">{{ $uni->nt_ten }}</option>
                                            @else
                                                <option value="{{ $uni->nt_id }}">{{ $uni->nt_ten }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    Mã sinh viên:
                                </div>
                                <div class="col-md-6">
                                    <input type="text" required="" name="studentCode" value="{{ $value['studentCode'] }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    Chuyên ngành
                                </div>
                                <div class="col-md-6">
                                    <input type="text" required="" name="specialized" value="{{ $value['specialized'] }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    Lớp hành chính
                                </div>
                                <div class="col-md-6">
                                    <input type="text" required="" name="nameClass" value="{{ $value['nameClass'] }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    Loại chương trình đào tạo
                                </div>
                                <div class="col-md-6">
                                    <select name="typeProgram">
                                        <option
                                            @if($value["typeProgram"] == "Chính quy")
                                                selected=""
                                            @endif
                                        value="Chính quy">Chính quy</option>
                                        <option
                                            @if($value["typeProgram"] == "Không chính quy")
                                                selected=""
                                            @endif
                                        value="Không chính quy">Không chính quy</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    Email sinh viên do trường cung cấp:
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="emailStudent" value="{{ $value['emailStudent'] }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">Sửa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
@endif

<!-- Xóa nhà trường -->
<div class="modal fade" id="deleteUniModel" tabindex="-1" role="dialog" aria-labelledby="deleteUniModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUniModelLabel">Cảnh báo!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-danger">Bạn có thực sự muốn xóa thông tin về trường 
                    "<span class="text-info font-italic name-uni-delete"></span> " không?
                </p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-danger btn-delete-uni">Có</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
            </div>
        </div>
    </div>
</div>


<!-- Chỉnh sửa người bảo trợ -->
@if($parents != null)
@for($i = 0; $i < count($parents); $i++)
    <div class="modal fade edit-university" id="editParent_{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="editParent_{{ $i }}_Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editParent_{{ $i }}_Label">Chỉnh sửa thông tin người bảo trợ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('student.editParents', $i) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    Họ và tên:
                                </div>
                                <div class="col-md-7">
                                    <input type="text" value="{{ $parents[$i]['fullname'] }}" name="fullname" required="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    Số điện thoại:
                                </div>
                                <div class="col-md-7">
                                    <input type="text" value="{{ $parents[$i]['phone'] }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="phone" required="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    Số chứng minh thư:
                                </div>
                                <div class="col-md-7">
                                    <input type="text" value="{{ $parents[$i]['cccd'] }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="cccd" required="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    Giới tính:
                                </div>
                                <div class="col-md-7">
                                    <select name="gender">
                                        <option value="Nam"
                                            @if($parents[$i]['gender'] == 'Nam')
                                                selected="" 
                                            @endif
                                        >Nam</option>
                                        <option value="Nữ"
                                            @if($parents[$i]['gender'] == 'Nữ')
                                                selected="" 
                                            @endif
                                        >Nữ</option>
                                        <option value="Khác"
                                            @if($parents[$i]['gender'] == 'Khác')
                                                selected="" 
                                            @endif
                                        >Khác</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    Số tài khoản:
                                </div>
                                <div class="col-md-7">
                                    <input type="text" value="{{ $parents[$i]['stk'] }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="stk">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    Quan hệ với sinh viên:
                                </div>
                                <div class="col-md-7">
                                    <input type="text" value="{{ $parents[$i]['relationship'] }}"
                                     name="relationship" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">Sửa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endfor
@endif

<!-- Xóa người bảo trợ -->
<div class="modal fade" id="deleteParentModal" tabindex="-1" role="dialog" aria-labelledby="deleteParentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteParentModalLabel">Cảnh báo!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-danger">Bạn có thực sự muốn xóa thông tin về người bảo trợ 
                    "<span class="text-info font-italic name-parent-delete"></span> " không?
                </p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-danger btn-delete-parent">Có</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
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
                    <div class="block-btn-center">
                        <button type="submit" class="btn btn-primary mr-2">Xác nhận đổi mật khẩu</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Chỉnh sửa thông tin cá nhân -->
<div class="modal fade" id="changeInforModel" tabindex="-1" role="dialog" aria-labelledby="changeInforModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
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
                    <small class="font-italic text-danger">
                        Lưu ý: Nếu muốn sửa địa chỉ email bạn phải xác nhận thay đổi email trong hòm thư email cũ của bạn
                    </small>
                    <br>
                    <small class="font-italic text-danger">
                        Lưu ý: Số điện thoại chính là điều kiện để bạn login vào hệ thống
                    </small>
                    
                    <div class="infomation-content">
                        <div class="block-personal-infor">
                            <table>
                                <tr>
                                    <td>
                                        <span>Họ và tên</span>
                                    </td>
                                    <td>
                                        <input type="text" value="{{ $name }}" name="fullname" required="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Email</span>
                                    </td>
                                    <td>
                                        <input type="email" value="{{ $email }}" name="email" required="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Số điện thoại chính</span>
                                    </td>
                                    <td>
                                        <input type="text" value="{{ $phone }}" name="phone" 
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Số căn cước công dân</span>
                                    </td>
                                    <td>
                                        <input type="text" value="{{ $cccd }}" name="cccd" 
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Ngày sinh</span>
                                    </td>
                                    <td >
                                        <div class="block_choose_date">
                                            <input type="text" value="{{ $ngaysinh }}" id="inputDoB" name="date" required="" placeholder="Chọn ngày tháng">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Giới tính</span>
                                    </td>
                                    <td >
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
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Số tài khoản</span>
                                        <div class="btn-plus btn-plus-stk">
                                            Thêm mới
                                            <i class="fas fa-plus-circle"></i>
                                        </div>
                                    </td>
                                    <td >
                                        <div class="parent-input-stk">
                                            @if($sotk != null)
                                                @foreach($sotk as $value)
                                                    <input type="text" value="{{ $value }}" name="stk[]" >
                                                @endforeach
                                            @else
                                               <input type="text" name="stk[]" placeholder="Ví dụ: 0123456789 - Agribank - Chi nhánh Hà Nội">
                                            @endif 
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Số điện thoại khác</span>
                                        <div class="btn-plus btn-plus-other">
                                            Thêm mới
                                            <i class="fas fa-plus-circle"></i>
                                        </div>
                                    </td>
                                    <td >
                                        <div class="parent-input-other">
                                            @if($otherSdt != null)
                                                @foreach($otherSdt as $value)
                                                    <input type="text" name="otherPhone[]" value="{{ $value }}" 
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                                @endforeach
                                            @else
                                                <input type="text" name="otherPhone[]" 
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                    placeholder="Số điện thoại khác" 
                                                >
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Địa chỉ thường chú</span>
                                    </td>
                                    <td >
                                        @if($addressString != null)
                                        <p class="font-italic">Địa chỉ thường chú cũ: <span class="text-info">{{ $addressString }}</span></p>
                                        @endif
                                        <button class="btn btn-sm btn-info btn-fix-address" type="button">Sửa</button>
                                        <div class="choose-address">
                                            <div class="choose-address-select">
                                                <select name="select_province" id="select_province" class="font-weight-bold">
                                                    <option hidden="" value="">Thành phố / Tỉnh</option>
                                                    @foreach($province_address as $value)
                                                        <option value="{{ $value->provinceid  }}">{{ $value->type }} {{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="choose-address-select">
                                                <select name="select_district" id="select_district" class="font-weight-bold">
                                                    <option hidden="" value="">Quận / Huyện</option>
                                                </select>
                                            </div>
                                            <div class="choose-address-select">
                                                <select name="select_ward" id="select_ward" class="font-weight-bold">
                                                    <option hidden="" value="">Phường / Xã</option>
                                                </select>
                                            </div>
                                            
                                            <input type="text" name="number_house" id="input-number-house" placeholder="Số nhà, đường (thôn, xóm)">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Nơi ở hiện tại</span>
                                    </td>
                                    <td >
                                        @if($addressNowString != null)
                                        <p class="font-italic">Nơi ở hiện tại cũ: <span class="text-info">{{ $addressNowString }}</span></p>
                                        @endif
                                        <button class="btn btn-sm btn-info btn-fix-addressNow" type="button">Sửa</button>
                                        <div class="choose-address-now">
                                            <div class="choose-address-select">
                                                <select name="select_provinceNow" id="select_province-now" class="font-weight-bold">
                                                    <option hidden="" value="">Thành phố / Tỉnh</option>
                                                    @foreach($province_address as $value)
                                                        <option value="{{ $value->provinceid  }}">{{ $value->type }} {{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="choose-address-select">
                                                <select name="select_districtNow" id="select_district-now" class="font-weight-bold">
                                                    <option hidden="" value="">Quận / Huyện</option>
                                                </select>
                                            </div>
                                            <div class="choose-address-select">
                                                <select name="select_wardNow" id="select_ward-now" class="font-weight-bold">
                                                    <option hidden="" value="">Phường / Xã</option>
                                                </select>
                                            </div>
                                            <input type="text" name="numberHouseNow" id="inputNumberHouseNow" placeholder="Số nhà, đường (thôn, xóm)">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <button class="submit-hide">Submit check validate</button>
                </form>
                <div class="block-btn-center">
                    <button class="btn btn-primary btn-submit-form mr-2" type="button">Xác nhận chỉnh sửa</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
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
<script type="text/javascript" src="{{ asset('cropperjs/croppie.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/Smoney/Student/student.js') }}"></script>
<script src="{{ asset('js/flatpickr.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
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

    var $url_path = '{!! url('/') !!}';
    $('#deleteUniModel').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let id = button.data('id');
        let name = button.data('name');
        let modal = $(this);
        modal.find('.name-uni-delete').text(name);
        modal.find('.btn-delete-uni').attr("href",$url_path+"/delete-infor-university/"+id);
    })
    
    $('#deleteParentModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let id = button.data('id');
        let name = button.data('name');
        let modal = $(this);
        modal.find('.name-parent-delete').text(name);
        modal.find('.btn-delete-parent').attr("href",$url_path+"/delete-infor-parent/"+id);
    })
    // date input
    flatpickr("#inputDoB", {
        altInput: true,
        altFormat: "d/m/Y",
        dateFormat: "Y-m-d",
    });
    // select 2
    $("#select_province").select2();
    $("#select_district").select2();
    $("#select_ward").select2();
    $("#select_province-now").select2();
    $("#select_district-now").select2();
    $("#select_ward-now").select2();

    // set up input range
    var min = 1000000;
    var max = 20000000;
    var cur = 3000000;
    @if($yourjob != null)
        @if($yourjob['jobstatus'] == "3")
            $(".for-jobstatus").hide();
        @endif
        cur = {{ $yourjob['money'] }};
    @endif
</script>
<script type="text/javascript" src="{{ asset('js/Smoney/Student/studentLoan.js') }}"></script>
@stop