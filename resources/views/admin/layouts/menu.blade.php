

<li {!!  (Request::is('admin/index2') || Request::is('admin/hanghoas') || Request::is('admin/hanghoas/create')   ? 'class="active"' : '' ) !!}>
        <a href="#">
            <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
            <span class="title">Hang hoa</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/hanghoas') ? 'class="active" id="active"' : '' ) !!}>
                <a href="{{ URL::to('admin/hanghoas') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Show list
                </a>
            </li>
            <li {!! (Request::is('admin/hanghoas/create') ? 'class="active" id="active"' : '' ) !!}>
                <a href="{{ URL::to('admin/hanghoas/create') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Add New Hàng hóa
                </a>
            </li>
            <li {!! (Request::is('admin/index2') ? 'class="active" id="active"' : '' ) !!}>
                <a href="{{ URL::to('admin/index2') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Deleted Hàng hóa
                </a>
            </li>

            
            
            
        </ul>
    </li>