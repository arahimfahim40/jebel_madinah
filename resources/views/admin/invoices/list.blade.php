@extends('admin.layout.main')
@section('title', 'Invoices')
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
    id="invoice_change_status_modal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title">Change Invoice Status</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <span class="pl-1">
              <input type="radio" name="invoice_status" value="pending" id="pending" class="invoice_status">
              <label for="pending">Pending</label>
            </span>
            <span class="pl-1">
              <input type="radio" name="invoice_status" value="open" id="open" class="invoice_status">
              <label for="open">Open</label>
            </span>
            <span class="pl-1">
              <input type="radio" name="invoice_status" value="past_due" id="past_due" class="invoice_status">
              <label for="past_due">Past Due</label>
            </span>
            <span class="pl-1">
              <input type="radio" name="invoice_status" value="paid" id="paid" class="invoice_status">
              <label for="paid">Paid</label>
            </span>
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

          {{-- <div class="site pt-2">
                    <div id="filter_form">
                        <div class="col-md-2 mb-1">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" class="form-control" name="status">
                                    <option value="all">All</option>
                                    @foreach (\App\Models\Invoice::INVOICE_STATUS as $invoice_status)
                                        <option value="{{$invoice_status}}" {{$status == $invoice_status ? 'selected': ''}}>{{ ucwords(str_replace('_', ' ', $invoice_status)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class=" col-md-3 mb-1">
                            <div class=" form-group">
                                <label for="from_date">From</label>
                                <input id="from_date" type="date" name="from_date" class="form-control">
                            </div>
                        </div>
                        <div class=" col-md-3 mb-1">
                            <div class=" form-group">
                                <label for="to_date">To</label>
                                <input id="to_date" type="date" name="to_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-1 mb-1">
                            <div  style="margin-top: 26px;">
                                <button class="btn btn-warning waves-effect waves-light" id="submit_filter">
                                    <b><i class="fa fa-filter"></i></b><span class="pl-1">Filter</span>
                                </button>
                            </div>
                        </div>
                            
                    </div>
                </div> --}}

          <div style="clear: both;"></div>
          <div class="form-group col-md-3 col-lg-3 col-sm-6 col-xs-12" style="margin:1%;margin-left:0px;">
            <input type="text" name="search" class="form-control b-a" placeholder="Search for ..." id="search">
          </div>
          <div class="form-group col-md-4" style="margin:1%;margin-left:0px;">
            @can('invoice-change-status')
              <button class="btn btn-info" style="float: left; border-radius: 5px; margin-right: 10px;"
                onclick="changeStatus()">
                <i class="fa fa-info-circle"></i> Change Status
              </button>
            @endcan
          </div>
          <div class="form-group col-md-1 col-lg-1 col-sm-2 col-xs-12" style="margin:1%;float: right;">
            <select class="form-control" id="showEntry">
              <option value="20">20</option>
              <option value="50">50</option>
              <option value="100">100</option>
              <option value="300">300</option>
              <option value="500">500</option>
              <option value="500">1000</option>
            </select>
          </div>
          <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12 text-right"
            style="margin-top:1.5%;float: right;text-align: right;">
            <div class="text text-warning"><b>{{ ucwords(str_replace('_', ' ', $status ? $status : 'All')) }} Invoices</b>
            </div>
          </div>
          @include('admin.invoices.payment_form')
          @include('admin.invoices.payment_edit')
          <div class="site table-responsive" id="user_data">
            @include('admin.invoices.data')
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade small-modal" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
    id="view_invoice_modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="height: 85vh; border-radius: 10px;">
        <div class="modal-header" style="padding:20px 15px 10px 25px !important;">
          <h2 style="float:left;">Invoice View</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float:right;">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="view_invoice" style="height: 84%; overflow-y: scroll;">
        </div>

        <div class='modal-footer'>
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
      updateInvoiceList(page);
    });
    // search section 
    $('#search').on('keyup', function(e) {
      if (e.which == 13) {
        updateInvoiceList();
      }
    });
    // Change Pagination
    $('#showEntry').change(function() {
      updateInvoiceList();
    });
    // Appliy Filtering
    $('#submit_filter').click(function() {
      updateInvoiceList();
    });

    function updateInvoiceList(page = 0) {
      $('#content_loader').html(
        "<div style='position:fixed; margin-top:15%; margin-left:40%;'><img width='100px' src='/img/loading.gif' alt='Loading ...'> </div> "
      );
      var request = $.ajax({
        url: "{{ route('invoices.index') }}",
        method: "GET",
        data: {
          page: page,
          status: "{{ request()->status }}",
          // location_id: "{{ request()->location_id }}",
          // customer_id: "{{ request()->customer_id }}",
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

    function addPayment(id) {
      $("#payment_form_modal").modal("show");
      $('#payment_form input[name="invoice_id"]').val(id);
    }
    $('#payment_form').on('submit', function(e) {
      e.preventDefault();
      $('#edit-page-loading').html("<div class='preloader'></div>");
      var request = $.ajax({
        url: "{{ route('invoice_payments.store') }}",
        method: "POST",
        data: {
          _token: $('input[name="_token"]').val(),
          invoice_id: $('#payment_form input[name="invoice_id"]').val(),
          payment_amount: $('#payment_form input[name="payment_amount"]').val(),
          discount: $('#payment_form input[name="discount"]').val(),
          payment_date: $('#payment_form input[name="payment_date"]').val(),
          evidence_link: $('#payment_form input[name="evidence_link"]').val(),
          description: $('#payment_form textarea[name="description"]').val(),
        },
        success: function(res) {
          if (res.status === 'success') {
            $('#payment_form').trigger("reset");
            $("#payment_form_modal").modal("hide");
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: res.message,
              showConfirmButton: false,
              timer: 3000
            });
          } else {
            $('#edit-form-dismissable-alerts #error-message').text(res.message);
            $('#edit-form-dismissable-alerts').show();
            setTimeout(function() {
              $('#edit-form-dismissable-alerts').hide();
            }, 4000);
          }
          $('#edit-page-loading').html('');
        },
        error: function(jqXHR, textStatus, errorThrown) {
          $('#edit-form-dismissable-alerts #error-message').text(jqXHR.responseText);
          $('#edit-form-dismissable-alerts').show();
          setTimeout(function() {
            $('#edit-form-dismissable-alerts').hide();
          }, 4000);
          $('#edit-page-loading').html('');
        },
      });
    })

    function updatePayment(invoiceId, paymentId, paymentAmount, discount, paymentDate, evidenceLink, description) {
      $("#payment_form_update_modal").modal("show");
      var datePart = paymentDate.split(' ')[0];
      $('#payment_form_update input[name="invoice_id"]').val(invoiceId);
      $('#payment_form_update input[name="payment_id"]').val(paymentId);
      $('#payment_form_update input[name="payment_amount"]').val(paymentAmount);
      $('#payment_form_update input[name="discount"]').val(discount);
      $('#payment_form_update input[name="payment_date"]').val(datePart);
      $('#payment_form_update input[name="evidence_link"]').val(evidenceLink);
      $('#payment_form_update textarea[name="description"]').val(description);
    }
    $('#payment_form_update').on('submit', function(e) {
      const paymentId = $('#payment_form_update input[name="payment_id"]').val()
      e.preventDefault();
      $('#edit-page-loading').html("<div class='preloader'></div>");
      var request = $.ajax({
        url: "/admin/invoice_payments/" + paymentId,
        method: "PUT",
        data: {
          _token: $('input[name="_token"]').val(),
          invoice_id: $('#payment_form_update input[name="invoice_id"]').val(),
          payment_amount: $('#payment_form_update input[name="payment_amount"]').val(),
          discount: $('#payment_form_update input[name="discount"]').val(),
          payment_date: $('#payment_form_update input[name="payment_date"]').val(),
          evidence_link: $('#payment_form_update input[name="evidence_link"]').val(),
          description: $('#payment_form_update textarea[name="description"]').val(),
        },
        success: function(res) {
          if (res.status === 'success') {
            $('#payment_form_update').trigger("reset");
            $("#payment_form_update_modal").modal("hide");
            $('#view_invoice_modal').modal('hide');
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: res.message,
              showConfirmButton: false,
              timer: 3000
            });
          } else {
            $('#edit-form-dismissable-alerts #error-message').text(res.message);
            $('#edit-form-dismissable-alerts').show();
            setTimeout(function() {
              $('#edit-form-dismissable-alerts').hide();
            }, 4000);
          }
          $('#edit-page-loading').html('');
        },
        error: function(jqXHR, textStatus, errorThrown) {
          $('#edit-form-dismissable-alerts #error-message').text(jqXHR.responseText);
          $('#edit-form-dismissable-alerts').show();
          setTimeout(function() {
            $('#edit-form-dismissable-alerts').hide();
          }, 4000);
          $('#edit-page-loading').html('');
        },
      });
    });

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
      var selectedInvoiceIds = [];
      $(".checkbox:checked").each(function() {
        selectedInvoiceIds.push($(this).attr('data-id'));
      });

      if (selectedInvoiceIds.length <= 0) {
        Swal.fire({
          position: 'center',
          icon: 'info',
          title: "Please select atleast one record to change the status.",
          showConfirmButton: false,
          timer: 4000
        });
      } else {
        $('#invoice_change_status_modal').modal('show');
      }
    }

    function submitForm() {
      var status = $(".invoice_status:checked").val();
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
        var selectedInvoiceIds = [];
        $(".checkbox:checked").each(function() {
          selectedInvoiceIds.push($(this).attr('data-id'));
        });

        var request = $.ajax({
          url: "{{ route('invoices.change_status') }}",
          method: "POST",
          data: {
            selectedInvoiceIds: selectedInvoiceIds,
            status: status,
            _token: '{{ csrf_token() }}',
          },
        });
        request.done(function(msg) {
          $('#invoice_change_status_modal').modal('hide');
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: msg.message,
            showConfirmButton: false,
            timer: 4000
          });
          updateInvoiceList();
        });
        request.fail(function(jqXHR, textStatus) {
          $('#invoice_change_status_modal').modal('hide');
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
