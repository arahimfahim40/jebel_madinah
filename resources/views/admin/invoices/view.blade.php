@php
  $lastPaymentAmount = 0;
  $hasJustAdvancedPay = false;
  $paymentTimeFromDB = [];
@endphp
@extends('admin.layout.main')
@section('title', 'Invoice')
@push('css')
  <style>
    * {
      box-sizing: border-box;
    }

    table,
    tr {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    .th1,
    .td1 {
      border: 1px solid #0a0a0a !important;
      text-align: left;
      padding: 5px;
      border-collapse: collapse !important;
    }

    #tr1:nth-child(even) {
      background-color: #dddddd;
    }

    #customers {
      font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td,
    th {
      font-size: 14px;
      padding: 5px !important;
    }

    .no-border {
      border: none !important;
    }

    #payments-section {
      /* display: none; */
      /* Hide the payments section by default */
    }
  </style>
@endpush

@section('content')
  <div class="site-content " style="margin-top: 60px; padding: 0px; background-color: #e8ebf0;">
    <div class="content-area py-1" style="margin: 0px;">
      <div class="container-fluid  bg-white" style="margin-top: 0px; max-width: 250mm; padding: 15px; min-height: 90vh">
        <div class="to-print">
          @include('errors')
        </div>

        @include('admin.invoices.payment_form')
        @include('admin.invoices.payment_edit')
        <div class="container" style="width:100%; margin: auto;">
          <div style="display: flex; align-items: center; gap: 5px; ">
            @can('invoice-edit')
              <a title="Invoice Edit" href="{{ route('invoices.edit', $invoice->id) }}"
                class="btn btn-info btn-circle btn-sm" style="align-content: center;">
                <span class="fa fa-pencil"></span>
              </a>
            @endcan
            @can('invoice-view')
              <a title="Download PDF" target="_blank" class="btn btn-warning btn-circle btn-sm waves-effect waves-light"
                href="{{ route('invoice_pdf', $invoice->id) }}" style="align-content: center;">
                <i class="fa fa-file-pdf-o"></i>
              </a>
            @endcan

            @can('payment-add')
              <button title="Add Payment" onclick="addPayment(`{{ $invoice->id }}`)"
                class="btn btn-info btn-circle btn-sm">
                <span class="fa fa-credit-card"></span>
              </button>
            @endcan
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="col-md-12 col-md-offset-1 ">

                <div style="width: 100%; text-align: center;">
                  <img src="{{ asset('img/logo.webp') }}" alt="logo" style="width: 140px;">
                  <div style=" font-size:20px;font-weight:bold; text-align:center">
                    Tax Invoice
                  </div>
                  <div style="margin-top: 4px; text-align:center">
                    <span style="font-size: 12px; font-weight: bold;">
                      TRN: <span>100040966200003</span>
                    </span>
                  </div>

                </div>

                <table
                  style="background-color: #f5f8f8; color: black; width: 100%; margin-top: 6px; margin-bottom: 8px; border-radius: 4px;"
                  id="print_content">
                  <tbody>
                    <tr>
                      <td colspan="3">
                        <table>
                          <tr>
                            <td>Customer</td>
                            <td>: <strong>{{ @$invoice->customer->name }}</strong></td>
                          </tr>
                          <tr>
                            <td>Phone</td>
                            <td>: <strong>{{ @$invoice->customer->phone }}</strong></td>
                          </tr>
                          <tr>
                            <td>Address</td>
                            <td>: <strong>Dubai U.A.E</strong></td>
                          </tr>
                        </table>
                      </td>
                      <td colspan="2">
                        <table style="text-align:left; width: 100%;">
                          <tr>
                            <td>Invoice No</td>
                            <td>: <strong
                                style="color: red;">{{ 'JAM' . str_pad($invoice->id, 6, '0', STR_PAD_LEFT) }}</strong>
                            </td>
                          </tr>
                          <tr>
                            <td>Invoice Date</td>
                            <td>: <strong>{{ date('Y-m-d', strtotime(@$invoice->invoice_date)) }}</strong>
                            </td>
                          </tr>
                          <tr>
                            <td>Due Balance</td>
                            <td>: <strong>@money($invoice->vehicles->sum('sold_price') - $invoice->discount - $invoice->payments->sum('payment_amount'), AED)</strong>
                            </td>
                          </tr>
                        </table>
                      </td>
                      {{-- <td colspan="2">
                <table dir="rtl" style="text-align:right; width: 100%;">
                  <tr>
                    <td>مشتری</td>
                    <td>: <strong>{{ @$invoice->customer->name }}</strong></td>
                  </tr>
                  <tr>
                    <td>المتحرک</td>
                    <td>: <strong>{{ @$invoice->customer->phone }}</strong></td>
                  </tr>
                  <tr>
                    <td>العنوان</td>
                    <td>: <strong>Dubai U.A.E</strong></td>
                  </tr>
                </table>
              </td> --}}
                    </tr>
                  </tbody>
                </table>

                <div id="yoba">
                  <table class="table table-bordered" style="width: 100%; border: unset;">
                    <thead>
                      <tr>
                        <th class="th1">#</th>
                        <th class="th1">Vehicle Description</th>
                        <th class="th1">Amount</th>
                        <th class="th1">Sub Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($invoice->vehicles as $key => $vehicle)
                        <tr style="width: 70mm;">
                          <td class="td1">{{ $key + 1 }}</td>
                          <td class="td1">
                            <strong>{{ @$vehicle->year . ' ' . @$vehicle->make . ' ' . @$vehicle->model . ' ' . @$vehicle->color }}</strong>
                            <br>
                            VIN: <strong>{{ @$vehicle->vin }}</strong>
                            <br>
                            Lot#: <strong>{{ @$vehicle->lot_number }}</strong>
                          </td>
                          <td class="td1">@money($vehicle->sold_price, AED)</td>
                          <td class="td1">@money($vehicle->sold_price, AED)</td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="2" class="no-border" style="border: none !important;"></td>
                        <td class="td1" colspan="2">
                          <div style="clear: both;">
                            <span style="float: left;"> Sub Total</span>
                            <span style="font-weight: bold; float: right;">
                              @money(@$invoice->vehicles->sum('sold_price'), AED)
                            </span>
                          </div>
                          @if ($invoice->discount > 0)
                            <div style="clear: both;">
                              <span style="float: left;">Discount</span>
                              <span style="font-weight: bold; float: right;">
                                -@money(@$invoice->discount, AED)
                              </span>
                            </div>
                          @endif
                          <div style="clear: both;">
                            <span style="float: left;">Total</span>
                            <span style="font-weight: bold; float: right;">
                              @money(@$invoice->vehicles->sum('sold_price') - @$invoice->discount, AED)
                            </span>
                          </div>
                          <div style="clear: both;"></div>
                        </td>
                      </tr>
                    </tfoot>
                  </table>

                  @if (count($invoice->payments) > 0)
                    <div id="payments-section" style="margin: 10px 0;">
                      <div style="text-align: left; font-weight: bold; margin: 5px 0;">Payments</div>
                      <table class="table table-bordered" width="100%">
                        <tbody>
                          <tr>
                            <th class="td1">#</th>
                            <th class="td1">Payment Amount</th>
                            <th class="td1">Date</th>
                            <th class="td1">Description</th>
                            <th class="td1">Link</th>
                            <th class="td1">Action</th>
                          </tr>
                          @foreach ($invoice->payments as $key => $payment)
                            <tr>
                              <td class="td1">{{ $key + 1 }}</td>

                              <td class="td1">@money(@$payment->payment_amount, AED)
                              </td>
                              <td class="td1" style="text-align:right;">{{ $payment->payment_date }}</td>
                              <td class="td1" style="max-width: 160px;">
                                {{ $payment->description }}
                              </td>
                              <td class="td1" style="text-align:center;">
                                @if ($payment->evidence_link)
                                  <a href="{{ $payment->evidence_link }}" target="_blank" style="cursor: pointer;"
                                    class="btn btn-info btn-circle btn-sm waves-effect waves-light">
                                    <i class="fa fa-link"></i>
                                  </a>
                                @endif
                              </td>
                              <td class="td1" style="text-align:center;">
                                <div style="display: flex; align-items: center; gap: 5px;">
                                  @can('payment-edit')
                                    <button
                                      onclick="updatePayment('{{ $invoice->id }}', '{{ $payment->id }}', '{{ $payment->payment_amount }}', '{{ $payment->discount }}', '{{ $payment->payment_date }}', '{{ $payment->evidence_link }}', '{{ $payment->description }}')"
                                      class="btn btn-info btn-circle btn-sm">
                                      <span class="fa fa-pencil"></span>
                                    </button>
                                  @endcan
                                  @can('payment-delete')
                                    <form method="POST" id="payment_delete_{{ $payment->id }}"
                                      action="{{ route('invoice_payments.destroy', $payment->id) }}"
                                      style="display: inline-block; margin: 0;">
                                      @method('delete')
                                      @csrf
                                      <a onclick="confirmDeletePayment('{{ $payment->id }}')"> <i class="fa fa-trash-o"
                                          style="font-size:16px; color:red; cursor:pointer;"></i></a>
                                    </form>
                                  @endcan
                                </div>
                              </td>
                            </tr>
                          @endforeach
                          <tr>
                            <th class="td1" colspan="2">Total Paid</th>
                            <th style="text-align:right;" class="td1">@money($invoice->payments->sum('payment_amount'), AED)</th>
                            <th class="td1">Due Balance</th>
                            <th style="text-align:right;" colspan="2" class="td1">@money($invoice->vehicles->sum('sold_price') - $invoice->discount - $invoice->payments->sum('payment_amount'), AED)</th>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  @endif

                  <table width="100%">
                    <tbody>
                      @if ($invoice->description)
                        <tr style="background-color: #f5f8f8; color: black;">
                          <th
                            style="padding-left:10px; padding-right:10px; width:100%; padding-top: 10px; padding-bottom: 5px;">
                            <span style="text-align:left;">Additional Note
                              : {{ $invoice->description }}
                            </span>
                          </th>
                        </tr>
                      @endif
                      <tr style="background-color: #f5f8f8; color: black;">
                        <td
                          style="padding-left:35% !important; width:100% !important; padding-top: 10px !important; padding-bottom: 10px !important;">
                          <b>Wire Transfer Information:</b><br>
                          Account Name: Jabal AL Madinah <br />
                          Account Number: ********** <br />
                          Currency: <br />
                          BIC Code: <br />
                          IBAN: <br />
                          Bank Name : Bank Name <br />
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  {{-- <table width="100%">
            <tbody>
              <tr>
                <th style="background-color: #eaf4f4;">Phone: <br>
                  M Phone
                </th>
                <th style="background-color: #eaf4f4;">Fax:
                  <br>N Fax
                </th>
                <th style="background-color: #eaf4f4;">
                  Website:<br>O Web</th>
                <th style="background-color: #eaf4f4;">
                  Facebook:<br>P Fb</th>
              </tr>
            </tbody>
          </table> --}}
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

@stop

@push('js')
  <script>
    function confirmDeletePayment(paymentId) {
      if (confirm('Payment will be deleted. Continue?')) {
        var request = $.ajax({
          url: "/invoice_payments/" + paymentId,
          method: "DELETE",
          data: {
            _token: "{{ csrf_token() }}"
          },
        });

        request.done(function(msg) {
          $('#view_invoice_modal').modal('hide');
          window.location.reload();
        });

        request.fail(function(jqXHR, textStatus) {
          alert('Failed to delete payment: ' + jqXHR.responseJSON.message);
        });
      }
    }
  </script>

  <script type="text/javascript">
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
          payment_date: $('#payment_form input[name="payment_date"]').val(),
          evidence_link: $('#payment_form input[name="evidence_link"]').val(),
          description: $('#payment_form textarea[name="description"]').val(),
        },
        success: function(res) {
          if (res.status === 'success') {
            $('#payment_form').trigger("reset");
            $("#payment_form_modal").modal("hide");
            window.location.reload();

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
      console.log(invoiceId, paymentId, paymentAmount, discount, paymentDate, evidenceLink, description)
      $("#payment_form_update_modal").modal("show");
      var datePart = paymentDate.split(' ')[0];
      $('#payment_form_update input[name="invoice_id"]').val(invoiceId);
      $('#payment_form_update input[name="payment_id"]').val(paymentId);
      $('#payment_form_update input[name="payment_amount"]').val(paymentAmount);
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
          payment_date: $('#payment_form_update input[name="payment_date"]').val(),
          evidence_link: $('#payment_form_update input[name="evidence_link"]').val(),
          description: $('#payment_form_update textarea[name="description"]').val(),
        },
        success: function(res) {
          if (res.status === 'success') {
            $('#payment_form_update').trigger("reset");
            $("#payment_form_update_modal").modal("hide");
            $('#view_invoice_modal').modal('hide');
            window.location.reload();
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
            Swal.fire({
              position: 'top left',
              icon: 'error',
              title: res.message,
              showConfirmButton: false,
              timer: 3000
            });
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
  </script>
@endpush
