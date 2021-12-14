<?php 
    use Illuminate\Support\Arr;
    use App\Models\SmoneyModels\NganHang;
 ?>
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="modalLoan_1Label">
            Thông tin hồ sơ của sinh viên - Ngày gửi: {{ date("h:i A d-m-Y", strtotime($hs->created_at)) }}
        </h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if(isset($showTimeLine) && $showTimeLine == 'showTimeLine')
            <p class="font-weight-bold text-uppercase color-blue">Trạng thái</p>
            <div class="time-loan">
                <div class="flex-parent">
                    <div class="input-flex-container"> 
                        <div class="input 
                        @if($hs->profileStatusInUni == 'wait')
                            active
                        @endif
                        ">
                            <span data-year="Yêu cầu vay" data-info="{{ $hs->hoten }} (Sinh viên)"></span>
                        </div>
                        <div class="input  
                        @if($hs->profileStatusInUni != 'wait' && $hs->profileStatusInBank == 'wait')
                            active 
                            @if($hs->profileStatusInUni == 'refuse')
                                loanRefuse 
                            @endif
                        @endif
                        ">
                            <span data-year="Xác nhận nhà trường" data-info="{{ $hs->uni['nt_ten'] }}"></span>
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
                            <span data-year="Xác nhận vay" data-info="{{ $hs->hoten }} (Sinh viên)"></span>
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
            <p class="status-feedback-uni text-center">
                @if($hs->profileStatusInUni == "refuse")
                    <span class="badge badge-danger">
                        Trường đã từ chối khoản vay vào: 
                        {{ date("h i A d/m/Y", strtotime($hs->feedbackUniDate)) }}
                    </span>
                    <br>
                    <span class="font-italic">Phản hồi với sinh viên: {{ $hs->feedbackContentUni }}</span>
                @elseif($hs->profileStatusInUni == "pass")
                    <span class="badge badge-success">
                        Trường đã chấp nhận khoản vay vào: 
                        {{ date("h i A d/m/Y", strtotime($hs->feedbackUniDate)) }}
                    </span>
                    <br>
                    <span class="font-italic">Phản hồi với sinh viên: {{ $hs->feedbackContentUni }}</span>
                @endif
            </p>

            @if(isset($hs->chooseBank) && $hs->profileStatusInBank == "pass")
                <p class="text-center">
                    <span class="badge badge-success">
                        Đã chấp nhận vay tại ngân hàng 
                        "{{ 
                            NganHang::where('nn_id', $hs->chooseBank)
                            ->select('nn_ten')->first()->nn_ten
                        }}" 
                        vào {{ date("h i A d/m/Y", strtotime($hs->feedbackBankDate)) }}
                    </span>
                </p>
            @endif
            @if(!isset($hs->chooseBank) && $hs->profileStatusInBank == "refuse")
                <p class="text-center">
                    <span class="badge badge-danger">
                        Khoản vay đã bị từ chối bởi các ngân hàng
                    </span>
                </p>
            @endif

            @if(isset($hs->two_sides_accept) && $hs->two_sides_accept == "true")
                <p class="text-center">
                    <span class="badge badge-success">
                        Khoản vay đã được lưu thông
                    </span>
                    <br>
                    <span class="font-italic">
                        Ngày có hiệu lực: {{ date("h:i A d/m/Y", strtotime($hs->date_accept)) }}
                    </span>
                    <br>
                    <span class="font-italic">
                        Ngày hết hạn: {{ date("h:i A d/m/Y", strtotime($hs->date_expired)) }} 
                    </span>
                </p>

                <!-- Thông tin khoản vay lưu thông -->
                <p class="font-weight-bold text-uppercase color-blue">
                    Thông tin khoản vay lưu thông
                </p>
                <div class="info-loan-circulate">
                    <table class="customTable">
                        <tbody>
                            <tr>
                                <td>
                                    <span>Số tiền cho vay</span>
                                </td>
                                <td>
                                    <span>
                                        <?php $idchooseBank = $hs->chooseBank;?>
                                        {{ number_format($hs->loanProposal[$idchooseBank]['money']) }} VNĐ
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Lãi suất cho vay</span>
                                </td>
                                <td>
                                    <span>
                                        {{ $hs->loanProposal[$idchooseBank]['interestRate'] }} % / tháng
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Kỳ hạn cho vay</span>
                                </td>
                                <td>
                                    <span>
                                        {{ $hs->loanProposal[$idchooseBank]['loanMonth'] }} tháng
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Số tiền sinh viên trả trong 1 tháng</span>
                                </td>
                                <td>
                                    <span>
                                        <?php 
                                            $moneyPayAMonth = 
                                                $hs->loanProposal[$idchooseBank]['moneyPayAMonth'];
                                            $aMonthProfit =
                                                $hs->loanProposal[$idchooseBank]['aMonthProfit'];

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
                                    <span>Số tiền phải trả trong suốt kỳ hạn</span>
                                </td>
                                <td>
                                    <span>
                                        <?php 
                                            $allLoanFinally  = round($sumMoney * 
                                                    $hs->loanProposal[$idchooseBank]['loanMonth']);
                                            echo number_format($allLoanFinally)." VNĐ";
                                         ?>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        @endif

        <!-- thông tin yêu cầu -->
        <p class="font-weight-bold text-uppercase color-blue">Thông tin hồ sơ</p>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="loanInfomation-tab" data-toggle="tab" href="#loanInfomation" role="tab" aria-controls="loanInfomation" aria-selected="true">Khoản vay</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="userInfomation-tab" data-toggle="tab" href="#userInfomation" role="tab" aria-controls="userInfomation" aria-selected="false">Cá nhân</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="shoolInfomation-tab" data-toggle="tab" href="#shoolInfomation" role="tab" aria-controls="shoolInfomation" aria-selected="false">Cơ sở đào tạo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="jobInfomation-tab" data-toggle="tab" href="#jobInfomation" role="tab" aria-controls="jobInfomation" aria-selected="false">Việc làm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="optionInfomation-tab" data-toggle="tab" href="#optionInfomation" role="tab" aria-controls="optionInfomation" aria-selected="false">Các tùy chọn</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="comfirmInfomation-tab" data-toggle="tab" href="#comfirmInfomation" role="tab" aria-controls="comfirmInfomation" aria-selected="false">Điều khoản</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="loanInfomation" role="tabpanel" aria-labelledby="loanInfomation-tab">
                <table class="customTable">
                    <tbody>
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
                                @foreach($hs->bank as $value)
                                    <span class="font-weight-bold">
                                        {{ $value->nn_ten }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="userInfomation" role="tabpanel" aria-labelledby="userInfomation-tab">
                <table class="customTable">
                    <tbody>
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
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="shoolInfomation" role="tabpanel" aria-labelledby="shoolInfomation-tab">
                <table class="customTable">
                    <tbody>
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
                        <tr>
                            <td>
                                <span>Bảng điểm</span>
                            </td>
                            <td class="block-image">
                                @if(isset($hs->imgPointAr))
                                    @foreach($hs->imgPointAr as $imgPoint)
                                    <a data-fancybox="gallery" href='{{ asset($imgPoint)  }}'>
                                        <img class="img-fluid" src='{{ asset($imgPoint)  }}' alt="">
                                    </a>
                                    @endforeach
                                @else
                                    <span class="text-tab-2-span">Không có thông tin</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Câu lạc bộ, đoàn thể của trường</span>
                            </td>
                            <td>
                                @if($hs->option == "1")
                                    @foreach($hs->nameClub as $nameClub)
                                    <span class="text-block">{{ $nameClub }}</span>
                                    @endforeach
                                @else
                                    <span class="text-block">Không có thông tin</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="jobInfomation" role="tabpanel" aria-labelledby="jobInfomation-tab">
                <table class="customTable">
                    <tbody>
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
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="optionInfomation" role="tabpanel" aria-labelledby="optionInfomation-tab">
                <p class="text-title">Thông tin người bảo trợ</p>
                @if(isset($hs->parents) && $hs->parents != null)
                    @for($k = 0; $k < count($hs->parents); $k++)    
                    <table class="customTable">
                        <tbody>
                            <tr class="header-title">
                                <td>
                                    <span>Người thứ</span>
                                </td>
                                <td>
                                    <span>{{ $k + 1 }}</span>
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
                        </tbody>
                    </table>
                    @endfor
                @endif

                @if($hs->pageObject != null)
                    <p class="text-title">Thông tin một số giấy tờ khác</p>
                    <?php $j = 1; ?>
                    @foreach($hs->pageObject as $pageObject)
                        <table class="customTable">
                            <tbody>
                                <tr class="header-title">
                                    <td>
                                        <span>Giấy tờ thứ</span>
                                    </td>
                                    <td>
                                        <span>{{ $j }}</span>
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
                                    <td class="block-image">
                                        @foreach($pageObject['arrayImg'] as $img)
                                        <a data-fancybox="gallery" href='{{ asset($img)  }}'>
                                            <img class="img-fluid" src='{{ asset($img)  }}' alt="">
                                        </a>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php $j++; ?>
                    @endforeach
                @endif
                @if(isset($hs->contentTag) && $hs->contentTag != null)
                    <p class="text-title">Các chủ để mà bạn quan tâm</p>
                    <table class="customTable">
                        <tbody>
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
                                    <span class="text-tab-2-span div_drop">
                                        @foreach($array as $ar)
                                            <a class="ui tag label">{{ $ar }}</a>
                                        @endforeach
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="tab-pane fade" id="comfirmInfomation" role="tabpanel" aria-labelledby="comfirmInfomation-tab">
                <table class="customTable">
                    <tbody>
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
                            <td>{{ $hs->opinion }}</td>              
                        </tr>
                        <tr>
                            <td>
                                <span>Số đánh giá</span>
                            </td>
                            <td class="flex-row">
                                <span>{{ $hs->star_votes }}</span> 
                                <i class="fas fa-star text-warning"></i>
                            </td>              
                        </tr>
                        <tr>
                            <td>
                                <span>Điều khoản</span>
                            </td>
                            <td class="flex-row">
                                @if($hs->pagepresent == "done")
                                    <i class="fas fa-check-circle text-success mr-2"></i>
                                    <span class="text-success">Đã chấp nhận điều khoản sử dụng</span>
                                @else
                                    <i class="fas fa-times-circle text-danger mr-2"></i>
                                    <span class="text-danger">
                                        Chưa chấp nhận điều khoản sử dụng
                                    </span> 
                                @endif
                            </td>              
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <form action="{{ route('school.feetbackLoan',$hs->_id) }}" method="post">
            @csrf
            <!-- <div class="guide">
                <p class="font-weight-bold m-0">Gợi ý</p>
                <i class="fas fa-sort-down down-sample-answer"></i>
            </div>
            <div class="sample-answer">
                <div class="block-sample-success">
                    <p class="sample sample-success">Chúng tôi xác định bạn là sinh viên của nhà trường!</p>
                </div>
                <div class="block-sample-danger">
                    <p class="sample sample-danger">Bạn không phải là sinh viên của nhà trường!</p>
                    <p class="sample sample-danger">Thông tin bạn gửi không đủ để xác minh thông tin</p>
                    <p class="sample sample-danger">Kết quả học tập của bạn không đảm bảo</p>
                </div>
            </div> -->
            <div class="handle">
                <p class="font-weight-bold text-center">Thông báo tới sinh viên</p>
                <textarea name="feedbackContent" required="" placeholder="Nhập thông báo" class="feedback-content form-control"></textarea>
            </div>
            <input type="text" hidden="" class="status-feedback" name="statusFeedback">
            <input type="submit" hidden="" class="auto-submit-form">
        </form>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-success btn-success-feetback">Chấp thuận</button>
            <button type="button" class="btn btn-danger btn-success-refuse">Từ chối</button>
      </div>
    </div>
