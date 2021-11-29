<hr class="info-hoso">
<div class="block-bank info-hoso">
    <div class="infomation-content">
        <div class="block-name-uni block-title">
            <div class="block-name-uni-left">
                <p class="text-uppercase">
                    Thông tin ngân hàng bạn gửi hồ sơ
                    <small class="text-lowercase text-danger font-italic">
                        (bắt buộc)
                    </small>
                </p>
            </div>
            <div class="hide-block-icon hide-block-yourbank">
                <i class="fas fa-caret-down"></i>
            </div>
        </div>
        @foreach($bank as $value)
            <div class="block-bank-infor">
                <table>
                    <tr class="table-header">
                        <td>
                            <span>Tên ngân hàng</span>
                        </td>
                        <td>
                            <span>{{ $value->nn_ten }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Địa chỉ trụ sở chính</span>
                        </td>
                        <td>
                            <span>{{ $value->nn_diachi }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Email</span>
                        </td>
                        <td>
                            <span>{{ $value->nn_email }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Lãi suất</span>
                        </td>
                        <td>
                            <span></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Vay tối đa</span>
                        </td>
                        <td>
                            <span></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Khả năng thành công</span>
                        </td>
                        <td>
                            <span></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Thông tin</span>
                        </td>
                        <td>
                            <span>{{ $value->nn_thongtin }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Chính sách</span>
                        </td>
                        <td>
                            <span>{{ $value->nn_chinhsach }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Hoạt động</span>
                        </td>
                        <td>
                            <span>{{ $value->nn_hoatdong }} </span>
                        </td>
                    </tr>
                </table>
            </div>
        @endforeach
    </div>
</div>

<hr class="info-hoso">

<div class="block-yourloan-info info-hoso">
    <div class="infomation-content">
        <div class="block-name-uni block-title">
            <div class="block-name-uni-left">
                <p class="text-uppercase">
                    Thông tin khoản vay của bạn
                    <small class="text-lowercase text-danger font-italic">
                        (bắt buộc)
                    </small>
                </p>
            </div>
            <div class="hide-block-icon hide-block-yourloan">
                <i class="fas fa-caret-down"></i>
            </div>
        </div>
        <div class="block-loan-infor">
            <table>
                <tr>
                    <td>
                        <span>Số tiền bạn yêu cầu</span>
                    </td>
                    <td>
                        <span>{{ number_format($hsk_money) }} VNĐ</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Lý do vay</span>
                    </td>
                    <td>
                        @if($hsk_purpose == "1")
                            <span>Chi trả học phí</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Khai báo kì hạn</span>
                    </td>
                    <td>
                        @if($hsk_duration == "1")
                            <span>3 tháng</span>
                        @elseif($hsk_duration == "2")
                            <span>6 tháng</span>
                        @elseif($hsk_duration == "3")
                            <span>12 tháng</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Cơ sở đào tạo bạn nộp hồ sơ</span>
                    </td>
                    <td>
                        <span>{{ $chooseSchool }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Thông tin bản điểm</span>
                    </td>
                    <td>
                        @foreach($imgPointAr as $value)
                            <a data-fancybox="gallery" href="{{ asset($value) }}">
                                <img class="img-fluid" src="{{ asset($value) }}" alt="">
                            </a>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Các tùy chọn khác</span>
                    </td>
                    <td>
                        @if($option == "1")
                            <span>Có</span>
                        @elseif($option == "2")
                            <span>Không</span>
                        @endif
                    </td>
                </tr>
                @if($option == "1")
                    <tr>
                        <td>
                            <span>Câu lạc bộ, đoàn thể đã tham gia</span>
                        </td>
                        <td>
                            @if($club == "1")
                                <span>Có tham gia</span>
                            @elseif($club == "2")
                                <span>Không tham gia</span>
                            @endif
                        </td>
                    </tr>
                @endif
                @if($option == "1" && $club == "1")
                    <tr>
                        <td>
                            <span>Tên các câu lạc bộ, đoàn thể đã tham gia</span>
                        </td>
                        <td>
                            @foreach($nameClub as $value)
                                <span>{{ $value }}</span>
                            @endforeach
                        </td>
                    </tr>
                @endif
                @if($option == "1" && $pageObject != null)
                    <tr>
                        <td>
                            <span>Các giấy tờ khác</span>
                        </td>
                        <td>
                            @foreach($pageObject as $value)
                                <div class="block-pageObject">
                                    <p class="block-pageObject-title">{{ $value['title'] }}</p>
                                    <div class="block-pageObject-content">
                                        @foreach($value['arrayImg'] as $arr)
                                        <a data-fancybox="gallery" href="{{ asset($arr) }}">
                                            <img class="img-fluid" src="{{ asset($arr) }}" alt="">
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                @endif
                @if($option == "1" && $contentTag != null)
                    <tr>
                        <td>
                            <span>Các chủ điểm bạn quan tâm</span>
                        </td>
                        <td>
                            @foreach($contentTag as $value)
                                <span>{{ $value }}</span>
                            @endforeach
                        </td>
                    </tr>
                @endif
                <tr>
                    <td>
                        <span>Kênh thông báo</span>
                    </td>
                    <td>
                        @if($portal == "1")
                            <span>Nhận qua Email</span>
                        @elseif($portal == "2")
                            <span>Nhận qua Số điện thoại</span>
                        @elseif($portal == "3")
                            <span>Nhận qua cả email và số điện thoại</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Ý kiến đóng góp</span>
                    </td>
                    <td>
                        <span>{{ $opinion }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Đánh giá hệ thống</span>
                    </td>
                    <td>
                        <span>
                            {{ $star_votes }}
                            <i class="fas fa-star text-warning"></i>
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="info-hoso mt-4" style="text-align: center;">
    <button class="btn-submit-loanRequest btn btn-primary">
        Xác nhận gửi!
    </button>
</div>