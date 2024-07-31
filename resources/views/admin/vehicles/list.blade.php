@extends('admin.layout.main')
@section('title', 'Vehicles')
@push('css')
  <link href="{{ asset('assets\vazirmatn-v33.003/Vazirmatn-Variable-font-face.css') }}" rel="stylesheet">
  <style>
    .content-table {
      /* font-family: 'Comic Sans MS'; */
      border-collapse: collapse;
      width: 100%;
      text-align: center;
    }

    #header-title {
      font-family: 'Times New Roman';
    }

    .content-table,
    th,
    td {
      padding: 0px 0px 0px 0px;
      font-size: 12px;
    }

    .bordered,
    .bordered th,
    .bordered td {
      border: 1px solid #ccc !important;
    }

    thead {
      position: sticky;
      top: 58px;
    }

    .wrapper,
    .site-content,
    .content-area,
    .table-responsive {
      overflow: unset;
    }

    .table-header-footer {
      background: #e9e8e8;
      color: black;
    }
  </style>
@endpush
@section('content')
  <!-- Change Status modal -->
  <div class="modal fade small-modal" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
    id="vehicle_change_status_modal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title">Change Vehicle Status</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <span class="pl-1">
              <input type="radio" name="vehicle_status" value="on_the_way" id="on_the_way" class="vehicle_status">
              <label for="on_the_way">On The Way</label>
            </span>
            <span class="pl-1">
              <input type="radio" name="vehicle_status" value="inventory" id="inventory" class="vehicle_status">
              <label for="inventory">Inventory</label>
            </span>
            {{-- <span class="pl-1">
              <input type="radio" name="vehicle_status" value="sold" id="sold" class="vehicle_status">
              <label for="sold">Sold</label>
            </span> --}}
          </div>
          <div class="modal-footer" style="text-align:center !important;">
            <button type="button" class="btn btn-primary btn-rounded" onclick="submitForm()">Change</button>
            <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Change Status modal -->
  <div class="modal fade modal" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
    id="vehicle_sell_modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title">Sell Vehicles</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="col-md-12 form-group">
                <label class="required">Select Customer</label>
                <select onchange="onCustomerChange(this)" name="customer_id" class="form-control s2s_customers"
                  required></select>
              </div>
              <div class="col-md-12 form-group">
                <label class="required">Invoice Date</label>
                <input type="date" name="invoice_date" placeholder="Invoice Date" class="form-control" required />
              </div>
              <div class="col-md-12 form-group">
                <label class="required">Due Date</label>
                <input type="date" name="invoice_due_date" placeholder="Due Date" class="form-control" required />
              </div>

              <div class="col-md-12 form-group">
                <label>Discount</label>
                <input type="number" name="discount" placeholder="Discount" class="form-control" value="0" />
              </div>
            </div>

            <div class="col-md-6">

            </div>

            <div class="col-md-12">
              <div class="col-md-12 form-group">
                <label>Description</label>
                <textarea name="description" placeholder="Description" rows="6" class="form-control"></textarea>
              </div>
            </div>

          </div>
          <div class="modal-footer" style="text-align:center !important;">
            <button type="button" class="btn btn-primary btn-rounded" onclick="submitForm()">Change</button>
            <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="site-content">
    <div class="content-area py-1">
      <div class="container-fluid">
        <div class=" bg-white table-responsive">
          @include('errors')
          <div style="clear: both;"></div>
          <div class="pt-1">
            <div class="form-group col-md-3 col-lg-3 col-sm-6 col-xs-12">
              <input type="text" name="search" class="form-control b-a" placeholder="Search for ..."
                id="search">
            </div>
            <div class="form-group col-md-4">
              @can('vehicle-change-status')
                <button class="btn btn-info" style="float: left; border-radius: 5px; margin-right: 10px;"
                  onclick="changeStatus()">
                  <i class="fa fa-info-circle"></i> Change Status
                </button>
              @endcan
              {{-- @can('vehicle-change-status')
                <button class="btn btn-success" style="float: left; border-radius: 5px;" onclick="vehicleSell()">
                  <i class="fa fa-dollar"></i> Sell
                </button>
              @endcan --}}
            </div>

            <div class="form-group col-md-1 col-lg-1 col-sm-2 col-xs-12" style="float:right;">
              <select class="form-control" id="showEntry">
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="300">300</option>
                <option value="500">500</option>
                <option value="500">1000</option>
              </select>
            </div>
            <div style="float: right; padding-top: 8px;">
              <div class="text text-warning"><b>{{ ucwords(str_replace('_', ' ', $status ? $status : 'All')) }}
                  Vehicles</b></div>
            </div>
          </div>
          <div class="site table-responsive" id="user_data">
            @include('admin.vehicles.data')
          </div>
        </div>
      </div>
    </div>
  </div>
@stop
@push('js')
  <script type="text/javascript">
    // Go to Pagination page
    $(document).on('click', '.pagination a', function(e) {
      e.preventDefault();
      var page = $(this).attr('href').split('page=')[1];
      updateVehicleList(page);
    });
    // search section 
    $('#search').on('keyup', function(e) {
      if (e.which == 13) {
        updateVehicleList();
      }
    });
    // Change Pagination
    $('#showEntry').change(function() {
      updateVehicleList();
    });
    // Appliy Filtering
    $('#submit_filter').click(function() {
      updateVehicleList();
    });

    function updateVehicleList(page = 0) {
      $('#content_loader').html(
        "<div style='position:fixed; margin-top:15%; margin-left:40%;'><img width='100px' src='/img/loading.gif' alt='Loading ...'> </div> "
      );
      var request = $.ajax({
        url: "{{ route('vehicles.index') }}",
        method: "GET",
        data: {
          page: page,
          status: "{{ request()->status }}",
          location_id: "{{ request()->location_id }}",
          customer_id: "{{ request()->customer_id }}",
          // from_date: $('#from_date').val(),
          // to_date: $('#to_date').val(),
          searchValue: $('#search').val(),
          paginate: $("#showEntry").val()
        },
      });
      request.done(function(msg) {
        $('#content_loader').html('');
        $('#user_data').html(msg);
      });
      request.fail(function(jqXHR, textStatus) {
        $('#content_loader').html('');
        $('#user_data').append(textStatus);
      });
    }



    function checkAll(checkbox) {
      if (checkbox.checked == true) {
        $(".checkbox").prop('checked', true);
        $(".checkbox_all").prop('checked', true);
      } else {
        $(".checkbox").prop('checked', false);
        $(".checkbox_all").prop('checked', false);
      }
    }

    function changeStatus() {
      var selectedVehicleIds = [];
      $(".checkbox:checked").each(function() {
        selectedVehicleIds.push($(this).attr('data-id'));
      });

      if (selectedVehicleIds.length <= 0) {
        Swal.fire({
          position: 'center',
          icon: 'info',
          title: "Please select atleast one record to change the status.",
          showConfirmButton: false,
          timer: 4000
        });
      } else {
        $('#vehicle_change_status_modal').modal('show');
      }
    }

    function vehicleSell() {
      var selectedVehicleIds = [];
      $(".checkbox:checked").each(function() {
        selectedVehicleIds.push($(this).attr('data-id'));
      });

      if (selectedVehicleIds.length <= 0) {
        Swal.fire({
          position: 'center',
          icon: 'info',
          title: "Please select atleast one record to change the status.",
          showConfirmButton: false,
          timer: 4000
        });
      } else {
        $('#vehicle_sell_modal').modal('show');
      }
    }

    function submitForm() {
      var status = $(".vehicle_status:checked").val();
      if (status == null) {
        Swal.fire({
          position: 'center',
          icon: 'info',
          title: "Please select at least one status",
          showConfirmButton: false,
          timer: 4000
        });
        return;
      } else {
        var selectedVehicleIds = [];
        $(".checkbox:checked").each(function() {
          selectedVehicleIds.push($(this).attr('data-id'));
        });

        var request = $.ajax({
          url: "{{ route('vehicles.change_status') }}",
          method: "POST",
          data: {
            selectedVehicleIds: selectedVehicleIds,
            status: status,
            _token: '{{ csrf_token() }}',
          },
        });
        request.done(function(msg) {
          $('#vehicle_change_status_modal').modal('hide');
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: msg.message,
            showConfirmButton: false,
            timer: 4000
          });
          updateVehicleList();
        });
        request.fail(function(jqXHR, textStatus) {
          $('#vehicle_change_status_modal').modal('hide');
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: jqXHR.responseJSON.message,
            showConfirmButton: false,
            timer: 4000
          });
        });
      }
    }

    function deleteVehicle(vehicle_id) {
      if (confirm('Vehicle will be deleted. Are you sure?')) {
        $('#content_loader').html(
          "<div style='position:fixed; margin-top:15%; margin-left:40%;'><img width='100px' src='/img/loading.gif' alt='Loading ...'> </div> "
        );
        var request = $.ajax({
          url: "{{ url('/admin/vehicles') }}" + '/' + vehicle_id,
          method: "DELETE",
          data: {
            _token: '{{ csrf_token() }}',
          },
        });
        request.done(function(msg) {
          $('#content_loader').html('');
          updateVehicleList();
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: "Vehicle deleted successfully.",
            showConfirmButton: false,
            timer: 4000
          });
        });
        request.fail(function(jqXHR, textStatus) {
          $('#content_loader').html('');
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: jqXHR.responseJSON.message,
            showConfirmButton: false,
            timer: 4000
          });
        });
      }
    }
  </script>
@endpush
