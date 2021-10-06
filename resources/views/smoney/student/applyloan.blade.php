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
            <!-- <h4 class="content-title">Hồ sơ đã lưu</h4> -->
            <!-- not done here -->
        </div>
    </div>

    <div class="loan-nearly-slide">
        <div class="loan-nearly-slide-content">
            <h4 class="content-title">Hồ sơ đã gửi yêu cầu!</h4>
            @if(count($findHSDone) == 0)
                <p class="title-empty-loan">Bạn chưa có một yêu cầu vay nào!</p>
            @endif
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
                                @if($hs->profileStatusInUni == "wait")
                                    <div class="block-status block-status-warning">Đang chờ</div>
                                @elseif($hs->profileStatusInUni == "pass")
                                    <div class="block-status block-status-confirm">Đã duyệt</div>
                                @elseif($hs->profileStatusInUni == "refuse")
                                    <div class="block-status block-status-danger">Từ chối</div>
                                @endif
                            </div>
                            <div class="information-bottom-right">
                                <span>Bên cho vay:</span>
                                @if($hs->profileStatusInBank == "wait")
                                    <div class="block-status block-status-warning">Đang chờ</div>
                                @elseif($hs->profileStatusInBank == "pass")
                                    <div class="block-status block-status-confirm">Đã duyệt</div>
                                @elseif($hs->profileStatusInBank == "refuse")
                                    <div class="block-status block-status-danger">Từ chối</div>
                                @endif
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
  <div class="modal-dialog modal-xl">
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
        <p class="font-weight-bold">Trạng thái</p>
        <div class="time-loan">
            <div class="flex-parent">
                <div class="input-flex-container"> 
                    <div class="input 
                    @if($hs->profileStatusInUni == 'wait')
                        active
                    @endif
                    ">
                        <span data-year="Yêu cầu vay" data-info="{{ $name }} (Bạn)"></span>
                    </div>
                    <div class="input  
                    @if($hs->profileStatusInUni != 'wait' && $hs->profileStatusInBank == 'wait')
                        active 
                        @if($hs->profileStatusInUni == 'refuse')
                            loanRefuse 
                        @endif
                    @endif
                    ">
                        <span data-year="Xác nhận nhà trường" data-info="{{ $hs->uni['nt_ma'] }}"></span>
                    </div>
                    <div class="input 
                    @if($hs->profileStatusInUni == 'pass' && $hs->profileStatusInBank != 'wait' && !isset($hs->yourDecision) )
                        active 
                        @if($hs->profileStatusInBank == 'refuse')
                            loanRefuse 
                        @endif
                    @endif
                    ">
                        <span data-year="Phản hồi ngân hàng" data-info="{{ $hs->nameBank }}"></span>
                    </div>
                    <div class="input 
                    @if(isset($hs->yourDecision) && !isset($hs->two_sides_accept))
                        active
                        @if($hs->yourDecision == 'cancel')
                            loanRefuse
                        @endif
                    @endif
                     ">
                        <span data-year="Xác nhận vay" data-info="{{ $name }} (Bạn)"></span>
                    </div>
                    <div class="input 
                    @if(isset($hs->two_sides_accept))
                        @if($hs->two_sides_accept == 'false')
                            active loanRefuse
                        @endif
                    @endif
                     ">
                        <span data-year="Khoản vay lưu thông" data-info="{{ $hs->nameBank }}"></span>
                    </div>
                </div>
            </div>
        </div>
        
        @if(isset($hs->feedbackContentUni) && $hs->feedbackContentUni != null)
            <hr>
            <!-- Thông báo nhà trường-->
            <p class="font-weight-bold">Thông báo nhà trường</p>
            <div class="ml-4">
                @if($hs->profileStatusInUni == "pass")
                    <span class="text-info">{{ $hs->feedbackContentUni }}</span>
                @elseif($hs->profileStatusInUni == "refuse")
                    <span class="text-danger">{{ $hs->feedbackContentUni }}</span>
                @endif
            </div>
        @endif

        @if(isset($hs->feedbackContentBank) && $hs->feedbackContentBank != null)
            <hr>
            <!-- Thông báo ngân hàng-->
            <p class="font-weight-bold">Thông báo ngân hàng</p>
            <div class="ml-4">
                @if($hs->profileStatusInBank == "pass")
                    <span class="text-info">{{ $hs->feedbackContentBank }}</span>
                @elseif($hs->profileStatusInBank == "refuse")
                    <span class="text-danger">{{ $hs->feedbackContentBank }}</span>
                @endif
            </div>
            @if(isset($hs->loanProposal) && $hs->loanProposal != null)
                <div class="container loan-proposal">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            Số tiền ngân hàng cho bạn vay:
                        </div>
                        <div class="col-md-6 font-weight-bold">
                            {{ number_format($hs->loanProposal['money']) }} VNĐ
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            Lãi suất cho khoản vay của bạn:
                        </div>
                        <div class="col-md-6 font-weight-bold">
                            {{ $hs->loanProposal['interestRate'] }} % / tháng
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            Kì hạn cho khoản vay của bạn:
                        </div>
                        <div class="col-md-6 font-weight-bold">
                            {{ $hs->loanProposal['loanMonth'] }} tháng
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            Số tiền bạn phải trả trong 1 tháng
                        </div>
                        <div class="col-md-6 font-weight-bold">
                            <?php 
                                $moneyPayAMonth = $hs->loanProposal['moneyPayAMonth'];
                                $aMonthProfit = $hs->loanProposal['aMonthProfit'];
                                $sumMoney = $moneyPayAMonth + $aMonthProfit;

                                $showString = number_format($sumMoney)." VNĐ ( ".
                                    number_format($moneyPayAMonth)." VNĐ - gốc + ".
                                    number_format($aMonthProfit)." VNĐ - lãi)";
                                echo $showString;
                             ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            Tổng số tiền bạn phải trả trong suốt kì hạn
                        </div>
                        <!-- wrong -->
                        <div class="col-md-6 font-weight-bold">
                            <?php 
                                $allLoanFinally = round($sumMoney * $hs->loanProposal['loanMonth']);
                                echo number_format($allLoanFinally)." VNĐ";
                             ?>
                        </div>
                    </div>
                    @if(!isset($hs->yourDecision))
                    <div class="row mb-3">
                        <div class="col-md-6 text-right">
                            <button class="btn btn-success" data-id="{{ $hs->_id }}" data-toggle="modal" data-target="#loanConfirmation" data-backdrop="static" data-keyboard="false">Xác nhận vay</button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-danger" data-id="{{ $hs->_id }}" data-toggle="modal" data-target="#refuseModalLoan">Từ chối vay</button>
                        </div>
                    </div>
                    @elseif(isset($hs->yourDecision) && $hs->yourDecision == 'cancel')
                    <div class="row mb-3">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-danger" disabled="">Đã từ chối</button>
                        </div>
                    </div>
                    @elseif(isset($hs->yourDecision) && $hs->yourDecision == 'yes')
                    <div class="row mb-3">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-success" disabled="">Đã chấp nhận</button>
                        </div>
                    </div>
                    @endif
                </div>
            @endif
            @if(isset($hs->two_sides_accept)  && isset($hs->bank_reason_refusal))
                <p class="font-weight-bold mt-3">
                    Khoản vay bị từ chối do lý do: 
                    <span class="text-danger">{{ $hs->bank_reason_refusal }}</span>
                </p>
            @elseif(isset($hs->two_sides_accept) && $hs->two_sides_accept == "true")
                <p class="font-weight-bold mt-3">
                    Khoản vay đã được lưu thông vào ngày: 
                    <span class="text-info">
                        {{ date("d/m/Y H:i", strtotime($hs->date_accept)) }}
                    </span>
                </p>
            @endif
        @endif
        <hr>
        <!-- hồ sơ -->
        <p class="font-weight-bold">Hồ sơ khoản vay</p>
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
                        <div class="col-md-4 mb-3 mt-3">
                            <p class="m-0 text-tab-1">Ngân hàng yêu cầu vay:</p>
                        </div>
                        <div class="col-md-8 mb-3 mt-3">
                            <span class="font-weight-bold text-tab-1-span">
                                {{ $hs->nameBank }}</span>
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
                            <span class="text-tab-2-span">{{ $hs->hoten }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Số điện thoại chính:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->sdt }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Số căn cước công dân:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->cccd }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Ngày sinh:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->ngaysinh }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Email:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->email }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Giới tính:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->gioitinh }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Số tài khoản:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            @foreach($hs->stk as $hsk_stk)
                                <span class="text-block text-tab-2-span">{{ $hsk_stk }}</span>
                            @endforeach
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Số điện thoại khác:</p>
                        </div>
                        <div class="col-md-8 mb-3">                            
                            @foreach($hs->otherSdt as $hsk_otherPhone)
                                <span class="text-block text-tab-2-span">{{ $hsk_otherPhone }}</span>
                            @endforeach
                        </div>
                        <hr>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Địa chỉ thường chú:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->diachi }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="m-0 text-tab-2">Địa chỉ tạm chú:</p>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-tab-2-span">{{ $hs->diachihientai }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="shoolInfomation_{{$dem}}" role="tabpanel" aria-labelledby="shoolInfomation-tab_{{$dem}}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Trường gửi hồ sơ:</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->uni['nt_ten'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Chuyên ngành</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->university['specialized'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Lớp hành chính</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->university['nameClass'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Mã sinh viên</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->university['studentCode'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Địa chỉ email nhà trường cấp</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->university['emailStudent'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Loại chương trình đào tạo</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->university['typeProgram'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Địa chỉ trụ sở chính</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->uni['nt_diachi'] }}
                            </span>
                        </div>
                        <!-- <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Trạng thái tốt nghiệp</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                            </span>
                        </div> -->
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Bảng điểm</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3 block-image">
                            @if(isset($hs->imgPointAr))
                                @foreach($hs->imgPointAr as $imgPoint)
                                <a data-fancybox="gallery" href='{{ asset($imgPoint)  }}'>
                                    <img class="img-fluid" src='{{ asset($imgPoint)  }}' alt="">
                                </a>
                                @endforeach
                            @else
                                <span class="text-tab-2-span">Không có thông tin</span>
                            @endif
                        </div>
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
                                @if($hs->yourjob['jobstatus'] == "1")
                                    Đang đi làm thuê
                                @elseif($hs->yourjob['jobstatus'] == "2")
                                    Tự kinh doanh
                                @elseif($hs->yourjob['jobstatus'] == "3")
                                    Không đi làm
                                @endif
                            </span>
                        </div>
                        @if($hs->yourjob['jobstatus'] != "3")
                            <div class="col-md-4 mb-3">
                                <p class="m-0 text-tab-2">Thời gian làm việc:</p>
                            </div>
                            <div class="col-md-8 mb-3">
                                <span class="text-tab-2-span">
                                    @if($hs->yourjob['timeJob']  == "1")
                                        Fulltime
                                    @elseif($hs->yourjob['timeJob']  == "2")
                                        Parttime
                                    @elseif($hs->yourjob['timeJob']  == "3")
                                        Fieldtrip
                                    @endif
                                </span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <p class="m-0 text-tab-2">Tên cơ sở làm việc:</p>
                            </div>
                            <div class="col-md-8 mb-3">
                                <span class="text-tab-2-span">{{ $hs->yourjob['nameCompany'] }}</span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <p class="m-0 text-tab-2">Địa chỉ cơ sở làm việc:</p>
                            </div>
                            <div class="col-md-8 mb-3">
                                <span class="text-tab-2-span">{{ $hs->yourjob['addressCompany'] }}</span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <p class="m-0 text-tab-2">Mức lương TB / tháng:</p>
                            </div>
                            <div class="col-md-8 mb-3">
                                <span class="text-tab-2-span">{{ number_format($hs->yourjob['money']) }} VNĐ</span>
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
                            @if($hs->option == "1")
                                @foreach($hs->nameClub as $nameClub)
                                <span class="text-block text-tab-2-span">{{ $nameClub }}</span>
                                @endforeach
                            @else
                                <span class="text-block text-tab-2-span">Không có thông tin</span>
                            @endif
                        </div>
                        <!-- NG bảo trợ -->
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 text-tab-2-title">Thông tin người bảo trợ</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                        </div>

                        @if(isset($hs->parents) && $hs->parents != null)
                        @for($k = 0; $k < count($hs->parents); $k++)               
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
                                {{ $hs->parents[$k]['fullname'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Số điện thoại</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->parents[$k]['phone'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Số căn cước công dân</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->parents[$k]['cccd'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Giới tính</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->parents[$k]['gender'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Số tài khoản</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->parents[$k]['stk'] }}
                            </span>
                        </div>
                        <div class="col-md-5 mb-3">
                            <p class="m-0 text-tab-2 pl-3 ml-3">Quan hệ với sinh viên</p>
                        </div>
                        <div class="col-md-7 mb-3 pl-3">
                            <span class="text-tab-2-span">
                                {{ $hs->parents[$k]['relationship'] }}
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
                        <?php $j++; ?>
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
                                {{ $hs->star_votes }} <i class="fas fa-star text-warning"></i>
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
        @if(isset($hs->two_sides_accept) && $hs->two_sides_accept == "true")
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        @else
        <button type="button" class="btn btn-danger" data-id="{{ $hs->_id }}" data-toggle="modal" data-target="#deleteModalHS">Xóa yêu cầu</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        @endif
      </div>
    </div>
  </div>
</div>
<?php $dem++; ?>
@endforeach


<div class="modal fade" id="deleteModalHS" tabindex="-1" role="dialog" aria-labelledby="deleteModalHSLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalHSLabel">Cảnh báo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-danger">
            <span>Bạn có thực sự muốn xóa yêu cầu khoản vay không?</span>
            <span>Thao tác này không thể hoàn tác</span>
        </p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-danger btn-delete-hoso">Xóa</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>

<!-- refuseModalLoan -->
<div class="modal fade" id="refuseModalLoan" tabindex="-1" role="dialog" aria-labelledby="refuseModalLoanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="refuseModalLoanLabel">Thông báo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-danger mb-1">Bạn có thật sự muốn hủy khoản vay này không?</p>
                <small class="text-danger">Hành động này không thể hoàn tác</small>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-danger confirm-delete ">Xác nhận xóa</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<!-- /refuseModalLoan -->

<!-- loanConfirmation -->
<div class="modal fade" id="loanConfirmation" tabindex="-1" role="dialog" aria-labelledby="loanConfirmationLable" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loanConfirmationLable">Thông báo</h5>
            </div>
            <form action="" method="post" class="form-comfirm-loan">
                @csrf
                <div class="modal-body">
                    <div class="container-fuild">
                        <div class="row">
                            <div class="col-md-12">
                                <p>Nhập mã xác thực qua email của bạn</p>
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Nhập mã xác nhận trong email của bạn" name="loanCode">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Xác nhận vay</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /loanConfirmation -->

<!-- back to top -->
<div class="back_to_top">
    <i class="fas fa-angle-up"></i>
</div>
@stop


@section('footer-js')
<script type="text/javascript" src="{{ asset('js/Smoney/Student/student.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
<script type="text/javascript">
    $(".complete-profile").click(function(e) {
        // ngăn call modal
        e.stopPropagation();
    })
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var $url_path = '{!! url('/') !!}';  
    $('#deleteModalHS').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var recipient = button.data('id')
      var modal = $(this)
      let $url = $url_path+"/deleteHoSo/"+recipient;
      modal.find('.btn-delete-hoso').attr("href",$url);
    })


    $('#refuseModalLoan').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('id')
        var modal = $(this)
        let $url = $url_path + "/confirm-delete/"+recipient;
        modal.find('.confirm-delete').attr("href",$url)
    })

    $('#loanConfirmation').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var recipient = button.data('id');
        var modal = $(this);
        let $url = $url_path + "/confirm-loan/"+recipient;
        modal.find('.form-comfirm-loan').attr("action",$url);

        // send gmail
        $.ajax({
            url:"{!! route('student.sendMailConfirm') !!}",
            method: "GET",
            data:{
                "idHS": recipient
            },
            success:function(data)
            {
                if(data.status == "success")
                    alert("Bạn đã gửi mail thành công")
                else if(data.status == "fail"){
                    alert("Chúng tôi không thể gửi thông báo đến email của bạn");
                    $('#loanConfirmation').modal("hide");
                }
            }
        });
    })
</script>
@stop