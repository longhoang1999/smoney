@extends('smoney/student/layouts/index')
@section('title')
    Thông tin khoản vay lưu thông
@parent
@stop
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/student.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/student2.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/studentLoan.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/applyloan_2.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/loaninfo.css') }}">
<link rel="stylesheet" href="{{ asset('css/Smoney/Homepage/customModal.css') }}">
<style>
    .banner-2 {
        background: url('{{ asset('img-smoney/bank/aaaa.png') }}') no-repeat;
        background-size: cover;
    }

</style>
@stop
@section('content')
    @include('smoney/student/layouts/header')
    <!-- student - block - title -->
    <div class="banner-2">
        <div class="block-banner-title">
            Thông tin khoản vay của bạn
        </div>
    </div>

    <!-- thông báo -->
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

    <!-- student - block - content -->
    <div class="content">
        <div class="content-title">
            <h1>Thông tin khoản vay đang lưu thông</h1>
        </div>
        <!-- table -->
        <table class="content-table" id="Table_KhoanVay">
            <thead>
                <tr>
                    <th>Tên sinh viên</th>
                    <th>Số tiền vay (VNĐ)</th>
                    <th>Lãi suất (%/tháng)</th>
                    <th>Sinh viên Trường</th>
                    <th>Ngày vay</th>
                    <th>Kỳ hạn (tháng)</th>
                    <th>Ngày trả</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <!-- student - block - content -->
    <div class="content">
        <div class="content-title">
            <h1>Thông tin khoản vay sắp hết kỳ hạn</h1>
        </div>
        <!-- table -->
        <table class="content-table" id="Table_KhoanVay_End">
            <thead>
                <tr>
                    <th>Tên sinh viên</th>
                    <th>Số tiền vay (VNĐ)</th>
                    <th>Lãi suất (%/tháng)</th>
                    <th>Kỳ hạn (tháng)</th>
                    <th>Sinh viên Trường</th>
                    <th>Hạn trả sau</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <!-- student - block - content -->
    <div class="content">
        <div class="content-title">
            <h1>Thông tin khoản vay đã quá hạn</h1>
        </div>
        <!-- table -->
        <table class="content-table" id="Table_KhoanVay_OutDate">
            <thead>
                <tr>
                    <th>Tên sinh viên</th>
                    <th>Số tiền vay (VNĐ)</th>
                    <th>Lãi suất (%/tháng)</th>
                    <th>Kỳ hạn (tháng)</th>
                    <th>Sinh viên Trường</th>
                    <th>Đã quá hạn</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

<!-- back to top -->
<div class="back_to_top">
    <i class="fas fa-angle-up"></i>
</div>


<!-- modal -->
<div class="modal fade customModal" id="detailLoanNormal" tabindex="-1" role="dialog" aria-labelledby="detailLoanNormalLable" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    

  </div>
</div>
@stop


@section('footer-js')
<script type="text/javascript" src="{{ asset('js/Smoney/Student/student.js') }}"></script>
<script type="text/javascript" src="{{ asset('datatables/js/jquery.dataTables.js') }}" ></script>
<script type="text/javascript" src="{{ asset('datatables/js/dataTables.bootstrap4.js') }}" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
<script type="text/javascript">
    var $url_path = '{!! url('/') !!}';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var table_3 = $('#Table_KhoanVay').DataTable({
        'createdRow': function( row, data, dataIndex ) {
            $(row).attr('data-id', data._id);
            $(row).attr('class', 'rowNomalLoan');
        },
        "columnDefs": [
            { className: "first blue", "targets": [ 0 ] }
        ],
        processing: true,
        serverSide: true,
        ajax: '{!! route("student.LoanOfPass") !!}',
        order:[],
        columns: [
            { data: 'nameStudent', name: 'nameStudent' }, 
            { data: 'loanProposal', name: 'loanProposal' }, 
            { data: 'interestRate', name: 'interestRate' }, 
            { data: 'nameUni', name: 'nameUni' }, 
            { data: 'dateAccept', name: 'dateAccept' },
            { data: 'loanMonth', name: 'loanMonth' },   
            { data: 'dateExpired', name: 'dateExpired' },   
        ]
    });
    // turn on model 
    $("#Table_KhoanVay").on("click", ".rowNomalLoan", function() {
        var recipient = $(this).data("id")
        $.ajax({
            url:"{!! route('student.getModalLoanNormal') !!}",
            method: "GET",
            data:{
                "idHS": recipient,
            },
            success:function(data)
            {
                $("#detailLoanNormal .modal-dialog.modal-xl").empty();
                $("#detailLoanNormal .modal-dialog.modal-xl").append(data);
                $("#detailLoanNormal").modal("show");
            }
        });
    })
</script>
<script type="text/javascript">
    var table = $('#Table_KhoanVay_End').DataTable({
        'createdRow': function( row, data, dataIndex ) {
            $(row).attr('data-id', data._id);
            $(row).attr('class', 'rowLoanEnd');
        },
        "columnDefs": [
            { className: "first blue", "targets": [ 0 ] }
        ],
        processing: true,
        serverSide: true,
        ajax: '{!! route("student.LoanOfBankComeEnd") !!}',
        order:[],
        columns: [
            { data: 'nameStudent', name: 'nameStudent' }, 
            { data: 'loanProposal', name: 'loanProposal' }, 
            { data: 'interestRate', name: 'interestRate' }, 
            { data: 'loanMonth', name: 'loanMonth' },
            { data: 'nameUni', name: 'nameUni' }, 
            { data: 'timeRemaining', name: 'timeRemaining' }
        ]
    });
    $("#Table_KhoanVay_End").on("click", ".rowLoanEnd", function() {
        var recipient = $(this).data("id")
        $.ajax({
            url:"{!! route('student.getModalLoanNormal') !!}",
            method: "GET",
            data:{
                "idHS": recipient
            },
            success:function(data)
            {
                $("#detailLoanNormal .modal-dialog.modal-xl").empty();
                $("#detailLoanNormal .modal-dialog.modal-xl").append(data);
                $("#detailLoanNormal").modal("show");
                $("#detailLoanNormal").find(".changeContent").addClass("text-danger");
            }
        });
    })
</script>
<script type="text/javascript">
    var table_2 = $('#Table_KhoanVay_OutDate').DataTable({
        'createdRow': function( row, data, dataIndex ) {
            $(row).attr('data-id', data._id);
            $(row).attr('class', 'rowLoanEnd');
        },
        "columnDefs": [
            { className: "first blue", "targets": [ 0 ] }
        ],
        processing: true,
        serverSide: true,
        ajax: '{!! route("student.LoanOfBankOutDate") !!}',
        order:[],
        columns: [
            { data: 'nameStudent', name: 'nameStudent' }, 
            { data: 'loanProposal', name: 'loanProposal' }, 
            { data: 'interestRate', name: 'interestRate' }, 
            { data: 'loanMonth', name: 'loanMonth' },
            { data: 'nameUni', name: 'nameUni' }, 
            { data: 'timeRemaining', name: 'timeRemaining' }
        ]
    });
    $("#Table_KhoanVay_OutDate").on("click", ".rowLoanEnd", function() {
            var recipient = $(this).data("id")
            $.ajax({
                url:"{!! route('student.getModalLoanNormal') !!}",
                method: "GET",
                data:{
                    "idHS": recipient
                },
                success:function(data)
                {
                    $("#detailLoanNormal .modal-dialog.modal-xl").empty();
                    $("#detailLoanNormal .modal-dialog.modal-xl").append(data);
                    $("#detailLoanNormal").modal("show");
                    $("#detailLoanNormal").find(".changeTitle").text("Đã quá hạn:");
                    $("#detailLoanNormal").find(".changeContent").addClass("text-danger");
                    
                }
            });
        })
</script>
@stop
