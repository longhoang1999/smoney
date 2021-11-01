@extends('smoney/university/layouts/index')
@section('title')
    Trang Trường
@parent
@stop
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/University/university.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/University/dashboard.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" 
integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" 
crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
<style>
    .banner-2{
        background: url('{{ asset("img-smoney/university/aaa.png")  }}');
        background-repeat: no-repeat;
        background-size: cover;
    }
    .loan-nearly-slide{
        background: url('{{ asset("img-smoney/img-students/hoavan-2.png")  }}');
        background-repeat: no-repeat;
        background-size: cover;
    }
    .logo{
      background-image: url('{{asset("img-smoney/university/university_logo.png")}}');
        background-repeat: no-repeat;
        background-size: contain;
    }
</style>
@stop
@section('content')
@include('smoney/university/layouts/header')
<!-- student - block - title -->
<div class="banner-2">
    <div class="block-banner-title">
        Khoản vay đang chờ xử lý
    </div>
</div>

<!-- student - block - content -->
<div class="content">
    <div class="content-title">
       <h1>Các khoản vay đang chờ xử lý</h1>
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
        <div class="notification-error">
            <ul>
                <li>
                    <span class="success">{{ Session::get('success') }}</span>
                </li>
            </ul>
        </div>
        @endif
    <!-- table -->
    <table class="content-table" id="Table_KhoanVay">
        <thead>
            <tr>
                <th>Họ tên</th>
                <th>Mã sinh viên</th>
                <th>Khoản vay</th>
                <th>Kì hạn</th>
                <th>Nhà trường</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
         </tbody>
    </table>
    <!-- paging -->
    <div class="paging">

    </div>
</div>

<!-- modal detail -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
    <script type="text/javascript">
        var $url_path = '{!! url('/') !!}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table_3 = $('#Table_KhoanVay').DataTable({
            "columnDefs": [
                { className: "first blue", "targets": [ 0 ] }
            ],
            processing: true,
            serverSide: true,
            ajax: '{!! route('school.LoanOfUniWait') !!}',
            order:[],
            columns: [
                { data: 'nameStudent', name: 'nameStudent' }, 
                { data: 'studentCode', name: 'studentCode' }, 
                { data: 'moneyRequest', name: 'moneyRequest' },   
                { data: 'duration', name: 'duration' }, 
                { data: 'uniStatus', name: 'uniStatus' }, 
                { data: 'action', name: 'action' },   
            ]
        });

        
        $('#modalDetail').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('id')
            $.ajax({
                url:"{!! route('school.getModalLoan') !!}",
                method: "GET",
                data:{
                    "idHS": recipient,
                },
                success:function(data)
                {
                    $("#modalDetail .modal-dialog.modal-xl").empty();
                    $("#modalDetail .modal-dialog.modal-xl").append(data);
                }
            });
        })
        $("#modalDetail").on("click",".down-sample-answer", function(){
            $("#modalDetail").find(".sample-answer").slideToggle("fast");
            $("#modalDetail").find(".sample-answer").css("display","flex");
            
        })
        $("#modalDetail").on("dblclick",".sample-answer .sample", function(){
            $("#modalDetail").find(".feedback-content").text("");
            $("#modalDetail").find(".feedback-content").text($(this).text());
        })
        $("#modalDetail").on("click",".btn-success-feetback", function(){
            $(".status-feedback").val("true");
            $( ".auto-submit-form" ).trigger( "click" );
        })
        $("#modalDetail").on("click",".btn-success-refuse", function(){
            $(".status-feedback").val("false");
            $( ".auto-submit-form" ).trigger( "click" );
        })
        
    </script>
@stop