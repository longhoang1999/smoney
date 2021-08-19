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
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/applyloan_2.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
<style>
    .banner{
        background: url('{{ asset("img-smoney/img-students/bg-title.png")  }}');
        background-repeat: no-repeat;
        background-size: cover;
        
    }
</style>
@stop
@section('content')
@include('smoney/student/layouts/header')
<?php 
    use App\Models\SmoneyModels\NhaTruong;
    use Illuminate\Support\Arr;
?>

<!-- student - block - title -->
<div class="banner">
    <div class="block-banner-title">
        Hồ sơ khoản vay sinh viên
    </div>
</div>
<div class="loan-nearly-slide-parent">
    <!-- from student html -->
    <div class="loan-nearly-slide">
        <div class="loan-nearly-slide-content">
            <h4 class="content-title">Hồ sơ đã lưu</h4>
            <?php $i_0 = 1000; ?>
            @foreach($findHSNotDone as $hs)
            <!--  a div content -->
            <div class="content-block-parents">
                <div class="content-block" data-toggle="modal" data-target="#modalLoan_1_{{ $i_0 }}">
                    <div class="content-block-title">
                        @if($hs->hsk_purpose == "1")
                            <span>Tiền học phí</span>
                        @endif
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="content-block-money">
                        <span>Số tiền</span>
                        <p class="number-monney">{{ number_format($hs->hsk_money) }} VND</p>
                    </div>
                    <div class="content-block-information">
                        <div class="information-top">
                            <div class="information-top-left">
                                <span>Kì hạn vay:</span>
                                @if($hs->hsk_duration == "1")
                                    <span>3 tháng</span>
                                @elseif($hs->hsk_duration == "2")
                                    <span>6 tháng</span>
                                @elseif($hs->hsk_duration == "3")
                                    <span>12 tháng</span>
                                @endif
                            </div>
                            <div class="information-top-right">
                                <span>Thời gian yêu cầu:</span>
                                <span>{{ date("h:i A d-m-Y", strtotime($hs->created_at)) }}</span>
                            </div>
                        </div>
                        <div class="information-bottom">
                            <div class="information-bottom-left">
                                <span>Đang ở bước:</span>
                                <span class="text-warning font-weight-bold">{{ $hs->takePagepresent }}</span>
                            </div>
                            <div class="information-bottom-right">
                                <a href="#" class="complete-profile block-status block-status-confirm">Hoàn thiện hồ sơ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  /a div content -->
            <?php $i_0++; ?>
            @endforeach
        </div>
    </div>

    <div class="loan-nearly-slide">
        <div class="loan-nearly-slide-content">
            <h4 class="content-title">Hồ sơ đã gửi yêu cầu!</h4>
            <?php $i=0; ?>
            @foreach($findHSDone as $hs)
            <!--  a div content -->
            <div class="content-block-parents">
                <div class="content-block content-block-done" data-toggle="modal" data-target="#modalLoan_1_{{ $i }}">
                    <div class="content-block-title">
                        @if($hs->hsk_purpose == "1")
                            <span>Tiền học phí</span>
                        @endif
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="content-block-money">
                        <span>Số tiền</span>
                        <p class="number-monney">{{ number_format($hs->hsk_money) }} VND</p>
                    </div>
                    <div class="content-block-information">
                        <div class="information-top">
                            <div class="information-top-left">
                                <span>Kì hạn vay:</span>
                                @if($hs->hsk_duration == "1")
                                    <span>3 tháng</span>
                                @elseif($hs->hsk_duration == "2")
                                    <span>6 tháng</span>
                                @elseif($hs->hsk_duration == "3")
                                    <span>12 tháng</span>
                                @endif
                            </div>
                            <div class="information-top-right">
                                <span>Thời gian yêu cầu:</span>
                                <span>{{ date("h:i A d-m-Y", strtotime($hs->created_at)) }}</span>
                            </div>
                        </div>
                        <div class="information-bottom">
                            <div class="information-bottom-left">
                                <span>Nhà trường:</span>
                                <div class="block-status block-status-warning">Đang chờ</div>
                            </div>
                            <div class="information-bottom-right">
                                <span>Bên cho vay:</span>
                                <div class="block-status block-status-warning">Đang chờ</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  /a div content -->
            <?php $i++; ?>
            @endforeach
        </div>
    </div>
</div>


<?php $dem=0; ?>
@foreach($findHSDone as $hs)
<!-- modal -->
<div class="modal fade" id="modalLoan_1_{{ $dem }}" tabindex="-1" role="dialog" aria-labelledby="modalLoan_1Label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLoan_1Label">
            Thông tin hồ sơ của bạn - Ngày gửi: {{ date("h:i A d-m-Y", strtotime($hs->created_at)) }}
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="loanInfomation-tab_{{$dem}}" data-toggle="tab" href="#loanInfomation_{{$dem}}" role="tab" aria-controls="loanInfomation_{{$dem}}" aria-selected="true">Tt.Khoản vay</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="userInfomation-tab_{{$dem}}" data-toggle="tab" href="#userInfomation_{{$dem}}" role="tab" aria-controls="userInfomation_{{$dem}}" aria-selected="false">Tt.cá nhân</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="shoolInfomation-tab_{{$dem}}" data-toggle="tab" href="#shoolInfomation_{{$dem}}" role="tab" aria-controls="shoolInfomation_{{$dem}}" aria-selected="false">Tt.Cơ sở đào tạo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="jobInfomation-tab_{{$dem}}" data-toggle="tab" href="#jobInfomation_{{$dem}}" role="tab" aria-controls="jobInfomation_{{$dem}}" aria-selected="false">Tt.Việc làm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="optionInfomation-tab_{{$dem}}" data-toggle="tab" href="#optionInfomation_{{$dem}}" role="tab" aria-controls="optionInfomation_{{$dem}}" aria-selected="false">Tùy chọn</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="comfirmInfomation-tab_{{$dem}}" data-toggle="tab" href="#comfirmInfomation_{{$dem}}" role="tab" aria-controls="comfirmInfomation_{{$dem}}" aria-selected="false">Điều khoản</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="loanInfomation_{{$dem}}" role="tabpanel" aria-labelledby="loanInfomation-tab_{{$dem}}">
                 <div class="container">
                    <div class="row">
                        <div class="col-md-4 mb-3 mt-3">
                            <p class="m-0 text-tab-1">Số tiền yêu cầu vay:</p>
                        </div>
                        <div class="col-md-8 mb-3 mt-3">
                            <span class="font-weight-bold text-primary text-tab-1-span">{{ number_format($hs->hsk_money) }} VNĐ</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-1">Mục đích vay:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-1-span">
                                @if($hs->hsk_purpose == "1")
                                    Tiền học phí
                                @endif
                            </span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-1">Kì hạn khai báo:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-1-span">
                                @if($hs->hsk_duration == "1")
                                    3 tháng
                                @elseif($hs->hsk_duration == "2")
                                    6 tháng
                                @elseif($hs->hsk_duration == "3")
                                    12 tháng
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="userInfomation_{{$dem}}" role="tabpanel" aria-labelledby="userInfomation-tab_{{$dem}}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Họ tên:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->hsk_ten }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Số điện thoại chính:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->hsk_main_phone }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Số căn cước công dân:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->hsk_cccd }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Ngày sinh:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ date("d/m/Y", strtotime($hs->hsk_birthday)) }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Email:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->hsk_email }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Giới tính:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->hsk_gender }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Số tài khoản:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            @foreach($hs->hsk_stk as $hsk_stk)
                                <span class="text-block text-tab-2-span">{{ $hsk_stk }}</span>
                            @endforeach
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Số điện thoại khác:</p>
                        </div>
                        <div class="col-md-8 mb-3">                            
                            @foreach($hs->hsk_otherPhone as $hsk_otherPhone)
                                <span class="text-block text-tab-2-span">{{ $hsk_otherPhone }}</span>
                            @endforeach
                        </div>
                        <hr>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Nơi bạn sống:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">
                                @if($hs->hsk_liveWith == "1")
                                    Sống cùng gia đình
                                @elseif($hs->hsk_liveWith == "2")
                                    Đang thuê trọ
                                @else
                                    {{ $hs->hsk_liveWith }}
                                @endif
                            </span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Địa chỉ thường chú:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->hsk_address }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Địa chỉ tạm chú:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->hsk_address_now }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="shoolInfomation_{{$dem}}" role="tabpanel" aria-labelledby="shoolInfomation-tab_{{$dem}}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2">Bạn học tại:</p>
                        </div>
                        <div class="col-md-7 mb-3">
                            <span class="text-tab-2-span">{{ $hs->hsk_numberSchool_checkBack }} trường</span>
                        </div>
                        @if(isset($hs->chooseSchool))
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2">Trường gửi hồ sơ:</p>
                        </div>
                        <div class="col-md-7 mb-3">
                            <?php 
                                $nameSchool = NhaTruong::select("nt_ten")->where("nt_id",$hs->chooseSchool)->first();
                             ?>
                            <span class="text-tab-2-span">
                                {{ $nameSchool['nt_ten'] }}
                            </span>
                        </div>
                        @endif

                        <?php 
                            $uniAr = array_keys($hs->university);
                         ?>

                        @for($k = 0; $k < count($uniAr); $k++)
                        <?php 
                            $nt_id = strval($uniAr[$k]);
                            $nameSl = NhaTruong::select("nt_ten")->where("nt_id",$nt_id)->first();
                         ?>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 text-tab-2-title">Thông tin cơ sở thứ {{ $k + 1 }}</p>
                        </div>
                        <div class="col-md-7 mb-3">
                            <span class="text-tab-2-span"></span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Tên trường</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">{{ $nameSl['nt_ten'] }}</span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Chuyên ngành</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->university[$nt_id]['specialized'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Lớp hành chính</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->university[$nt_id]['class'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Mã sinh viên</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->university[$nt_id]['studentCode'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Địa chỉ email nhà trường cấp</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->university[$nt_id]['emailUni'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Loại chương trình đào tạo</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->university[$nt_id]['programType'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Địa chỉ trụ sở chính</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->university[$nt_id]['uniAddress'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Trạng thái tốt nghiệp</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->university[$nt_id]['leaveUni'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Bảng điểm</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3 block-image">
                            @if(isset($hs->university[$nt_id]['imgPointAr']))
                                @foreach($hs->university[$nt_id]['imgPointAr'] as $imgPoint)
                                <a data-fancybox="gallery" href='{{ asset($imgPoint)  }}'>
                                    <img class="img-fluid" src='{{ asset($imgPoint)  }}' alt="">
                                </a>
                                @endforeach
                            @else
                                <span class="text-tab-2-span">Không có thông tin</span>
                            @endif
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="jobInfomation_{{$dem}}" role="tabpanel" aria-labelledby="jobInfomation-tab_{{$dem}}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Tình trạng việc làm:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">
                                @if($hs->employmentStatus == "1")
                                    Đang làm thuê
                                @elseif($hs->employmentStatus == "2")
                                    Không đi làm
                                @elseif($hs->employmentStatus == "3")
                                    Tự kinh doanh
                                @endif
                            </span>
                        </div>
                        @if($hs->employmentStatus != "2")
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Thời gian làm việc:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">
                                @if($hs->timeWork == "1")
                                    Fulltime
                                @elseif($hs->timeWork == "2")
                                    Partime
                                @elseif($hs->timeWork == "3")
                                    Fieldtrip
                                @endif
                            </span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Tên cơ sở làm việc:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->nameCompany }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Địa chỉ cơ sở làm việc:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->addressCompany }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Mức lương TB / tháng:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ number_format($hs->wage) }} VNĐ</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="optionInfomation_{{$dem}}" role="tabpanel" aria-labelledby="optionInfomation-tab_{{$dem}}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2">Câu lạc bộ, đoàn thể của trường:</p>
                        </div>
                        <div class="col-md-7 mb-3">
                            @if($hs->club != "2")
                                @foreach($hs->nameClub as $nameClub)
                                <span class="text-block text-tab-2-span">{{ $nameClub }}</span>
                                @endforeach
                            @else
                                <span class="text-block text-tab-2-span">Không tham gia</span>
                            @endif
                        </div>
                        <!-- NG bảo trợ -->
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 text-tab-2-title">Thông tin người bảo trợ</p>
                        </div>
                        <div class="col-md-7 mb-3">
                            <span class="text-tab-2-span">
                                @if($hs->yourParents == "2")
                                    <span class="text-block text-tab-2-span">Không có người bảo trợ</span>
                                @endif
                            </span>
                        </div>

                        @if($hs->yourParents != "2")
                        <?php $yourParents = array_keys($hs->yourParentsInfo); ?>
                        @for($k = 0; $k < count($yourParents); $k++)
                        <?php $parents_key = strval($yourParents[$k]);?>                     
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3 text-primary">Người thứ {{ $k + 1 }}</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span"></span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Họ tên</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->yourParentsInfo[$parents_key]['name'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Số điện thoại</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->yourParentsInfo[$parents_key]['phone'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Số căn cước công dân</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->yourParentsInfo[$parents_key]['cccd'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Giới tính</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->yourParentsInfo[$parents_key]['gender'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Số tài khoản</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->yourParentsInfo[$parents_key]['stk'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Quan hệ với sinh viên</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->yourParentsInfo[$parents_key]['relationship'] }}
                            </span>
                        </div>
                        @endfor
                        @endif


                        <!-- Giấy tờ -->
                        @if($hs->pageObject != null)
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 text-tab-2-title">Thông tin một số giấy tờ khác</p>
                        </div>
                        <div class="col-md-7 mb-3">
                            <span class="text-tab-2-span"></span>
                        </div>
                        <?php $j = 1; ?>
                        @foreach($hs->pageObject as $pageObject)
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3 text-primary">Giấy tờ thứ thứ {{ $j }}</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span"></span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Tên giấy tờ</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">{{ $pageObject['title'] }}</span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Hình ảnh</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3 block-image">
                            @foreach($pageObject['arrayImg'] as $img)
                            <a data-fancybox="gallery" href='{{ asset($img)  }}'>
                                <img class="img-fluid" src='{{ asset($img)  }}' alt="">
                            </a>
                            @endforeach
                        </div>
                        @endforeach
                        @endif

                        <!-- Chủ đề quan tâm -->
                        @if(isset($hs->contentTag) && $hs->contentTag != null)
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 text-tab-2-title">Các chủ để mà bạn quan tâm</p>
                        </div>
                        <div class="col-md-7 mb-3">
                            <span class="text-tab-2-span"></span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Các chủ đề</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <?php 
                                $pieces = explode("|", $hs->contentTag);
                                $array = array();
                                for ($i=0; $i < count($pieces)-1; $i++) {
                                    $array = Arr::add($array, $i ,$pieces[$i]);
                                }
                             ?>
                            <span class="text-tab-2-span div_drop">
                                @foreach($array as $ar)
                                    <a class="ui tag label">{{ $ar }}</a>
                                @endforeach
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="comfirmInfomation_{{$dem}}" role="tabpanel" aria-labelledby="comfirmInfomation-tab_{{$dem}}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Cổng thông tin liên lạc:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">Liên lạc qua 
                                @if($hs->portal == "1")
                                    email
                                @elseif($hs->portal == "2")
                                    số điện thoại
                                @else
                                    số điện thoại và email
                                @endif
                            </span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Ý kiến của bạn:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">
                                {{ $hs->opinion }}
                            </span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Số đánh giá</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">
                                {{ $hs->hsk_duration }} <i class="fas fa-star text-warning"></i>
                            </span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Điều khoản</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            @if($hs->pagepresent == "done")
                            <span class="text-tab-2-span text-success">
                                Đã chấp nhận điều khoản sử dụng
                            </span>
                            @else
                            <span class="text-tab-2-span text-success">
                                Chưa chấp nhận điều khoản sử dụng
                            </span> 
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
<?php $dem++; ?>
@endforeach


<?php $dem=1000; ?>
@foreach($findHSNotDone as $hs)
<!-- modal -->
<div class="modal fade" id="modalLoan_1_{{ $dem }}" tabindex="-1" role="dialog" aria-labelledby="modalLoan_1Label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLoan_1Label">
            Thông tin hồ sơ của bạn - Ngày gửi: {{ date("h:i A d-m-Y", strtotime($hs->created_at)) }}
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="loanInfomation-tab_{{$dem}}" data-toggle="tab" href="#loanInfomation_{{$dem}}" role="tab" aria-controls="loanInfomation_{{$dem}}" aria-selected="true">Tt.Khoản vay</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="userInfomation-tab_{{$dem}}" data-toggle="tab" href="#userInfomation_{{$dem}}" role="tab" aria-controls="userInfomation_{{$dem}}" aria-selected="false">Tt.cá nhân</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="shoolInfomation-tab_{{$dem}}" data-toggle="tab" href="#shoolInfomation_{{$dem}}" role="tab" aria-controls="shoolInfomation_{{$dem}}" aria-selected="false">Tt.Cơ sở đào tạo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="jobInfomation-tab_{{$dem}}" data-toggle="tab" href="#jobInfomation_{{$dem}}" role="tab" aria-controls="jobInfomation_{{$dem}}" aria-selected="false">Tt.Việc làm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="optionInfomation-tab_{{$dem}}" data-toggle="tab" href="#optionInfomation_{{$dem}}" role="tab" aria-controls="optionInfomation_{{$dem}}" aria-selected="false">Tùy chọn</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="comfirmInfomation-tab_{{$dem}}" data-toggle="tab" href="#comfirmInfomation_{{$dem}}" role="tab" aria-controls="comfirmInfomation_{{$dem}}" aria-selected="false">Điều khoản</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="loanInfomation_{{$dem}}" role="tabpanel" aria-labelledby="loanInfomation-tab_{{$dem}}">
                 <div class="container">
                    <div class="row">
                        <div class="col-md-4 mb-3 mt-3">
                            <p class="m-0 text-tab-1">Số tiền yêu cầu vay:</p>
                        </div>
                        <div class="col-md-8 mb-3 mt-3">
                            <span class="font-weight-bold text-primary text-tab-1-span">{{ number_format($hs->hsk_money) }} VNĐ</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-1">Mục đích vay:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-1-span">
                                @if($hs->hsk_purpose == "1")
                                    Tiền học phí
                                @endif
                            </span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-1">Kì hạn khai báo:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-1-span">
                                @if($hs->hsk_duration == "1")
                                    3 tháng
                                @elseif($hs->hsk_duration == "2")
                                    6 tháng
                                @elseif($hs->hsk_duration == "3")
                                    12 tháng
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="userInfomation_{{$dem}}" role="tabpanel" aria-labelledby="userInfomation-tab_{{$dem}}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Họ tên:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->hsk_ten }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Số điện thoại chính:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->hsk_main_phone }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Số căn cước công dân:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->hsk_cccd }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Ngày sinh:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ date("d/m/Y", strtotime($hs->hsk_birthday)) }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Email:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->hsk_email }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Giới tính:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->hsk_gender }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Số tài khoản:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            @if(isset($hs->hsk_stk) && $hs->hsk_stk != null)
                                @foreach($hs->hsk_stk as $hsk_stk)
                                    <span class="text-block text-tab-2-span">{{ $hsk_stk }}</span>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Số điện thoại khác:</p>
                        </div>
                        <div class="col-md-8 mb-3">   
                            @if(isset($hs->hsk_otherPhone) && $hs->hsk_otherPhone != null)                         
                                @foreach($hs->hsk_otherPhone as $hsk_otherPhone)
                                    <span class="text-block text-tab-2-span">{{ $hsk_otherPhone }}</span>
                                @endforeach
                            @endif
                        </div>
                        <hr>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Nơi bạn sống:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">
                                @if(isset($hs->hsk_liveWith))
                                    @if($hs->hsk_liveWith == "1")
                                        Sống cùng gia đình
                                    @elseif($hs->hsk_liveWith == "2")
                                        Đang thuê trọ
                                    @else
                                        {{ $hs->hsk_liveWith }}
                                    @endif
                                @endif
                            </span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Địa chỉ thường chú:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->hsk_address }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Địa chỉ tạm chú:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->hsk_address_now }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="shoolInfomation_{{$dem}}" role="tabpanel" aria-labelledby="shoolInfomation-tab_{{$dem}}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2">Bạn học tại:</p>
                        </div>
                        <div class="col-md-7 mb-3">
                            <span class="text-tab-2-span">{{ $hs->hsk_numberSchool_checkBack }} trường</span>
                        </div>
                        @if(isset($hs->chooseSchool))
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2">Trường gửi hồ sơ:</p>
                        </div>
                        <div class="col-md-7 mb-3">
                            <?php 
                                $nameSchool = NhaTruong::select("nt_ten")->where("nt_id",$hs->chooseSchool)->first();
                             ?>
                            <span class="text-tab-2-span">
                                {{ $nameSchool['nt_ten'] }}
                            </span>
                        </div>
                        @endif


                        @if(isset($hs->university) && $hs->university != null)
                        <?php $uniAr = array_keys($hs->university); ?>
                        @for($k = 0; $k < count($uniAr); $k++)
                        <?php 
                            $nt_id = strval($uniAr[$k]);
                            $nameSl = NhaTruong::select("nt_ten")->where("nt_id",$nt_id)->first();
                         ?>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 text-tab-2-title">Thông tin cơ sở thứ {{ $k + 1 }}</p>
                        </div>
                        <div class="col-md-7 mb-3">
                            <span class="text-tab-2-span"></span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Tên trường</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">{{ $nameSl['nt_ten'] }}</span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Chuyên ngành</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->university[$nt_id]['specialized'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Lớp hành chính</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->university[$nt_id]['class'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Mã sinh viên</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->university[$nt_id]['studentCode'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Địa chỉ email nhà trường cấp</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->university[$nt_id]['emailUni'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Loại chương trình đào tạo</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->university[$nt_id]['programType'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Địa chỉ trụ sở chính</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->university[$nt_id]['uniAddress'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Trạng thái tốt nghiệp</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->university[$nt_id]['leaveUni'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Bảng điểm</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3 block-image">
                            @if(isset($hs->university[$nt_id]['imgPointAr']))
                                @foreach($hs->university[$nt_id]['imgPointAr'] as $imgPoint)
                                <a data-fancybox="gallery" href='{{ asset($imgPoint)  }}'>
                                    <img class="img-fluid" src='{{ asset($imgPoint)  }}' alt="">
                                </a>
                                @endforeach
                            @else
                                <span class="text-tab-2-span">Không có thông tin</span>
                            @endif
                        </div>
                        @endfor
                        @endif
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="jobInfomation_{{$dem}}" role="tabpanel" aria-labelledby="jobInfomation-tab_{{$dem}}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Tình trạng việc làm:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">
                                @if($hs->employmentStatus == "1")
                                    Đang làm thuê
                                @elseif($hs->employmentStatus == "2")
                                    Không đi làm
                                @elseif($hs->employmentStatus == "3")
                                    Tự kinh doanh
                                @endif
                            </span>
                        </div>
                        @if($hs->employmentStatus != "2")
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Thời gian làm việc:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">
                                @if($hs->timeWork == "1")
                                    Fulltime
                                @elseif($hs->timeWork == "2")
                                    Partime
                                @elseif($hs->timeWork == "3")
                                    Fieldtrip
                                @endif
                            </span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Tên cơ sở làm việc:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->nameCompany }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Địa chỉ cơ sở làm việc:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->addressCompany }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Mức lương TB / tháng:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ number_format($hs->wage) }} VNĐ</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="optionInfomation_{{$dem}}" role="tabpanel" aria-labelledby="optionInfomation-tab_{{$dem}}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2">Câu lạc bộ, đoàn thể của trường:</p>
                        </div>
                        <div class="col-md-7 mb-3">
                            @if(isset($hs->club) && $hs->club != null)
                                @if($hs->club != "2")
                                    @foreach($hs->nameClub as $nameClub)
                                    <span class="text-block text-tab-2-span">{{ $nameClub }}</span>
                                    @endforeach
                                @else
                                    <span class="text-block text-tab-2-span">Không tham gia</span>
                                @endif
                            @endif
                        </div>
                        <!-- NG bảo trợ -->
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 text-tab-2-title">Thông tin người bảo trợ</p>
                        </div>
                        <div class="col-md-7 mb-3">
                            <span class="text-tab-2-span">
                                @if(isset($hs->yourParents) && $hs->yourParents != null)
                                    @if($hs->yourParents == "2")
                                        <span class="text-block text-tab-2-span">Không có người bảo trợ</span>
                                    @endif
                                @endif
                            </span>
                        </div>

                        @if(isset($hs->yourParents))
                            @if($hs->yourParents != "2")
                            <?php $yourParents = array_keys($hs->yourParentsInfo); ?>
                            @for($k = 0; $k < count($yourParents); $k++)
                            <?php $parents_key = strval($yourParents[$k]);?>                     
                            <div class="col-md-5 mb-3">
                                <p class="m-0 text-tab-2 pl-3 ml-3 text-primary">Người thứ {{ $k + 1 }}</p>
                            </div>
                            <div class="col-md-7 mb-3 pl-3">
                                <span class="text-tab-2-span"></span>
                            </div>
                            <div class="col-md-5 mb-3">
                                <p class="m-0 text-tab-2 pl-3 ml-3">Họ tên</p>
                            </div>
                            <div class="col-md-7 mb-3 pl-3">
                                <span class="text-tab-2-span">
                                    {{ $hs->yourParentsInfo[$parents_key]['name'] }}
                                </span>
                            </div>
                            <div class="col-md-5 mb-3">
                                <p class="m-0 text-tab-2 pl-3 ml-3">Số điện thoại</p>
                            </div>
                            <div class="col-md-7 mb-3 pl-3">
                                <span class="text-tab-2-span">
                                    {{ $hs->yourParentsInfo[$parents_key]['phone'] }}
                                </span>
                            </div>
                            <div class="col-md-5 mb-3">
                                <p class="m-0 text-tab-2 pl-3 ml-3">Số căn cước công dân</p>
                            </div>
                            <div class="col-md-7 mb-3 pl-3">
                                <span class="text-tab-2-span">
                                    {{ $hs->yourParentsInfo[$parents_key]['cccd'] }}
                                </span>
                            </div>
                            <div class="col-md-5 mb-3">
                                <p class="m-0 text-tab-2 pl-3 ml-3">Giới tính</p>
                            </div>
                            <div class="col-md-7 mb-3 pl-3">
                                <span class="text-tab-2-span">
                                    {{ $hs->yourParentsInfo[$parents_key]['gender'] }}
                                </span>
                            </div>
                            <div class="col-md-5 mb-3">
                                <p class="m-0 text-tab-2 pl-3 ml-3">Số tài khoản</p>
                            </div>
                            <div class="col-md-7 mb-3 pl-3">
                                <span class="text-tab-2-span">
                                    {{ $hs->yourParentsInfo[$parents_key]['stk'] }}
                                </span>
                            </div>
                            <div class="col-md-5 mb-3">
                                <p class="m-0 text-tab-2 pl-3 ml-3">Quan hệ với sinh viên</p>
                            </div>
                            <div class="col-md-7 mb-3 pl-3">
                                <span class="text-tab-2-span">
                                    {{ $hs->yourParentsInfo[$parents_key]['relationship'] }}
                                </span>
                            </div>
                            @endfor
                            @endif
                        @endif

                        <!-- Giấy tờ -->
                        @if($hs->pageObject != null)
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 text-tab-2-title">Thông tin một số giấy tờ khác</p>
                        </div>
                        <div class="col-md-7 mb-3">
                            <span class="text-tab-2-span"></span>
                        </div>
                        <?php $j = 1; ?>
                        @foreach($hs->pageObject as $pageObject)
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3 text-primary">Giấy tờ thứ thứ {{ $j }}</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span"></span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Tên giấy tờ</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">{{ $pageObject['title'] }}</span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Hình ảnh</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3 block-image">
                            @foreach($pageObject['arrayImg'] as $img)
                            <a data-fancybox="gallery" href='{{ asset($img)  }}'>
                                <img class="img-fluid" src='{{ asset($img)  }}' alt="">
                            </a>
                            @endforeach
                        </div>
                        @endforeach
                        @endif

                        <!-- Chủ đề quan tâm -->
                        @if(isset($hs->contentTag) && $hs->contentTag != null)
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 text-tab-2-title">Các chủ để mà bạn quan tâm</p>
                        </div>
                        <div class="col-md-7 mb-3">
                            <span class="text-tab-2-span"></span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Các chủ đề</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <?php 
                                $pieces = explode("|", $hs->contentTag);
                                $array = array();
                                for ($i=0; $i < count($pieces)-1; $i++) {
                                    $array = Arr::add($array, $i ,$pieces[$i]);
                                }
                             ?>
                            <span class="text-tab-2-span div_drop">
                                @foreach($array as $ar)
                                    <a class="ui tag label">{{ $ar }}</a>
                                @endforeach
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="comfirmInfomation_{{$dem}}" role="tabpanel" aria-labelledby="comfirmInfomation-tab_{{$dem}}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Cổng thông tin liên lạc:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">
                                @if(isset($hs->portal))
                                    Liên lạc qua 
                                    @if($hs->portal == "1")
                                        email
                                    @elseif($hs->portal == "2")
                                        số điện thoại
                                    @else
                                        số điện thoại và email
                                    @endif
                                @endif
                            </span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Ý kiến của bạn:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">
                                {{ $hs->opinion }}
                            </span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Số đánh giá</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">
                                {{ $hs->hsk_duration }} <i class="fas fa-star text-warning"></i>
                            </span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Điều khoản</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            @if($hs->pagepresent == "done")
                            <span class="text-tab-2-span text-success">
                                Đã chấp nhận điều khoản sử dụng
                            </span>
                            @else
                            <span class="text-tab-2-span text-success">
                                Chưa chấp nhận điều khoản sử dụng
                            </span> 
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
<?php $dem++; ?>
@endforeach


<!-- back to top -->
<div class="back_to_top">
    <i class="fas fa-angle-up"></i>
</div>
@stop


@section('footer-js')
<!-- <script type="text/javascript" src="{{ asset('js/Smoney/Student/student.js') }}"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
<script type="text/javascript">
    // $(".content-block-done").click(function(e) {
    //     if(e.target.className.indexOf("complete-profile") == -1){
    //         $("#modalLoan_1").modal("show");
    //     }
    // })
</script>
@stop