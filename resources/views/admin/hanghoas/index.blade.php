@extends('admin/layouts/default')

@section('title')
Hang hoa
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/dataTables.bootstrap4.css') }}" />
<link href="{{ asset('css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('css/pages/cssformindex.css')}}" type="text/css">
 


@stop



{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Hàng hóa</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Hàng hóa</li>
        <li class="active">Hàng hóa List</li>
    </ol>
</section>

<section class="content">
<div class="container">
    <div class="row">
     <div class="col-12">
     @include('flash::message')
        <div class="card border-primary ">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title float-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Hàng hóa List
                </h4>
               
                <div class="float-right">
                    <a href="{{ route('admin.hanghoas.create') }}" class="btn btn-sm btn-secondary"><span class="fa fa-plus"></span> @lang('button.create')</a>
                </div>
            </div>
            <br />

            <!-- sửa -->
            <form id="commentForm" action="{{ route('admin.hanghoas.up') }}"
                              method="POST" enctype="multipart/form-data" class="form-horizontal">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="row">
                 <label for="id" class="col-sm-2 control-label"><p>ID sản phẩm </p></label>
                 <div class="col-sm-10">
                 <input id="id" name="id" type="text"
                            class="form-control required" placeholder="ID" 
                            value="{!! old('id') !!}" readonly/>

                          {!! $errors->first('id', '<span class="help-block">:message</span>') !!}
                 </div>
                 </div>
            <div class="row">
                 <label for="first_name" class="col-sm-2 control-label"><p>Tên sản phẩm </p></label>
                 <div class="col-sm-10">
                 <input id="first_name" name="first_name" type="text"
                           placeholder="Tên sản phẩm" class="form-control required"
                            value="{!! old('first_name') !!}"/>

                          {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                 </div>
                 </div>

                  <div class="row">
                 <label for="last_name" class="col-sm-2 control-label"><p>Ngày nhập </p></label>
                 <div class="col-sm-10">
                 <input id="last_name" name="last_name" type="text"
                           placeholder="Ngày nhập" class="form-control required"
                            value="{!! old('last_name') !!}"/>

                          {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                 </div>
                 </div>

                  <div class="row">
                 <label for="infor" class="col-sm-2 control-label"><p>Thông tin </p></label>
                 <div class="col-sm-10">
                 <input id="infor" name="infor" type="text"
                           placeholder="Thông tin" class="form-control required"
                            value="{!! old('infor') !!}"/>

                          {!! $errors->first('infor', '<span class="help-block">:message</span>') !!}
                 </div>
                 </div>


                
                 {!! Form::open(['route' => 'admin.hanghoas.up']) !!}

                 <div class="form-group col-sm-12 text-center">
                 {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                 </div>

                  {!! Form::close() !!}
              
          </form>


            <!-- in dữ liệu cho file index -->
           <div class="card-body">
                <div class="table-responsive-lg table-responsive-sm table-responsive-md">
                <table class="table table-bordered width100" id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Ngày nhập</th>
                            <th>Thông tin</th>                            
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       

                    </tbody>
                </table>
                </div>
            </div>

        </div>
        </div>
 </div>
 </div>

</section>
 @stop
{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('vendors/datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('vendors/datatables/js/dataTables.bootstrap4.js') }}" ></script>


<script>
    $(function() {
        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('admin.hanghoas.data') !!}',
            order:[],
            columns: [
                { data: 'id', name: 'id' },
                { data: 'Tensp', name: 'Tensp' },
                { data: 'Ngaynhap', name: 'Ngaynhap' },
                { data: 'Thongtin', name: 'Thongtin' },
                { data: 'created_at', name:'created_at'},
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
        table.on( 'draw', function () {
            $('.livicon').each(function(){
                $(this).updateLivicon();
            });
        } );
        //lấy dữ liệu từ một hàng lên input text
        $('#table tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        $('input#id').val(data.id);
        $('input#first_name').val(data.Tensp);
        $('input#last_name').val(data.Ngaynhap);
        $('input#infor').val(data.Thongtin);
       
       $("#myModal").css("display","block"); 
       $('input#in1').val(data.id);
         $('input#in2').val(data.Tensp);
          $('input#in3').val(data.Ngaynhap);
           $('input#in4').val(data.Thongtin);
        });
    });

    



</script>
        <div class="formfix">
        
        <div id="myModal" class="modal">
          <!-- Modal content -->
        <div class="modal-content">
            <form action="{{ route('admin.hanghoas.up') }}" class="form_fix" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <span class="close">&times;</span>
                <h3>Sửa thông tin hàng hóa</h3>
                <div class="formgroup">

                    <div class="row">
                    <p class="col-sm-4">ID</p>
                    <div class="col-sm-8">
                    <input id="in1" type="text" placeholder="ID" name="id" class="form-control required" readonly/>
                </div>
            </div>

                <div class="row">
                    <p class="col-sm-4">Tên sản phẩm</p>
                    <div class="col-sm-8">
                    <input id="in2" type="text" placeholder="Tên sản phẩm" name="first_name"  class="form-control required">
                    </div>
                </div>
                <div class="row">
                    <p class="col-sm-4">Ngày nhập</p>
                    <div class="col-sm-8">
                    <input id="in3" type="text" placeholder="Ngày nhập" name="last_name"  class="form-control required">
                </div>
                </div>
                <div class="row">
                    <p class="col-sm-4">Thông tin</p>
                    <div class="col-sm-8">
                    <input id="in4" type="text" placeholder="Thông tin"  name="infor" class="form-control required">
                </div>
                    </div>
                   
                      {!! Form::open(['route' => 'admin.hanghoas.up']) !!}
                      {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                      {!! Form::close() !!}
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                </div>
            </form>
        
        </div>
        </div>
    </div>

        <script>
        // lấy phần Modal
        var modal = document.getElementById('myModal');
        // Khi click ngoài Modal thì đóng Modal
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
      
       
         $(".close").click(function(){
           $("#myModal").css("display","none"); 
        })
         $("button.btn.btn-secondary").click(function(){
            $("#myModal").css("display","none");
        });
        
        </script>

    <!-- modal xóa -->
    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteLabel">Delete Hàng hóa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete this hang hoa? This operation is irreversible.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a  type="button" class="btn btn-danger Remove_square">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    <!-- /.modal-dialog -->

<script>
$(function () {
    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });
});
var $url_path = '{!! url('/') !!}';
$('#delete_confirm').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var $recipient = button.data('id');
    var modal = $(this)
    modal.find('.modal-footer a').prop("href",$url_path+"/admin/"+$recipient+"/delete");
})
</script>
@stop

