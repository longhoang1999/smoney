@extends('admin/layouts/default')

@section('title')
Hanghoas
@parent
@stop
@section('header_styles')
     <link rel="stylesheet" href="{{asset('css/pages/addcreate.css')}}" type="text/css"/>
     
@stop

@section('content')
  @include('common.errors')
    <section class="content-header">
     <h1>Hanghoas Edit</h1>
     <ol class="breadcrumb">
         <li>
             <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                 Dashboard
             </a>
         </li>
         <li>Hanghoas</li>
         <li class="active">Edit Hanghoa </li>
     </ol>
    </section>
    <section class="content">
    <div class="container">
      <div class="row">
             <div class="col-12">
              <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Edit  Hanghoa
                        </h4></div>
                    <br />
                <div class="card-body">
                    <form id="commentForm" action="{{ route('admin.hanghoas.up') }}"
                              method="POST" enctype="multipart/form-data" class="form-horizontal">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <ul>
                                    <li class="nav-item"><a href="#tab1" data-toggle="tab" class="nav-link">Hàng hóa Profile</a></li>
                </ul>

                <div class="row">
                 <label for="id" class="col-sm-2 control-label"><p>ID sản phẩm </p></label>
                 <div class="col-sm-10">
                 <input id="id" name="id" type="text"
                            class="form-control required"
                            value="{{$id}}" readonly/>

                          {!! $errors->first('id', '<span class="help-block">:message</span>') !!}
                 </div>
                 </div>
                <div class="row">
                 <label for="first_name" class="col-sm-2 control-label"><p>Tên sản phẩm </p></label>
                 <div class="col-sm-10">
                 <input id="first_name" name="first_name" type="text"
                           placeholder="Tên sản phẩm" class="form-control required"
                            value="{{$tensp}}"/>

                          {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                 </div>
                 </div>

                  <div class="row">
                 <label for="last_name" class="col-sm-2 control-label"><p>Ngày nhập </p></label>
                 <div class="col-sm-10">
                 <input id="last_name" name="last_name" type="text"
                           placeholder="Ngày nhập" class="form-control required"
                            value="{{$ngaynhap}}"/>

                          {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                 </div>
                 </div>

                  <div class="row">
                 <label for="infor" class="col-sm-2 control-label"><p>Thông tin </p></label>
                 <div class="col-sm-10">
                 <input id="infor" name="infor" type="text"
                           placeholder="Thông tin" class="form-control required"
                            value="{{$infor}}"/>

                          {!! $errors->first('infor', '<span class="help-block">:message</span>') !!}
                 </div>
                 </div>
                 

                {!! Form::open(['route' => 'admin.hanghoas.up']) !!}

                @include('admin.hanghoas.fields')

                {!! Form::close() !!}
            </form>
                </div>
              </div>
           </div>
        </div>
    </div>
   </section>
 @stop
@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("form").submit(function() {
                $('input[type=submit]').attr('disabled', 'disabled');
                return true;
            });
        });
    </script>
@stop
