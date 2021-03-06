@extends('smoney/homepage/layouts/index')
@section('title')
    Home Page
@parent
@stop
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Homepage/index.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Homepage/responsive_2.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/tabbular.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/animate/animate.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/jquery.circliful.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/owl_carousel/css/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/index.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/owl_carousel/css/owl.theme.css') }}">

<style>
	.border_lightblue{
		background: url("{{ asset('img-smoney/home-page/Untitled-1.png')  }}") no-repeat;
		background-size: contain;
	}
	.secction_service{
		background: url("{{ asset('img-smoney/home-page/Vector-bg.png')  }}") no-repeat;
		background-size: cover;
	}
</style>

@stop
@section('content')
<div class="header" id="header">
	<div class="header-top">
		<div class="header-top-left">
			<a href="#" class="header-facebook">
				<i class="fab fa-facebook-f"></i>
			</a>
			<a href="#" class="header-youtube">
				<i class="fab fa-youtube"></i>
			</a>
			<a href="#" class="header-twitter">
				<i class="fab fa-twitter"></i>
			</a>
		</div>
		<div class="header-top-right">
			<a href="#" class="download-app">
				<span class="mr-1">@lang('smoney/homepage.download_App') </span>
				<i class="fas fa-download"></i>
			</a>
			<div class="multi-language">
				<div class="multi-language-select">
					<span class="mr-1">@lang('smoney/homepage.language')</span>
					<i class="fas fa-sort-down"></i>
				</div>
				<div class="multi-language-choose">
					<a href="{{ route('user.change-language',['vn']) }}">@lang('smoney/homepage.vietnamese')</a>
					<a href="{{ route('user.change-language',['eng']) }}">@lang('smoney/homepage.english')</a>
				</div>
			</div>
		</div>
	</div>
	<div class="header-buttom">
		<div class="header-buttom-left">
			<a href="{{ route('homepage.homepage_old') }}" id="header_logo">
				<img src="{{ asset('img-smoney/home-page/Group 484.png') }}" alt="">
			</a>
		</div>
		<div class="header-buttom-right">
			<a href="#" id="icon_home">
				<i class="fas fa-home"></i>
			</a>
			<ul id="header_menu">
				<li>
					<a href="#" id="link_introduce">@lang('smoney/homepage.introduce')</a>
				</li>
				<li class="menu_service">
					<span id="link_service">@lang('smoney/homepage.service') <i class="fas fa-sort-down"></i></span>
					<div class="more_service">
						<a href="#">@lang('smoney/homepage.loan_Support')</a>
						<a href="#">@lang('smoney/homepage.finance_Support')</a>
						<a href="#">@lang('smoney/homepage.job_Seeking')</a>
					</div>
				</li>
				<li>
					<a href="#" id="link_knowledge">@lang('smoney/homepage.knowledge')</a>
				</li>
				<li>
					<a href="{{ route('student.marketplace') }}" id="link_marketplace">Marketplace</a>
				</li>
			</ul>
			<a href="#" id="icon_search" data-toggle="modal" data-target="#modalSearch">
				<i class="fas fa-search"></i>
			</a>
			@if(isset($status) && $status == 'userLogged')
				<div id="user_logged">
					<div class="user_logged_content">
						@if($image)
							<div class="block-avatar">
								<img src="{{ asset($image) }}" alt="">
							</div>
						@else
							<div class="block-avatar">
								<img src="{{ asset('img-smoney/img-students/avatar-default.png') }}" alt="">
							</div>
						@endif
						<span class="mr-2 name-user">{{ $name }}</span>
						<span class="user_logged_content-icon">
							<i class="fas fa-sort-down"></i>
						</span>
					</div>
					<div class="user_logged_more">
						@if($type == "1")
							<a href="{{ route('student.student') }}" class="user_logged_more_link">@lang('smoney/homepage.personal_Page')</a>
						@elseif($type == "2")
							<a href="{{ route('schhool.schoolDashboard') }}" class="user_logged_more_link">Trang nh?? tr?????ng</a>
						@elseif($type == "3")
							<a href="{{ route('bank.bankDashboard') }}" class="user_logged_more_link">Trang ng??n h??ng</a>
						@elseif($type == "4")
							<a href="{{ route('admin.dashboard') }}" class="user_logged_more_link">Trang Admin</a>
						@endif
						<a href="{{ route('student.logout') }}" class="user_logged_more_link">@lang('smoney/homepage.logout')</a>
					</div>
				</div>
			@else
				<a href="{{ route('homepage.login') }}" id="header_login">
					@lang('smoney/homepage.login')
					<i class="fas fa-lock"></i>
				</a>
			@endif
		</div>
		
		<!-- responsive btn -->
		<div class="responsive-header">
			<div class="responsive-header-icon">
				<i class="fas fa-bars"></i>
			</div>
		</div>
	</div>
</div>
<!-- nav responsive -->
<div class="responsive-header-icon-content">
	<ul>
		<li class="li_res_link_login">
			@if(isset($status) && $status == 'userLogged')
				<a href="#" id="res_link_login">
					@if($image)
						<div class="res-block-avatar">
							<img src="{{ asset($image) }}" alt="">
						</div>
					@else
						<div class="res-block-avatar">
							<img src="{{ asset('img-smoney/img-students/avatar-default.png') }}" alt="">
						</div>
					@endif
					<span>{{ $name }}</span>
					<i class="fas fa-sort-down"></i>
				</a>
				<div class="res_more_login">
					<a href="{{ route('student.student') }}">@lang('smoney/homepage.personal_Page')</a>
					<a href="{{ route('student.logout') }}">@lang('smoney/homepage.logout')</a>
				</div>
			@else
				<a href="{{ route('homepage.login') }}" id="res_link_login">
					????ng nh???p
					<i class="fas fa-lock"></i>
				</a>
			@endif
		</li>
		<li>
			<a href="#" id="res_link_introduce">Gi???i thi???u</a>
		</li>
		<li class="li_res_link_service">
			<a href="#" id="res_link_service">
				D???ch v??? <i class="fas fa-sort-down"></i>
			</a>
			<div class="res_more_service">
				<a href="#">@lang('smoney/homepage.loan_Support')</a>
				<a href="#">@lang('smoney/homepage.finance_Support')</a>
				<a href="#">@lang('smoney/homepage.job_Seeking')</a>
			</div>
		</li>
		<li>
			<a href="#" id="res_link_knowledge">Ki???n th???c</a>
		</li>
		<li>
			<a href="{{ route('student.marketplace') }}" id="res_link_marketplace">Marketplace</a>
		</li>
		<li>
			<a href="#" id="res_link_search" data-toggle="modal" data-target="#modalSearch">
				T??m ki???m
				<i class="fas fa-search"></i>
			</a>
		</li>
	</ul>
</div>


<div class="banner_introduce" id="banner_introduce">
	<img src="{{ asset('img-smoney/home-page/Union.png') }}" alt="" class="for-pc">
	<img src="{{ asset('img-smoney/home-page/Union_3.jpg') }}" alt="" class="for-tablet">

	<div class="introduce_content profile wow fadeInLeft" data-wow-duration="3s">
		<h4>@lang('smoney/homepage.solution')</h4>
		<span>
			SMoney mang ?????n d???ch v??? t?? v???n v?? c??c gi???i ph??p t??i ch??nh ?????ng b???, h??? tr??? c??c b???n sinh vi??n th??o g??? nh???ng kh?? kh??n t??i ch??nh ??i???n h??nh trong cu???c s???ng (h???c ph??, sinh ho???t ph??, ti???p c???n c??c kho???n vay v?? d???ch v??? t??i ch??nh kh??c, ???), qua ???? n??ng cao hi???u qu??? h???c t???p, c???i thi???n ch???t l?????ng cu???c s???ng.
		</span>
		<div class="introduce_footer">
			<a href="{{ route('homepage.getRegister') }}" class="create_account">@lang('smoney/homepage.create_Account')</a>
			<div class="introduce_footer_icon">
				<i class="fab fa-apple"></i>
				<i class="fab fa-google-play"></i>
			</div>
		</div>
	</div>
</div>
<div class="section_definition" id="section_definition">
	<div class="definition_content wow fadeInLeft" data-wow-duration="3s">
		<h4>SMoney l?? g???</h4>
		<span class="content_one">
			SMoney l?? n???n t???ng c??ng ngh??? cung c???p d???ch v??? t?? v???n t??i ch??nh cho sinh vi??n. C??c th??nh vi??n s??? d???ng d???ch v??? SMoney s??? ???????c k???t n???i v?? t???o ??i???u ki???n ti???p c???n nh???ng g??i t??n d???ng h??? tr??? h???c ph??, sinh ho???t ph?? d??nh cho sinh vi??n d?????i s??? b???o tr??? c???a tr?????ng ?????i h???c sinh vi??n ??ang theo h???c. 
		</span>
		<span class="content_two">
			V???i m???ng l?????i li??n k???t ch???t ch??? v???i c??c t??? ch???c t??n d???ng uy t??n, c??c th??nh vi??n c???a SMoney s??? c?? c?? h???i ???????c h??? tr??? gi???i thi???u vi???c l??m v???i c??c nh?? tuy???n d???ng, ???????c h??? tr??? x??y d???ng h??? s?? t??n d???ng c?? nh??n t???i c??c ng??n h??ng v?? c??ng ty t??i ch??nh, ?????ng th???i nh???n ???????c th??ng tin v??? c??c ch??nh s??ch ??u ????i d??nh cho c??c s???n ph???m d???ch v??? ph???c v??? ?????i s???ng sinh vi??n (thu?? nh?? tr???, mua s???m m??y t??nh c?? nh??n,...)
		</span>
		<div class="definition_footer">
			<div class="try_it_now">D??ng th??? ngay</div>
		</div>
	</div>
	<div class="border_lightblue wow fadeInRight" data-wow-duration="3s">
		<div class="definition_img">
			<img src="{{ asset('img-smoney/home-page/Mask Group-2.png') }}" alt="">
		</div>
	</div>
	<img src="{{ asset('img-smoney/home-page/aa.png') }}" alt="" class="img_feature">
	<img src="{{ asset('img-smoney/home-page/aa_2.png') }}" alt="" class="img_feature_phone">
	<img src="{{ asset('img-smoney/home-page/aa_3.png') }}" alt="" class="img_feature_phone_big">
	<img src="{{ asset('img-smoney/home-page/aa_4.png') }}" alt="" class="img_feature_phone_small">
	<div class="small_icon">
		<img src="{{ asset('img-smoney/home-page/Frame_3.png') }}" alt="">
	</div>
	<!-- <img src="img-smoney/home-page/Mask Group-1.png" alt="" class="earth"> -->
	<img src="{{ asset('img-smoney/home-page/phone_1.png') }}" alt="" class="phone wow fadeInLeft" data-wow-duration="3s" id="feature_phone">
	<div class="salient_features profile wow fadeInRight" data-wow-duration="3s">
		<p class="features_title">
			T??nh n??ng n???i b???t
		</p>
		<ul>
			<li class="block_one">
				<img src="{{ asset('img-smoney/home-page/Group 10.png') }}" alt="">
				<span class="block-span">
					<p class="m-0 font-weight-bold block_title">????n gi???n - thu???n ti???n</p>
					<span class="font-italic">
						Quy tr??nh vay ???????c t???i ??u - ?????ng b??? gi??p cho vi???c ti???p c???n kh??c kho???n vay tr??? n??n ????n gi???n, nhanh ch??ng. 
					</span>
				</span>
			</li>
			<li class="block_two">
				<img src="{{ asset('img-smoney/home-page/Group 11.png') }}" alt="">
				<span class="block-span">
					<p class="m-0 font-weight-bold block_title">L??i su???t th???p</p>
					<span class="font-italic">
						Nh??? quy tr??nh ho???t ?????ng ????n gi???n, m???c l??i su???t ????a ra ???????c ????a ra ??? m???c ??u ????i h??n.
					</span>
				</span>
			</li>
			<li class="block_three">
				<img src="{{ asset('img-smoney/home-page/Group 12.png') }}" alt="">
				<span class="block-span">
					<p class="m-0 font-weight-bold block_title">H??? tr??? qu???n l?? t??i ch??nh</p>
					<span class="font-italic">
						Ng?????i d??ng ???????c ph??p s??? d???ng mi???n ph?? c??ng c??? qu???n l?? t??i ch??nh: l???p k??? ho???ch ti???t ki???m - tr??? n???, qu???n l?? d??ng ti???n, v.v.
					</span>
				</span>
			</li>
			<li class="block_four">
				<img src="{{ asset('img-smoney/home-page/Group 13.png') }}" alt="">
				<span class="block-span">
					<p class="m-0 font-weight-bold block_title">Ki???n th???c - Vi???c l??m - D???ch v???</p>
					<span class="font-italic">
						Theo d??i tin t???c, n??ng cao ki???n th???c, t??m ki???m kh??a h???c - vi???c l??m - ph??ng tr??? th??ng qua c??c n???n t???ng li??n k???t c???a Smoney.
					</span>
				</span>
			</li>
		</ul>
	</div>
	<div class="salient_features_footer">
		<ul>
			<li>
				<h4>
					<span id="text-member"></span>
					K+
				</h4>
				Active members
			</li>
			<li>
				<h4>
					<span id="text-banks"></span>
					+
				</h4>
				Banks
			</li>
			<li>
				<h4>
					<span id="text-university"></span>
					+</h4>
				Universities
			</li>
			<li>
				<h4>$
					<span id="text-process"></span>
					M+</h4>
				Processing
			</li>
			<li>
				<h4>
					<span id="text-job"></span>
					+</h4>
				Jobs
			</li>
		</ul>
	</div>
</div>
<div class="secction_using" id="secction_using">
	<div class="tick"></div>
	<div class="secction_using_title profile wow fadeInDown" data-wow-duration="3s">
		<h4>C??ch s??? d???ng SMoney</h4>
		<div class="secction_using_btn">
			<ul>
				<li>
					<a class="using_student using_selected" href="#">Sinh vi??n</a>
				</li>
				<li>
					<a class="using_university" href="#">Nh?? tr?????ng</a>
				</li>
				<li>
					<a class="using_bank" href="#">Ng??n h??ng</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="secction_using_content">
		<div class="using_content_left profile wow fadeInLeft" data-wow-duration="3s">
			<div class="left_img">
				<img src="{{ asset('img-smoney/home-page/cachsudung.jpg') }}" alt="">
			</div>
			<div class="left_content content_student">
				<p class="font-weight-bold mt-1 mb-0">T??m ki???m kho???n vay ph?? h???p</p>
				<span>
					T??m ki???m kho???n vay ph?? h???p v???i nhu c???u t??i ch??nh, kh??? n??ng tr??? n??? v?? l???ch s??? t??n d???ng c???a b???n ho??n to??n t??? ?????ng ch??? trong gi??y l??t
				</span>
				<p class="font-weight-bold mt-1 mb-0">Ho??n th??nh ????n ????ng k?? vay</p>
				<span>
					Khi s???n s??ng, h??y ho??n th??nh ????n ????ng k?? tr???c tuy???n c???a m??nh v???i s??? tr??? gi??p t??? c??c chuy??n gia t?? v???n cho vay c???a Smoney.
				</span>
				<p class="font-weight-bold mt-1 mb-0">Nh???n kho???n vay ???????c gi???i ng??n</p>
				<span>
					Ngay sau khi ho??n thi???n c??c th??? t???c c???n thi???t v?? ???????c ?????m b???o theo ????ng th??? t???c quy tr??nh, kho???n gi???i ng??n s??? ???????c nhanh ch??ng chuy???n v??o t??i kho???n c???a b???n.
				</span>
			</div>
			<div class="left_content content_university">
				<p class="font-weight-bold mt-1 mb-0">Cung c???p th??ng tin v??? sinh vi??n v?? c??c kho???n vay</p>
				<span>
					Cung c???p c??c th??ng tin c???n thi???t v??? c??c kho???n sinh vi??n c???n vay ????? x??c ?????nh nhu c???u c??ng nh?? c??c th??ng tin v??? SV ????ng k?? vay ????? l??m c??n c??? t??nh ??i???m t??n d???ng credit scoring.
				</span>
				<p class="font-weight-bold mt-1 mb-0">B???o ?????m c??c kho???n vay</p>
				<span>
					D???a tr??n ????n ????ng k?? vay c???a sinh vi??n, nh?? tr?????ng x??c nh???n b???o ?????m c??c kho???n vay s??? d???ng ????ng m???c ????ch
				</span>
				<p class="font-weight-bold mt-1 mb-0">Qu???n l?? kho???n vay</p>
				<span>
					Sau khi ????n ????ng k?? vay c???a sinh vi??n ???????c ph?? duy???t, kho???n vay gi???i ng??n s??? ???????c chuy???n v??o t??i kho???n c???a tr?????ng. Nh?? tr?????ng, c??n c??? v??o t??nh h??nh sinh vi??n, ????? gi???i ng??n c??c kho???n vay n??y cho sinh vi??n.
				</span>
			</div>
			<div class="left_content content_bank">
				<p class="font-weight-bold mt-1 mb-0">Ph?? duy???t kho???n vay</p>
				<span>
					C??n c??? v??o ????n ????ng k?? vay v?? ?????m b???o c???a Nh?? tr?????ng, xem x??t, ph?? duy???t c??c kho???n vay tr??n c?? s??? th??ng tin ????ng k?? v?? ??i???m ????nh gi?? t??n d???ng c?? nh??n do SMoney cung c???p.
				</span>
				<p class="font-weight-bold mt-1 mb-0">Gi???i ng??n kho???n vay</p>
				<span>
					Sau khi ph?? duy???t, Ng??n h??ng gi???i ng??n c??c kho???n vay v??o t??i kho???n c???a Nh?? tr?????ng.
				</span>
				<p class="font-weight-bold mt-1 mb-0">Theo d??i ngh??a v??? tr??? n???</p>
				<span>
					Theo d??i t??nh h??nh th???c hi???n ngh??a v??? tr??? n??? c???a Sinh vi??n theo c?? s??? d??? li???u c???a Smoney v?? th???c hi???n c??c nghi???p v???, h??? tr??? n???u c???n thi???t.
				</span>
			</div>
		</div>
		<div class="using_content_right profile wow fadeInRight" data-wow-duration="3s">
			<img src="{{ asset('img-smoney/home-page/right.jpg') }}" alt="">
		</div>
	</div>
</div>
<div class="secction_service" id="secction_service">
	<div class="tick"></div>
	<div class="service_title profile wow fadeInDown" data-wow-duration="3s">
		<h4>D???ch v???</h4>
	</div>
	<div class="service_content">
		<ul>
			<li class="profile wow fadeInUp" data-wow-duration="3s">
				<div class="service_content_block">
					<div class="service_menu_title">
						<i class="fas fa-hand-holding-usd"></i>
					</div>
					<div class="tick"></div>
					<p>H??? tr??? vay v???n</p>
					<span class="text-justify">H??? tr??? sinh vi??n ti???p c???n c??c kho???n t??n d???ng ph???c v??? m???c ????ch h???c t???p v?? ti??u d??ng.</span>
					<div class="service_content_more">
						<i class="fas fa-angle-double-right"></i>
					</div>
				</div>
			</li>
			<li class="profile wow fadeInDown" data-wow-duration="3s">
				<div class="service_content_block">
					<div class="service_menu_title">
						<i class="fas fa-hryvnia"></i>
					</div>
					<div class="tick"></div>
					<p>T?? v???n t??i ch??nh</p>
					<span class="text-justify">Sinh vi??n ???????c chuy??n gia t?? v???n l???p k??? ho???ch qu???n l?? t??i ch??nh c?? nh??n, ti???t ki???m, ?????u t??... t??y theo nhu c???u v?? m???c ti??u t??i ch??nh, t??nh tr???ng t??i ch??nh c???a t???ng c?? nh??n.</span>
					<div class="service_content_more">
						<i class="fas fa-angle-double-right"></i>
					</div>
				</div>
			</li>
			<li class="profile wow fadeInUp" data-wow-duration="3s">
				<div class="service_content_block">
					<div class="service_menu_title">
						<i class="far fa-clipboard"></i>
					</div>
					<div class="tick"></div>
					<p>T??m ki???m vi???c l??m</p>
					<span class="text-justify">C??c th??nh vi??n c?? c?? h???i ???????c ti???p x??c tr???c ti???p v???i c??c nh?? tuy???n d???ng ?????n t??? c??c t??? ch???c t??i ch??nh, doanh nghi???p trong m???ng l?????i ?????i t??c c???a SMoney.</span>
					<div class="service_content_more">
						<i class="fas fa-angle-double-right"></i>
					</div>
				</div>
			</li>
		</ul>
	</div>
	<div class="register_now profile wow fadeInDown" data-wow-duration="3s">
		<div class="register_now_btn">????ng k?? d???ch v??? ngay</div>
	</div>
</div>
<div class="secction_knowledge" id="secction_knowledge">
	<div class="tick"></div>
	<div class="knowledge_title profile wow fadeInDown" data-wow-duration="3s">
		<h4>Ki???n th???c h???u ??ch</h4>
	</div>
	<div class="container-fuild knowledge_content">
		<div class="row">
			<div class="col-md-4 col-sm-6 col-12 profile wow fadeInLeft" data-wow-duration="3s">
				<a href="https://www.pronexus.com.vn/tt/thu-vien/cong-viec-cua-co-van-tai-chinh-la-gi"
				target="_blank" class="knowledge_content_block knowledge_block_1">
					<img src="{{ asset('img-smoney/home-page/kienthuc_1.png') }}" alt="">
					<p title="C??ng vi???c c???a C??? v???n t??i ch??nh l?? g???">C??ng vi???c c???a C??? v???n t??i ch??nh l?? g???</p>
					<span>12-04-2021</span>
				</a>
			</div>
			<div class="col-md-4 col-sm-6 col-12 profile wow fadeInLeft" data-wow-duration="2s">
				<a href="https://www.pronexus.com.vn/tt/chi-tieu/lam-the-nao-de-thiet-lap-va-dat-duoc-muc-tieu-tai-chinh-trong-nam-2021" target="_blank" class="knowledge_content_block knowledge_block_2">
					<img src="{{ asset('img-smoney/home-page/kienthuc_2.png') }}" alt="">
					<p title="L??m th??? n??o ????? thi???t l???p v?? ?????t ???????c m???c ti??u t??i ch??nh trong n??m 2021">L??m th??? n??o ????? thi???t l???p v?? ?????t ???????c m???c ti??u t??i ch??nh trong n??m 2021</p>
					<span>19-02-2021</span>
				</a>
			</div>
			<div class="col-md-4 col-sm-6 col-12 profile wow fadeInLeft" data-wow-duration="1s">
				<a href="https://www.pronexus.com.vn/tt/tai-chinh-ca-nhan/huong-dan-lap-bao-cao-tai-chinh-ca-nhan-day-du-nhat" target="_blank" class="knowledge_content_block knowledge_block_3">
					<img src="{{ asset('img-smoney/home-page/kienthuc_1.png') }}" alt="">
					<p title="H?????ng d???n l???p b??o c??o t??i ch??nh c?? nh??n ?????y ????? nh???t">H?????ng d???n l???p b??o c??o t??i ch??nh c?? nh??n ?????y ????? nh???t</p>
					<span>02-12-2020</span>
				</a>
			</div>
			<div class="col-md-4 col-sm-6 col-12 profile wow fadeInLeft" data-wow-duration="3s">
				<a href="https://www.pronexus.com.vn/tt/lap-ngan-sach/danh-sach-20-hang-muc-pho-bien-nhat-trong-ngan-sach-tai-chinh-gia-dinh" target="_blank" class="knowledge_content_block knowledge_block_4">
					<img src="{{ asset('img-smoney/home-page/kienthuc_2.png') }}" alt="">
					<p title="Danh s??ch 20 h???ng m???c ph??? bi???n nh???t trong ng??n s??ch t??i ch??nh gia ????nh">Danh s??ch 20 h???ng m???c ph??? bi???n nh???t trong ng??n s??ch t??i ch??nh gia ????nh</p>
					<span>02-12-2020</span>
				</a>
			</div>
			<div class="col-md-4 col-sm-6 col-12 profile wow fadeInLeft" data-wow-duration="2s">
				<a href="https://www.pronexus.com.vn/tt/tai-chinh-ca-nhan/50-loi-khuyen-ve-tai-chinh-ca-nhan-se-giup-ban-thay-doi-cach-nghi-ve-tien-bac" target="_blank" class="knowledge_content_block knowledge_block_5">
					<img src="{{ asset('img-smoney/home-page/kienthuc_1.png') }}" alt="">
					<p title="50 l???i khuy??n v??? t??i ch??nh c?? nh??n s??? gi??p b???n thay ?????i c??ch ngh?? v??? ti???n b???c">50 l???i khuy??n v??? t??i ch??nh c?? nh??n s??? gi??p b???n thay ?????i c??ch ngh?? v??? ti???n b???c</p>
					<span>02-12-2020</span>
				</a>
			</div>
			<div class="col-md-4 col-sm-6 col-12 profile wow fadeInLeft" data-wow-duration="1s">
				<a href="https://www.pronexus.com.vn/tt/lap-ngan-sach/5-danh-muc-thiet-yeu-nhat-trong-gia-dinh-can-lap-ngan-sach-co-the-ban-da-bo-qua" target="_blank" class="knowledge_content_block knowledge_block_6">
					<img src="{{ asset('img-smoney/home-page/kienthuc_2.png') }}" alt="">
					<p title="5 danh m???c thi???t y???u nh???t trong gia ????nh c???n l???p ng??n s??ch c?? th??? b???n ???? b??? qua">5 danh m???c thi???t y???u nh???t trong gia ????nh c???n l???p ng??n s??ch c?? th??? b???n ???? b??? qua</p>
					<span>02-12-2020</span>
				</a>
			</div>
		</div>
	</div>
	<a href="#" class="showmore_knowledge">
		Xem th??m <i class="fas fa-long-arrow-alt-right"></i>
	</a>
</div>
<div class="back_to_top" id="backtotop_btn">
	<i class="fas fa-angle-up"></i>
</div>

<!-- Modal -->
<div class="modal fade" id="modalSearch" tabindex="-1" role="dialog" aria-labelledby="modalSearchLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="modalSearchLabel">T??m ki???m</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body">
        		<form action="" method="post">
        			@csrf
        			<div class="form-group">
        				<label for="input-search">T??? kh??a</label>
        				<input type="text" name="keyword" id="input-search" class="form-control" placeholder="T??? kh??a">
        			</div>
        		</form>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">????ng</button>
        		<button type="button" class="btn btn-primary">T??m ki???m</button>
      		</div>
		</div>
  	</div>
</div>
@stop



@section('footer-js')
<script src="{{ asset('js/headroom.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/Smoney/Homepage/index.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/frontend/jquery.circliful.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/wow/js/wow.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/frontend/carousel.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/frontend/index.js') }}"></script>


<script>
	window.addEventListener("scroll", function() {
		var numberRunElement = document.querySelector(".img_feature");
		if (window.scrollY > (parseFloat(numberRunElement.offsetTop) )) {
			animateValue("text-member", 0, 300, 4000);
			animateValue("text-banks", 0, 50, 4000);
			animateValue("text-university", 0, 200, 4000);
			animateValue("text-process", 0, 200, 4000);
			animateValue("text-job", 0, 2000, 500);
		}
	});
</script>
@stop