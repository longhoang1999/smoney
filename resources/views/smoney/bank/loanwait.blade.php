@extends('smoney/bank/layouts/index')
@section('title')
    Trang Trường
    @parent
@stop
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/University/university.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/University/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512 %-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/Smoney/Bank/loanWait.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
    <style>
        .banner-2 {
            background: url('{{ asset('img-smoney/bank/aaaa.png') }}');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .loan-nearly-slide {
            background: url('{{ asset('img-smoney/img-students/hoavan-2.png') }}');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .logo {
            background-image: url('{{ asset('img-smoney/university/university_logo.png') }}');
            background-repeat: no-repeat;
            background-size: contain;
        }

    </style>
@stop
@section('content')
    @include('smoney/bank/layouts/header')
    <!-- student - block - title -->
    <div class="banner-2">
        <div class="block-banner-title">
            Thông tin khoản vay tín dụng
        </div>
    </div>

    <!-- student - block - content -->
    <div class="content">
        <div class="content-title">
            <h1>Thông tin khoản vay đang chờ</h1>
        </div>
        @if ($errors->any())
        <div class="notification-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        <span class="error">{{ $error }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
        @endif
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
                    <th>Tên sinh viên</th>
                    <th>Yêu cầu vay</th>
                    <th>Mục đích vay</th>
                    <th>Kì hạn</th>
                    <th>Trường xác nhận</th>
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


    <!-- back to top -->
    <div class="back_to_top">
        <i class="fas fa-angle-up"></i>
    </div>


    <!-- modal detail -->
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">

    </div>
@stop


@section('footer-js')
    <script type="text/javascript" src="{{ asset('datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('datatables/js/dataTables.bootstrap4.js') }}" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/Smoney/Student/student.js') }}"></script>
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
            ajax: '{!! route("bank.LoanOfBankWait") !!}',
            order:[],
            columns: [
                { data: 'nameStudent', name: 'nameStudent' }, 
                { data: 'moneyRequest', name: 'moneyRequest' }, 
                { data: 'purpose', name: 'purpose' }, 
                { data: 'duration', name: 'duration' },   
                { data: 'nameUni', name: 'nameUni' }, 
                { data: 'action', name: 'action' },   
            ]
        });

        $('#modalDetail').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('id')
            $.ajax({
                url:"{!! route('bank.getModalLoan') !!}",
                method: "GET",
                data:{
                    "idHS": recipient,
                },
                success:function(data)
                {
                    $("#modalDetail").empty();
                    $("#modalDetail").append(data);
                }
            });
        })

        $("#modalDetail").on("click", ".btn-success-refuse" ,function(){
            $(this).css("opacity","1");
            $(".block-refuse").slideToggle("fast");
            $(".block-success").slideUp("fast");
            $(".btn-success-feetback").css("opacity","0.5");
        })
        $("#modalDetail").on("click", ".btn-success-feetback" ,function(){
            $(this).css("opacity","1");
            $(".block-success").slideToggle("fast");
            $(".block-refuse").slideUp("fast");
            $(".btn-success-refuse").css("opacity","0.5");
        })
    
        $("#modalDetail").on("click", ".btn-math" , function() {
            if($("input[type=range]").val() == "0"){
                alert("Bạn đang không cho vay số tiền nào");
            }else if($("input[name=interestRate]").val() == ""){
                alert("Bạn chưa nhập lãi xuất");
            }else if($("input[name=loanMonth]").val() == ""){
                alert("Bạn chưa kì hạn khoản vay");
            }else{
                // loanMoney số tiền ban đầu cho vay
                // interestRate lãi suất vay trên tháng
                // loanMonth số tháng kì hạn
                // moneyPayAMonth trả trong 1 tháng (gốc)
                // aMonthProfit trả trong 1 tháng (lãi)
                // sumMoney tổng cả gốc và lãi trong 1 tháng
                // allLoanFinally tông số tiền phải trả trong tất cả các tháng
                let loanMoney = $("input[type=range]").val();
                let interestRate = $("input[name=interestRate]").val();
                let loanMonth =  $("input[name=loanMonth]").val();
                let moneyPayAMonth = Math.round(loanMoney / loanMonth);
                let aMonthProfit = Math.round((moneyPayAMonth*interestRate) / 100);

                let sumMoney = moneyPayAMonth + aMonthProfit;
                let showString = 
                    sumMoney.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + 
                    " VNĐ ( " + moneyPayAMonth.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + " VNĐ - gốc + " 
                    + aMonthProfit.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + " VNĐ - lãi)";

                let allLoanFinally = Math.round(sumMoney * loanMonth);
                allLoanFinally = allLoanFinally.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + " VNĐ";

                $(".moneyPayAMonth").val(moneyPayAMonth);
                $(".aMonthProfit").val(aMonthProfit);
                $(".havePayAMonth").val(showString);
                $(".allLoanFinally").val(allLoanFinally);
            }
        })
        $("#modalDetail").on("click", ".block-success-right button" , function() {
            $( ".btn-math" ).trigger( "click" );
            $( ".btn-submit" ).trigger( "click" );
        })
    </script>
@stop