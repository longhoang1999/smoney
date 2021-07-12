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
	<a href="#" id="header_logo">
		<img src="{{ asset('img-smoney/home-page/Group 484.png') }}" alt="">
	</a>
	<a href="#" id="icon_home">
		<i class="fas fa-home"></i>
	</a>
	<ul id="header_menu">
		<li>
			<a href="#" id="link_introduce">Giới thiệu</a>
		</li>
		<li class="menu_service">
			<span id="link_service">Dịch vụ <i class="fas fa-sort-down"></i></span>
			<div class="more_service">
				<a href="#">Example 1</a>
				<a href="#">Example 2</a>
				<a href="#">Example 3</a>
				<a href="#">Example 4</a>
			</div>
		</li>
		<li>
			<a href="#" id="link_knowledge">Kiến thức</a>
		</li>
		<li>
			<a href="#" id="link_marketplace">Marketplace</a>
		</li>
	</ul>
	<a href="#" id="icon_search">
		<i class="fas fa-search"></i>
	</a>
	<a href="#" id="download_app">
		Tải app
		<i class="fas fa-download"></i>
	</a>
	<a href="{{ route('homepage.login') }}" id="header_login">
		Đăng nhập
		<i class="fas fa-lock"></i>
	</a>
	<div class="responsive-header">
		<div class="responsive-header-icon">
			<i class="fas fa-bars"></i>
		</div>
		
	</div>
</div>
<!-- nav responsive -->
<div class="responsive-header-icon-content">
	<ul>
		<li>
			<a href="#" id="res_link_introduce">Giới thiệu</a>
		</li>
		<li class="li_res_link_service">
			<a href="#" id="res_link_service">
				Dịch vụ <i class="fas fa-sort-down"></i>
			</a>
			<div class="res_more_service">
				<a href="#">Example 1</a>
				<a href="#">Example 2</a>
				<a href="#">Example 3</a>
				<a href="#">Example 4</a>
			</div>
		</li>
		<li>
			<a href="#" id="res_link_knowledge">Kiến thức</a>
		</li>
		<li>
			<a href="#" id="res_link_marketplace">Marketplace</a>
		</li>
		<li>
			<a href="#" id="res_link_search">
				Tìm kiếm
				<i class="fas fa-search"></i>
			</a>
		</li>
		<li>
			<a href="#" id="res_link_download">
				Tải app
				<i class="fas fa-download"></i>
			</a>
		</li>
		<li>
			<a href="{{ route('student.student') }}" id="res_link_login">
				Đăng nhập
				<i class="fas fa-lock"></i>
			</a>
		</li>
	</ul>
</div>


<div class="banner_introduce" id="banner_introduce">
	<img src="{{ asset('img-smoney/home-page/Union.png') }}" alt="" class="for-pc">
	<img src="{{ asset('img-smoney/home-page/Union_3.jpg') }}" alt="" class="for-tablet">

	<div class="introduce_content profile wow fadeInLeft" data-wow-duration="3s">
		<h4>Giải pháp tài chính tối ưu cho sinh viên</h4>
		<span>
			Ut aliquam, dui vitae tempor rutrum, ipsum eros dictum massa, sed consequat sapien sapien quis lacus. Aenean quis dictum massa, vitae gravida neque. In nec hendrerit erat.
		</span>
		<div class="introduce_footer">
			<div class="create_account">Tạo tài khoản</div>
			<div class="introduce_footer_icon">
				<i class="fab fa-apple"></i>
				<i class="fab fa-google-play"></i>
			</div>
		</div>
	</div>
	<!-- <div class="introduce_image">
		<img src="img-smoney/home-page/Ellipse 2.png" alt="">
		<img src="img-smoney/home-page/Ellipse 2-1.png" alt="">
		<img src="img-smoney/home-page/nguoi.png" alt="">
	</div> -->
</div>
<div class="section_definition" id="section_definition">
	<div class="definition_content wow fadeInLeft" data-wow-duration="3s">
		<h4>SMoney là gì?</h4>
		<span class="content_one">
			Donec hendrerit et enim vel gravida. Nam in eros sed massa dignissim vehicula. Duis laoreet at tortor vitae laoreet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras a nibh placerat, eleifend nunc ut, interdum orci.
		</span>
		<span class="content_two">
			Pellentesque vel sem et turpis maximus luctus. Quisque aliquet dui nec vehicula bibendum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi sodales aliquet dignissim. Nulla porta mi vulputate bibendum imperdiet. Mauris nec tincidunt lacus. Aliquam cursus augue lectus, in vestibulum tortor congue vitae.
		</span>
		<div class="definition_footer">
			<div class="try_it_now">Dùng thử ngay</div>
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
			Tính năng nổi bật
		</p>
		<ul>
			<li class="block_one">
				<img src="{{ asset('img-smoney/home-page/Group 10.png') }}" alt="">
				<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ut libero efficitur, feugiat metus vitae, ullamcorper sem.</span>
			</li>
			<li class="block_two">
				<img src="{{ asset('img-smoney/home-page/Group 11.png') }}" alt="">
				<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ut libero efficitur, feugiat metus vitae, ullamcorper sem.</span>
			</li>
			<li class="block_three">
				<img src="{{ asset('img-smoney/home-page/Group 12.png') }}" alt="">
				<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ut libero efficitur, feugiat metus vitae, ullamcorper sem.</span>
			</li>
			<li class="block_four">
				<img src="{{ asset('img-smoney/home-page/Group 13.png') }}" alt="">
				<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ut libero efficitur, feugiat metus vitae, ullamcorper sem.</span>
			</li>
		</ul>
	</div>
	<div class="salient_features_footer">
		<ul>
			<li>
				<h4>300K+</h4>
				Active members
			</li>
			<li>
				<h4>50+</h4>
				Banks
			</li>
			<li>
				<h4>200+</h4>
				Universities
			</li>
			<li>
				<h4>$200M+</h4>
				Processing
			</li>
			<li>
				<h4>2000+</h4>
				Jobs
			</li>
		</ul>
	</div>
</div>
<div class="secction_using" id="secction_using">
	<div class="tick"></div>
	<div class="secction_using_title profile wow fadeInDown" data-wow-duration="3s">
		<h4>Cách sử dụng SMoney</h4>
		<div class="secction_using_btn">
			<ul>
				<li>
					<a class="using_student" href="#">Sinh viên</a>
				</li>
				<li>
					<a class="using_university" href="#">Nhà trường</a>
				</li>
				<li>
					<a class="using_bank" href="#">Ngân hàng</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="secction_using_content">
		<div class="using_content_left profile wow fadeInLeft" data-wow-duration="3s">
			<div class="left_img">
				<img src="{{ asset('img-smoney/home-page/cachsudung.jpg') }}" alt="">
			</div>
			<div class="left_content">
				<span>
				Donec hendrerit et enim vel gravida. Nam in eros sed massa dignissim vehicula. Duis laoreet at tortor vitae laoreet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras a nibh placerat, eleifend nunc ut, interdum orci.
				</span>
				<span>
					Pellentesque vel sem et turpis maximus luctus. Quisque aliquet dui nec vehicula bibendum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi sodales aliquet dignissim.
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
		<h4>Dịch vụ</h4>
	</div>
	<div class="service_content">
		<ul>
			<li class="profile wow fadeInUp" data-wow-duration="3s">
				<div class="service_content_block">
					<div class="service_menu_title">
						<i class="fas fa-hand-holding-usd"></i>
					</div>
					<div class="tick"></div>
					<p>Hỗ trợ vay vốn</p>
					<span>Integer eleifend pharetra aliquam. Vivamus pulvinar, felis eu ornare sodales, diam justo vestibulum nunc, ac porta urna.</span>
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
					<p>Tư vấn tài chính</p>
					<span>Integer eleifend pharetra aliquam. Vivamus pulvinar, felis eu ornare sodales, diam justo vestibulum nunc, ac porta urna.</span>
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
					<p>Tìm kiếm việc làm</p>
					<span>Integer eleifend pharetra aliquam. Vivamus pulvinar, felis eu ornare sodales, diam justo vestibulum nunc, ac porta urna.</span>
					<div class="service_content_more">
						<i class="fas fa-angle-double-right"></i>
					</div>
				</div>
			</li>
		</ul>
	</div>
	<div class="register_now profile wow fadeInDown" data-wow-duration="3s">
		<div class="register_now_btn">Đăng ký dịch vụ ngay</div>
	</div>
</div>
<div class="secction_knowledge" id="secction_knowledge">
	<div class="tick"></div>
	<div class="knowledge_title profile wow fadeInDown" data-wow-duration="3s">
		<h4>Kiến thức hữu ích</h4>
	</div>
	<div class="container-fuild knowledge_content">
		<div class="row">
			<div class="col-md-4 col-sm-6 col-12 profile wow fadeInLeft" data-wow-duration="3s">
				<a href="#" class="knowledge_content_block knowledge_block_1">
					<img src="{{ asset('img-smoney/home-page/kienthuc_1.png') }}" alt="">
					<p>Quisque sed urna semper, fermentum lorem sit amet, placerat mi.</p>
					<span>Oct 5, 2020</span>
				</a>
			</div>
			<div class="col-md-4 col-sm-6 col-12 profile wow fadeInLeft" data-wow-duration="2s">
				<a href="#" class="knowledge_content_block knowledge_block_2">
					<img src="{{ asset('img-smoney/home-page/kienthuc_2.png') }}" alt="">
					<p>Quisque sed urna semper, fermentum lorem sit amet, placerat mi.</p>
					<span>Oct 5, 2020</span>
				</a>
			</div>
			<div class="col-md-4 col-sm-6 col-12 profile wow fadeInLeft" data-wow-duration="1s">
				<a href="#" class="knowledge_content_block knowledge_block_3">
					<img src="{{ asset('img-smoney/home-page/kienthuc_1.png') }}" alt="">
					<p>Quisque sed urna semper, fermentum lorem sit amet, placerat mi.</p>
					<span>Oct 5, 2020</span>
				</a>
			</div>
			<div class="col-md-4 col-sm-6 col-12 profile wow fadeInLeft" data-wow-duration="3s">
				<a href="#" class="knowledge_content_block knowledge_block_4">
					<img src="{{ asset('img-smoney/home-page/kienthuc_2.png') }}" alt="">
					<p>Quisque sed urna semper, fermentum lorem sit amet, placerat mi.</p>
					<span>Oct 5, 2020</span>
				</a>
			</div>
			<div class="col-md-4 col-sm-6 col-12 profile wow fadeInLeft" data-wow-duration="2s">
				<a href="#" class="knowledge_content_block knowledge_block_5">
					<img src="{{ asset('img-smoney/home-page/kienthuc_1.png') }}" alt="">
					<p>Quisque sed urna semper, fermentum lorem sit amet, placerat mi.</p>
					<span>Oct 5, 2020</span>
				</a>
			</div>
			<div class="col-md-4 col-sm-6 col-12 profile wow fadeInLeft" data-wow-duration="1s">
				<a href="#" class="knowledge_content_block knowledge_block_6">
					<img src="{{ asset('img-smoney/home-page/kienthuc_2.png') }}" alt="">
					<p>Quisque sed urna semper, fermentum lorem sit amet, placerat mi.</p>
					<span>Oct 5, 2020</span>
				</a>
			</div>
		</div>
	</div>
	<a href="#" class="showmore_knowledge">
		Xem thêm <i class="fas fa-long-arrow-alt-right"></i>
	</a>
</div>
<div class="back_to_top" id="backtotop_btn">
	<i class="fas fa-angle-up"></i>
</div>
@stop



@section('footer-js')
<script type="text/javascript" src="{{ asset('js/Smoney/Homepage/index.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/frontend/jquery.circliful.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/wow/js/wow.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/frontend/carousel.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/frontend/index.js') }}"></script>
@stop