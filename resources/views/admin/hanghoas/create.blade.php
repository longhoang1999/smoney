
@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Hanghoa
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')

    <link rel="stylesheet" href="{{asset('css/pages/add.css')}}" type="text/css">
@stop

@section('content')
@include('common.errors')
<section class="content-header">
    <h1>Hàng hóa</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Hàng hóa</li>
        <li class="active">Create Hanghoa </li>
    </ol>
</section>

<section class="content">
<div class="container">
<div class="row">
    <div class="col-12">
     <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Create New  Hàng hóa
                </h4></div>
            <br />
            <div class="card-body">

                 <form id="commentForm" action="{{ route('admin.hanghoas.store') }}"
                              method="POST" enctype="multipart/form-data" class="form-horizontal">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <ul>
                                    <li class="nav-item"><a href="#tab1" data-toggle="tab" class="nav-link">Hàng hóa Profile</a></li>
                </ul>

               
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


            {!! Form::open(['route' => 'admin.hanghoas.store']) !!}

                <div class="form-group col-sm-12 text-center">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{!! route('admin.hanghoas.index') !!}" class="btn btn-secondary">Cancel</a>
                 </div>

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
