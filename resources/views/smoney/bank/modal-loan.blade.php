<?php 
    use Illuminate\Support\Arr;
 ?>

<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="modalLoan_1Label">
        Thông tin hồ sơ của sinh viên - Ngày gửi: {{ date("h:i A d-m-Y", strtotime($hs->created_at)) }}
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <p class="text-uppercase color-blue">Chi tiết yêu cầu vay</p>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="loanInfomation-tab" data-toggle="tab" href="#loanInfomation" role="tab" aria-controls="loanInfomation" aria-selected="true">Khoản vay</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="userInfomation-tab" data-toggle="tab" href="#userInfomation" role="tab" aria-controls="userInfomation" aria-selected="false">Cá nhân sinh viên</a>
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
                            <span>Kỳ hạn khai báo</span>
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

    <p class="text-uppercase color-blue">Thông tin cơ bản sinh viên</p>
    <div class="user-credit-score">
        <div class="user-credit-avatar mr-3">
            <a data-fancybox="gallery" href="{{ asset( $hs->avatar ) }}">
                <img src="{{ asset( $hs->avatar ) }}" alt="">
            </a>
        </div>
        <div class="user-credit-info">
            <table class="customTable">
                <tbody>
                    <tr>
                        <td>
                            <span>Họ và tên</span>
                        </td>
                        <td>
                            <span>{{ $hs->hoten }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Số CMT/CCCD</span>
                        </td>
                        <td>
                            <span>{{ $hs->cccd }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Số điện thoại</span>
                        </td>
                        <td>
                            <span>{{ $hs->sdt }}</span>
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
                </tbody>
            </table>
        </div>
    </div>

    <hr>
    <p class="text-uppercase color-blue">Các yêu cầu của sinh viên với ngân hàng</p>
    <div class="user-credit-score">
        <table class="customTable">
            <tbody>
                <tr>
                    <td>
                        <span>Số lần gửi yêu cầu vay tới ngân hàng</span>
                    </td>
                    <td>
                        <span>{{ $arrReuestStudent[1] }} lần</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Số lần vay thành công</span>
                    </td>
                    <td>
                        <span>{{ $arrReuestStudent[2] }} lần</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Số lần sinh viên hủy đề xuất</span>
                    </td>
                    <td>
                        <span>{{ $arrReuestStudent[3] }} lần</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Số lần ngân hàng từ chối</span>
                    </td>
                    <td>
                        <span>{{ $arrReuestStudent[4] }} lần</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <hr>
    <p class="text-uppercase color-blue">Thông tin khoản vay giữa ngân hàng với sinh viên</p>
    <div class="user-credit-score">
        <table class="customTable">
            <tbody>
                <tr>
                    <td>
                        <span>Số khoản vay đang lưu thông</span>
                    </td>
                    <td>
                        <span>{{ $arrReuestStudent[5] }} khoản</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Số khoản vay sắp hết hạn</span>
                    </td>
                    <td>
                        <span>{{ $arrReuestStudent[6] }} khoản</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Số khoản vay quá hạn</span>
                    </td>
                    <td>
                        <span>{{ $arrReuestStudent[7] }} khoản</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Số khoản vay đã thanh toán xong</span>
                    </td>
                    <td>
                        <span>{{ $arrReuestStudent[8] }} khoản</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <hr>
    <p class="text-uppercase color-blue">Thông tin khoản vay với các ngân hàng khác trên hệ thống</p>
    <div class="user-credit-score">
        <table class="customTable">
            <tbody>
                <tr>
                    <td>
                        <span>Số khoản vay đang vay tại các ngân hàng khác (chưa thanh toán)</span>
                    </td>
                    <td>
                        <span>{{ $arrReuestStudent[9] }} khoản</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="btn-decision">
        <p class="font-weight-bold text-danger">Bạn muốn chấp nhận hay không?</p>
        <div class="block-btn-decision">
            <button type="button" class="btn btn-success btn-success-feetback">Xác nhận</button>
            <button type="button" class="btn btn-danger btn-success-refuse">Từ chối</button>
        </div>
    </div>
    <div class="block-success style-block-success">
        <form action="{{ route('bank.passWaitLoan') }}" method="post" class="form-success">
            @csrf
            <input type="text" hidden="" value="{{ $hs->_id }}" name="idHS">
            <div class="container-fuild">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="">Số tiền ngân hàng muốn cho vay (VNĐ):</label>
                    </div>
                    <div class="col-md-12">
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
                                    <span class="money-from">5 triệu</span>
                                    <input type="range" step="50000" name="money">
                                    <span class="money-to">20 triệu</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="">Lãi xuất (%):</label>
                    </div>
                    <div class="col-md-8">
                        <input name="interestRate" type="number" step="0.1" placeholder="Lãi xuất(%) / tháng" required="">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="">Kì hạn (tháng):</label>
                    </div>
                    <div class="col-md-8">
                        <input name="loanMonth" type="number" step="1" required="" 
                            @if($hs->hsk_duration == '1')
                                value="3"
                            @elseif($hs->hsk_duration == '2')
                                value="6"
                            @elseif($hs->hsk_duration == '3')
                                value="12"
                            @endif
                        placeholder="Kỳ hạn trong (tháng)"> 
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="">Số tiền phải trả trong mỗi tháng (VNĐ):</label>
                    </div>
                    <div class="col-md-8 block-btn-math">
                        <input class="havePayAMonth" type="text" readonly="" placeholder="Trả mỗi tháng (tháng)">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="">Tổng số tiền trả cuối cùng (gốc + lãi) (VNĐ):</label>
                    </div>
                    <div class="col-md-8 block-btn-math">
                        <input class="allLoanFinally" type="text" readonly="" placeholder="Tổng tiền phải trả">
                        <button type="button" class="btn btn-warning btn-math ml-3">Tính</button>
                    </div>
                </div>
                <input type="text" hidden="" class="moneyPayAMonth" name="moneyPayAMonth" required="">
                <input type="text" hidden="" class="aMonthProfit" name="aMonthProfit" required="">
                <input type="submit" hidden="" class="btn-submit">
            </div>
        </form>
        <div class="btn-trigger container-fuild">
            <div class="row mb-3">
                <div class="col-md-4"></div>
                <div class="col-md-8 block-success-right">
                    <button type="button" class="btn btn-info pl-5 pr-5">Gửi</button>
                </div>
            </div>
        </div>
    </div>

    <div class="block-refuse style-block-refuse">
        <form action="{{ route('bank.refuseWaitLoan') }}" method="post" class="form-refuse">
            @csrf
            <input type="text" hidden="" value="{{ $hs->_id }}" name="idHS">
            <div class="block-refuse-left">
                <label for="loan-reason">Lý do bạn từ chối khoản vay:</label>
                <textarea id="loan-reason" class="form-control" placeholder="Nhập lý do" required="" name="loanReason"></textarea>
            </div>
            <div class="block-refuse-right">
                <button type="submit" class="btn btn-info pl-5 pr-5">Gửi</button>
            </div>
        </form>
    </div>

  </div>
</div>


<script type="text/javascript">
    // set up input range
    var min = 5000000;
    var max = 20000000;
    var cur = {{ $hs->hsk_money }};
    var rangeElement = document.querySelector("input[type='range']")
    $("input[type='range']").attr("min",min);
    $("input[type='range']").attr("max",max);
    $("input[type='range']").attr("value",cur);
    $(".show-money").html(asMoney(cur))
    $("input[type='range']").attr("style",generateBackground($("input[type='range']")));

    rangeElement.addEventListener('input', updateSlider)
    function asMoney(value) {
        return parseFloat(value)
          .toLocaleString('en-US', { maximumFractionDigits: 2 }) + '  VNĐ'
    }
    function generateBackground(rangeElement) {   
        if (rangeElement.val() === min) {
            return
        }
        let percentage =  (rangeElement.val() - min) / (max - min) * 100;
        return 'background: linear-gradient(to right, #50299c, #7a00ff ' + percentage + '%, #d3edff ' + percentage + '%, #dee1e2 100%)'
    }
    function updateSlider () {
        $(".show-money").html(asMoney($("input[type='range']").val()))
        $("input[type='range']").attr("style",generateBackground($("input[type='range']")));
    }

    $(".plus").click(function() {
        $("input[type='range']").val(parseInt($("input[type='range']").val()) + 50000)
        updateSlider()
    })
    $(".sub").click(function() {
        $("input[type='range']").val(parseInt($("input[type='range']").val()) - 50000)
        updateSlider()
    })
    // end set up input range
</script>