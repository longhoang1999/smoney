<?php 
    use Illuminate\Support\Arr;
    use Carbon\Carbon;
 ?>
<div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLoan_1Label">
            Thông tin khoản vay
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Thông tin khoản vay</h5>
        <div class="info-loan-normal container">
            <div class="row mb-2">
                <div class="col-md-6">Họ và tên: </div>
                <div class="col-md-6 font-weight-bold text-primary">{{ $hs->hoten }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6">Sinh viên trường: </div>
                <div class="col-md-6 font-weight-bold text-primary">{{ $hs->uni['nt_ten'] }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6">Số tiền vay: </div>
                <div class="col-md-6 font-weight-bold text-primary">
                    {{ number_format($hs->loanProposal[$hs->chooseBank]['money']) }} VNĐ
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6">Kì hạn: </div>
                <div class="col-md-6 font-weight-bold text-primary">
                    {{ number_format($hs->loanProposal[$hs->chooseBank]['loanMonth']) }} tháng
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6">Lãi xuất: </div>
                <div class="col-md-6 font-weight-bold text-primary">
                    {{ number_format($hs->loanProposal[$hs->chooseBank]['interestRate']) }} % / tháng
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6">Số tiền phải trả trong 1 tháng: </div>
                <div class="col-md-6 font-weight-bold text-primary">
                    <?php 
                        $moneyPayAMonth = $hs->loanProposal[$hs->chooseBank]['moneyPayAMonth'];
                        $aMonthProfit = $hs->loanProposal[$hs->chooseBank]['aMonthProfit'];
                        $sumMoney = $moneyPayAMonth + $aMonthProfit;

                        $showString = number_format($sumMoney)." VNĐ ( ".
                            number_format($moneyPayAMonth)." VNĐ - gốc + ".
                            number_format($aMonthProfit)." VNĐ - lãi)";
                        echo $showString;
                     ?>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6">Tổng số tiền bạn phải trả trong suốt kì hạn: </div>
                <div class="col-md-6 font-weight-bold text-primary">
                    <?php 
                        $allLoanFinally 
                            = round($sumMoney * 
                                $hs->loanProposal[$hs->chooseBank]['loanMonth']);
                        echo number_format($allLoanFinally)." VNĐ";
                     ?>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6">Ngày có hiệu lực: </div>
                <div class="col-md-6 font-weight-bold text-primary">
                    {{ date("d/m/Y H:i A", strtotime($hs->date_accept)) }}
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6">Ngày hết hạn: </div>
                <div class="col-md-6 font-weight-bold text-primary">
                    {{ date("d/m/Y H:i A", strtotime($hs->date_expired)) }}
                </div>
            </div>

            <!-- cho ngân hàng -->
            @if($status != 'onlySeePaid')
                <div class="row mb-2">
                    <div class="col-md-6 changeTitle">
                        @if(isset($status) && $status == 'outdate')
                            Đã quá hạn trả nợ
                        @else
                            Thời gian còn lại: 
                        @endif
                    </div>
                    <div class="col-md-6 font-weight-bold changeContent
                        @if(isset($status) && ($status == 'danger' || $status == 'outdate'))
                            text-danger
                        @else
                            text-primary
                        @endif
                     ">
                        <?php 
                            $date_expired = Carbon::createFromFormat('Y-m-d H:i', $hs->date_expired);
                         ?>
                        {{ $date_expired->diffInDays(Carbon::now()) }} ngày

                    </div>
                </div>
            @endif

            <!-- cho sv -->
            @if(isset($hs->dateOfPayment) && $hs->dateOfPayment != "")
                <hr>
                <div class="row mb-2">
                    <div class="col-md-6">
                        Ngày thanh toán:
                    </div>
                    <div class="col-md-6 font-weight-bold text-primary">
                        {{ date("d/m/Y H:i A", strtotime($hs->dateOfPayment)) }}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        Khoản vay đã trả:
                    </div>
                    <div class="col-md-6 font-weight-bold text-primary">
                        {{ number_format($hs->totalMoney) }} VNĐ
                    </div>
                </div>
                @if(isset($hs->moneyOutDate) && $hs->moneyOutDate != "")
                    <div class="row mb-2">
                        <div class="col-md-6">
                            Tiền phạt quá hạn (nếu có):
                        </div>
                        <div class="col-md-6 font-weight-bold text-primary">
                            {{ number_format($hs->moneyOutDate) }} VNĐ
                        </div>
                    </div>
                @endif
                <div class="row mb-2">
                    <div class="col-md-6">
                        Tổng tiền đã trả:
                    </div>
                    <div class="col-md-6 font-weight-bold text-primary">
                        @if(isset($hs->moneyOutDate) && $hs->moneyOutDate != "")
                            {{ number_format(intval($hs->totalMoney) 
                                + intval($hs->moneyOutDate)) }} VNĐ
                        @else
                            {{ number_format($hs->totalMoney) }} VNĐ
                        @endif
                    </div>
                </div>
            @endif

        </div>
        @if(isset($status) && $status == 'danger')
            <hr>
            <h5>Quyết định thanh toán</h5>
            <form action="{{ route('bank.LoanComfirmPay') }}" method="post">
                @csrf
                <input type="hidden" value="{{ $hs->_id }}" name="idHS">
                <div class="info-loan-normal container">
                    <div class="row">
                        <div class="col-md-8">
                            <p>
                                <span>Xác nhận sinh viên đã trả hết toàn bộ số tiền </span>
                                <span class="font-weight-bold text-info">{{ number_format($allLoanFinally)." VNĐ" }}</span>
                                <input type="text" hidden="" value="{{ $allLoanFinally }}" name="totalMoney">
                            </p>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-warning">Xác nhận</button>
                        </div>
                    </div>
                </div>
            </form>
        @endif
        @if(isset($status) && $status == 'outdate')
            <hr>
            <h5>Quyết định thanh toán</h5>
            <form action="{{ route('bank.LoanPayOutDate') }}" method="post">
                @csrf
                <input type="hidden" value="{{ $hs->_id }}" name="idHS">
                <div class="info-loan-normal container">
                    <div class="row mb-2">
                        <div class="col-md-7">
                            <p>Xác nhận sinh viên đã trả hết toàn bộ số tiền: </p>
                        </div>
                        <div class="col-md-5">
                            <span class="font-weight-bold text-info">{{ number_format($allLoanFinally)." VNĐ" }}</span>
                            <input type="text" hidden="" value="{{ $allLoanFinally }}" name="totalMoney">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-7 titleMoneyOutDate">
                            Số tiền trả thêm vì quá hạn thanh toán: 
                        </div>
                        <div class="col-md-5 inputMoneyOutDate">
                            <span class="detailMoneyOutDate">0 VNĐ</span>
                            <div class="MoneyOutDateChild">
                                <button type="button" class="btn-show-input">
                                    <i class="fas fa-long-arrow-alt-right"></i>
                                </button>
                                <input type="number" class="form-control moneyOutDate" placeholder="Nhập số tiền" name="moneyOutDate">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-7"></div>
                        <div class="col-md-5">
                            <button type="submit" class="btn btn-warning">Xác nhận</button>
                        </div>
                    </div>
                </div>
            </form>
        @endif
        <hr>
        <h5>Thông tin hồ sơ của sinh viên - Ngày gửi: {{ date("h:i A d-m-Y", strtotime($hs->created_at)) }}</h5>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="loanInfomation-tab" data-toggle="tab" href="#loanInfomation" role="tab" aria-controls="loanInfomation" aria-selected="true">Tt.Khoản vay</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="userInfomation-tab" data-toggle="tab" href="#userInfomation" role="tab" aria-controls="userInfomation" aria-selected="false">Tt.cá nhân</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="shoolInfomation-tab" data-toggle="tab" href="#shoolInfomation" role="tab" aria-controls="shoolInfomation" aria-selected="false">Tt.Cơ sở đào tạo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="jobInfomation-tab" data-toggle="tab" href="#jobInfomation" role="tab" aria-controls="jobInfomation" aria-selected="false">Tt.Việc làm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="optionInfomation-tab" data-toggle="tab" href="#optionInfomation" role="tab" aria-controls="optionInfomation" aria-selected="false">Tùy chọn</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="comfirmInfomation-tab" data-toggle="tab" href="#comfirmInfomation" role="tab" aria-controls="comfirmInfomation" aria-selected="false">Điều khoản</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="loanInfomation" role="tabpanel" aria-labelledby="loanInfomation-tab">
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
            <div class="tab-pane fade" id="userInfomation" role="tabpanel" aria-labelledby="userInfomation-tab">
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
                        @if($hs->otherSdt)                         
                            @foreach($hs->otherSdt as $hsk_otherPhone)
                                <span class="text-block text-tab-2-span">{{ $hsk_otherPhone }}</span>
                            @endforeach
                        @endif
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
            <div class="tab-pane fade" id="shoolInfomation" role="tabpanel" aria-labelledby="shoolInfomation-tab">
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
            <div class="tab-pane fade" id="jobInfomation" role="tabpanel" aria-labelledby="jobInfomation-tab">
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
            <div class="tab-pane fade" id="optionInfomation" role="tabpanel" aria-labelledby="optionInfomation-tab">
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
            <div class="tab-pane fade" id="comfirmInfomation" role="tabpanel" aria-labelledby="comfirmInfomation-tab">
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

      @if(isset($seeHS) && $seeHS == "seeHS")
      <div class="modal-footer">
        <a href="{{ route('checkPosition.seeHS',$hs->_id) }}" class="btn btn-primary">Xem chi tiết</a>
      </div>
      @endif


    </div>
    
</div>

<script type="text/javascript">
    var timer;
    $(".moneyOutDate").keyup(function() {
        clearTimeout(timer);
        timer = setTimeout(() => {
            let inputMoney = $(this).val().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
            $(".detailMoneyOutDate").text(`${inputMoney} VNĐ`);
            $(".moneyOutDate").css("right", "-20rem");
            $(".MoneyOutDateChild button").show();
        }, 1000)
    })

    $(".MoneyOutDateChild button").click(function() {
        $(".moneyOutDate").css("right", "3.5rem");
        $(this).hide();
    })
</script>