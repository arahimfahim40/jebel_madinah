@extends('admin.layout.main')
@section('title', 'Dashboard')
@section('style')
  <style type="text/css">
    #veh_summary:hover {
      color: #000;
      cursor: pointer;
    }

    #ship_summary:hover {
      color: #000;
      cursor: pointer;
    }
  </style>
@stop
@section('content')
  <div class="site-content">
    <!-- Content -->
    <div class="content-area py-1">
      <div class="container-fluid">
        <div class="row row-md">
          <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="box box-block bg-white tile tile-1 mb-2">
              <div class="t-icon right"><span class="bg-danger"></span><i class="ti-car"></i></div>
              <div class="t-content">
                <h6 class="text-uppercase mb-1">Vehicles</h6>
                <h1 class="mb-1">{{ @$vehicles }}</h1>
                <i class="fa fa-caret-up text-success mr-0-5"></i><span>
                  {{-- <a href="{{route('all_vehicle_admin')}}">View All Vehicles</a></span> --}}
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="box box-block bg-white tile tile-1 mb-2">
              <div class="t-icon right"><span class="bg-success"></span><i class="fa fa-ship"></i></div>
              <div class="t-content">
                <h6 class="text-uppercase mb-1">Shipments</h6>
                <h1 class="mb-1">{{ @$containers }}</h1>
                <i class="fa fa-caret-up text-success mr-0-5"></i><span>
                  {{-- <a href="{{route('shipment_admin',[10,10,1])}}">View All Shipments</a></span> --}}
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="box box-block bg-white tile tile-1 mb-2">
              <div class="t-icon right"><span class="bg-primary"></span><i class="ti-receipt"></i></div>
              <div class="t-content">
                <h6 class="text-uppercase mb-1">Invoices</h6>
                <h1 class="mb-1">{{ @$invoices }}</h1>
                <i class="fa fa-caret-up text-success mr-0-5"></i><span>
                  {{-- <a href="{{route('invoice_admin','5')}}">View All Invoices</a></span> --}}
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="box box-block bg-white tile tile-1 mb-2">
              <div class="t-icon right"><span class="bg-warning"></span><i class="fa fa-users"></i></div>
              <div class="t-content">
                <h6 class="text-uppercase mb-1">Customers</h6>
                <h1 class="mb-1">{{ @$customers }}</h1>
                <i class="fa fa-users text-success mr-0-5"></i><span>
                  {{-- <a href="{{route('customer_admin','5')}}">View Customers</a></span> --}}
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link text-muted" id="ship_summary"><b>Vehicle Summary</b></a>
              </li>
            </ul>
            <div class="box box-block bg-white b-t-0 mb-2">
              <div class="tables-responsive">
                <table class="table table-grey-head mb-md-0 tables-responsive">
                  <tbody id="vehicle_summary">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          {{-- <div class="col-md-2">
                    <div class="box bg-white text-xs-center b-t mb-2">
                        <div class="box-block pb-1">
                            <img class="img img-rouded img-fluid" src="{{asset('img/logo.png')}}">
                        </div>
                    </div>
                </div> --}}
        </div>

        <div class="row row-md mb-2">
          <div class="col-md-12">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link text-muted active"><b>Shipment Summary</b></a>
              </li>
            </ul>
            <div class="box box-block bg-white b-t-0 mb-2">
              <div class="tables-responsive">
                <table class="table table-grey-head mb-md-0 tables-responsive">
                  <tbody class="shipment_summary">
                    <div style='text-align:center' id="shiploading"><img width='40px' src='img/loading.gif'
                        alt='Loading ...'> </div>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
      <div class="container-fluid">
        <div class="row text-xs-center">
          <div class="col-sm-4 text-sm-left mb-0-5 mb-sm-0">
            © 2019-{{ date('Y') }} Jabal AL Madinah, All rights reserved.
          </div>
          <div class="col-sm-8 text-sm-right">
          </div>
        </div>
      </div>
    </footer>
  </div>
@stop
@section('js')
  <script type="text/javascript">
    $(document).ready(function() {
      vehicle_summary();
      shipment_summary();
    });
    // vehicle summary section
    function vehicle_summary() {
      $('#vehicle_summary').html(
        "<div style='text-align:center'><img width='40px' src='img/loading.gif' alt='Loading ...'> </div>"
      );
      var request = $.ajax({
        url: "{{ url('admin_vehicle_summary') }}",
        method: "GET",
        data: {},
        dataType: "json"
      });

      request.done(function(msg) {
        // $('#spinnerveh').addClass('hide');
        // $('.vehdiv').addClass('hide');
        $('#vehicle_summary').html(msg)
      });

      request.fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
      });
    }

    // shipment summary section
    function shipment_summary() {
      $('#veh_summary').removeClass('active');
      $('#ship_summary').addClass('active');
      var request = $.ajax({
        url: "{{ url('admin_shipment_summary') }}",
        method: "GET",
        dataType: "json"
      });
      request.done(function(msg) {
        $("#shiploading").hide();
        $('.shipment_summary').html(msg)
      });
      request.fail(function(jqXHR, textStatus) {
        $("#shiploading").hide();
        $('.shipment_summary').html("<div class='alert alert-danger'>" + textStatus + "</div>")
      });

    }
  </script>
@stop
