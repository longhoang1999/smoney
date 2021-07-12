<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="{{ asset('fontawesome-free-5.14.0-web/css/all.css') }}">
	
    <link rel="shortcut icon" href="{{ asset('img-smoney/smoney.png') }}">

	<link rel="stylesheet" href="{{ asset('css/Smoney/Homepage/footer.css') }}">
	<title>
		@section('title')
            | Smoney
        @show
	</title>
	<style>
		@font-face {
  			font-family: smoneyFont;
  			src: url("{{ asset('font/AvertaStdCY_Regular_3.otf')  }}");
		}
		body,div, span, a, p ,h1, h2, h3, h4, h5, h6, li{
  			font-family: smoneyFont !important;
		}
	</style>
	<!--page level css-->
  	@yield('header_styles')
  	<!--end of page level css-->

</head>
<body>
    
    @yield('content')

	@include('smoney/homepage/layouts/footer')
	<!-- js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    @yield('footer-js')

</body>
</html>