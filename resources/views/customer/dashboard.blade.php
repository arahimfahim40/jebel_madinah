@extends('customer.layout.main')
@section('title', 'Dashboard')
@section('style')
  <style type="text/css">
    #veh_summary:hover {
      /* color: #000; */
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
              <div class="t-icon right"><span class="bg-danger"></span><i class="fa fa-car"></i></div>
              <div class="t-content">
                <h6 class="text-uppercase mb-1">Vehicles</h6>
                <h1 class="mb-1">{{ $dashboardCounts['vehicles'] }}</h1>
                <i class="fa fa-caret-up text-success mr-0-5"></i><span>
                  <a href="{{ route('vehicles.index') }}">View All Vehicles</a></span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="box box-block bg-white tile tile-1 mb-2">
              <div class="t-icon right"><span class="bg-primary"></span><i class="ti-receipt"></i></div>
              <div class="t-content">
                <h6 class="text-uppercase mb-1">All Invoices</h6>
                <h1 class="mb-1">{{ $dashboardCounts['all_invoices'] }}</h1>
                <i class="fa fa-caret-up text-success mr-0-5"></i><span>
                  <a href="{{ route('invoices.index') }}">View All Invoices</a></span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="box box-block bg-white tile tile-1 mb-2">
              <div class="t-icon right"><span class="bg-warning"></span><i class="ti-receipt"></i></div>
              <div class="t-content">
                <h6 class="text-uppercase mb-1">Open Invoices</h6>
                <h1 class="mb-1">{{ $dashboardCounts['open_invoices'] }}</h1>
                <i class="fa fa-caret-up text-success mr-0-5"></i><span>
                  <a href="{{ route('invoices.index') }}?status=open">View Open Invoices</a></span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="box box-block bg-white tile tile-1 mb-2">
              <div class="t-icon right"><span class="bg-success"></span><i class="ti-receipt"></i></div>
              <div class="t-content">
                <h6 class="text-uppercase mb-1">Paid Invoices</h6>
                <h1 class="mb-1">{{ $dashboardCounts['paid_invoices'] }}</h1>
                <i class="fa fa-caret-up text-success mr-0-5"></i><span>
                  <a href="{{ route('invoices.index') }}?status=paid">View Paid Invoices</a></span>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="box box-block bg-white mb-2">
              <h4 class="py-1">Vehicle Summary</h4>
              <div class="tables-responsive">
                <table class="table table-grey-head mb-md-0 tables-responsive">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Location Name</th>
                      <th>On The Way</th>
                      <th>On Hand No Title</th>
                      <th>On Hand With Title</th>
                      <th>Shipped</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($vehicleSummary as $index => $vehicle)
                      <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $vehicle->location_name ? $vehicle->location_name : 'Unknown' }}</td>
                        <td>
                          <a
                            href="{{ route('vehicles.index') }}?status=on_the_way&location_id={{ $vehicle->point_of_loading_id }}">
                            {{ $vehicle->on_the_way }}
                          </a>
                        </td>
                        <td>
                          <a
                            href="{{ route('vehicles.index') }}?status=on_hand_no_title&location_id={{ $vehicle->point_of_loading_id }}">
                            {{ $vehicle->on_hand_no_title }}
                          </a>
                        </td>
                        <td>
                          <a
                            href="{{ route('vehicles.index') }}?status=on_hand_with_title&location_id={{ $vehicle->point_of_loading_id }}">
                            {{ $vehicle->on_hand_with_title }}
                          </a>
                        </td>
                        <td>
                          <a
                            href="{{ route('vehicles.index') }}?status=shipped&location_id={{ $vehicle->point_of_loading_id }}">
                            {{ $vehicle->shipped }}
                          </a>
                        </td>
                        <th>
                          <a href="{{ route('vehicles.index') }}?location_id={{ $vehicle->point_of_loading_id }}">
                            {{ $vehicle->on_the_way + $vehicle->on_hand_no_title + $vehicle->on_hand_with_title + $vehicle->shipped }}
                          </a>
                        </th>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th colspan="2">Total</th>
                      <th>
                        <a href="{{ route('vehicles.index') }}?status=on_the_way">
                          {{ $vehicleSummary->sum('on_the_way') }}
                        </a>
                      </th>
                      <th>
                        <a href="{{ route('vehicles.index') }}?status=on_hand_no_title">
                          {{ $vehicleSummary->sum('on_hand_no_title') }}
                        </a>
                      </th>
                      <th>
                        <a href="{{ route('vehicles.index') }}?status=on_hand_with_title">
                          {{ $vehicleSummary->sum('on_hand_with_title') }}
                        </a>
                      </th>
                      <th>
                        <a href="{{ route('vehicles.index') }}?status=shipped">
                          {{ $vehicleSummary->sum('shipped') }}
                        </a>
                      </th>
                      <th>
                        <a href="{{ route('vehicles.index') }}">
                          {{ $vehicleSummary->sum('on_the_way') + $vehicleSummary->sum('on_hand_no_title') + $vehicleSummary->sum('on_hand_with_title') + $vehicleSummary->sum('shipped') }}
                        </a>
                      </th>
                    </tr>
                  </tfoot>
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
