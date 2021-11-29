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
<link rel="stylesheet" href="{{ asset('css/Smoney/Student/apply-loan-custom.css') }}">
<style>
    .banner{
        background: url('{{ asset("img-smoney/img-students/bg-title.png")  }}');
        background-repeat: no-repeat;
        background-size: cover;
    }
    .btn-confirm-insite{
        background: rgb(107,168,242);
        background: linear-gradient(90deg, rgba(107,168,242,1) 0%, rgba(119,128,226,1) 100%);
        color: white;
        text-align: center;
        border-radius: 5px;
        padding: 0 2rem;
        display: flex;
        margin-right: 10px;
        align-items: center;
    }
    
</style>
@stop
@section('content')
@include('smoney/student/layouts/header')
<?php 
    use App\Models\SmoneyModels\NhaTruong;
    use App\Models\SmoneyModels\NganHang;
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
            <!-- not done here -->
            @if(count($findHSNotDone) == 0)
                <p class="title-empty-loan">Bạn không có khoản vay đã lưu nào!</p>
            @endif
            <?php $j = 1000; ?>
            @foreach($findHSNotDone as $hs)
            <!--  a div content -->
            <div class="content-block-parents">
                <div class="content-block content-block-notdone" data-toggle="modal" data-target="#modalLoanNotDone_{{ $j }}">
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
                                <a href="{{ route('student.completeProfile',$hs->_id) }}" class="complete-profile block-status block-status-confirm">Hoàn thiện hồ sơ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  /a div content -->
            <?php $j++; ?>
            @endforeach
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
                                @elseif($hs->profileStatusInBank == "paid")
                                    <div class="block-status block-status-confirm">Đã trả nợ</div>
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

<!-- detail hồ sơ done -->
<?php $dem = 0; ?>
@foreach($findHSDone as $hs)
<!-- modal -->
<div class="modal fade modal-project" id="modalLoan_1_{{ $dem }}" tabindex="-1" role="dialog" aria-labelledby="modalLoan_1Label" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="modalLoan_1Label">
            Thông tin hồ sơ của bạn - Ngày gửi: {{ date("h:i A d/m/Y", strtotime($hs->created_at)) }}
        </h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="font-weight-bold text-uppercase color-blue">Trạng thái</p>
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
                        <span data-year="Phản hồi ngân hàng" 
                            data-info=" 
                                @foreach($hs->bank as $value)
                                    {{ $value->nn_ten }}
                                @endforeach
                             "
                        ></span>
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
                        <span data-year="Phản hồi ngân hàng" 
                            data-info=" 
                                @foreach($hs->bank as $value)
                                    {{ $value->nn_ten }}
                                @endforeach
                             "
                        ></span>
                    </div>
                </div>
            </div>
        </div>
        
        @if(isset($hs->feedbackContentUni) && $hs->feedbackContentUni != null)
            <hr>
            <!-- Thông báo nhà trường-->
            <p class="font-weight-bold text-uppercase color-blue">Thông báo nhà trường</p>
            <div class="ml-4">
                @if($hs->profileStatusInUni == "pass")
                    <div class="model-success">
                        <div class="model-icon icon-success">
                            <i class="fas fa-check"></i>
                        </div>
                        <span class="text-info">{{ $hs->feedbackContentUni }}</span>
                    </div>
                @elseif($hs->profileStatusInUni == "refuse")
                    <div class="model-success">
                        <div class="model-icon icon-refuse">
                            <i class="fas fa-times"></i>
                        </div>
                        <span class="text-danger">{{ $hs->feedbackContentUni }}</span>
                    </div>
                @endif
            </div>
        @endif

        @if(isset($hs->loanProposal) && $hs->loanProposal != null)
            <hr>
            <!-- Thông báo ngân hàng-->
            <?php  $arrBank = array_keys($hs->loanProposal); ?>
            @for($i = 0; $i < count($arrBank); $i++)
                <?php 
                    //Tìm tên ngân hàng
                    $findBank = NganHang::where("nn_id", $arrBank[$i])
                        ->select("nn_ten")->first();
                 ?>
                <p class="font-weight-bold text-uppercase color-blue">
                    Thông báo ngân hàng {{ $findBank->nn_ten }}
                </p>
                <div class="ml-4">
                    <span class="text-info">
                        {{ $hs->loanProposal[$arrBank[$i]]['feedbackContentBank'] }}
                    </span>
                </div>

                <!-- Đề xuất khoản vay -->
                @if(isset($hs->loanProposal[$arrBank[$i]]['money']))
                    <div class="infomation-content ml-4 mr-4">
                        <table>
                            <tr>
                                <td>
                                    <span>Số tiền ngân hàng cho bạn vay</span>
                                </td>
                                <td>
                                    <span>{{ number_format($hs->loanProposal[$arrBank[$i]]['money']) }} VNĐ</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Lãi suất cho khoản vay của bạn</span>
                                </td>
                                <td>
                                    <span>{{ $hs->loanProposal[$arrBank[$i]]['interestRate'] }} % / tháng</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Kì hạn cho khoản vay của bạn</span>
                                </td>
                                <td>
                                    <span>{{ $hs->loanProposal[$arrBank[$i]]['loanMonth'] }} tháng</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Số tiền bạn phải trả trong 1 tháng</span>
                                </td>
                                <td>
                                    <span>
                                        <?php 
                                            $moneyPayAMonth = 
                                                $hs->loanProposal[$arrBank[$i]]['moneyPayAMonth'];
                                            $aMonthProfit =
                                                $hs->loanProposal[$arrBank[$i]]['aMonthProfit'];

                                            $sumMoney = $moneyPayAMonth + $aMonthProfit;

                                            $showString = number_format($sumMoney)." VNĐ ( ".
                                                number_format($moneyPayAMonth)." VNĐ - gốc + ".
                                                number_format($aMonthProfit)." VNĐ - lãi)";
                                            echo $showString;
                                         ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Tổng số tiền bạn phải trả trong suốt kì hạn</span>
                                </td>
                                <td>
                                    <span>
                                        <?php 
                                            $allLoanFinally  = round($sumMoney * 
                                                    $hs->loanProposal[$arrBank[$i]]['loanMonth']);
                                            echo number_format($allLoanFinally)." VNĐ";
                                         ?>
                                    </span>
                                </td>
                            </tr>
                            <!-- Phản hồi báo từ ngân hàng -->
                            @if(!isset($hs->yourDecision))
                            <tr>
                                <td></td>
                                <td>
                                    <button class="btn btn-success" data-bank = {{ $arrBank[$i] }} data-id="{{ $hs->_id }}" data-toggle="modal" data-target="#loanConfirmation" data-backdrop="static" data-keyboard="false">Xác nhận vay</button>
                                </td>
                            </tr>
                            @elseif(isset($hs->yourDecision) && $hs->yourDecision == 'cancel')
                            <tr>
                                <td></td>
                                <td>
                                    <button class="btn btn-danger" disabled="">Đã từ chối</button>
                                </td>
                            </tr>
                            @elseif(isset($hs->yourDecision) && $hs->yourDecision == 'yes')
                            <tr>
                                <td></td>
                                <td>
                                    @if($hs->chooseBank == $arrBank[$i])
                                        <button class="btn btn-success" disabled="">Đã chấp nhận</button>
                                    @else
                                        <button class="btn btn-danger" disabled="">Đã từ chối</button>
                                    @endif
                                </td>
                            </tr>
                            @endif
                        </table>
                    </div>
                @endif
            @endfor
            @if(isset($hs->two_sides_accept)  && isset($hs->bank_reason_refusal))
                <div class="ml-4">
                    <div class="model-success">
                        <div class="model-icon icon-refuse">
                            <i class="fas fa-times"></i>
                        </div>
                        <span class="text-danger">
                            Khoản vay bị từ chối do lý do: 
                            {{ $hs->bank_reason_refusal }}
                        </span>
                    </div>
                </div>
            @elseif(isset($hs->two_sides_accept) && $hs->two_sides_accept == "true")
                <div class="pl-4 mt-2">
                    <div class="model-success flex-center">
                        <div class="model-icon icon-success">
                            <i class="fas fa-check"></i>
                        </div>
                        <span class="text-info">
                            Đã chấp thuận
                        </span>
                    </div>
                </div>
                <div class="pl-4 mt-2">
                    <div class="model-success text-info flex-center">
                        Khoản vay đã được lưu thông vào ngày:  
                        {{ date("d/m/Y H:i", strtotime($hs->date_accept)) }}
                    </div>
                </div>
                <div class="pl-4 mt-2">
                    <div class="model-success text-info flex-center">
                        Khoản vay hết hạn vào ngày: 
                        {{ date("d/m/Y H:i", strtotime($hs->date_expired)) }}
                    </div>
                </div>
            @endif
        @endif
        <hr>
        <!-- hồ sơ -->
        <p class="font-weight-bold text-uppercase color-blue">Hồ sơ khoản vay</p>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="loanInfomation-tab_{{$dem}}" data-toggle="tab" href="#loanInfomation_{{$dem}}" role="tab" aria-controls="loanInfomation_{{$dem}}" aria-selected="true">Khoản vay</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="userInfomation-tab_{{$dem}}" data-toggle="tab" href="#userInfomation_{{$dem}}" role="tab" aria-controls="userInfomation_{{$dem}}" aria-selected="false">Cá nhân</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="shoolInfomation-tab_{{$dem}}" data-toggle="tab" href="#shoolInfomation_{{$dem}}" role="tab" aria-controls="shoolInfomation_{{$dem}}" aria-selected="false">Cơ sở đào tạo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="jobInfomation-tab_{{$dem}}" data-toggle="tab" href="#jobInfomation_{{$dem}}" role="tab" aria-controls="jobInfomation_{{$dem}}" aria-selected="false">Việc làm</a>
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
                <div class="infomation-content ml-4 mr-4">
                    <table>
                        <tr>
                            <td>
                                <span>Số tiền yêu cầu vay</span>
                            </td>
                            <td>
                                <span>{{ number_format($hs->hsk_money) }} VNĐ</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Mục đích vay</span>
                            </td>
                            <td>
                                <span>
                                    @if($hs->hsk_purpose == "1")
                                        Tiền học phí
                                    @endif
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Kì hạn khai báo</span>
                            </td>
                            <td>
                                <span>
                                    @if($hs->hsk_duration == "1")
                                        3 tháng
                                    @elseif($hs->hsk_duration == "2")
                                        6 tháng
                                    @elseif($hs->hsk_duration == "3")
                                        12 tháng
                                    @endif
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Ngân hàng yêu cầu vay</span>
                            </td>
                            <td>
                                <span>
                                    @foreach($hs->bank as $value)
                                        <span class="font-weight-bold text-tab-1-span">
                                            {{ $value->nn_ten }}</span>
                                        <br>
                                    @endforeach
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="userInfomation_{{$dem}}" role="tabpanel" aria-labelledby="userInfomation-tab_{{$dem}}">
                <div class="infomation-content ml-4 mr-4">
                    <table>
                        <tr>
                            <td>
                                <span>Họ tên</span>
                            </td>
                            <td>
                                <span>{{ $hs->hoten }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Số điện thoại chính</span>
                            </td>
                            <td>
                                <span>{{ $hs->sdt }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Số căn cước công dân</span>
                            </td>
                            <td>
                                <span>{{ $hs->cccd }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Ngày sinh</span>
                            </td>
                            <td>
                                <span>{{ $hs->ngaysinh }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Email</span>
                            </td>
                            <td>
                                <span>{{ $hs->email }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Giới tính</span>
                            </td>
                            <td>
                                <span>{{ $hs->gioitinh }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Số tài khoản</span>
                            </td>
                            <td>
                                @foreach($hs->stk as $hsk_stk)
                                    <span class="text-block">{{ $hsk_stk }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Số điện thoại khác</span>
                            </td>
                            <td>
                                @if($hs->otherSdt != null)                  
                                    @foreach($hs->otherSdt as $hsk_otherPhone)
                                        <span class="text-block">{{ $hsk_otherPhone }}</span>
                                    @endforeach 
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Địa chỉ thường chú</span>
                            </td>
                            <td>
                                <span>{{ $hs->diachi }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Địa chỉ tạm chú</span>
                            </td>
                            <td>
                                <span>{{ $hs->diachihientai }}</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="shoolInfomation_{{$dem}}" role="tabpanel" aria-labelledby="shoolInfomation-tab_{{$dem}}">
                <div class="infomation-content ml-4 mr-4">
                    <table>
                        <tr>
                            <td>
                                <span>Trường gửi hồ sơ</span>
                            </td>
                            <td>
                                <span>{{ $hs->uni['nt_ten'] }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Chuyên ngành</span>
                            </td>
                            <td>
                                <span>{{ $hs->university['specialized'] }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Lớp hành chính</span>
                            </td>
                            <td>
                                <span>{{ $hs->university['nameClass'] }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Mã sinh viên</span>
                            </td>
                            <td>
                                <span>{{ $hs->university['studentCode'] }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Địa chỉ email nhà trường cấp</span>
                            </td>
                            <td>
                                <span>{{ $hs->university['emailStudent'] }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Loại chương trình đào tạo</span>
                            </td>
                            <td>
                                <span>{{ $hs->university['typeProgram'] }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Địa chỉ trụ sở chính</span>
                            </td>
                            <td>
                                <span>{{ $hs->uni['nt_diachi'] }}</span>
                            </td>
                        </tr>
                        <!-- <tr>
                            <td>
                                <span>Trạng thái tốt nghiệp</span>
                            </td>
                            <td>
                                <span></span>
                            </td>
                        </tr> -->
                        <tr>
                            <td>
                                <span>Bảng điểm</span>
                            </td>
                            <td>
                                <div class="block-image">
                                    @if(isset($hs->imgPointAr))
                                        @foreach($hs->imgPointAr as $imgPoint)
                                        <a data-fancybox="gallery" href='{{ asset($imgPoint)  }}'>
                                            <img class="img-fluid" src='{{ asset($imgPoint)  }}' alt="">
                                        </a>
                                        @endforeach
                                    @else
                                        <span>Không có thông tin</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Câu lạc bộ, đoàn thể của trường</span>
                            </td>
                            <td>
                                @if($hs->option == "1" && $hs->nameClub != null)
                                    @foreach($hs->nameClub as $nameClub)
                                    <span class="text-block">{{ $nameClub }}</span>
                                    @endforeach
                                @else
                                    <span class="text-block">Không có thông tin</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="jobInfomation_{{$dem}}" role="tabpanel" aria-labelledby="jobInfomation-tab_{{$dem}}">
                <div class="infomation-content ml-4 mr-4">
                    <table>
                        <tr>
                            <td>
                                <span>Tình trạng việc làm</span>
                            </td>
                            <td>
                                <span>
                                    @if($hs->yourjob['jobstatus'] == "1")
                                        Đang đi làm thuê
                                    @elseif($hs->yourjob['jobstatus'] == "2")
                                        Tự kinh doanh
                                    @elseif($hs->yourjob['jobstatus'] == "3")
                                        Không đi làm
                                    @endif
                                </span>
                            </td>
                        </tr>
                        @if($hs->yourjob['jobstatus'] != "3")
                            <tr>
                                <td>
                                    <span>Thời gian làm việc</span>
                                </td>
                                <td>
                                    <span>
                                        @if($hs->yourjob['timeJob']  == "1")
                                            Fulltime
                                        @elseif($hs->yourjob['timeJob']  == "2")
                                            Parttime
                                        @elseif($hs->yourjob['timeJob']  == "3")
                                            Fieldtrip
                                        @endif
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Tên cơ sở làm việc</span>
                                </td>
                                <td>
                                    <span>{{ $hs->yourjob['nameCompany'] }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Địa chỉ cơ sở làm việc</span>
                                </td>
                                <td>
                                    <span>{{ $hs->yourjob['addressCompany'] }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Mức lương TB / tháng</span>
                                </td>
                                <td>
                                    <span>{{ number_format($hs->yourjob['money']) }} VNĐ</span>
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="optionInfomation_{{$dem}}" role="tabpanel" aria-labelledby="optionInfomation-tab_{{$dem}}">
                <p class="m-0 text-tab-2 text-tab-2-title">Thông tin người bảo trợ</p>
                @if(isset($hs->parents) && $hs->parents != null)
                    @for($k = 0; $k < count($hs->parents); $k++) 
                        <div class="infomation-content ml-4 mr-4">
                            <table>
                                <tr class="header-title">
                                    <td>
                                        <span class="font-weight-bold">Người thứ</span>
                                    </td>
                                    <td>
                                        <span class="font-weight-bold">{{ $k + 1 }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Họ tên</span>
                                    </td>
                                    <td>
                                        <span>{{ $hs->parents[$k]['fullname'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Số điện thoại</span>
                                    </td>
                                    <td>
                                        <span>{{ $hs->parents[$k]['phone'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Số căn cước công dân</span>
                                    </td>
                                    <td>
                                        <span>{{ $hs->parents[$k]['cccd'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Giới tính</span>
                                    </td>
                                    <td>
                                        <span>{{ $hs->parents[$k]['gender'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Số tài khoản</span>
                                    </td>
                                    <td>
                                        <span>{{ $hs->parents[$k]['stk'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Quan hệ với sinh viên</span>
                                    </td>
                                    <td>
                                        <span>{{ $hs->parents[$k]['relationship'] }}</span>
                                    </td>
                                </tr>
                            </table>
                            <hr>
                        </div>
                    @endfor
                @endif            

                <!-- Giấy tờ -->
                @if($hs->pageObject != null)
                    <p class="m-0 text-tab-2 text-tab-2-title">
                        Thông tin một số giấy tờ khác
                    </p>
                    <?php $j = 1; ?>
                    @foreach($hs->pageObject as $pageObject)
                        <div class="infomation-content ml-4 mr-4">
                            <table>
                                <tr>
                                    <td>
                                        <span>Giấy tờ thứ</span>
                                    </td>
                                    <td>
                                        <span class="font-weight-bold">{{ $j }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Tên giấy tờ</span>
                                    </td>
                                    <td>
                                        <span>{{ $pageObject['title'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Hình ảnh</span>
                                    </td>
                                    <td>
                                        <div class="col-md-7 mb-3 pl-3 block-image">
                                            @foreach($pageObject['arrayImg'] as $img)
                                            <a data-fancybox="gallery" href='{{ asset($img)  }}'>
                                                <img class="img-fluid" src='{{ asset($img)  }}' alt="">
                                            </a>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <hr>
                        </div>
                        <?php $j++; ?>
                    @endforeach
                @endif

                <!-- Chủ đề quan tâm -->
                @if(isset($hs->contentTag) && $hs->contentTag != null)
                    <p class="m-0 text-tab-2 text-tab-2-title">
                        Các chủ để mà bạn quan tâm
                    </p>
                    <div class="infomation-content ml-4 mr-4">
                        <table>
                            <tr>
                                <td>
                                    <span>Các chủ đề</span>
                                </td>
                                <td>
                                    <?php 
                                        $pieces = explode("|", $hs->contentTag);
                                        $array = array();
                                        for ($i=0; $i < count($pieces)-1; $i++) {
                                            $array = Arr::add($array, $i ,$pieces[$i]);
                                        }
                                     ?>
                                    <span class="div_drop">
                                        @foreach($array as $ar)
                                            <a class="ui tag label">{{ $ar }}</a>
                                        @endforeach
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                @endif
            </div>
            <div class="tab-pane fade" id="comfirmInfomation_{{$dem}}" role="tabpanel" aria-labelledby="comfirmInfomation-tab_{{$dem}}">
                <div class="infomation-content ml-4 mr-4">
                    <table>
                        <tr>
                            <td>
                                <span>Cổng thông tin liên lạc</span>
                            </td>
                            <td>
                                <span>Liên lạc qua 
                                    @if($hs->portal == "1")
                                        email
                                    @elseif($hs->portal == "2")
                                        số điện thoại
                                    @else
                                        số điện thoại và email
                                    @endif
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Ý kiến của bạn</span>
                            </td>
                            <td>
                                <span>{{ $hs->opinion }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Số đánh giá</span>
                            </td>
                            <td>
                                <span>
                                    {{ $hs->star_votes }} 
                                    <i class="fas fa-star text-warning"></i>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Điều khoản</span>
                            </td>
                            <td>
                                @if($hs->pagepresent == "done")
                                    <div class="model-success">
                                        <div class="model-icon icon-success">
                                            <i class="fas fa-check"></i>
                                        </div>
                                        <span class="text-success">
                                            Đã chấp nhận điều khoản sử dụng
                                        </span>
                                    </div>
                                @else
                                    <div class="model-success">
                                        <div class="model-icon icon-refuse">
                                            <i class="fas fa-times"></i>
                                        </div>
                                        <span class="text-danger">
                                            Chưa chấp nhận điều khoản sử dụng
                                        </span>
                                    </div> 
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="btn-handle-loan">
            @if(isset($hs->two_sides_accept) && $hs->two_sides_accept == "true")
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">
                    Đóng
                </button>
            @else
                <button type="button" class="btn btn-danger mr-4" data-id="{{ $hs->_id }}" data-toggle="modal" data-target="#deleteModalHS">
                    Xóa yêu cầu
                </button>
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">
                    Đóng
                </button>
            @endif
        </div>

      </div>
    </div>
  </div>
</div>
<?php $dem++; ?>
@endforeach


<!-- detail hồ sơ not done -->
<?php $count = 1000; ?>
@foreach($findHSNotDone as $hs)
<!-- modal -->
<div class="modal fade modal-project" id="modalLoanNotDone_{{ $count }}" tabindex="-1" role="dialog" aria-labelledby="modalLoanNotDone_Label" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="modalLoanNotDone_Label">
            Thông tin hồ sơ của bạn - Ngày gửi: {{ date("h:i A d/m/Y", strtotime($hs->created_at)) }}
        </h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- hồ sơ -->
        <p class="font-weight-bold text-uppercase color-blue">Hồ sơ khoản vay</p>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="loanInfomation-tab_{{$count}}" data-toggle="tab" href="#loanInfomation_{{$count}}" role="tab" aria-controls="loanInfomation_{{$count}}" aria-selected="true">Khoản vay</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="userInfomation-tab_{{$count}}" data-toggle="tab" href="#userInfomation_{{$count}}" role="tab" aria-controls="userInfomation_{{$count}}" aria-selected="false">Cá nhân</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="shoolInfomation-tab_{{$count}}" data-toggle="tab" href="#shoolInfomation_{{$count}}" role="tab" aria-controls="shoolInfomation_{{$count}}" aria-selected="false">Cơ sở đào tạo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="jobInfomation-tab_{{$count}}" data-toggle="tab" href="#jobInfomation_{{$count}}" role="tab" aria-controls="jobInfomation_{{$count}}" aria-selected="false">Việc làm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="optionInfomation-tab_{{$count}}" data-toggle="tab" href="#optionInfomation_{{$count}}" role="tab" aria-controls="optionInfomation_{{$count}}" aria-selected="false">Tùy chọn</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="comfirmInfomation-tab_{{$count}}" data-toggle="tab" href="#comfirmInfomation_{{$count}}" role="tab" aria-controls="comfirmInfomation_{{$count}}" aria-selected="false">Điều khoản</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="loanInfomation_{{$count}}" role="tabpanel" aria-labelledby="loanInfomation-tab_{{$count}}">
                <div class="infomation-content ml-4 mr-4">
                    <table>
                        <tr>
                            <td>
                                <span>Số tiền yêu cầu vay</span>
                            </td>
                            <td>
                                <span>{{ number_format($hs->hsk_money) }} VNĐ</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Mục đích vay</span>
                            </td>
                            <td>
                                <span>
                                    @if($hs->hsk_purpose == "1")
                                        Tiền học phí
                                    @endif
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Kì hạn khai báo</span>
                            </td>
                            <td>
                                <span>
                                    @if($hs->hsk_duration == "1")
                                        3 tháng
                                    @elseif($hs->hsk_duration == "2")
                                        6 tháng
                                    @elseif($hs->hsk_duration == "3")
                                        12 tháng
                                    @endif
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Ngân hàng yêu cầu vay</span>
                            </td>
                            <td>
                                <span>
                                    @foreach($hs->bank as $value)
                                        <span class="font-weight-bold text-tab-1-span">
                                            {{ $value->nn_ten }}</span>
                                        <br>
                                    @endforeach
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="userInfomation_{{$count}}" role="tabpanel" aria-labelledby="userInfomation-tab_{{$count}}">
                <div class="infomation-content ml-4 mr-4">
                    <table>
                        <tr>
                            <td>
                                <span>Họ tên</span>
                            </td>
                            <td>
                                <span>{{ $hs->hoten }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Số điện thoại chính</span>
                            </td>
                            <td>
                                <span>{{ $hs->sdt }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Số căn cước công dân</span>
                            </td>
                            <td>
                                <span>{{ $hs->cccd }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Ngày sinh</span>
                            </td>
                            <td>
                                <span>{{ $hs->ngaysinh }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Email</span>
                            </td>
                            <td>
                                <span>{{ $hs->email }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Giới tính</span>
                            </td>
                            <td>
                                <span>{{ $hs->gioitinh }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Số tài khoản</span>
                            </td>
                            <td>
                                @foreach($hs->stk as $hsk_stk)
                                    <span class="text-block">{{ $hsk_stk }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Số điện thoại khác</span>
                            </td>
                            <td>
                                @if($hs->otherSdt != null)                  
                                    @foreach($hs->otherSdt as $hsk_otherPhone)
                                        <span class="text-block">{{ $hsk_otherPhone }}</span>
                                    @endforeach 
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Địa chỉ thường chú</span>
                            </td>
                            <td>
                                <span>{{ $hs->diachi }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Địa chỉ tạm chú</span>
                            </td>
                            <td>
                                <span>{{ $hs->diachihientai }}</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="shoolInfomation_{{$count}}" role="tabpanel" aria-labelledby="shoolInfomation-tab_{{$count}}">
                <div class="infomation-content ml-4 mr-4">
                    <table>
                        <tr>
                            <td>
                                <span>Trường gửi hồ sơ</span>
                            </td>
                            <td>
                                <span>
                                    @if($hs->uni['nt_ten'] !=  null)
                                        {{ $hs->uni['nt_ten'] }}
                                    @else
                                        Không có thông tin
                                    @endif
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Chuyên ngành</span>
                            </td>
                            <td>
                                <span>
                                    <?php $keyUni = $hs->chooseSchool; ?>
                                    @if(isset($hs->university[$keyUni]['nameClass']))
                                        {{ $hs->university[$keyUni]['specialized'] }}
                                    @else
                                        Không có thông tin
                                    @endif
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Lớp hành chính</span>
                            </td>
                            <td>
                                <span>
                                    @if(isset($hs->university[$keyUni]['nameClass']))
                                        {{ $hs->university[$keyUni]['nameClass'] }}
                                    @else
                                        Không có thông tin
                                    @endif
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Mã sinh viên</span>
                            </td>
                            <td>
                                <span>
                                    @if(isset($hs->university[$keyUni]['studentCode']))
                                        {{ $hs->university[$keyUni]['studentCode'] }}
                                    @else
                                        Không có thông tin
                                    @endif
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Địa chỉ email nhà trường cấp</span>
                            </td>
                            <td>
                                <span>
                                    @if(isset($hs->university[$keyUni]['emailStudent']))
                                        {{ $hs->university[$keyUni]['emailStudent'] }}
                                    @else
                                        Không có thông tin
                                    @endif
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Loại chương trình đào tạo</span>
                            </td>
                            <td>
                                <span>
                                    @if(isset($hs->university[$keyUni]['typeProgram']))
                                        {{ $hs->university[$keyUni]['typeProgram'] }}
                                    @else
                                        Không có thông tin
                                    @endif
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Địa chỉ trụ sở chính</span>
                            </td>
                            <td>
                                <span>
                                    @if($hs->uni['nt_diachi'] != null)
                                        {{ $hs->uni['nt_diachi'] }}
                                    @else
                                        Không có thông tin
                                    @endif
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Bảng điểm</span>
                            </td>
                            <td>
                                <div class="block-image">
                                    @if(isset($hs->imgPointAr))
                                        @foreach($hs->imgPointAr as $imgPoint)
                                        <a data-fancybox="gallery" href='{{ asset($imgPoint)  }}'>
                                            <img class="img-fluid" src='{{ asset($imgPoint)  }}' alt="">
                                        </a>
                                        @endforeach
                                    @else
                                        <span>Không có thông tin</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Câu lạc bộ, đoàn thể của trường</span>
                            </td>
                            <td>
                                @if($hs->option == "1" && $hs->nameClub != null)
                                    @foreach($hs->nameClub as $nameClub)
                                    <span class="text-block">{{ $nameClub }}</span>
                                    @endforeach
                                @else
                                    <span class="text-block">Không có thông tin</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="jobInfomation_{{$count}}" role="tabpanel" aria-labelledby="jobInfomation-tab_{{$count}}">
                <div class="infomation-content ml-4 mr-4">
                    <table>
                        <tr>
                            <td>
                                <span>Tình trạng việc làm</span>
                            </td>
                            <td>
                                <span>
                                    @if($hs->yourjob['jobstatus'] == "1")
                                        Đang đi làm thuê
                                    @elseif($hs->yourjob['jobstatus'] == "2")
                                        Tự kinh doanh
                                    @elseif($hs->yourjob['jobstatus'] == "3")
                                        Không đi làm
                                    @endif
                                </span>
                            </td>
                        </tr>
                        @if($hs->yourjob['jobstatus'] != "3")
                            <tr>
                                <td>
                                    <span>Thời gian làm việc</span>
                                </td>
                                <td>
                                    <span>
                                        @if($hs->yourjob['timeJob']  == "1")
                                            Fulltime
                                        @elseif($hs->yourjob['timeJob']  == "2")
                                            Parttime
                                        @elseif($hs->yourjob['timeJob']  == "3")
                                            Fieldtrip
                                        @endif
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Tên cơ sở làm việc</span>
                                </td>
                                <td>
                                    <span>{{ $hs->yourjob['nameCompany'] }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Địa chỉ cơ sở làm việc</span>
                                </td>
                                <td>
                                    <span>{{ $hs->yourjob['addressCompany'] }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Mức lương TB / tháng</span>
                                </td>
                                <td>
                                    <span>{{ number_format($hs->yourjob['money']) }} VNĐ</span>
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="optionInfomation_{{$count}}" role="tabpanel" aria-labelledby="optionInfomation-tab_{{$count}}">
                <p class="m-0 text-tab-2 text-tab-2-title">Thông tin người bảo trợ</p>
                @if(isset($hs->parents) && $hs->parents != null)
                    @for($k = 0; $k < count($hs->parents); $k++) 
                        <div class="infomation-content ml-4 mr-4">
                            <table>
                                <tr class="header-title">
                                    <td>
                                        <span class="font-weight-bold">Người thứ</span>
                                    </td>
                                    <td>
                                        <span class="font-weight-bold">{{ $k + 1 }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Họ tên</span>
                                    </td>
                                    <td>
                                        <span>{{ $hs->parents[$k]['fullname'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Số điện thoại</span>
                                    </td>
                                    <td>
                                        <span>{{ $hs->parents[$k]['phone'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Số căn cước công dân</span>
                                    </td>
                                    <td>
                                        <span>{{ $hs->parents[$k]['cccd'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Giới tính</span>
                                    </td>
                                    <td>
                                        <span>{{ $hs->parents[$k]['gender'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Số tài khoản</span>
                                    </td>
                                    <td>
                                        <span>{{ $hs->parents[$k]['stk'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Quan hệ với sinh viên</span>
                                    </td>
                                    <td>
                                        <span>{{ $hs->parents[$k]['relationship'] }}</span>
                                    </td>
                                </tr>
                            </table>
                            <hr>
                        </div>
                    @endfor
                @endif            

                <!-- Giấy tờ -->
                @if($hs->pageObject != null)
                    <p class="m-0 text-tab-2 text-tab-2-title">
                        Thông tin một số giấy tờ khác
                    </p>
                    <?php $j = 1; ?>
                    @foreach($hs->pageObject as $pageObject)
                        <div class="infomation-content ml-4 mr-4">
                            <table>
                                <tr>
                                    <td>
                                        <span>Giấy tờ thứ</span>
                                    </td>
                                    <td>
                                        <span class="font-weight-bold">{{ $j }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Tên giấy tờ</span>
                                    </td>
                                    <td>
                                        <span>{{ $pageObject['title'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Hình ảnh</span>
                                    </td>
                                    <td>
                                        <div class="col-md-7 mb-3 pl-3 block-image">
                                            @foreach($pageObject['arrayImg'] as $img)
                                            <a data-fancybox="gallery" href='{{ asset($img)  }}'>
                                                <img class="img-fluid" src='{{ asset($img)  }}' alt="">
                                            </a>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <hr>
                        </div>
                        <?php $j++; ?>
                    @endforeach
                @endif

                <!-- Chủ đề quan tâm -->
                @if(isset($hs->contentTag) && $hs->contentTag != null)
                    <p class="m-0 text-tab-2 text-tab-2-title">
                        Các chủ để mà bạn quan tâm
                    </p>
                    <div class="infomation-content ml-4 mr-4">
                        <table>
                            <tr>
                                <td>
                                    <span>Các chủ đề</span>
                                </td>
                                <td>
                                    <?php 
                                        $pieces = explode("|", $hs->contentTag);
                                        $array = array();
                                        for ($i=0; $i < count($pieces)-1; $i++) {
                                            $array = Arr::add($array, $i ,$pieces[$i]);
                                        }
                                     ?>
                                    <span class="div_drop">
                                        @foreach($array as $ar)
                                            <a class="ui tag label">{{ $ar }}</a>
                                        @endforeach
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                @endif
            </div>
            <div class="tab-pane fade" id="comfirmInfomation_{{$count}}" role="tabpanel" aria-labelledby="comfirmInfomation-tab_{{$count}}">
                <div class="infomation-content ml-4 mr-4">
                    <table>
                        <tr>
                            <td>
                                <span>Cổng thông tin liên lạc</span>
                            </td>
                            <td>
                                @if($hs->portal != null)
                                    <span>Liên lạc qua 
                                        @if($hs->portal == "1")
                                            email
                                        @elseif($hs->portal == "2")
                                            số điện thoại
                                        @else
                                            số điện thoại và email
                                        @endif
                                    </span>
                                @else
                                    Không có thông tin
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Ý kiến của bạn</span>
                            </td>
                            <td>
                                <span>
                                    @if($hs->opinion != null)
                                        {{ $hs->opinion }}
                                    @else
                                        Không có thông tin
                                    @endif
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Số đánh giá</span>
                            </td>
                            <td>
                                <span>
                                    @if($hs->star_votes != null)
                                        {{ $hs->star_votes }} 
                                        <i class="fas fa-star text-warning"></i>
                                    @else
                                        Không có thông tin
                                    @endif
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Điều khoản</span>
                            </td>
                            <td>
                                @if($hs->pagepresent == "done")
                                    <div class="model-success">
                                        <div class="model-icon icon-success">
                                            <i class="fas fa-check"></i>
                                        </div>
                                        <span class="text-success">
                                            Đã chấp nhận điều khoản sử dụng
                                        </span>
                                    </div>
                                @else
                                    <div class="model-success">
                                        <div class="model-icon icon-refuse">
                                            <i class="fas fa-times"></i>
                                        </div>
                                        <span class="text-danger">
                                            Chưa chấp nhận điều khoản sử dụng
                                        </span>
                                    </div> 
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="btn-handle-loan">
            <a href="{{ route('student.completeProfile',$hs->_id) }}" class="btn-confirm-insite">Hoàn thiện hồ sơ</a>
            <button type="button" class="btn btn-danger mr-4" data-id="{{ $hs->_id }}" data-toggle="modal" data-target="#deleteModalHS">
                Xóa yêu cầu
            </button>
        </div>

      </div>
    </div>
  </div>
</div>
<?php $count++; ?>
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
<!-- <div class="modal fade" id="refuseModalLoan" tabindex="-1" role="dialog" aria-labelledby="refuseModalLoanLabel" aria-hidden="true">
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
</div> -->
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


    // $('#refuseModalLoan').on('show.bs.modal', function (event) {
    //     var button = $(event.relatedTarget)
    //     var recipient = button.data('id')
    //     var modal = $(this)
    //     let $url = $url_path + "/confirm-delete/"+recipient;
    //     modal.find('.confirm-delete').attr("href",$url)
    // })

    $('#loanConfirmation').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var idHS = button.data('id');
        var idBank = button.data('bank');
        var modal = $(this);
        let $url = `${$url_path}/confirm-loan/${idHS}/${idBank}`;
        modal.find('.form-comfirm-loan').attr("action",$url);

        // send gmail
        $.ajax({
            url:"{!! route('student.sendMailConfirm') !!}",
            method: "GET",
            data:{
                "idHS": idHS,
                "idBank": idBank
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