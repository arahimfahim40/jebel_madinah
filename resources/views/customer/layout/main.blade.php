<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from big-bang-studio.com/neptune/neptune-default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Jan 2017 10:20:07 GMT -->

<head>
	<!-- Meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="{{ asset('img/logo-small.png') }}" />

	<!-- Title -->
	<title>@yield('title')</title>
	<!-- Vendor CSS -->
	<link rel="stylesheet" href="{{asset('assets/bootstrap4/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/themify-icons/themify-icons.css')}}">
	<link rel="stylesheet" href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/animate.css/animate.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/jscrollpane/jquery.jscrollpane.css')}}">
	<link rel="stylesheet" href="{{asset('assets/waves/waves.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/switchery/dist/switchery.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/morris/morris.css')}}">
	<link rel="stylesheet" href="{{asset('assets/jvectormap/jquery-jvectormap-2.0.3.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom-style.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/core.css')}}">


	<style type="text/css">
		div.dataTables_filter label {
			margin-left: 10px;
		}

		div.dataTables_wrapper div.dt-buttons {
			margin-top: 12px;
			float: right !important;
		}

		table.dataTable thead th.sorting:after {
			display: none;
		}
	</style>
	@stack('style')
</head>

<body class="fixed-sidebar fixed-header skin-default content-appear">
	<div class="wrapper">
		<!-- Preloader -->
		<div class="preloader"></div>
		<!-- Sidebar -->
		<div class="site-overlay"></div>
		
		<!-- Header -->
        @include('customer.layout.sidebar')
        @include('customer.layout.header')

		@yield('content')

	</div>

	<!-- Vendor JS -->
	<script type="text/javascript" src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/jquery-plugin/tableHTMLExport.js')}}"></script>

	<script type="text/javascript" src="{{asset('assets/tether/js/tether.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/bootstrap4/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/detectmobilebrowser/detectmobilebrowser.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/jscrollpane/jquery.mousewheel.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/jscrollpane/mwheelIntent.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/jscrollpane/jquery.jscrollpane.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/jquery-fullscreen-plugin/jquery.fullscreen-min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/waves/waves.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/switchery/dist/switchery.min.js')}}"></script>
	
	<script type="text/javascript" src="{{asset('assets/TinyColor/tinycolor.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/sparkline/jquery.sparkline.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/raphael/raphael.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/morris/morris.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/jvectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/jvectormap/jquery-jvectormap-world-mill.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/peity/jquery.peity.js')}}"></script>

	<!-- Neptune JS -->
	<script type="text/javascript" src="{{asset('assets/js/app.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/js/index.js')}}"></script>
	@stack('js')

	{{-- <script src="//code.tidio.co/tdup9f1gwjdflkk5w17ak3sbsfkngnlk.js" async></script> --}}

</body>

</html>