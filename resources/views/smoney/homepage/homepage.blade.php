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
				<span class="mr-1">Tải App </span>
				<i class="fas fa-download"></i>
			</a>
			<div class="multi-language">
				<div class="multi-language-select">
					<span class="mr-1">Tiếng Việt</span>
					<i class="fas fa-sort-down"></i>
				</div>
				<div class="multi-language-choose">
					<a href="#">Tiếng Việt</a>
					<a href="#">Tiếng Anh</a>
				</div>
			</div>
		</div>
	</div>
	<div class="header-buttom">
		<div class="header-buttom-left">
			<a href="#" id="header_logo">
				<img src="{{ asset('img-smoney/home-page/Group 484.png') }}" alt="">
			</a>
		</div>
		<div class="header-buttom-right">
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
						<a href="#">Hỗ trợ vay vốn</a>
						<a href="#">Tư vấn tài chính</a>
						<a href="#">Tìm kiếm việc làm</a>
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
						<a href="{{ route('student.student') }}" class="user_logged_more_link">Trang cá nhân</a>
						<a href="{{ route('student.logout') }}" class="user_logged_more_link">Đăng xuất</a>
					</div>
				</div>
			@else
				<a href="{{ route('homepage.login') }}" id="header_login">
					Đăng nhập
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
			@if(isset($status) && $status == 'userLogged')
				<a href="{{ route('homepage.login') }}" id="res_link_login">
					{{ $name }}
					<i class="fas fa-lock"></i>
				</a>
			@else
				<a href="{{ route('homepage.login') }}" id="res_link_login">
					Đăng nhập
					<i class="fas fa-lock"></i>
				</a>
			@endif
		</li>
	</ul>
</div>


<div class="banner_introduce" id="banner_introduce">
	<img src="{{ asset('img-smoney/home-page/Union.png') }}" alt="" class="for-pc">
	<img src="{{ asset('img-smoney/home-page/Union_3.jpg') }}" alt="" class="for-tablet">

	<div class="introduce_content profile wow fadeInLeft" data-wow-duration="3s">
		<h4>Giải pháp tài chính tối ưu cho sinh viên</h4>
		<span>
			SMoney mang đến dịch vụ tư vấn và các giải pháp tài chính đồng bộ, hỗ trợ các bạn sinh viên tháo gỡ những khó khăn tài chính điển hình trong cuộc sống (học phí, sinh hoạt phí, tiếp cận các khoản vay và dịch vụ tài chính khác, …), qua đó nâng cao hiệu quả học tập, cải thiện chất lượng cuộc sống.
		</span>
		<div class="introduce_footer">
			<div class="create_account">Tạo tài khoản</div>
			<div class="introduce_footer_icon">
				<i class="fab fa-apple"></i>
				<i class="fab fa-google-play"></i>
			</div>
		</div>
	</div>
</div>
<div class="section_definition" id="section_definition">
	<div class="definition_content wow fadeInLeft" data-wow-duration="3s">
		<h4>SMoney là gì?</h4>
		<span class="content_one">
			SMoney là nền tảng công nghệ cung cấp dịch vụ tư vấn tài chính cho sinh viên. Các thành viên sử dụng dịch vụ SMoney sẽ được kết nối và tạo điều kiện tiếp cận những gói tín dụng hỗ trợ học phí, sinh hoạt phí dành cho sinh viên dưới sự bảo trợ của trường đại học sinh viên đang theo học. 
		</span>
		<span class="content_two">
			Với mạng lưới liên kết chặt chẽ với các tổ chức tín dụng uy tín, các thành viên của SMoney sẽ có cơ hội được hỗ trợ giới thiệu việc làm với các nhà tuyển dụng, được hỗ trợ xây dựng hồ sơ tín dụng cá nhân tại các ngân hàng và công ty tài chính, đồng thời nhận được thông tin về các chính sách ưu đãi dành cho các sản phẩm dịch vụ phục vụ đời sống sinh viên (thuê nhà trọ, mua sắm máy tính cá nhân,...)
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
				<span>
					<p class="m-0 font-weight-bold block_title">Đơn giản - thuận tiện</p>
					<span class="font-italic">
						Quy trình vay được tối ưu - đồng bộ giúp cho việc tiếp cận khác khoản vay trở nên đơn giản, nhanh chóng. 
					</span>
				</span>
			</li>
			<li class="block_two">
				<img src="{{ asset('img-smoney/home-page/Group 11.png') }}" alt="">
				<span>
					<p class="m-0 font-weight-bold block_title">Lãi suất thấp</p>
					<span class="font-italic">
						Nhờ quy trình hoạt động đơn giản, mức lãi suất đưa ra được đưa ra ở mức ưu đãi hơn.
					</span>
				</span>
			</li>
			<li class="block_three">
				<img src="{{ asset('img-smoney/home-page/Group 12.png') }}" alt="">
				<span>
					<p class="m-0 font-weight-bold block_title">Hỗ trợ quản lý tài chính</p>
					<span class="font-italic">
						Người dùng được phép sử dụng miễn phí công cụ quản lý tài chính: lập kế hoạch tiết kiệm - trả nợ, quản lý dòng tiền, v.v.
					</span>
				</span>
			</li>
			<li class="block_four">
				<img src="{{ asset('img-smoney/home-page/Group 13.png') }}" alt="">
				<span>
					<p class="m-0 font-weight-bold block_title">Kiến thức - Việc làm - Dịch vụ</p>
					<span class="font-italic">
						Theo dõi tin tức, nâng cao kiến thức, tìm kiếm khóa học - việc làm - phòng trọ thông qua các nền tảng liên kết của Smoney.
					</span>
				</span>
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
					<a class="using_student using_selected" href="#">Sinh viên</a>
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
			<div class="left_content content_student">
				<p class="font-weight-bold mt-1 mb-0">Tìm kiếm khoản vay phù hợp</p>
				<span>
					Tìm kiếm khoản vay phù hợp với nhu cầu tài chính, khả năng trả nợ và lịch sử tín dụng của bạn hoàn toàn tự động chỉ trong giây lát
				</span>
				<p class="font-weight-bold mt-1 mb-0">Hoàn thành đơn đăng ký vay</p>
				<span>
					Khi sẵn sàng, hãy hoàn thành đơn đăng ký trực tuyến của mình với sự trợ giúp từ các chuyên gia tư vấn cho vay của Smoney.
				</span>
				<p class="font-weight-bold mt-1 mb-0">Nhận khoản vay được giải ngân</p>
				<span>
					Ngay sau khi hoàn thiện các thủ tục cần thiết và được đảm bảo theo đúng thủ tục quy trình, khoản giải ngân sẽ được nhanh chóng chuyển vào tài khoản của bạn.
				</span>
			</div>
			<div class="left_content content_university">
				<p class="font-weight-bold mt-1 mb-0">Cung cấp thông tin về sinh viên và các khoản vay</p>
				<span>
					Cung cấp các thông tin cần thiết về các khoản sinh viên cần vay để xác định nhu cầu cũng như các thông tin về SV đăng ký vay để làm căn cứ tính điểm tín dụng credit scoring.
				</span>
				<p class="font-weight-bold mt-1 mb-0">Bảo đảm các khoản vay</p>
				<span>
					Dựa trên đơn đăng ký vay của sinh viên, nhà trường xác nhận bảo đảm các khoản vay sử dụng đúng mục đích
				</span>
				<p class="font-weight-bold mt-1 mb-0">Quản lý khoản vay</p>
				<span>
					Sau khi đơn đăng ký vay của sinh viên được phê duyệt, khoản vay giải ngân sẽ được chuyển vào tài khoản của trường. Nhà trường, căn cứ vào tình hình sinh viên, để giải ngân các khoản vay này cho sinh viên.
				</span>
			</div>
			<div class="left_content content_bank">
				<p class="font-weight-bold mt-1 mb-0">Phê duyệt khoản vay</p>
				<span>
					Căn cứ vào đơn đăng ký vay và đảm bảo của Nhà trường, xem xét, phê duyệt các khoản vay trên cơ sở thông tin đăng ký và điểm đánh giá tín dụng cá nhân do SMoney cung cấp.
				</span>
				<p class="font-weight-bold mt-1 mb-0">Giải ngân khoản vay</p>
				<span>
					Sau khi phê duyệt, Ngân hàng giải ngân các khoản vay vào tài khoản của Nhà trường.
				</span>
				<p class="font-weight-bold mt-1 mb-0">Theo dõi nghĩa vụ trả nợ</p>
				<span>
					Theo dõi tình hình thực hiện nghĩa vụ trả nợ của Sinh viên theo cơ sở dữ liệu của Smoney và thực hiện các nghiệp vụ, hỗ trợ nếu cần thiết.
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
					<span class="text-justify">Hỗ trợ sinh viên tiếp cận các khoản tín dụng phục vụ mục đích học tập và tiêu dùng.</span>
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
					<span class="text-justify">Sinh viên được chuyên gia tư vấn lập kế hoạch quản lý tài chính cá nhân, tiết kiệm, đầu tư... tùy theo nhu cầu và mục tiêu tài chính, tình trạng tài chính của từng cá nhân.</span>
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
					<span class="text-justify">Các thành viên có cơ hội được tiếp xúc trực tiếp với các nhà tuyển dụng đến từ các tổ chức tài chính, doanh nghiệp trong mạng lưới đối tác của SMoney.</span>
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
				<a href="https://www.pronexus.com.vn/tt/thu-vien/cong-viec-cua-co-van-tai-chinh-la-gi"
				target="_blank" class="knowledge_content_block knowledge_block_1">
					<img src="{{ asset('img-smoney/home-page/kienthuc_1.png') }}" alt="">
					<p title="Công việc của Cố vấn tài chính là gì?">Công việc của Cố vấn tài chính là gì?</p>
					<span>12-04-2021</span>
				</a>
			</div>
			<div class="col-md-4 col-sm-6 col-12 profile wow fadeInLeft" data-wow-duration="2s">
				<a href="https://www.pronexus.com.vn/tt/chi-tieu/lam-the-nao-de-thiet-lap-va-dat-duoc-muc-tieu-tai-chinh-trong-nam-2021" target="_blank" class="knowledge_content_block knowledge_block_2">
					<img src="{{ asset('img-smoney/home-page/kienthuc_2.png') }}" alt="">
					<p title="Làm thế nào để thiết lập và đạt được mục tiêu tài chính trong năm 2021">Làm thế nào để thiết lập và đạt được mục tiêu tài chính trong năm 2021</p>
					<span>19-02-2021</span>
				</a>
			</div>
			<div class="col-md-4 col-sm-6 col-12 profile wow fadeInLeft" data-wow-duration="1s">
				<a href="https://www.pronexus.com.vn/tt/tai-chinh-ca-nhan/huong-dan-lap-bao-cao-tai-chinh-ca-nhan-day-du-nhat" target="_blank" class="knowledge_content_block knowledge_block_3">
					<img src="{{ asset('img-smoney/home-page/kienthuc_1.png') }}" alt="">
					<p title="Hướng dẫn lập báo cáo tài chính cá nhân đầy đủ nhất">Hướng dẫn lập báo cáo tài chính cá nhân đầy đủ nhất</p>
					<span>02-12-2020</span>
				</a>
			</div>
			<div class="col-md-4 col-sm-6 col-12 profile wow fadeInLeft" data-wow-duration="3s">
				<a href="https://www.pronexus.com.vn/tt/lap-ngan-sach/danh-sach-20-hang-muc-pho-bien-nhat-trong-ngan-sach-tai-chinh-gia-dinh" target="_blank" class="knowledge_content_block knowledge_block_4">
					<img src="{{ asset('img-smoney/home-page/kienthuc_2.png') }}" alt="">
					<p title="Danh sách 20 hạng mục phổ biến nhất trong ngân sách tài chính gia đình">Danh sách 20 hạng mục phổ biến nhất trong ngân sách tài chính gia đình</p>
					<span>02-12-2020</span>
				</a>
			</div>
			<div class="col-md-4 col-sm-6 col-12 profile wow fadeInLeft" data-wow-duration="2s">
				<a href="https://www.pronexus.com.vn/tt/tai-chinh-ca-nhan/50-loi-khuyen-ve-tai-chinh-ca-nhan-se-giup-ban-thay-doi-cach-nghi-ve-tien-bac" target="_blank" class="knowledge_content_block knowledge_block_5">
					<img src="{{ asset('img-smoney/home-page/kienthuc_1.png') }}" alt="">
					<p title="50 lời khuyên về tài chính cá nhân sẽ giúp bạn thay đổi cách nghĩ về tiền bạc">50 lời khuyên về tài chính cá nhân sẽ giúp bạn thay đổi cách nghĩ về tiền bạc</p>
					<span>02-12-2020</span>
				</a>
			</div>
			<div class="col-md-4 col-sm-6 col-12 profile wow fadeInLeft" data-wow-duration="1s">
				<a href="https://www.pronexus.com.vn/tt/lap-ngan-sach/5-danh-muc-thiet-yeu-nhat-trong-gia-dinh-can-lap-ngan-sach-co-the-ban-da-bo-qua" target="_blank" class="knowledge_content_block knowledge_block_6">
					<img src="{{ asset('img-smoney/home-page/kienthuc_2.png') }}" alt="">
					<p title="5 danh mục thiết yếu nhất trong gia đình cần lập ngân sách có thể bạn đã bỏ qua">5 danh mục thiết yếu nhất trong gia đình cần lập ngân sách có thể bạn đã bỏ qua</p>
					<span>02-12-2020</span>
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