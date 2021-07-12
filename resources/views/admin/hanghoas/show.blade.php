@extends('admin/layouts/default')

@section('title')
Hanghoa
@parent
@stop
@section('header_styles')
    
  
    <link href="{{ asset('css/pages/img.css') }}" rel="stylesheet" type="text/css">
    <script
  src="https://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>
  <script src="{{asset('js/pages/img.js')}}"></script> 
@stop

@section('content')
<section class="content-header">
    <h1>Hanghoa View</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Hanghoas</li>
        <li class="active">Hanghoa View</li>
    </ol>
</section>

<section class="content">
<div class="container">
    <div class="row">
      <div class="col-12">
       <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Thông tin Hang hoa 
                    </h4>
                </div>
                    <div class="card-body">
                        @include('admin.hanghoas.show_fields')
                    </div>
                </div>

    <div class="form-group">
           <a href="{!! route('admin.hanghoas.index') !!}" class="btn btn-warning mt-2">Back</a>
    </div>
     </div>
     </div>
  </div>
</section>
@stop
