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

    .form-check-label {
      padding-left: 4px;
    }
  </style>
@endpush
@section('content')

  @include('admin.invoices.add_customer')
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
        <div class="modal-body" style="overflow-y: auto; max-height: 65vh;">
          <div class="row">
            <form id="vehcile-sell-form" method="post" enctype="multipart/form-data">

              <div class="col-md-6">
                <div class="col-md-12 form-group">
                  <label class="required">Select Customer</label>
                  <select id="customer_id" name="customer_id" class="form-control s2s_customers" required></select>
                  <div id="customer-error" class="text-danger" style="display: none;"></div>
                </div>
                <div class="col-md-12 form-group">
                  <label class="required">Invoice Date</label>
                  <input type="date" name="invoice_date" placeholder="Invoice Date" class="form-control"
                    value="{{ now()->format('Y-m-d') }}" required />
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

              <div class="col-md-6" id="vehicle-sold-price-list"></div>
              <div class="col-md-12">
                <div class="col-md-12 form-group">
                  <label>Description</label>
                  <textarea name="description" placeholder="Description" rows="4" class="form-control"></textarea>
                </div>
              </div>
              <div class="col-md-12">
                <div class="col-md-12 form-group">
                  <hr>
                </div>
                <div class="col-md-12 form-group">
                  <div>
                    <label style="font-weight: bold; font-size: 14px;">Payment Section</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="payment_type" id="unpaid" value="unpaid"
                      checked>
                    <label class="form-check-label" for="unpaid">Unpaid</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="payment_type" id="fully_paid"
                      value="fully_paid">
                    <label class="form-check-label" for="fully_paid">Fully Paid</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="payment_type" id="partial_paid"
                      value="partial_paid">
                    <label class="form-check-label" for="partial_paid">Partially Paid</label>
                  </div>
                </div>

                <div style="display: none;" id="vehicle-payment-form">
                  <div class="col-md-6">
                    <div class="form-group">
                      <span class="main"><label for="payment_amount">Payment Amount (AED)</label>&nbsp;<span
                          class="text-danger">*</span></span>
                      <input type="number" step=".01" name="payment_amount" id="payment_amount"
                        class="form-control" required />
                      <span id="payment_amount" style="color: red;font-weight: bold;"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <span class="main"><label for="payment_date">Payment Date</label>&nbsp;<span
                          class="text-danger">*</span></span>
                      <input type="date" value="{{ now()->format('Y-m-d') }}" name="payment_date" id="payment_date"
                        class="form-control" required />
                      <span id="payment_date" style="color: red;font-weight: bold;"></span>
                    </div>
                  </div>
                  <div class="col-md-12 form-group">
                    <label for="">Evidence Link</label>
                    <input type="text" class="form-control" name="evidence_link" id="evidence_link">
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <span class="main"><label for="payment_description">Payment Description</label>&nbsp;</span>
                      <textarea name="payment_description" id="payment_description" cols="70" rows="3" class="form-control"></textarea>
                    </div>
                  </div>

                </div>
              </div>

            </form>
          </div>
          <div class="modal-footer" style="text-align:center !important;">
            <button type="button" class="btn btn-primary" style="border-radius: 5px;"
              onclick="submitSellForm()">Save</button>
            <button type="button" class="btn btn-danger" style="border-radius: 5px;"
              data-dismiss="modal">Close</button>
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
              @can('vehicle-change-status')
                <button class="btn btn-success" style="float: left; border-radius: 5px;" onclick="vehicleSell(this)">
                  <i class="fa fa-dollar"></i> Sell
                </button>
              @endcan
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


    var selectedVehicleForSell = [];

    function vehicleSell() {
      selectedVehicleForSell = [];
      var isSold = false;
      $(".checkbox:checked").each(function() {
        selectedVehicleForSell.push({
          id: $(this).data('id'),
          description: $(this).data('description'),
          sold_price: $(this).data('sold_price'),
        });
        if ($(this).attr('data-status') == 'sold') {
          isSold = true;
          return;
        }
      });

      if (isSold) {
        Swal.fire({
          position: 'center',
          icon: 'info',
          title: "At last one of vehicles is already sold.",
          showConfirmButton: false,
          timer: 4000
        });
        return;
      }

      if (selectedVehicleForSell.length <= 0) {
        Swal.fire({
          position: 'center',
          icon: 'info',
          title: "Please select atleast one record for selling.",
          showConfirmButton: false,
          timer: 4000
        });
      } else {
        generateVehicleSoldField();
        $('#vehicle_sell_modal').modal('show');
      }
    }

    function generateVehicleSoldField() {
      $(`#vehicle-sold-price-list`).html('');
      selectedVehicleForSell.forEach(element => {
        var newField = $('<div>', {
          class: `form-group col-md-12 vehicle-field-${element.id}`
        }).append(
          $('<label>', {
            for: element.id,
            text: element.description
          }),
          $('<div>', {
            class: 'input-group'
          }).append(
            $('<div>', {
              class: 'input-group-addon',
              text: 'Sold Price (AED)'
            }),
            $('<input>', {
              type: 'number',
              step: 'any',
              name: `vehicles[${element.id}]`,
              class: 'vehicle_charges form-control',
              placeholder: 'Enter Vehicle Sold Price',
              value: element.sold_price
            })
          )
        );
        $(`#vehicle-sold-price-list`).append(newField);
      });
    }

    $('input[type=radio][name=payment_type]').change(function() {
      if (this.value == 'partial_paid') {
        $('#vehicle-payment-form').show();
      } else if (this.value == 'fully_paid' || this.value == 'unpaid') {
        $('#vehicle-payment-form').hide();
      }
    });


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

    function submitSellForm() {

      // Assuming you have a form element with an ID of 'myForm'
      var form = $('#vehcile-sell-form')[0];
      $('#customer-error').hide();

      // Create a new FormData object
      var formData = new FormData(form);

      // To get all input values
      var formValues = {};
      formData.forEach(function(value, key) {
        formValues[key] = value;
      });

      var request = $.ajax({
        url: "{{ route('vehicles.sell_and_payment') }}",
        method: "POST",
        data: {
          ...formValues,
          _token: '{{ csrf_token() }}',
        },
        success: function(data) {
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: data.message,
            showConfirmButton: false,
            timer: 3000
          });
          updateVehicleList();
          $('#vehicle_sell_modal').modal('hide');
          window.open("{{ url('/') }}" + `/admin/invoices/${data.invoice_id}`, '_blank');
        },
        error: function(jqXHR, textStatus) {
          var errors = jqXHR.responseJSON.errors;
          if (Object.keys(errors).length > 0) {
            for (const key in errors) {
              if (errors.hasOwnProperty(key)) {
                if (key == 'customer_id') {
                  $('#customer-error').html(errors[key]);
                  $('#customer-error').show();
                }
              }
            }
          }
        },
      });

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
