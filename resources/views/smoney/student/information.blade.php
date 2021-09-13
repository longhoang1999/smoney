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
                                    <p>{{ $name }}</p>
                                    <input type="text" value="{{ $name }}" readonly="" class="font-weight-bold" name="fullname" required="">
                                </div>
                            </div>
                            <div class="block-item">
                                <div class="block-item-title">
                                    <span>Email: </span>
                                </div>
                                <div class="block-item-content">
                                    <p>{{ $email }}</p>
                                    <input type="email" value="{{ $email }}" readonly="" class="font-weight-bold" name="email" required="">
                                </div>
                            </div>
                            <div class="block-item">
                                <div class="block-item-title">
                                    <span>Số căn cước công dân: </span>
                                </div>
                                <div class="block-item-content">
                                    <p>{{ $cccd }}</p>
                                    <input type="text" value="{{ $cccd }}" readonly="" class="font-weight-bold" name="cccd" 
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required="">
                                </div>
                            </div>
                            <div class="block-item">
                                <div class="block-item-title">
                                    <span>Ngày sinh: </span>
                                </div>
                                <div class="block-item-content">
                                    <p>{{ date("d/m/Y", strtotime($ngaysinh)) }}</p>
                                    <input type="date" value="{{ $ngaysinh }}" readonly="" class="font-weight-bold" name="date" required="">
                                </div>
                            </div>
                            <div class="block-item">
                                <div class="block-item-title">
                                    <span>Giới tính: </span>
                                </div>
                                <div class="block-item-content">
                                    <p>{{ $gender }}</p>
                                    <select name="gender" id="selecct-gender" disabled="" class="font-weight-bold">
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
                            <div class="block-item">
                                <div class="block-item-title">
                                    <span>Số tài khoản: </span>
                                </div>
                                <div class="block-item-content">
                                    <p>
                                        <span>{{ $sotk }}</span>
                                    </p>
                                    <div class="btn-plus">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <input type="text" value="{{ $sotk }}" readonly="" class="font-weight-bold" name="stk" 
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                </div>
                            </div>
                            <button class="btn btn-sm btn-light mt-3 btn-submit-form" type="submit">Xác nhận chỉnh sửa</button>
                        </div>
                        <div class="infomation-content-rigit">
                            <div class="block-item">
                                <div class="block-item-title">
                                    <span>Số điện thoại chình:
                                        <br>
                                        <small class="font-italic">(dùng làm tài khoản đăng nhập hệ thống)</small>
                                    </span>
                                </div>
                                <div class="block-item-content">
                                    <p class="not-change">{{ $phone }}</p>
                                    <input type="text" value="{{ $phone }}" readonly="" class="font-weight-bold not-change">
                                </div>
                            </div>

                            <div class="block-item">
                                <div class="block-item-title">
                                    <span>Số điện thoại khác:
                                    </span>
                                </div>
                                <div class="block-item-content">
                                    <p class="not-change">01234567</p>
                                    <div class="btn-plus">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="block-item">
                                <div class="block-item-title">
                                    <span>Địa chỉ thường chú: </span>
                                </div>
                                <div class="block-item-content">
                                    <p>{{ $address }}</p>

                                    <select id="select_province" class="font-weight-bold">
                                        <option hidden="" value="">Thành phố / Tỉnh</option>
                                        @foreach($province_address as $value)
                                            <option value="{{ $value->provinceid  }}">{{ $value->type }} {{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    <select id="select_district" class="font-weight-bold">
                                        <option hidden="" value="">Quận / Huyện</option>
                                    </select>
                                    <select id="select_ward" class="font-weight-bold">
                                        <option hidden="" value="">Phường / Xã</option>
                                    </select>

                                    <input type="text" value="{{ $address }}" readonly="" class="font-weight-bold not-change" name="address" id="input-address" >
                                </div>
                            </div>
                            <div class="block-item">
                                <div class="block-item-title">
                                    <span>Số nhà(đường, phố): </span>
                                </div>
                                <div class="block-item-content">
                                    <p>Số nhà 21 ngõ 100 Kim ngưu</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="line"></div>
            <div class="row justify-content-between" style="width: 100%;">
                <div class="col-md-12 div-block">
                    <div class="block-infomation-university">
                        <p class="text-uppercase block-title">
                            Thông tin cơ sở đào tạo
                            <ins class="ml-3">Thêm mới</ins>
                        </p>
                        <div class="number">1</div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Tên cơ sở: </span>
                            </div>
                            <div class="block-item-content">
                                <p>Trường Đại Học ABC</p>
                                <input type="text" value="Trường Đại Học ABC" readonly="" class="font-weight-bold">
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Mã sinh viên: </span>
                            </div>
                            <div class="block-item-content">
                                <p>17103100124</p>
                                <input type="text" value="17103100124" readonly="" class="font-weight-bold">
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Chuyên ngành: </span>
                            </div>
                            <div class="block-item-content">
                                <p>Công Nghệ Thông Tin</p>
                                <div class="btn-plus">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <input type="text" value="Công Nghệ Thông Tin" readonly="" class="font-weight-bold">
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Lớp hành chính: </span>
                            </div>
                            <div class="block-item-content">
                                <p>ĐHTI11A2</p>
                                <input type="text" value="ĐHTI11A2" readonly="" class="font-weight-bold">
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Loại chương trình đào tạo: </span>
                            </div>
                            <div class="block-item-content">
                                <p>Chính quy đợt 1</p>
                                <input type="text" value="Chính quy đợt 1" readonly="" class="font-weight-bold">
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Email sinh viên do trường cung cấp: </span>
                            </div>
                            <div class="block-item-content">
                                <p>abc@dneti.edu.vn</p>
                                <input type="text" value="Chính quy đợt 1" readonly="" class="font-weight-bold">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 div-block">
                    <div class="block-infomation-university">
                        <div class="number">2</div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Tên cơ sở: </span>
                            </div>
                            <div class="block-item-content">
                                <p>Trường Cao đẳng DEF</p>
                                <input type="text" value="Trường Đại Học ABC" readonly="" class="font-weight-bold">
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Mã sinh viên: </span>
                            </div>
                            <div class="block-item-content">
                                <p>17103132424</p>
                                <input type="text" value="17103100124" readonly="" class="font-weight-bold">
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Chuyên ngành: </span>
                            </div>
                            <div class="block-item-content">
                                <p>Điện tử viễn thông</p>
                                <div class="btn-plus">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <input type="text" value="Công Nghệ Thông Tin" readonly="" class="font-weight-bold">
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Lớp hành chính: </span>
                            </div>
                            <div class="block-item-content">
                                <p>ĐHĐT11A2</p>
                                <input type="text" value="ĐHTI11A2" readonly="" class="font-weight-bold">
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Loại chương trình đào tạo: </span>
                            </div>
                            <div class="block-item-content">
                                <p>Chính quy đợt 1</p>
                                <input type="text" value="Chính quy đợt 1" readonly="" class="font-weight-bold">
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Email sinh viên do trường cung cấp: </span>
                            </div>
                            <div class="block-item-content">
                                <p>abcd@dneti.edu.vn</p>
                                <input type="text" value="Chính quy đợt 1" readonly="" class="font-weight-bold">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="line"></div>
                <div class="col-md-12 div-block">
                    <div class="block-infomation-university">
                        <p class="text-uppercase block-title">
                            Thông tin người bảo trợ
                            <ins class="ml-3">Thêm mới</ins>
                        </p>
                        <div class="number">1</div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Họ tên: </span>
                            </div>
                            <div class="block-item-content">
                                <p>Nguyễn Văn A</p>
                                <input type="text" value="Nguyễn Văn A" readonly="" class="font-weight-bold">
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Số điện thoại: </span>
                            </div>
                            <div class="block-item-content">
                                <p>0123456789</p>
                                <input type="text" value="0123456789" readonly="" class="font-weight-bold">
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Số căn cước công dân: </span>
                            </div>
                            <div class="block-item-content">
                                <p>142922188</p>
                                <input type="text" value="142922188" readonly="" class="font-weight-bold">
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Giới tinh: </span>
                            </div>
                            <div class="block-item-content">
                                <p>Nam</p>
                                <input type="text" value="Nam" readonly="" class="font-weight-bold">
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Số tài khoản: </span>
                            </div>
                            <div class="block-item-content">
                                <p>098765432123</p>
                                <input type="text" value="098765432123" readonly="" class="font-weight-bold">
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Quan hệ với sinh viên: </span>
                            </div>
                            <div class="block-item-content">
                                <p>Bố ruột</p>
                                <input type="text" value="Bố ruột" readonly="" class="font-weight-bold">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 div-block">
                    <div class="block-infomation-university">
                        <div class="number">2</div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Họ tên: </span>
                            </div>
                            <div class="block-item-content">
                                <p>Nguyễn Văn B</p>
                                <input type="text" value="Nguyễn Văn A" readonly="" class="font-weight-bold">
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Số điện thoại: </span>
                            </div>
                            <div class="block-item-content">
                                <p>012443256789</p>
                                <input type="text" value="0123456789" readonly="" class="font-weight-bold">
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Số căn cước công dân: </span>
                            </div>
                            <div class="block-item-content">
                                <p>142922342188</p>
                                <input type="text" value="142922188" readonly="" class="font-weight-bold">
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Giới tinh: </span>
                            </div>
                            <div class="block-item-content">
                                <p>Nữ</p>
                                <input type="text" value="Nam" readonly="" class="font-weight-bold">
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Số tài khoản: </span>
                            </div>
                            <div class="block-item-content">
                                <p>098765432123</p>
                                <input type="text" value="098765432123" readonly="" class="font-weight-bold">
                            </div>
                        </div>
                        <div class="block-item">
                            <div class="block-item-title">
                                <span>Quan hệ với sinh viên: </span>
                            </div>
                            <div class="block-item-content">
                                <p>Mẹ ruột</p>
                                <input type="text" value="Bố ruột" readonly="" class="font-weight-bold">
                            </div>
                        </div>
                    </div>
                </div>
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
    $("#select_ward").change(function() {
        let fullAddress = 
        `${$("#select_ward option:selected").text()} - ${$("#select_district option:selected").text()} - ${$("#select_province option:selected").text()}`;
        $("#input-address").val(fullAddress);
    })
</script>
@stop