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
		.bg-primary {
			color: #eee !important;
			background-color: #3d85c6 !important;
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

<script type="text/javascript">
	var request = $.ajax({
		url: "{{route('customer_sidebar_count')}}",
		method: "GET",
		dataType: 'json'
	});
	
	$(document).ready(function() {
		// Get location and store in global variables of js
		window.vehicle_section = false;
		window.invoice_section = false;
		
		if ($('.vehicles_section .active').html() != undefined && !vehicle_section) {
			vehicle_section = true;
			get_admin_sidebar_sub_count('Vehicle');
		} else if ($('.invoice_section .active').html() != undefined && !invoice_section) {
			invoice_section = true;
			get_admin_sidebar_sub_count('Invoice');
		}

	});

	request.done(function(msg) {
		$('.t_all_vehicle').text(msg.t_all_vehicle);
		$('.t_all_invoice').text(msg.t_all_invoice);
	});


	function get_admin_sidebar_sub_count(type = 'Vehicle') {
		var vehicle_sub_count = $.ajax({
			url: "{{route('customer_sidebar_sub_count')}}",
			method: "GET",
			dataType: 'json',
			data: {
				type: type
			}
		});
		vehicle_sub_count.done(function(msg) {
			if (type == 'Vehicle') {
				window.vehicle_section = true;
				$('.t_pending_vehicle').text(msg.t_pending);
				$('.t_on_the_way_vehicle').text(msg.t_on_the_way);
				$('.t_on_hand_no_title_vehicle').text(msg.t_on_hand_no_title);
				$('.t_on_hand_with_title_vehicle').text(msg.t_on_hand_with_title);
				$('.t_shipped_vehicle').text(msg.t_shipped);
			} else if (type == 'Invoice') {
				window.invoice_section = true;
				$('.t_pending_invoice').text(msg.t_pending_invoice);
				$('.t_open_invoice').text(msg.t_open_invoice);
				$('.t_past_due_invoice').text(msg.t_past_due_invoice);
				$('.t_paid_invoice').text(msg.t_paid_invoice);
			}
		});

		vehicle_sub_count.fail(function(jqXHR, textStatus) {
			alert('fail to load the vehicle summary total.');
			console.log(msg, jqXHR);
		});
	}


	$(document).ready(function() {
		$('#example th, .client_side_sorting_table th').each(function(col) {
			$(this).click(function() {
				if ($(this).is('.asc')) {
					$(this).removeClass('asc sorting_asc');
					$(this).addClass('selected desc sorting_desc');
					sortOrder = -1;
				} else {
					$(this).addClass('selected asc sorting_asc');
					$(this).removeClass('desc sorting_desc');
					sortOrder = 1;
				}
				$(this).siblings().removeClass('selected asc sorting_asc');
				$(this).siblings().removeClass('selected desc sorting_desc');
				var arrData = $('table').find('tbody >tr:has(td)').get();
				arrData.sort(function(a, b) {
					var val1 = $(a).children('td').eq(col).text();
					var val2 = $(b).children('td').eq(col).text();
					var val1Numeric = val1.replace(/[$,DH]/g, '');
					var val2Numeric = val2.replace(/[$,DH]/g, '');
					var dateRegex = /^\d{4}-\d{2}-\d{2}$/;
					if ($.isNumeric(val1Numeric) && $.isNumeric(val2Numeric) &&  !(dateRegex.test(val1) || dateRegex.test(val2) )) {
						console.log(val1Numeric, val2Numeric);
						// Sort numerically
						return sortOrder == 1 ? val1Numeric - val2Numeric : val2Numeric - val1Numeric;
					}else{
						return (val1 < val2) ? -sortOrder : (val1 > val2) ? sortOrder : 0;
					}
				});
				$.each(arrData, function(index, row) {
					$('tbody').append(row);
				});
			});
		});
		$('.excel').click(function() {
			$("#example").tableHTMLExport({
				type: 'csv',
				filename: 'sample.csv',
				separator: ',',
				newline: '\r\n',
				trimContent: true,
				quoteFields: true,
				ignoreColumns: '.column',
				ignoreRows: '.bottom',
				htmlContent: false,
				consoleLog: false,
			});
		});

	});

	$(document).ready(function() {
		$(".select2").select2();
	});


	$(document).on('select2:open', () => {
		document.querySelector('.select2-search__field').focus();
	});

</script>

</html>