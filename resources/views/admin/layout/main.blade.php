<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('img/logo-small.png') }}" />
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap4/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/animate.css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/jscrollpane/jquery.jscrollpane.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/waves/waves.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/switchery/dist/switchery.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/morris/morris.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/jvectormap/jquery-jvectormap-2.0.3.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/toastr/toastr.min.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/DataTables-1.10.12/datatables.min.css')}}" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom-style.css') }}">
    <link rel="stylesheet" type="text/css"
      href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&family=Roboto+Condensed:wght@300;400;700&display=swap">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css"> --}}
    <!-- Neptune CSS -->

    <style>
      .search_reload:hover {
        cursor: pointer;
        font-weight: bold;
      }

      .search-listing {
        overflow-x: scroll;
      }

      .containerr {
        position: absolute;
        overflow: none;
        width: 100%;
        padding-top: 56.25%;
        /* 16:9 Aspect Ratio (divide 9 by 16 = 0.5625) */
        margin-top: 60px;
        margin-right: 230px;
        margin-left: 220px;
      }

      /* Then style the iframe to fit in the container div with full height and width */
      .responsive-iframe {
        position: absolute;
        left: 0;
        bottom: 0;
        right: 0;
        width: 90%;
        height: 100%;
      }

      .form-group>.select2-container {
        width: 100% !important;
      }

      .select2-selection.select2-selection--single {
        overflow: hidden;
        border-radius: unset;
        height: 32px;
        padding-top: 1px;
        padding-bottom: 1px;
        border: 1px solid rgba(0, 0, 0, .15);
        width: 100%;
      }
    </style>
    @stack('css')
  </head>

  <body class="fixed-sidebar fixed-header skin-default content-appear bg-white">
    <div class="wrapper" style="overflow: unset;">
      <div class="preloader"></div>
      @include('admin.layout.sidebar')
      @include('admin.layout.header')
      @yield('content')

      <!-- Notification general modal -->
      <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
        id="logProperties">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body" style="padding: 0px;">
              <div class="bg-info p-1 px-2" style="display:flex;">
                <div class="font-weight-bold" style="width:5%">#</div>
                <div class="font-weight-bold" style="width:25%">Attribute</div>
                <div class="font-weight-bold" style="width:40%">Value</div>
                <div class="font-weight-bold" style="width:40%">Old Value</div>
              </div>
              <div id="properties_loading" style="display:none;">
                <div style='position:relative; margin-top:5%; margin-left:45%; z-index:1000;'><img width='70px'
                    src='{{ asset('img/loading.gif') }}' alt='Loading ...'> </div>
              </div>
              <div style="max-height: 500px; overflow-y: auto;" id="log_data"></div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Notification general modal -->
    </div>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/jquery-plugin/tableHTMLExport.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/tether/js/tether.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bootstrap4/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/detectmobilebrowser/detectmobilebrowser.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/jscrollpane/jquery.mousewheel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/jscrollpane/mwheelIntent.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/jscrollpane/jquery.jscrollpane.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/jquery-fullscreen-plugin/jquery.fullscreen-min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/waves/waves.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/switchery/dist/switchery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/TinyColor/tinycolor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/sparkline/jquery.sparkline.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/raphael/raphael.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/morris/morris.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/jvectormap/jquery-jvectormap-2.0.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/jvectormap/jquery-jvectormap-world-mill.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/peity/jquery.peity.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/select2/dist/js/select2.min.js') }}"></script>
    {{-- <script type="text/javascript" src="{{asset('assets/DataTables-1.10.12/datatables.min.js')}}"></script> --}}
    <script type="text/javascript" src="{{ asset('assets/sweetalert2v11/sweetalert2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/notify/notify.js') }}"></script>
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script> --}}

    @stack('js')

    <script type="text/javascript">
      var request = $.ajax({
        url: "{{ route('admin_sidebar_count') }}",
        method: "GET",
        dataType: 'json'
      });

      $(document).ready(function() {
        // Get Owners and store in global variables of js
        window.owners = <?php echo json_encode(getOwners()); ?>;
        window.vehicle_section = false;
        window.vehicle_summary_section = false;
        window.invoice_section = false;

        if ($('.vehicles_section .active').html() != undefined && !vehicle_section) {
          vehicle_section = true;
          get_admin_sidebar_sub_count('Vehicle');
          if ($('.vehicle_summary_section .active').html() != undefined && !vehicle_summary_section) {
            vehicle_summary_section = true;
            get_admin_sidebar_sub_count('VehicleSummary');
          }
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
          url: "{{ route('admin_sidebar_sub_count') }}",
          method: "GET",
          dataType: 'json',
          data: {
            type: type
          }
        });
        vehicle_sub_count.done(function(msg) {
          if (type == 'Vehicle') {
            window.vehicle_section = true;
            $('.t_on_the_way_vehicle').text(msg.t_on_the_way);
            $('.t_inventory_vehicle').text(msg.t_inventory);
            $('.t_sold_vehicle').text(msg.t_sold);
          } else if (type == 'VehicleSummary') {
            window.vehicle_summary_section = true;
            owners.forEach(item => {
              $('.t_on_summary_' + item.id).text(msg['t_on_summary_' + item.id]);
            });
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
              if ($.isNumeric(val1Numeric) && $.isNumeric(val2Numeric) && !(dateRegex.test(val1) ||
                  dateRegex.test(val2))) {
                console.log(val1Numeric, val2Numeric);
                // Sort numerically
                return sortOrder == 1 ? val1Numeric - val2Numeric : val2Numeric - val1Numeric;
              } else {
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

      function addNewCustomer() {
        if (true) {
          // window.location.href = "{{ route('unitedCustomers') }}";
        } else {
          alert("You are not allowed to add new customer!");
        }
      }

    </script>

    @include('admin.layout.select2-search')

  </body>

</html>
