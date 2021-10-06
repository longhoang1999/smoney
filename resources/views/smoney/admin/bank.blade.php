@extends('smoney/admin/layouts/index')
@section('title')
    Trang Trường
    @parent
@stop
@section('header_styles')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Admin/admin.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Admin/index.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .banner {
            background-image: url('{{ asset('img-smoney/university/school-dashboard-banner.png') }}');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: bottom;
        }
        .logo {
            @if($avatar == "")
                background-image: url('{{ asset('img-smoney/img-students/avatar-default.png')}}');
            @else
                background-image: url('{{ asset($avatar)}}');
            @endif
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
@stop
@section('content')
    @include('smoney/admin/layouts/header')
    <!-- student - block - title -->
    <div class="banner">
        <div class='container'>
            <div class='logo-container'>
                <div class='logo-title'>Admin</div>
                <span>(Trang tài khoản ngân hàng)</span>
            </div>
            <div class='w-100 mb-5'>
                <div class='d-flex justify-content-between my-3'>
                    <span class="summary-title-overal">Tài khoản trong hệ thống</span>
                </div>
                <div class='summary-row'>
                    <div class='summary-container col-4'>
                        <div class='summary-background summary-items line-blue py-2 px-4'>
                            <div class="summary-top">
                                <div class="summary-title ">Tổng số tài khoản sinh viên</div>
                                <div class="summary-value">11 Tài khoản</div>
                            </div>
                            <div class="summary-bottom positive"><i class="fas fa-chevron-up"></i> 16%</div>
                            <img src="{{ asset('img-smoney/admin/adminStudent.png') }}" alt="">
                        </div>
                    </div>
                    <div class='summary-container col-4'>
                        <div class='summary-background summary-items line-orange'>
                            <div class="summary-top">
                                <div class="summary-title ">Tổng số tài khoản nhà trường</div>
                                <div class="summary-value">12 Tài khoản</div>
                            </div>
                            <div class="summary-bottom negative"><i class="fas fa-chevron-down"></i> 16%</div>
                            <img src="{{ asset('img-smoney/admin/adminUni.png') }}" alt="">
                        </div>
                    </div>
                  
                    <div class='summary-container col-4'>
                        <div class='summary-background summary-items line-green'>
                            <div class="summary-top">
                                <div class="summary-title ">Tổng số tài khoản ngân hàng</div>
                                <div class="summary-value negative">22 Khoản</div>
                            </div>
                            <div class="summary-bottom negative"><i class="fas fa-chevron-down"></i> 16%</div>
                            <img src="{{ asset('img-smoney/admin/adminBank.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- student - block - content -->
    <div class="content">
        <div class="item">
            <div class="content-title">
                <h1>Thông tin tài khoản ngân hàng</h1>
            </div>
                @if(Session::has('error'))
                <div class="notification-error">
                    <ul>
                        <li>
                            <span class="error">{{ Session::get('error') }}</span>
                        </li>
                    </ul>
                </div>
                @endif

                @if(Session::has('success'))
                <div class="notification-success">
                    <ul>
                        <li>
                            <span class="success">{{ Session::get('success') }}</span>
                        </li>
                    </ul>
                </div>
                @endif
            <div> 
                <div class="add-new" data-toggle="modal" data-target="#addNewBankModal">
                    <span>Thêm mới</span>
                    <i class="fas fa-plus-circle"></i>
                </div>
            </div>
            <!-- table -->
            <table class="content-table" id="Table_Bank">
                <thead>
                    <tr>
                        <th>Phone</th>
                        <th>Ảnh</th>
                        <th>Tên</th>
                        <th>Địa chỉ</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <!-- resetModal -->
    <div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="resetModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resetModalLabel">Thông báo reset mật khẩu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-danger">Bạn có muốn reset mật khẩu của ngân hàng "<span class="nameUniReset text-info"></span>" không?</p>
                    <p class="text-info">Mật khẩu sẽ được đặt lại theo số điện thoại của người dùng!</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-danger btn-reset-pass">Đặt lại mật khẩu</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal chỉnh sửa -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Chi tiết thông tin ngân hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" class="form-fix-school" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container-fuild">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <span class="font-weight-bold">Tên ngân hàng</span>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="tenBank form-control" placeholder="Tên ngân hàng" required="" name="tenBank">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <span class="font-weight-bold">Số điện thoại</span>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="phoneBank form-control" placeholder="Số điện thoại" required="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="phoneBank">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <span class="font-weight-bold">Hình ảnh</span>
                                </div>
                                <div class="col-md-8 flex-box">
                                    <div class="roud imgBank m-0">
                                    </div>
                                    <div class="ml-4">
                                        <button type="button" class="btn btn-sm btn-primary btn-open-file">Tải ảnh lên</button>
                                        <input type="file" accept="image/*" class="input-file-hidden" name="imgBank">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <span class="font-weight-bold">Email</span>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" placeholder="Email" class="emailBank form-control" name="emailBank">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <span class="font-weight-bold">Địa chỉ</span>
                                </div>
                                <div class="col-md-8"> 
                                    <textarea name="addressBank" class="addressBank form-control" placeholder="Địa chỉ" required=""></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <span class="font-weight-bold">Thông tin</span>
                                </div>
                                <div class="col-md-8"> 
                                    <textarea name="infomationBank" class="infomationBank form-control" placeholder="Thông tin"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <span class="font-weight-bold">Chính sách</span>
                                </div>
                                <div class="col-md-8"> 
                                    <textarea name="policyBank" class="policyBank form-control" placeholder="Chính sách"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <span class="font-weight-bold">Hoạt động</span>
                                </div>
                                <div class="col-md-8"> 
                                    <textarea name="activeBank" class="activeBank form-control" placeholder="Hoạt động"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Chỉnh sửa</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- modal add bank -->
    <div class="modal fade" id="addNewBankModal" tabindex="-1" role="dialog" aria-labelledby="addNewBankModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewBankModalLabel">Thêm một ngân hàng mới vào hệ thống</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- add new  -->
                <form action="{{ route('admin.addNewBank') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container-fuild">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <span class="font-weight-bold">Tên ngân hàng</span>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" placeholder="Tên ngân hàng" required="" name="tenBank">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <span class="font-weight-bold">Số điện thoại</span>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" placeholder="Số điện thoại" required="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="phoneBank">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <span class="font-weight-bold">Hình ảnh</span>
                                </div>
                                <div class="col-md-8 flex-box">
                                    <div class="ml-4">
                                        <button type="button" class="btn btn-sm btn-primary btn-open-file-add">Tải ảnh lên</button>
                                        <input type="file" accept="image/*" class="input-file-hidden-add" name="imgBank">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <span class="font-weight-bold">Email</span>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" placeholder="Email" class=" form-control" name="emailBank">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <span class="font-weight-bold">Địa chỉ</span>
                                </div>
                                <div class="col-md-8"> 
                                    <textarea name="addressBank" class="form-control" placeholder="Địa chỉ" required=""></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <span class="font-weight-bold">Thông tin</span>
                                </div>
                                <div class="col-md-8"> 
                                    <textarea name="infomationBank" class="form-control" placeholder="Thông tin"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <span class="font-weight-bold">Chính sách</span>
                                </div>
                                <div class="col-md-8"> 
                                    <textarea name="policyBank" class="form-control" placeholder="Chính sách"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <span class="font-weight-bold">Hoạt động</span>
                                </div>
                                <div class="col-md-8"> 
                                    <textarea name="activeBank" class="form-control" placeholder="Hoạt động"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >Thêm ngân hàng</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- back to top -->
    <div class="back_to_top">
        <i class="fas fa-angle-up"></i>
    </div>
@stop


@section('footer-js')
    <script type="text/javascript" src="{{ asset('datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('datatables/js/dataTables.bootstrap4.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('js/Smoney/Student/student.js') }}"></script>
    <script type="text/javascript">
        var $url_path = '{!! url('/') !!}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // bank
        var table_3 = $('#Table_Bank').DataTable({
            "columnDefs": [
                { className: "first blue", "targets": [ 0 ] }
            ],
            processing: true,
            serverSide: true,
            ajax: '{!! route('admin.showAllbank') !!}',
            order:[],
            columns: [
                { data: 'nn_sdt', name: 'nn_sdt' },
                { data: 'avatar', name: 'avatar' },
                { data: 'nn_ten', name: 'nn_ten' },
                { data: 'nn_diachi', name: 'nn_diachi'},
                { data: 'nn_email', name: 'nn_email' }, 
                { data: 'action', name: 'action' },       
            ]
        });

        $('#resetModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var idUni = button.data('id')
            var nameUni = button.data('name')
            $(".nameUniReset").text(nameUni);
            let $url = $url_path+"/resetPassBank/"+idUni;
            $(".btn-reset-pass").attr("href",$url);
        })

        $('#detailModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('id')
            $.ajax({
                url:"{!! route('admin.getBankInfo') !!}",
                method: "GET",
                data:{
                    "idBank": recipient,
                },
                success:function(data)
                {
                    $(".tenBank").val(data['tenBank']);
                    $(".phoneBank").val(data['phoneBank']);
                    $(".imgBank").empty();
                    if(data['imgBank'] != ""){
                        $(".imgBank").append(`<img src="${data['imgBank']}" alt="">`);
                    }
                    $(".emailBank").val(data['emailBank']);
                    $(".addressBank").val(data['addressBank']);
                    $(".infomationBank").val(data['infomationBank']);
                    $(".policyBank").val(data['policyBank']);
                    $(".activeBank").val(data['activeBank']);
                    
                    let $url = $url_path+"/fixBank/"+data['idBank'];
                    $(".form-fix-school").attr("action", $url);
                }
            });
        })
        $(".btn-open-file").click(function() {
            $(".input-file-hidden").click();
        })
        $(".btn-open-file-add").click(function() {
            $(".input-file-hidden-add").click();
        })
    </script>
@stop