<hr class="info-hoso">
<div class="block-perant info-hoso">
    <div class="block-title">
        <p class="font-weight-bold text-uppercase">
            <span>Thông tin ngân hàng bạn gửi hồ sơ</span>
            <span class="text-lowercase text-danger font-italic">(bắt buộc)</span>
        </p>
        <div class="hide-block-icon hide-block-yourbank">
            <i class="fas fa-caret-down"></i>
        </div>
    </div>
    @foreach($bank as $value)
    <div class="block-info-content block-bank-infor">
        <div class="block-info-left container">
            <div class="row">
                <!-- Tên ngân hàng -->
                <div class="col-md-4">
                    <p>Tên ngân hàng: </p>
                </div>
                <div class="col-md-8">
                    <p class="font-weight-bold">
                        {{ $value->nn_ten }}
                    </p>
                </div>
                <!-- Địa chỉ trụ sở chính -->
                <div class="col-md-4">
                    <p>Địa chỉ trụ sở chính: </p>
                </div>
                <div class="col-md-8">
                    <p class="font-weight-bold">
                        {{ $value->nn_diachi }}
                    </p>
                </div>
                <!-- Địa chỉ trụ sở chính -->
                <div class="col-md-4">
                    <p>Email: </p>
                </div>
                <div class="col-md-8">
                    <p class="font-weight-bold">
                        {{ $value->nn_email }}
                    </p>
                </div>
                <!-- Lãi suất -->
                <div class="col-md-4">
                    <p>Lãi suất: </p>
                </div>
                <div class="col-md-8">
                    <p class="font-weight-bold">
                        
                    </p>
                </div>
                <!-- Vay tối đa -->
                <div class="col-md-4">
                    <p>Vay tối đa: </p>
                </div>
                <div class="col-md-8">
                    <p class="font-weight-bold">
                        
                    </p>
                </div>
            </div>
        </div>
        <div class="block-info-right container">
            <div class="row">
                <!-- Khả năng thành công -->
                <div class="col-md-4">
                    <p>Khả năng thành công: </p>
                </div>
                <div class="col-md-8">
                    <p class="font-weight-bold">
                        
                    </p>
                </div>
                <!-- Thông tin -->
                <div class="col-md-4">
                    <p>Thông tin: </p>
                </div>
                <div class="col-md-8">
                    <p class="font-weight-bold">
                        {{ $value->nn_thongtin }} 
                    </p>
                </div>
                <!-- Chính sách -->
                <div class="col-md-4">
                    <p>Chính sách: </p>
                </div>
                <div class="col-md-8">
                    <p class="font-weight-bold">
                        {{ $value->nn_chinhsach }} 
                    </p>
                </div>
                <!-- Hoạt động -->
                <div class="col-md-4">
                    <p>Hoạt động: </p>
                </div>
                <div class="col-md-8">
                    <p class="font-weight-bold">
                        {{ $value->nn_hoatdong }} 
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<hr class="info-hoso">
<div class="block-perant info-hoso">
    <div class="block-title">
        <p class="font-weight-bold text-uppercase">
            <span>Thông tin khoản vay của bạn</span>
            <span class="text-lowercase text-danger font-italic">(bắt buộc)</span>
        </p>
        <div class="hide-block-icon hide-block-yourloan">
            <i class="fas fa-caret-down"></i>
        </div>
    </div>
    <div class="block-info-content block-loan-infor">
        <div class="block-info-left container">
            <div class="row">
                <!-- Số tiền bạn yêu cầu -->
                <div class="col-md-4">
                    <p>Số tiền bạn yêu cầu: </p>
                </div>
                <div class="col-md-8">
                    <p class="font-weight-bold">
                        {{ number_format($hsk_money) }} VNĐ
                    </p>
                </div>
                <!-- Lý do vay -->
                <div class="col-md-4">
                    <p>Lý do vay: </p>
                </div>
                <div class="col-md-8">
                    @if($hsk_purpose == "1")
                        <p class="font-weight-bold">Chi trả học phí</p>
                    @endif
                </div>
                <!-- Khai báo kì hạn -->
                <div class="col-md-4">
                    <p>Khai báo kì hạn: </p>
                </div>
                <div class="col-md-8">
                    @if($hsk_duration == "1")
                        <p class="font-weight-bold">3 tháng</p>
                    @elseif($hsk_duration == "2")
                        <p class="font-weight-bold">6 tháng</p>
                    @elseif($hsk_duration == "3")
                        <p class="font-weight-bold">12 tháng</p>
                    @endif
                </div>
                <!-- Cơ sở đào tạo bạn nộp hồ sơ -->
                <div class="col-md-4">
                    <p>Cơ sở đào tạo bạn nộp hồ sơ: </p>
                </div>
                <div class="col-md-8">
                    <p class="font-weight-bold">{{ $chooseSchool }}</p>
                </div>
                <!-- Thông tin bản điểm -->
                <div class="col-md-4">
                    <p>Thông tin bản điểm: </p>
                </div>
                <div class="col-md-8">
                    @foreach($imgPointAr as $value)
                        <a data-fancybox="gallery" href="{{ asset($value) }}">
                            <img class="img-fluid" src="{{ asset($value) }}" alt="">
                        </a>
                    @endforeach
                </div>
                <!-- Các tùy chọn khác -->
                <div class="col-md-4">
                    <p>Các tùy chọn khác: </p>
                </div>
                <div class="col-md-8">
                    @if($option == "1")
                        <p class="font-weight-bold">Có</p>
                    @elseif($option == "2")
                        <p class="font-weight-bold">Không</p>
                    @endif
                </div>

                @if($option == "1")
                    <!-- Tham gia câu lạc bộ, đoàn thể -->
                    <div class="col-md-4">
                        <p>Tham gia câu lạc bộ, đoàn thể: </p>
                    </div>
                    <div class="col-md-8">
                        @if($club == "1")
                            <p class="font-weight-bold">Có tham gia</p>
                        @elseif($club == "2")
                            <p class="font-weight-bold">Không tham gia</p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        <div class="block-info-right container">
            <div class="row">
                @if($option == "1" && $club == "1")
                    <!-- Tham gia câu lạc bộ -->
                    <div class="col-md-4">
                        <p>Tên các câu lạc bộ, đoàn thể tham gia: </p>
                    </div>
                    <div class="col-md-8">
                        @foreach($nameClub as $value)
                            <p class="font-weight-bold m-0">{{ $value }}</p>
                        @endforeach
                    </div>
                @endif

                @if($option == "1")
                    <!-- Các giấy tờ khác -->
                    <div class="col-md-4">
                        <p>Các giấy tờ khác: </p>
                    </div>
                    <div class="col-md-8">
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
                    </div>
                @endif

                @if($option == "1")
                    <!-- Tag -->
                    <div class="col-md-4">
                        <p>Các chủ điểm bạn quan tâm: </p>
                    </div>
                    <div class="col-md-8">
                        @foreach($contentTag as $value)
                            <p class="font-weight-bold">{{ $value }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Tag -->
                <div class="col-md-4">
                    <p>Kênh thông báo: </p>
                </div>
                <div class="col-md-8">
                    @if($portal == "1")
                        <p class="font-weight-bold">Nhận qua Email</p>
                    @elseif($portal == "2")
                        <p class="font-weight-bold">Nhận qua Số điện thoại</p>
                    @elseif($portal == "3")
                        <p class="font-weight-bold">Nhận qua cả email và số điện thoại</p>
                    @endif
                </div>

                <!-- Ý kiến đóng góp -->
                <div class="col-md-4">
                    <p>Ý kiến đóng góp: </p>
                </div>
                <div class="col-md-8">
                    <p class="font-weight-bold">{{ $opinion }}</p>
                </div>

                <!-- Đánh giá hệ thống -->
                <div class="col-md-4">
                    <p>Đánh giá hệ thống: </p>
                </div>
                <div class="col-md-8">
                    <p class="font-weight-bold">
                        {{ $star_votes }}
                        <i class="fas fa-star text-warning"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="info-hoso" style="text-align: center;">
    <button class="btn-submit-loanRequest btn btn-primary">
        Xác nhận gửi!
    </button>
</div>