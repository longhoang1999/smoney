@extends('smoney/student/layouts/index')
@section('title')
    Yêu cầu khoản vay
@parent
@stop
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/student.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/tabbular.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/animate/animate.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/jquery.circliful.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/owl_carousel/css/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/owl_carousel/css/owl.theme.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/index.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/studentResponsive.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Homepage/responsive_footer.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/test4.css') }}">
<link href="{{ asset('dropzone/css/dropzone.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
<link rel="stylesheet" href="{{ asset('css/Smoney/Student/apply-loan-custom.css') }}">
<style>
    .square-select::before{
      content: '';
      background: url('{{ asset("img-smoney/home-page/tick.png")  }}') no-repeat;
      background-size: cover;
    }
    .headroom--pinned{
        transform: translateY(-100%) !important;
    }
    .headroom--top{
        transform: translateY(0%) !important;
    }
</style>
@stop
@section('content')
@include('smoney/student/layouts/header')

<!-- information user -->
<div class="information">
    <div class="row" style="margin-top: 7.5rem;">
        <div class="col-12 text-center block-top-info">
            <div class="main-avatar" 
                @if($avatar == "")
                    style="background: url('{{ asset('img-smoney/img-students/avatar-default.png')  }}')"
                @else
                    style="background: url('{{ asset($avatar)  }}')"
                @endif
            >
            </div>
            <div class="main-content">
                <span>{{ $name }}</span>
            </div>
            <a href="#" class="user-page">(Trang cá nhân)</a>
        </div>
    </div>
</div>
<div class="block-main">
    <div class="block-main-left">
        <div class="block-timeline">
            <ul class="timeline">
                <li class="timeline-one active">
                    <span>Thông tin khoản vay</span>
                </li>
                <div class="line"></div>
                <li class="timeline-two">
                    <span>Chọn cơ sở đào tạo</span>  
                </li>
                <div class="line"></div>
                <li class="timeline-three">
                    <span>Tùy chọn khác (nếu có)</span>
                </li>
                <div class="line"></div>
                <li class="timeline-four">
                    <span>Kênh thông báo</span>
                </li>
                <div class="line"></div>
                <li class="timeline-five">
                    <span>Đóng góp</span>
                </li>
                <div class="line"></div>
                <li class="timeline-six">
                    <span>Điều khoản Smoney</span>
                </li>
          </ul>
        </div>
        <div class="block-save">
            <div class="block-save-top">
                <span class="main-nottop-title-detail">Xem thông tin cá nhân của bạn!</span>
                <div class="show-info-modal" data-toggle="modal" data-target="#modalRequiredInfo">
                    <span class="mr-1">Xem thông tin</span>
                </div>
            </div>
            <div class="block-save-buttom">
                <span class="main-nottop-title-detail">Bạn có thể lưu lại hồ sơ và hoàn thiện sau!</span>
                <div class="save-file">
                    <span class="mr-1">Lưu lại hồ sơ</span>
                    <i class="fas fa-save"></i>
                </div>
            </div>
        </div>
    </div>
    <!--  main -->
    <!-- include here -->
    <div class="main">
    </div>
</div>

<div class="modal fade" id="modalNotExist" tabindex="-1" role="dialog" aria-labelledby="modalNotExistLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNotExistLabel">Bạn khai báo thiếu thông tin!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>     
            </div>
            <div class="modal-body">
                <p class="text-danger">Bạn nhập thiếu trường "<span class="font-italic text-info notExistContent"></span>"</p>
            </div>
        </div>
    </div>
</div>

<!-- required tt cá nhân -->
<div class="modal fade" id="modalRequiredInfo" tabindex="-1" role="dialog" aria-labelledby="modalRequiredInfoLabel" aria-hidden="true">
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
                    @if($name != null && $phone != null && $cccd != null && $gender != null && $addressString != null && $email != null && $ngaysinh != null && $sotk != null && $addressNowString != null && $university != null && $yourjob != null)
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    @endif
                </h5>   
            </div>
            <div class="modal-body">
                <div class="status-message">
                    <h5 class="text-primary modal-title-heading">Hãy đảm bảo thông tin cá nhân của bạn đầy đủ trước khi thực hiện yêu cầu vay !!</h5>

                    @if($name == null || $phone == null || $cccd == null || $gender == null || $addressString == null || $email == null || $ngaysinh == null || $sotk == null || $addressNowString == null || $university == null || $yourjob == null)
                        <div class="mb-4 modal-title-comfirm">
                            <p class="m-0 text-info">Bạn nhập thiếu thông tin, hãy click nút <span class="text-primary">"Chỉnh sửa thông tin cá nhân"</span> phía trên để bổ sung thông tin cá nhân của bạn</p>
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
                            <div class="block-parent-infor mt-3 mb-4">
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
                            <div class="block-job-infor mt-3 mb-4">
                                <span>Bạn chưa khai báo thông tin này</span>
                            </div>
                        @endif
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<!-- có lưu không -->
<!-- Modal -->
<div class="modal fade" id="WantToSave" tabindex="-1" role="dialog" aria-labelledby="WantToSaveLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="WantToSaveLabel">Thông báo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Bạn có muốn lưu lại hồ sơ không?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-WantToSave">Có</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
            </div>
        </div>
    </div>
</div>

<!-- back to top -->
<div class="back_to_top">
    <i class="fas fa-angle-up"></i>
</div>
@stop


@section('footer-js')
<script type="text/javascript" src="{{ asset('js/Smoney/Student/student.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/frontend/jquery.circliful.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/wow/js/wow.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/frontend/carousel.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/frontend/index.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="{{ asset('js/Smoney/Student/loanRequest.js') }}"></script>
<script type="text/javascript">
    var idBank = [];
    @foreach($choseBank as $value)
        idBank.push({{ $value }});
    @endforeach
    
    @if($name == null || $phone == null || $cccd == null || $gender == null || $addressString == null || $email == null || $ngaysinh == null || $sotk == null || $addressNowString == null || $university == null || $yourjob == null)
        $('#modalRequiredInfo').modal({backdrop: 'static', keyboard: false})  
    @endif
    var maHS = null, sent = null, hsk_numberSchool = null;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#modalRequiredInfo").on("click",".btn-refress",function(){
        $.ajax({
            url:"{!! route('student.refressInfo') !!}",
            method: "POST",
            success:function(data)
            {
              $("#modalRequiredInfo").empty();
              //document.querySelector("#modalRequiredInfo").innerHTML = data;
              $("#modalRequiredInfo").append(data);
            }
        });
    })
    @if(isset($dataComplete))
        let dataComplete = JSON.parse('{{ $dataComplete }}'.replace(/&quot;/g,'"'));
        $.ajax({
            url:"{!! route('student.loadTimeline') !!}",
            method: "GET",
            data:{"page": dataComplete.pagepresent},
            success:function(data)
            {
              $(".main").empty();
              $(".main").append(data);
              fillDataComplete(dataComplete);
            }
        });
        function fillDataComplete(dataComplete){
            switch(dataComplete.pagepresent){
                case 'thongtinkhoanvay1':{
                    // hsk_money
                    $("input[type='range']").attr("value",dataComplete.hsk_money);
                    $(".show-money").html(asMoney(dataComplete.hsk_money))
                    $("input[type='range']").attr("style",generateBackground($("input[type='range']")));
                    // hsk_purpose
                    $(".loan-purpose").val(dataComplete.hsk_purpose);
                    $(".loan-purpose").parent().find(`li.square-item[data-value=
                        ${dataComplete.hsk_purpose}
                    ]`).addClass("square-select");
                    // hsk_duration
                    $(".loan-duration").val(dataComplete.hsk_duration);
                    $(".loan-duration").parent().find(`li.square-item[data-value=
                        ${dataComplete.hsk_duration}
                    ]`).addClass("square-select");
                    maHS = dataComplete._id;
                    break;
                }
                case 'cosodaotao5':{
                    maHS = dataComplete._id ;
                    $(".choose-school").val(dataComplete.chooseSchool);
                    $(".choose-school").parent().find(`li.square-item[data-value=
                        ${dataComplete.chooseSchool}]`)
                        .addClass("square-select");
                    break;
                }
                case 'cosodaotao4':{
                    maHS = dataComplete._id ; 
                    $(".block-show-img .row").empty();
                    $(".block-show-img .row").append(`<span class="col-md-12 main-top-title-detail">Các file ảnh đã upload lên</span>`);
                    dataComplete.imgPointAr.forEach(function(item, index){
                        let urlImg = `{{ url('/') }}/${item}`;
                        imgAr.push(item);
                        $(".block-show-img .row").append(`<div class="col-md-4 mt-3 item-show-img" data-value="${item}"><a data-fancybox="gallery" href="${urlImg}"><img class="img-fluid" src="${urlImg}" alt=""></a><div class="delete-icon" title="Xóa ảnh"><i class="fas fa-times"></i></div></div>`);
                    })
                    break;
                }
                case 'someoption':{
                    $(".timeline-one").removeClass("active");
                    if(!$(".timeline-one").hasClass("done")){
                        $(".timeline-one").addClass("done");
                    }
                    // end refress UI
                    maHS = dataComplete._id ;
                    $(".option").val(dataComplete.option);
                    $(".option").parent().find(`li.square-item[data-value=
                        ${dataComplete.option}]`)
                        .addClass("square-select");
                    break;
                }
                case 'option1':{
                    $(".timeline-one").removeClass("active");
                    if(!$(".timeline-one").hasClass("done")){
                        $(".timeline-one").addClass("done");
                    }
                    // end refress UI
                    maHS = dataComplete._id ;
                    $(".club").val(dataComplete.club);
                    $(".club").parent().find(`li.square-item[data-value=
                        ${dataComplete.club}]`)
                        .addClass("square-select");
                    break;
                }
                case 'option2':{ 
                    $(".timeline-one").removeClass("active");
                    if(!$(".timeline-one").hasClass("done")){
                        $(".timeline-one").addClass("done");
                    }
                    // end refress UI
                    maHS = dataComplete._id ;
                    $(".multi-account-number").empty();
                    dataComplete.nameClub.forEach(function(item, index) {
                      if(item != null)
                        $(".multi-account-number").append('<input type="text" class="input-text mt-1" placeholder="Nhập câu lạc bộ, đoàn thể" value="'+ item +'">');
                    })
                    break;
                }
                case 'otherpage1':{ 
                    $(".timeline-one").removeClass("active");
                    if(!$(".timeline-one").hasClass("done")){
                        $(".timeline-one").addClass("done");
                    }
                    // end refress UI
                    maHS = dataComplete._id ;
                    fillDataOtherPage1(dataComplete.pageObject);
                    break;
                }
                case 'tag1':{ 
                    $(".timeline-one").removeClass("active");
                    if(!$(".timeline-one").hasClass("done")){
                        $(".timeline-one").addClass("done");
                    }
                    // end refress UI
                    maHS = dataComplete._id ;
                    let ar = document.querySelectorAll("#div1 a");
                    ar.forEach((item) => {
                        if(dataComplete.contentTag.indexOf(item.innerText) != -1){
                            $("#div2").append(item)
                        }
                    })
                    $("#content_tag").val("");
                    arrayTag = [];
                    let lenth = $("#div2 a").length;
                    for (let i = 0; i < lenth; i++) {
                      arrayTag.push($("#div2 a")[i].text)
                    }
                    let content_tag = "";
                    arrayTag.forEach(function(item, index){
                      content_tag = content_tag + item + "|";
                    })
                    $("#content_tag").val(content_tag);
                    break;
                }
                case 'notification1':{
                    $(".timeline-one").removeClass("active");
                    if(!$(".timeline-one").hasClass("done")){
                        $(".timeline-one").addClass("done");
                    }
                    $(".timeline-two").removeClass("active");
                    if(!$(".timeline-two").hasClass("done")){
                        $(".timeline-two").addClass("done");
                    }
                    // end refress UI
                    maHS = dataComplete._id ;
                    $(".portal").val(dataComplete.portal);
                    $(".portal").parent().find(`li.square-item[data-value=${dataComplete.portal}]`).addClass("square-select");
                    break;
                }
                case 'vote1':{ 
                    $(".timeline-one").removeClass("active");
                    if(!$(".timeline-one").hasClass("done")){
                        $(".timeline-one").addClass("done");
                    }
                    $(".timeline-two").removeClass("active");
                    if(!$(".timeline-two").hasClass("done")){
                        $(".timeline-two").addClass("done");
                    }
                    $(".timeline-three").removeClass("active");
                    if(!$(".timeline-three").hasClass("done")){
                        $(".timeline-three").addClass("done");
                    }
                    // end refress UI
                    maHS = dataComplete._id ;
                    $(".opinion").text(dataComplete.opinion);
                    $("#star_Share").val(dataComplete.star_votes);
                    refreshStar(dataComplete.star_votes);
                    break;
                }
            }
        }
        function fillDataOtherPage1(data){
            if(data != null ){
                //  giấy tờ 1
                if(data[0] != undefined){
                  $(".block-show-img .row").empty();
                  $(".block-show-img .row").append(`<span class="col-md-12 main-top-title-detail">Các file ảnh đã upload lên</span>`);
                  imgAr = data[0]['arrayImg'];
                  imgAr.forEach(function(item, index) {
                    let urlImg = `{{ url('/') }}/${item}`;
                    $(".block-show-img .row").append(`<div class="col-md-4 mt-3 item-show-img" data-value="${item}"><a data-fancybox="gallery" href="${urlImg}"><img class="img-fluid" src="${urlImg}" alt=""></a><div class="delete-icon" title="Xóa ảnh"><i class="fas fa-times"></i></div></div>`);
                  })
                }
                // giấy tờ 2
                if(data[1] != undefined){
                  $(".block-show-img_2 .row").empty();
                  $(".block-show-img_2 .row").append(`<span class="col-md-12 main-top-title-detail">Các file ảnh đã upload lên</span>`);
                  imgAr_2 = data[1]['arrayImg'];
                  imgAr_2.forEach(function(item, index) {
                    let urlImg = `{{ url('/') }}/${item}`;
                    $(".block-show-img_2 .row").append(`<div class="col-md-4 mt-3 item-show-img" data-value="${item}"><a data-fancybox="gallery" href="${urlImg}"><img class="img-fluid" src="${urlImg}" alt=""></a><div class="delete-icon" title="Xóa ảnh"><i class="fas fa-times"></i></div></div>`);
                  })
                }  
                // giấy tờ 3
                if(data[2] != undefined){
                  $(".block-btn-add button").click();
                  $(".block-show-img_3 .row").empty();
                  $(".block-show-img_3 .row").append(`<span class="col-md-12 main-top-title-detail">Các file ảnh đã upload lên</span>`);
                  imgAr_3 = data[2]['arrayImg'];
                  $(".title-ortherpage-3").val(data[2]['title']);
                  imgAr_3.forEach(function(item, index) {
                    let urlImg = `{{ url('/') }}/${item}`;
                    $(".block-show-img_3 .row").append(`<div class="col-md-4 mt-3 item-show-img" data-value="${item}"><a data-fancybox="gallery" href="${urlImg}"><img class="img-fluid" src="${urlImg}" alt=""></a><div class="delete-icon" title="Xóa ảnh"><i class="fas fa-times"></i></div></div>`);
                  })
                }
                // giấy tờ 4
                if(data[3] != undefined){
                  $(".block-btn-add button").click();
                  $(".block-show-img_4 .row").empty();
                  $(".block-show-img_4 .row").append(`<span class="col-md-12 main-top-title-detail">Các file ảnh đã upload lên</span>`);
                  imgAr_4 = data[3]['arrayImg'];
                  $(".title-ortherpage-4").val(data[3]['title']);
                  imgAr_4.forEach(function(item, index) {
                    let urlImg = `{{ url('/') }}/${item}`;
                    $(".block-show-img_4 .row").append(`<div class="col-md-4 mt-3 item-show-img" data-value="${item}"><a data-fancybox="gallery" href="${urlImg}"><img class="img-fluid" src="${urlImg}" alt=""></a><div class="delete-icon" title="Xóa ảnh"><i class="fas fa-times"></i></div></div>`);
                  })
                }
                // giấy tờ 5
                if(data[4] != undefined){
                  $(".block-btn-add button").click();
                  $(".block-show-img_5 .row").empty();
                  $(".block-show-img_5 .row").append(`<span class="col-md-12 main-top-title-detail">Các file ảnh đã upload lên</span>`);
                  imgAr_5 = data[4]['arrayImg'];
                  $(".title-ortherpage-5").val(data[4]['title']);
                  imgAr_5.forEach(function(item, index) {
                    let urlImg = `{{ url('/') }}/${item}`;
                    $(".block-show-img_5 .row").append(`<div class="col-md-4 mt-3 item-show-img" data-value="${item}"><a data-fancybox="gallery" href="${urlImg}"><img class="img-fluid" src="${urlImg}" alt=""></a><div class="delete-icon" title="Xóa ảnh"><i class="fas fa-times"></i></div></div>`);
                  })
                } 
            }
        }
        function generateBackground(rangeElement) {   
            if (rangeElement.val() === min) {
              return
            }
            let percentage =  (rangeElement.val() - min) / (max - min) * 100;
            return 'background: linear-gradient(to right, #50299c, #7a00ff ' + percentage + '%, #d3edff ' + percentage + '%, #dee1e2 100%)'
        }
    @else
        $.ajax({
            url:"{!! route('student.loadTimeline') !!}",
            method: "GET",
            data:{"page": "thongtinkhoanvay1"},
            // data:{"page": "thongtincanhan1"},
            // data:{"page": "thongtincanhan2"},
            // data:{"page": "thongtincuchu1"},
            // data:{"page": "thongtincuchu2"},
            // data:{"page": "thongtincuchu3"},
            // data:{"page": "cosodaotao1"},
            // data:{"page": "cosodaotao2"},
            // data:{"page": "cosodaotao3"},
            // data:{"page": "cosodaotao4"},
            // data:{"page": "vieclam1"},
            // data:{"page": "vieclam2"},
            // data:{"page": "vieclam3"},
            // data:{"page": "vieclam4"},
            // data:{"page": "option1"},
            // data:{"page": "option2"},
            // data:{"page": "option3"},
            // data:{"page": "option4"},
            // data:{"page": "otherpage1"},
            // data:{"page": "tag1"},
            // data:{"page": "notification1"},
            // data:{"page": "vote1"},
            // data:{"page": "confirm1"},
            success:function(data)
            {
              $(".main").empty();
              $(".main").append(data);
            }
        });
    @endif

    
    $(".btn-WantToSave").click(function() {
        $.ajax({
            url:"{!! route('student.loadTimeline') !!}",
            method: "GET",
            data:{
                "pagepresent" : "savedRequest",
                "data" : maHS
            },
            success:function(data)
            {
              alert("Thông tin của bạn đã được lưu!");
              sent = "true";
              location.replace("{{ route('student.student') }}");
            }
        });
    })
    
    function scrollToMain(){
        $(window).scrollTop($('.main').offset().top - 20);
    }
</script>
@stop