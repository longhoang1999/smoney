<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalRequiredInfoLabel">
                <div class="success-title">
                    <span>Thông tin khoản vay của bạn</span>
                </div>
                <div class="modal-head-btn">
                    <button class="btn-refress">
                        <i class="fas fa-sync-alt"></i>
                        Làm mới
                    </button>
                    <a href="{{ route('student.information') }}" target="_blank" class="btn-fix-personal">
                        <i class="fas fa-pen"></i>
                        Chỉnh sửa thông tin cá nhân
                    </a>
                </div>
            </h5>   
        </div>

        <div class="modal-body">
            <div class="status-message">
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
            </div>

            <div class="block-info">
                <div class="infomation-content">
                    <div class="block-name-uni block-title">
                        <div class="block-name-uni-left">
                            <p class="text-uppercase">
                                Thông tin cá nhân
                                <small class="text-lowercase text-danger font-italic">
                                    (bắt buộc)
                                </small>
                            </p>
                        </div>
                        <div class="hide-block-icon hide-block-info">
                            <i class="fas fa-caret-down"></i>
                        </div>
                    </div>
                    <div class="block-personal-infor">
                        <table>
                            <tr>
                                <td>
                                    <span>Họ và tên</span>
                                </td>
                                <td>
                                    <span>{{ $name }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Số điện thoại</span>
                                </td>
                                <td>
                                    <span>{{ $phone }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Số căn cước công dân</span>
                                </td>
                                <td>
                                    <span>{{ $cccd }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Giới tính</span>
                                </td>
                                <td>
                                    <span>{{ $gender }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Địa chỉ thường chú</span>
                                </td>
                                <td>
                                    <span>{{ $addressString }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Email</span>
                                </td>
                                <td>
                                    <span>{{ $email }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Ngày sinh</span>
                                </td>
                                <td>
                                    <span>{{ date("d/m/Y", strtotime($ngaysinh)) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Số tài khoản</span>
                                </td>
                                <td>
                                    @if($sotk != null)
                                        @foreach($sotk as $value)
                                            <span>{{ $value }}</span>
                                        @endforeach
                                    @else
                                        <span>Trống</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Số điện thoại khác</span>
                                </td>
                                <td>
                                    @if($otherSdt != null)
                                        @foreach($otherSdt as $value)
                                            <span>{{ $value }}</span>
                                        @endforeach
                                    @else
                                        <span>Trống</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Nơi ở hiện tại</span>
                                </td>
                                <td>
                                    <span>{{ $addressNowString }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="block-uni">
                <div class="infomation-content">
                    <div class="block-name-uni block-title">
                        <div class="block-name-uni-left">
                            <p class="text-uppercase">
                                Thông tin cơ sở đào tạo
                                <small class="text-lowercase text-danger font-italic">
                                    (bắt buộc)
                                </small>
                            </p>
                        </div>
                        <div class="hide-block-icon hide-block-uni">
                            <i class="fas fa-caret-down"></i>
                        </div>
                    </div>
                    @if($university != null)
                    @foreach($university as $value)
                        <div class="block-school-infor" data-id="{{ $value['id'] }}">
                            <table>
                                <tr class="table-header">
                                    <td>
                                        <span>Tên cơ sở</span>
                                    </td>
                                    <td>
                                        <span>{{ $value['name'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Chuyên ngành</span>
                                    </td>
                                    <td>
                                        <span>{{ $value['specialized'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Loại chương trình đào tạo</span>
                                    </td>
                                    <td>
                                        <span>{{ $value['typeProgram'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Mã sinh viên</span>
                                    </td>
                                    <td>
                                        <span>{{ $value['studentCode'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Lớp hành chính</span>
                                    </td>
                                    <td>
                                        <span>{{ $value['nameClass'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Email sinh viên do trường cung cấp</span>
                                    </td>
                                    <td>
                                        @if($value['emailStudent'] != null)
                                            <span>{{ $value['emailStudent'] }}</span>
                                        @else
                                            <span>Trống</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @endforeach
                    @else
                        <div class="block-school-infor mt-3 mb-4">
                            <span>Bạn chưa khai báo thông tin này</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="block-perant">
                <div class="infomation-content">
                    <div class="block-name-uni block-title">
                        <div class="block-name-uni-left">
                            <p class="text-uppercase">
                                Thông tin người bảo trợ
                                <small class="text-lowercase text-gray font-italic">
                                    (Không bắt buộc)
                                </small>
                            </p>
                        </div>
                        <div class="hide-block-icon hide-block-parents">
                            <i class="fas fa-caret-down"></i>
                        </div>
                    </div>
                    @if($parents != null)
                    @for($i = 0; $i < count($parents); $i++)
                        <div class="block-parent-infor">
                            <table>
                                <tr class="table-header">
                                    <td>
                                        <span>Họ tên</span>
                                    </td>
                                    <td>
                                        <span>{{  $parents[$i]["fullname"] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Số căn cước công dân</span>
                                    </td>
                                    <td>
                                        <span>{{ $parents[$i]["cccd"] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Số tài khoản</span>
                                    </td>
                                    <td>
                                        <span>{{ $parents[$i]["stk"] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Số điện thoại</span>
                                    </td>
                                    <td>
                                        <span>{{ $parents[$i]["phone"] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Giới tính</span>
                                    </td>
                                    <td>
                                        <span>{{ $parents[$i]["gender"] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Quan hệ với sinh viên</span>
                                    </td>
                                    <td>
                                        <span>{{ $parents[$i]["relationship"] }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @endfor
                    @else
                        <div class="block-school-infor mt-3 mb-4">
                            <span>Bạn chưa khai báo thông tin này</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="block-job">
                <div class="infomation-content">
                    <div class="block-name-uni block-title">
                        <div class="block-name-uni-left">
                            <p class="text-uppercase">
                                Thông tin việc làm của bạn
                                <small class="text-lowercase text-danger font-italic">
                                    (Bắt buộc)
                                </small>
                            </p>
                        </div>
                        <div class="hide-block-icon hide-block-yourjob">
                            <i class="fas fa-caret-down"></i>
                        </div>
                    </div>
                    @if($yourjob != null)
                        <div class="block-job-infor">
                            <table>
                                <tr>
                                    <td>
                                        <span>Tình trạng việc làm của bạn</span>
                                    </td>
                                    <td>
                                        <span>
                                            @if($yourjob['jobstatus'] == "1")
                                                Đang đi làm thuê
                                            @elseif($yourjob['jobstatus'] == "2")
                                                Tự kinh doanh
                                            @elseif($yourjob['jobstatus'] == "3")
                                                Không đi làm
                                            @endif
                                        </span>     
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Tên cơ sở bạn làm việc</span>
                                    </td>
                                    <td>
                                        @if($yourjob['jobstatus'] != "3")
                                            <span>{{ $yourjob['nameCompany'] }}</span>
                                        @else
                                            <span>Trống - do bạn không đi làm</span>
                                        @endif    
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Mức lương trung bình của bạn</span>
                                    </td>
                                    <td>
                                        @if($yourjob['jobstatus'] != "3")
                                            <span>
                                                {{ number_format($yourjob['money']) }} VNĐ
                                            </span>
                                        @else
                                            <span>Trống - do bạn không đi làm</span>
                                        @endif   
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Thời gian bạn làm việc</span>
                                    </td>
                                    <td>
                                        @if($yourjob['jobstatus'] != "3")
                                            @if($yourjob['timeJob']  == "1")
                                                <span>Fulltime</span>
                                            @elseif($yourjob['timeJob']  == "2")
                                                <span>Parttime</span>
                                            @elseif($yourjob['timeJob']  == "3")
                                                <span>Fieldtrip</span>
                                            @endif
                                        @else
                                            <span>Trống - do bạn không đi làm</span>
                                        @endif  
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Địa chỉ nơi bạn làm việc</span>
                                    </td>
                                    <td>
                                        @if($yourjob['jobstatus'] != "3")
                                            <span>
                                                {{ $yourjob['addressCompany'] }}
                                            </span>
                                        @else
                                            <span>Trống - do bạn không đi làm</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @else
                        <div class="block-school-infor mt-3 mb-4">
                            <span>Bạn chưa khai báo thông tin này</span>
                        </div>
                    @endif
                </div>
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