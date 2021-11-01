<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem chi tiết khoản vay</title>
    <link rel="stylesheet" href="{{ asset('fontawesome-free-5.14.0-web/css/all.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{ asset('img-smoney/smoney.png') }}">

    <link rel="stylesheet" href="{{ asset('css/Smoney/Homepage/footer.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/student.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/student2.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/studentLoan.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/applyloan_2.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/loaninfo.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/showprofile.css') }}">
</head>
<body>
    <?php 
        use Illuminate\Support\Arr;
        use Carbon\Carbon;
     ?>
    <div class="loan-header">
        Thông tin khoản vay
    </div>
    <div class="div-block mt-0">
        <div class="block-title">
            <p class="text-uppercase text-primary m-0">Thông tin khoản vay</p>
        </div>
        <div class="infomation-content">
            <div class="block-name-uni">
                <div class="block-name-uni-left">
                    <p>1. Thông tin khoản vay đã lưu thông</p>
                </div>
            </div>
            <table>
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
                        <span>Sinh viên trường</span>
                    </td>
                    <td>
                        <span>{{ $hs->uni['nt_ten'] }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Số tiền vay</span>
                    </td>
                    <td>
                        <span>
                            {{ number_format($hs->loanProposal[$hs->chooseBank]['money']) }} VNĐ
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Kì hạn</span>
                    </td>
                    <td>
                        <span>
                            {{ number_format($hs->loanProposal[$hs->chooseBank]['loanMonth']) }} tháng
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Lãi xuất</span>
                    </td>
                    <td>
                        <span>
                            {{ number_format($hs->loanProposal[$hs->chooseBank]['interestRate']) }} % / tháng
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Số tiền phải trả trong 1 tháng</span>
                    </td>
                    <td>
                        <span>
                            <?php 
                                $moneyPayAMonth = $hs->loanProposal[$hs->chooseBank]['moneyPayAMonth'];
                                $aMonthProfit = $hs->loanProposal[$hs->chooseBank]['aMonthProfit'];
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
                                $allLoanFinally 
                                    = round($sumMoney * 
                                        $hs->loanProposal[$hs->chooseBank]['loanMonth']);
                                echo number_format($allLoanFinally)." VNĐ";
                             ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Ngày có hiệu lực</span>
                    </td>
                    <td>
                        <span>
                            {{ date("d/m/Y H:i A", strtotime($hs->date_accept)) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Ngày hết hạn</span>
                    </td>
                    <td>
                        <span>
                            {{ date("d/m/Y H:i A", strtotime($hs->date_expired)) }}
                        </span>
                    </td>
                </tr>
                @if(isset($hs->dateOfPayment) && $hs->dateOfPayment != "")
                    <hr>
                    <tr>
                        <td>
                            <span>Ngày thanh toán</span>
                        </td>
                        <td>
                            <span>
                                {{ date("d/m/Y H:i A", strtotime($hs->dateOfPayment)) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Khoản vay đã trả</span>
                        </td>
                        <td>
                            <span>
                                {{ number_format($hs->totalMoney) }} VNĐ
                            </span>
                        </td>
                    </tr>
                    @if(isset($hs->moneyOutDate) && $hs->moneyOutDate != "")
                        <tr>
                            <td>
                                <span>Tiền phạt quá hạn (nếu có)</span>
                            </td>
                            <td>
                                <span>
                                    {{ number_format($hs->moneyOutDate) }} VNĐ
                                </span>
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td>
                            <span>Tổng tiền đã trả</span>
                        </td>
                        <td>
                            <span>
                                @if(isset($hs->moneyOutDate) && $hs->moneyOutDate != "")
                                    {{ number_format(intval($hs->totalMoney) 
                                        + intval($hs->moneyOutDate)) }} VNĐ
                                @else
                                    {{ number_format($hs->totalMoney) }} VNĐ
                                @endif
                            </span>
                        </td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
    <div class="div-block">
        <div class="block-title">
            <p class="text-uppercase text-primary m-0">Thông tin hồ sơ yêu cầu</p>
        </div>
        <div class="infomation-content">
            <div class="block-name-uni">
                <div class="block-name-uni-left">
                    <p>1. Thông tin khoản vay</p>
                </div>
            </div>
            <table>
                <tr>
                    <td>
                        <span>Ngày gửi</span>
                    </td>
                    <td>
                        <span>{{ date("d/m/Y h:i A", strtotime($hs->created_at)) }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Số tiền yêu cầu vay</span>
                    </td>
                    <td>
                        <span>{{ date("d/m/Y h:i A", strtotime($hs->created_at)) }}</span>
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
                        <span>{{ $hs->nameBank }}</span>
                    </td>
                </tr>
            </table>
        </div>
        <div class="infomation-content">
            <div class="block-name-uni">
                <div class="block-name-uni-left">
                    <p>2. Thông tin cá nhân</p>
                </div>
            </div>
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
                        @if($hs->otherSdt)                         
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
                    <td>{{ $hs->diachi }}</td>
                </tr>
                <tr>
                    <td>
                        <span>Địa chỉ tạm chú</span>
                    </td>
                    <td>{{ $hs->diachihientai }}</td>
                </tr>
            </table>
        </div>
        <div class="infomation-content">
            <div class="block-name-uni">
                <div class="block-name-uni-left">
                    <p>3. Thông tin cơ sở đào tạo</p>
                </div>
            </div>
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
                <tr>
                    <td>
                        <span>Bảng điểm</span>
                    </td>
                    <td>
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
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Câu lạc bộ, đoàn thể của trường bạn tham gia</span>
                    </td>
                    <td>
                        <div class="col-md-7 mb-3 pl-3 block-image">
                            @if($hs->option == "1")
                                @foreach($hs->nameClub as $nameClub)
                                <span class="text-block">{{ $nameClub }}</span>
                                @endforeach
                            @else
                                <span class="text-block">Không có thông tin</span>
                            @endif
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="infomation-content">
            <div class="block-name-uni">
                <div class="block-name-uni-left">
                    <p>4. Thông tin việc làm của bạn</p>
                </div>
            </div>
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
        <div class="infomation-content">
            <div class="block-name-uni">
                <div class="block-name-uni-left">
                    <p>5. Một số thông tin khác</p>
                </div>
            </div>
            <p class="text-title-child">Thông tin người bảo trợ</p>
            @if(isset($hs->parents) && $hs->parents != null)
                @for($k = 0; $k < count($hs->parents); $k++)  
                    <table>
                        <tr>
                            <td>
                                <span class="text-primary font-weight-bold">
                                    <u>Người thứ {{ $k + 1 }}</u>
                                </span>
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
                @endfor
            @endif

            @if($hs->pageObject != null)
            <p class="text-title-child">Thông tin một số giấy tờ khác</p>
                <?php $j = 1; ?>
                @foreach($hs->pageObject as $pageObject)
                    <table>
                        <tr>
                            <td>
                                <span class="text-primary font-weight-bold">
                                    <u>Giấy tờ thứ thứ {{ $j }}</u>
                                </span>
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
                    <?php $j++; ?>
                @endforeach 
            @endif

            @if(isset($hs->contentTag) && $hs->contentTag != null)
                <p class="text-title-child">Các chủ đề bạn quan tâm</p>
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
                            <span class="text-tab-2-span div_drop">
                                @foreach($array as $ar)
                                    <a class="ui tag label">{{ $ar }}</a>
                                @endforeach
                            </span>
                        </td>
                    </tr>
                </table>
            @endif
        </div>
        <div class="infomation-content">
            <div class="block-name-uni">
                <div class="block-name-uni-left">
                    <p>6. Thông tin các điều khoản</p>
                </div>
            </div>
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
                            {{ $hs->star_votes }} <i class="fas fa-star text-warning"></i>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Điều khoản</span>
                    </td>
                    <td>
                        @if($hs->pagepresent == "done")
                        <span class="text-success">
                            Đã chấp nhận điều khoản sử dụng
                        </span>
                        @else
                        <span class="text-success">
                            Chưa chấp nhận điều khoản sử dụng
                        </span> 
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>






















     <div class="modal fade" id="detailLoanNormal" tabindex="-1" role="dialog" aria-labelledby="detailLoanNormalLable" aria-hidden="true">
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
                            {{ $showString }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">Tổng số tiền bạn phải trả trong suốt kì hạn: </div>
                        <div class="col-md-6 font-weight-bold text-primary">
                            <?php 
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
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
</body>
</html>