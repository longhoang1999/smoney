<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalRequiredInfoLabel">
                <div class="success-title">
                    <span>Thông tin khoản vay của bạn</span>
                </div>
                <div class="modal-head-btn">
                    <button class="btn btn-warning btn-refress">Làm mới</button>
                    <a href="{{ route('student.information') }}" target="_blank" class="btn btn-info">Chỉnh sửa thông tin cá nhân</a>
                </div>
            </h5>   
        </div>
        <div class="modal-body">
            <h5 class="text-primary modal-title-heading">Hãy đảm bảo thông tin cá nhân của bạn đầy đủ trước khi thực hiện yêu cầu vay !!</h5>

            @if($name == null || $phone == null || $cccd == null || $gender == null || $addressString == null || $email == null || $ngaysinh == null || $sotk == null || $addressNowString == null || $university == null || $yourjob == null)
                <div class="mb-4 modal-title-comfirm">
                    <p class="m-0 text-info">Bạn nhập thiếu thông tin, hãy click nút <span class="text-primary">"Chỉnh sửa"</span> phía trên để bổ sung thông tin cá nhân của bạn</p>
                    <p class="mb-1 text-info">Các trường thông tin bị thiếu</p>
                    <div class="empty-infor">
                        @if($name == null) 
                            <p class="m-0 text-danger">* Tên sinh viên</p>
                        @endif
                        @if($phone == null) 
                            <p class="m-0 text-danger">* Số điện thoại sinh viên</p>
                        @endif
                        @if($cccd == null) 
                            <p class="m-0 text-danger">* Số căn cước công dân sinh viên</p>
                        @endif
                        @if($gender == null) 
                            <p class="m-0 text-danger">* Giới tính sinh viên</p>
                        @endif
                        @if($addressString == null) 
                            <p class="m-0 text-danger">* Địa chỉ thường chú sinh viên</p>
                        @endif
                        @if($email == null) 
                            <p class="m-0 text-danger">* Email sinh viên</p>
                        @endif
                        @if($ngaysinh == null) 
                            <p class="m-0 text-danger">* Ngày tháng năm sinh của sinh viên</p>
                        @endif
                        @if($sotk == null) 
                            <p class="m-0 text-danger">* Số tài khoản của sinh viên</p>
                        @endif
                        @if($addressNowString == null) 
                            <p class="m-0 text-danger">* Nơi ở hiện tại của sinh viên</p>
                        @endif
                        @if($university == null) 
                            <p class="m-0 text-danger">* Thông tin về cơ sở đào tạo của sinh viên</p>
                        @endif
                        @if($yourjob == null) 
                            <p class="m-0 text-danger">* Thông tin về tình trạng việc làm của sinh viên</p>
                        @endif
                    </div>
                </div>
            @else
                <div class="mb-4 modal-title-comfirm">
                    <p class="mb-1 text-success">Các trường thông tin của bạn đã đủ. Bạn có thể yêu cầu khoản vay của mình</p>
                </div>
            @endif
            <div class="block-info">
                <div class="block-title">
                     <p class="font-weight-bold text-uppercase">
                        <span>Thông tin cá nhân</span>
                        <span class="text-lowercase text-danger font-italic">(bắt buộc)</span>
                    </p>
                    <div class="hide-block-icon hide-block-info">
                        <i class="fas fa-caret-down"></i>
                    </div>
                </div>
                <div class="block-info-content block-personal-infor">
                    <div class="block-info-left container">
                        <div class="row">
                            <!-- Họ và tên -->
                            <div class="col-md-4">
                                <p>Họ và tên: </p>
                            </div>
                            <div class="col-md-8">
                                <p class="font-weight-bold">{{ $name }}</p>
                            </div>
                            <!-- Số căn cước công dân -->
                            <div class="col-md-4">
                                <p>Số điện thoại: </p>
                            </div>
                            <div class="col-md-8">
                                <p class="font-weight-bold">{{ $phone }}</p>
                            </div>
                            <!-- Số căn cước công dân -->
                            <div class="col-md-4">
                                <p>Số căn cước công dân: </p>
                            </div>
                            <div class="col-md-8">
                                <p class="font-weight-bold">{{ $cccd }}</p>
                            </div>
                            <!-- Giới tính -->
                            <div class="col-md-4">
                                <p>Giới tính: </p>
                            </div>
                            <div class="col-md-8">
                                <p class="font-weight-bold">{{ $gender }}</p>
                            </div>
                            <!-- Địa chỉ thường chú -->
                            <div class="col-md-4">
                                <p>Địa chỉ thường chú: </p>
                            </div>
                            <div class="col-md-8">
                                <p class="font-weight-bold">{{ $addressString }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="block-info-right container">
                        <div class="row">
                            <!-- Email -->
                            <div class="col-md-4">
                                <p>Email: </p>
                            </div>
                            <div class="col-md-8">
                                <p class="font-weight-bold">{{ $email }}</p>
                            </div>
                            <!-- Ngày sinh -->
                            <div class="col-md-4">
                                <p>Ngày sinh: </p>
                            </div>
                            <div class="col-md-8">
                                <p class="font-weight-bold">{{ date("d/m/Y", strtotime($ngaysinh)) }}</p>
                            </div>
                            <!-- Số tài khoản -->
                            <div class="col-md-4">
                                <p>Số tài khoản: </p>
                            </div>
                            <div class="col-md-8">
                                @if($sotk != null)
                                    @foreach($sotk as $value)
                                        <p class="font-weight-bold m-0">{{ $value }}</p>
                                    @endforeach
                                @else
                                    <p class="font-weight-bold m-0">Trống</p>
                                @endif
                            </div>
                            <!-- Số tài khoản -->
                            <div class="col-md-4">
                                <p>Số điện thoại khác: </p>
                            </div>
                            <div class="col-md-8">
                                @if($otherSdt != null)
                                    @foreach($otherSdt as $value)
                                        <p class="font-weight-bold m-0">{{ $value }}</p>
                                    @endforeach
                                @else
                                    <p class="font-weight-bold m-0">Trống</p>
                                @endif
                            </div>
                            <!-- Nơi ở hiện tại -->
                            <div class="col-md-4">
                                <p>Nơi ở hiện tại: </p>
                            </div>
                            <div class="col-md-8">
                                <p class="font-weight-bold">{{ $addressNowString }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="block-uni">
                <div class="block-title">
                    <p class="font-weight-bold text-uppercase">
                        <span class="title-modal-Choseuni">Thông tin cơ sở đào tạo</span>
                        <span class="text-lowercase text-danger font-italic">(bắt buộc)</span>
                    </p>
                    <div class="hide-block-icon hide-block-uni">
                        <i class="fas fa-caret-down"></i>
                    </div>
                </div>
                @if($university != null)
                @foreach($university as $value)
                    <div class="block-info-content block-school-infor" data-id="{{ $value['id'] }}">
                        <div class="block-info-left container">
                            <div class="row">
                                <!-- Tên cơ sở -->
                                <div class="col-md-4">
                                    <p>Tên cơ sở: </p>
                                </div>
                                <div class="col-md-8">
                                    <p class="font-weight-bold">{{ $value['name'] }}</p>
                                </div>
                                <!-- Chuyên ngành -->
                                <div class="col-md-4">
                                    <p>Chuyên ngành: </p>
                                </div>
                                <div class="col-md-8">
                                    <p class="font-weight-bold">{{ $value['specialized'] }}</p>
                                </div>
                                <!-- Loại chương trình đào tạo: -->
                                <div class="col-md-4">
                                    <p>Loại chương trình đào tạo: </p>
                                </div>
                                <div class="col-md-8">
                                    <p class="font-weight-bold">{{ $value['typeProgram'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="block-info-right container">
                            <div class="row">
                                <!-- Mã sinh viên -->
                                <div class="col-md-4">
                                    <p>Mã sinh viên: </p>
                                </div>
                                <div class="col-md-8">
                                    <p class="font-weight-bold">{{ $value['studentCode'] }}</p>
                                </div>
                                <!-- Mã sinh viên -->
                                <div class="col-md-4">
                                    <p>Lớp hành chính: </p>
                                </div>
                                <div class="col-md-8">
                                    <p class="font-weight-bold">{{ $value['nameClass'] }}</p>
                                </div>
                                <!-- Email sinh viên do trường cung cấp: -->
                                <div class="col-md-4">
                                    <p>Email sinh viên do trường cung cấp: </p>
                                </div>
                                <div class="col-md-8">
                                    @if($value['emailStudent'] != null)
                                        <p class="font-weight-bold">{{ $value['emailStudent'] }}</p>
                                    @else
                                        <p class="font-weight-bold">Trống</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                    <div class="block-info-content">
                        <span class="font-italic">============ Bạn chưa khai báo thông tin về cơ sở đào tạo mà bạn theo học ============</span>
                    </div>
                @endif
            </div>
            <hr>
            <div class="block-perant">
                <div class="block-title">
                    <p class="font-weight-bold text-uppercase">
                        <span>Thông tin người bảo trợ</span>
                        <span class="text-lowercase text-info font-italic">(Không bắt buộc)</span>
                    </p>
                    <div class="hide-block-icon hide-block-parents">
                        <i class="fas fa-caret-down"></i>
                    </div>
                </div>
                @if($parents != null)
                @for($i = 0; $i < count($parents); $i++)
                    <div class="block-info-content block-parent-infor">
                        <div class="block-info-left container">
                            <div class="row">
                                <!-- Họ tên -->
                                <div class="col-md-4">
                                    <p>Họ tên: </p>
                                </div>
                                <div class="col-md-8">
                                    <p class="font-weight-bold">{{  $parents[$i]["fullname"] }}</p>
                                </div>
                                <!-- Số căn cước công dân -->
                                <div class="col-md-4">
                                    <p>Số căn cước công dân: </p>
                                </div>
                                <div class="col-md-8">
                                    <p class="font-weight-bold">{{ $parents[$i]["cccd"] }}</p>
                                </div>
                                <!-- Số tài khoản -->
                                <div class="col-md-4">
                                    <p>Số tài khoản: </p>
                                </div>
                                <div class="col-md-8">
                                    <p class="font-weight-bold">{{ $parents[$i]["stk"] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="block-info-right container">
                            <div class="row">
                                <!-- Số điện thoại -->
                                <div class="col-md-4">
                                    <p>Số điện thoại: </p>
                                </div>
                                <div class="col-md-8">
                                    <p class="font-weight-bold">{{ $parents[$i]["phone"] }}</p>
                                </div>
                                <!-- Giới tinh -->
                                <div class="col-md-4">
                                    <p>Giới tinh: </p>
                                </div>
                                <div class="col-md-8">
                                    <p class="font-weight-bold">{{ $parents[$i]["gender"] }}</p>
                                </div>
                                <!-- Quan hệ với sinh viên -->
                                <div class="col-md-4">
                                    <p>Quan hệ với sinh viên: </p>
                                </div>
                                <div class="col-md-8">
                                    <p class="font-weight-bold">{{ $parents[$i]["relationship"] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
                @else
                    <div class="block-info-content">
                        <span class="font-italic">============ Bạn chưa khai báo thông tin về người bảo trợ của bạn ============</span>
                    </div>
                @endif
            </div>
            <hr>
            <div class="block-perant">
                <div class="block-title">
                    <p class="font-weight-bold text-uppercase">
                        <span>Thông tin việc làm của bạn</span>
                        <span class="text-lowercase text-danger font-italic">(bắt buộc)</span>
                    </p>
                    <div class="hide-block-icon hide-block-yourjob">
                        <i class="fas fa-caret-down"></i>
                    </div>
                </div>
                @if($yourjob != null)
                    <div class="block-info-content block-job-infor">
                        <div class="block-info-left container">
                            <div class="row">
                                <!-- Tình trạng việc làm của bạn -->
                                <div class="col-md-4">
                                    <p>Tình trạng việc làm của bạn: </p>
                                </div>
                                <div class="col-md-8">
                                    <p class="font-weight-bold">
                                        @if($yourjob['jobstatus'] == "1")
                                            Đang đi làm thuê
                                        @elseif($yourjob['jobstatus'] == "2")
                                            Tự kinh doanh
                                        @elseif($yourjob['jobstatus'] == "3")
                                            Không đi làm
                                        @endif
                                    </p>
                                </div>
                                <!-- Tên cơ sở bạn làm việc -->
                                <div class="col-md-4">
                                    <p>Tên cơ sở bạn làm việc: </p>
                                </div>
                                <div class="col-md-8">
                                    @if($yourjob['jobstatus'] != "3")
                                        <p class="font-weight-bold">{{ $yourjob['nameCompany'] }}</p>
                                    @else
                                        <p class="font-weight-bold">Trống - do bạn không đi làm</p>
                                    @endif
                                </div>
                                <!-- Mức lương trung bình của bạn -->
                                <div class="col-md-4">
                                    <p>Mức lương trung bình của bạn: </p>
                                </div>
                                <div class="col-md-8">
                                    @if($yourjob['jobstatus'] != "3")
                                        <p class="font-weight-bold">{{ number_format($yourjob['money']) }} VNĐ</p>
                                    @else
                                        <p class="font-weight-bold">Trống - do bạn không đi làm</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="block-info-right container">
                            <div class="row">
                                <!-- Thời gian bạn làm việc -->
                                <div class="col-md-4">
                                    <p>Thời gian bạn làm việc: </p>
                                </div>
                                <div class="col-md-8">
                                    @if($yourjob['jobstatus'] != "3")
                                        @if($yourjob['timeJob']  == "1")
                                            <p class="font-weight-bold">Fulltime</p>
                                        @elseif($yourjob['timeJob']  == "2")
                                            <p class="font-weight-bold">Parttime</p>
                                        @elseif($yourjob['timeJob']  == "3")
                                            <p class="font-weight-bold">Fieldtrip</p>
                                        @endif
                                    @else
                                        <p class="font-weight-bold">Trống - do bạn không đi làm</p>
                                    @endif
                                </div>
                                <!-- Địa chỉ nơi bạn làm việc -->
                                <div class="col-md-4">
                                    <p>Địa chỉ nơi bạn làm việc: </p>
                                </div>
                                <div class="col-md-8">
                                    @if($yourjob['jobstatus'] != "3")
                                        <p class="font-weight-bold">{{ $yourjob['addressCompany'] }}</p>
                                    @else
                                        <p class="font-weight-bold">Trống - do bạn không đi làm</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="block-info-content">
                        <span class="font-italic fz-14">=============Bạn chưa cập nhật nội dung việc làm với hệ thống==============</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    @if($name != null && $phone != null && $cccd != null && $gender != null && $addressString != null && $email != null && $ngaysinh != null && $sotk != null && $addressNowString != null && $university != null && $yourjob != null)
        $("#modalRequiredInfo .modal-header").append('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
    @else
        $("#modalRequiredInfo .modal-header button.close").remove();
    @endif
</script>