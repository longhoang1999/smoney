<?php 
    use Illuminate\Support\Arr;

 ?>
<div class="modal-dialog modal-xl">
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

        <div class="btn-decision">
            <p>Bạn muốn chấp nhận hay không?</p>
            <div class="block-btn-decision">
                <button type="button" class="btn btn-success btn-success-feetback">Xác nhận</button>
                <button type="button" class="btn btn-danger btn-success-refuse">Từ chối</button>
            </div>
        </div>
        <div class="block-success">
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
                        <button type="button" class="btn btn-info">Gửi</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="block-refuse">
            <form action="{{ route('bank.refuseWaitLoan') }}" method="post" class="form-refuse">
                @csrf
                <input type="text" hidden="" value="{{ $hs->_id }}" name="idHS">
                <div class="block-refuse-left">
                    <label for="loan-reason">Lý do bạn từ chối khoản vay:</label>
                    <textarea id="loan-reason" class="form-control" placeholder="Nhập lý do" required="" name="loanReason"></textarea>
                </div>
                <div class="block-refuse-right">
                    <button type="submit" class="btn btn-info">Gửi</button>
                </div>
            </form>
        </div>

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