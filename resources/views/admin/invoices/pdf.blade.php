<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css">
      @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100;300;500;600;700&display=swap');

      .arabic {
        direction: rtl;
        font-family: 'Vazirmatn', sans-serif;
        font-weight: 300;
      }

      th {
        font-weight: bold;
      }

      .note-popover {
        display: none;
      }

      @media print {
        .to-print {
          display: none;
          background: transparent;
          outline: none;
          border: none;
        }

        .site-sidebar {
          display: none;
        }

        div.footer-in-print {
          position: fixed;
          bottom: 0px;
          width: 100%;
        }

        .site-content {
          margin-top: 0px !important;
        }

        .container-fluid {
          padding: 0px !important;
        }

        .table-bordered td,
        .table-bordered th {
          border: 1px solid #c3c3c3 !important;
        }

        .no-border {
          border: none !important;
        }
      }

      @media screen {
        .site-content {
          font-size: 120% !important;
        }

        .only-screen-hide {
          display: none;
        }
      }

      .no-border {
        border: none !important;
      }

      .arabic {
        font-family: 'Noto Sans Arabic', sans-serif;
      }

      .text-uppercase {
        text-transform: uppercase;
      }

      .rtl-text {
        direction: rtl;
        float: right;
      }

      .radios-right {
        border: 2px solid #0081a1;
        border-top-right-radius: 25px;
        background: #0081a1;
        text-align: center !important;
        padding-top: 10px;
      }

      .radios-left {
        border: 2px solid #0081a1;
        border-bottom-left-radius: 25px;
        background: #0081a1;
        text-align: center !important;
        padding-top: 10px;
      }

      .center {
        margin: auto;
        width: 100%;
        border: 1px solid black;
        padding: 10px;
      }

      .colspan-top-text {
        vertical-align: top;
        text-align: left;
      }

      .bordered {
        border: 1px solid #c3c3c3;
      }

      .f-11 {
        font-size: 11px;
      }

      .f-12 {
        font-size: 12px;
      }

      label {
        font-weight: bold;
      }

      .bt-1 {
        border-top: 1px solid #c3c3c3;
      }

      .br-1 {
        border-right: 1px solid #c3c3c3;
      }

      .bl-1 {
        border-left: 1px solid #c3c3c3;
      }

      .bb-1 {
        border-bottom: 1px solid #c3c3c3;
      }

      .table-bordered td,
      .table-bordered th {
        border: 1px solid #c3c3c3;
      }

      #payment-table th,
      #payment-table td {
        padding: 3px;
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
  </head>

  <body>
    <div class="site-content " style="margin-top: 60px; padding: 0px; background-color: #e8ebf0;">
      <div class="content-area py-1" style="margin: 0px;">
        <div class="container-fluid  bg-white" style="margin-top: 0px; max-width: 250mm; padding: 15px; ">
          <div class="to-print">
            @include('errors')
          </div>

          <div style="width: 100%; text-align: center;">
            <img src="{{ asset('img/logo.webp') }}" alt="logo" style="width: 140px;">
            <div style="margin-top: 10px; font-size:20px;font-weight:bold; text-align:center">
              <strong>Tax Invoice |</strong>
              <strong>
                <span>&nbsp;</span>
                <span>فاتورة ضريبية</span>
              </strong>
            </div>
            <div style="margin-top: 10px; text-align:center">
              <strong> <span class="arabic" style="font-size: 18px; font-weight:500;">
                  TRN: <span>100440701900003</span>
                </span></strong>
            </div>

          </div>

          <table style="width: 100%;" id="print_content">
            <tbody>
              <tr>
                <td colspan="2">
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
                <td colspan="1">
                  <table style="text-align:left; width: 100%;">
                    <tr>
                      <td>Invoice No / رقم</td>
                      <td>: <strong
                          style="color: red;">{{ 'JAM' . str_pad($invoice->id, 6, '0', STR_PAD_LEFT) }}</strong>
                      </td>
                    </tr>
                    <tr>
                      <td>Date / التاریخ</td>
                      <td>: <strong>{{ date('Y-m-d', strtotime(@$invoice->invoice_date)) }}</strong>
                      </td>
                    </tr>
                  </table>
                </td>
                <td colspan="2">
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
                </td>
              </tr>
            </tbody>
          </table>

          <table class="table table-bordered mt-1" style="width: 100%;max-width: 100%; border: unset;">
            <thead>
              <tr style="border-color: #c3c3c3;">
                <th style="border: 1px solid #c3c3c3;">#</th>
                <th style="border: 1px solid #c3c3c3;">Vehicle Description</th>
                <th style="border: 1px solid #c3c3c3;">Amount</th>
                <th style="border: 1px solid #c3c3c3;">Sub Total</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($invoice->vehicles as $key => $vehicle)
                <tr class="">
                  <td>{{ $key + 1 }}</td>
                  <td>
                    <strong>{{ @$vehicle->year . ' ' . @$vehicle->make . ' ' . @$vehicle->model . ' ' . @$vehicle->color }}</strong>
                    <br>
                    VIN: <strong>{{ @$vehicle->vin }}</strong>
                    <br>
                    Lot#: <strong>{{ @$vehicle->lot_number }}</strong>
                  </td>
                  <td>@money($vehicle->sold_price)</td>
                  <td>@money($vehicle->sold_price)</td>
                </tr>
              @endforeach
              <tr>
                <td colspan="2" class="no-border" style="border: none !important;"></td>
                <td colspan="3">
                  <div style="display:flex; justify-content:space-between">
                    <span> Sub Total</span>
                    <span>
                      <strong>@money(@$invoice->vehicles->sum('sold_price'))</strong>
                    </span>
                  </div>
                  <div style="display:flex; justify-content:space-between">
                    <span>Discount</span>
                    <span style="font-weight: bold;">
                      @money(@$invoice->discount)
                    </span>
                  </div>
                  <div style="display:flex; justify-content:space-between">
                    <span>Total</span>
                    <span style="font-weight: bold;">
                      @money(@$invoice->vehicles->sum('sold_price') - @$invoice->discount)
                    </span>
                  </div>

                </td>
              </tr>
            </tbody>
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
                    <th class="td1">Link</th>
                    <th class="td1">Description</th>
                    <th class="td1">Action</th>
                  </tr>
                  <?php
                  $totalPayment = 0;
                  $totaldiscount = 0;
                  ?>
                  @foreach ($invoice->payments as $key => $payment)
                    <tr>
                      <td class="td1">{{ $key + 1 }}</td>

                      <td class="td1" style="font-size: 10px;">${{ number_format($payment->payment_amount, 2) }}
                      </td>
                      <td class="td1" style="text-align:right;">{{ $payment->payment_date }}</td>

                      <td class="td1" style="text-align:right;">
                        <a href="{{ $payment->evidence_link }}" target="_blank" style="cursor: pointer;"
                          class="btn btn-info btn-circle btn-sm waves-effect waves-light">
                          <i class="fa fa-link"></i>
                        </a>
                      </td>
                      <td class="td1" style="max-width: 150px;">
                        {{ $payment->description }}
                      </td>
                      <td>
                        <div style="display: flex; align-items: center; gap: 5px;">
                          <button
                            onclick="updatePayment('{{ $invoice->id }}', '{{ $payment->id }}', '{{ $payment->payment_amount }}', '{{ $payment->discount }}', '{{ $payment->payment_date }}', '{{ $payment->evidence_link }}', '{{ $payment->description }}')"
                            class="btn btn-info btn-circle btn-sm">
                            <span class="fa fa-pencil"></span>
                          </button>
                          <form method="POST" id="payment_delete_{{ $payment->id }}"
                            action="{{ route('invoice_payments.destroy', $payment->id) }}"
                            style="display: inline-block; margin: 0;">
                            @method('delete')
                            @csrf
                            <a onclick="confirmDeletePayment('{{ $payment->id }}')"> <i class="fa fa-trash-o"
                                style="font-size:16px; color:red; cursor:pointer;"></i></a>
                          </form>
                        </div>
                      </td>
                    </tr>
                    <?php
                    $totalPayment = $totalPayment + $payment->payment_amount;
                    $totaldiscount = $totaldiscount + $payment->discount;
                    ?>
                  @endforeach
                  <tr>
                    <th class="td1"></th>
                    <th class="td1">Sub Total</th>
                    <th style="text-align:right;" class="td1">${{ number_format(@$totalPayment, 2) }}</th>
                    <th style="text-align:right;" class="td1">${{ number_format(@$totaldiscount, 2) }}</th>
                    <th style="text-align:right;" class="td1"></th>
                    <th style="text-align:right;" class="td1">
                    </th>
                  </tr>
                </tbody>
              </table>
            </div>
          @endif

          <div style="width:100%; display: flex; justify-content:space-between;" class="mt-3 mb-1">
            <div style="font-size: 15px;">
              <span dir="ltr" style="font-size: 13px;">Signature</span>
              <span style="font-size: 13px;">/</span>
              <span>التوقيع</span>&nbsp;
            </div>
            <div dir="rtl" style="font-size: 13px;">
              <span style="font-size: 15px;">التوقيع المستلم</span>&nbsp;
              <span>/</span>
              <span dir="ltr">Receiver's Signature</span>
              <br />
              <strong>{{ Auth::user()->username }}</strong>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 footer-in-print">
              <hr>
              <table style="width: 100%;">
                <tfoot>
                  <tr>
                    <td>
                      <span>&nbsp;</span>
                      <span>Account Number:</span>
                    </td>
                    <td colspan="4">
                      <strong>3708436165601</strong>
                      <span class="rtl-text pull-right" dir="rtl" style="text-align: right; font-size: 15px;">
                        <span>&nbsp;</span>
                        <span>رقم الحساب:</span>
                      </span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <span>&nbsp;</span>
                      <span>Account Name:</span>
                    </td>
                    <td colspan="4">
                      <strong>UNITED CARS AUCTION FOR USED CARS AND MOTOR CYCLES LLC</strong>
                      <span class="rtl-text pull-right" dir="rtl" style="text-align: right; font-size: 15px;">
                        <span>&nbsp;</span>
                        <span>اسم الحساب:</span>
                      </span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <span>&nbsp;</span>
                      <span>IBAN:</span>
                    </td>
                    <td colspan="4">
                      <strong>AE790340003708436165601</strong>
                      <span class="rtl-text pull-right" dir="rtl" style="text-align: right; font-size: 15px;">
                        <span>&nbsp;</span>
                        <span>رقم الحساب المصرفی دولی:</span>
                      </span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <span>&nbsp;</span>
                      <span>Account Type:</span>
                    </td>
                    <td colspan="4">
                      <strong>Current Account</strong>
                      <span class="rtl-text pull-right" dir="rtl"
                        style="text-align: right; font-size: 15px; unicode-bidi : bidi-override !important;">
                        <span>&nbsp;</span>
                        <span>نوع الحساب :</span>
                      </span>
                    </td>
                  </tr>
                  <tr>
                    <td width="22%">
                      <span>&nbsp;</span>
                      <span>Date Account Opend:</span>
                    </td>
                    <td colspan="4">
                      <strong> 12 Jul 2021</strong>
                      <span class="rtl-text pull-right" dir="rtl" style="text-align: right; font-size: 15px;">
                        <span>&nbsp;</span>
                        <span>تاریخ فتح الحساب:</span>
                      </span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <span>&nbsp;</span>
                      <span>Branch Name:</span>
                    </td>
                    <td colspan="4">
                      <strong>EIDUBAISOUQ</strong>
                      <span class="rtl-text pull-right" dir="rtl" style="text-align: right; font-size: 15px;">
                        <span>&nbsp;</span>
                        <span>اسم الفرع :</span>
                      </span>
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>

  </body>

</html>

{{-- @section('js')
  <script type="text/javascript" src="{{ asset('assets/summernote/summernote.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/forms-editors.js') }}"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $(".note-insert").hide();
      $(".note-image-popover").hide();
      $(".note-link-popover").hide();
      $(".note-view").hide();
      $(".note-fontname").hide();
      $('#summernote').summernote({
        spellCheck: true
      });
      $(".note-insert").hide();
      $(".note-image-popover").hide();
      $(".note-link-popover").hide();
      $(".note-view").hide();
      $(".note-fontname").hide();
      $('#summernote_email').summernote({
        spellCheck: true
      });
    });
  </script>
  <script type="text/javascript">
    // print 
    $(document).ready(function() {

      $(document).on('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && (e.key == "p" || e.charCode == 16 || e.charCode == 112 || e
            .keyCode == 80)) {
          alert("Please use the Print button below for a better rendering on the document");
          e.cancelBubble = true;
          e.preventDefault();
          e.stopImmediatePropagation();
        }
      });

      window.addEventListener('beforeprint', (event) => {
        printInvoice();
      });

      $("#btn-print").on('click', function() {
        printInvoice();
      });

      // setup modal.
      $('.tbn_print_invoice').on('click', function() {
        $("#vehicle_id").val($(this).data("vid"));
        $("#customer_name").val($(this).data("customer"));
      });

      // validate payment amount.
      $("#pay_amount").on("keyup", function() {
        var paytime = $('#payment_time').find(":selected").val();
        if (paytime == "none") {
          alert('Please select payment time.');
        }
      });
    });

    $('#add_new_payment').click(function() {
      addPayment();
    });
    $("#add_new_payment_submit").click(function(event) {
      event.preventDefault();
      var account = $('#account_id').val();
      var amount = parseFloat($('#pay_amount').val());
      var amoutFormated = amount.toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });
      var pending_amount = ($("#pending_amount_input").val() - amount);
      if (amount <= 0) {
        alert("amout must be more then zero!");
        return;
      }
      if (account == '') {
        alert("Account is required");
        return;
      }
      var advance_pay = $('#advance_pay_checkbox').is(':checked');
      var payment_time = $('#compose_email_modal #payment_time').val();
      console.log(payment_time);
      var payment_text = '';
      var new_paid_amount_row = '';
      if (advance_pay) {
        payment_text = 'We sold a vehicle of United Trade Project on ';
        new_paid_amount_row = `Advance Received Amount: <b>${amoutFormated} DH</b>`;
      } else {
        payment_text = `We received an amount of <b> ${amoutFormated} DH</b> from `;
        new_paid_amount_row = `${numToWord(++payment_time)} Payment: <b>${amoutFormated} DH</b>`;
      }
      $('#payment_text').html(payment_text);
      $('#new_paid_amount_row').html(new_paid_amount_row);
      $('#pending_amount').html(pending_amount.toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      }));
      if (pending_amount <= 0) {
        $('#clear_note').show();
      } else {
        $('#clear_note').hide();
      }
      $('#summernote_email').summernote('reset');
      if (window.send_email_confirmed) {
        $("#add_new_payment_form").submit();
      } else {
        $('#compose_email_modal').modal('show');
      }
    });
    $('#btn-email').click(function() {
      if ($('[name="customer_id"]').val() != '') {
        $('.email-modal').modal('show');
      } else {
        Swal.fire('Customer Requires to Compose Email',
          'Customer is not specified. Please edit the vehicle and choose a customer.', 'info');
      }
    });
    $('#pay_amount, #advance_pay_checkbox').on('change', function() {
      window.send_email_confirmed = false;
      $('#send_email_confirmed').hide();
    });
    $("#confirm-email").on("click", function() {
      $('[name="email_body"]').val($('#summernote_email').summernote('code'));
      window.send_email_confirmed = true;
      $('#send_email_confirmed').show();
    });

    function numToWord(number) {
      var list = [
        "",
        "First",
        "Second",
        "Third",
        "Fourth",
        "Fifth",
        "Sixth",
        "Seventh",
        "Eighth",
        "Ninth",
        "Tenth",
        "Eleventh",
        "Twelfth",
        "Thirteenth",
        "Fourteenth",
        "Fifteenth",
        "Sixteenth",
        "Seventeenth",
        "Eighteenth",
        "Nineteenth",
      ];
      if (number >= 0 || number < 20) {
        return list[number];
      }
      return number;
    }



    function addPayment() {
      if ("{{ @$invoice->customer_phone }}" == null || "{{ @$invoice->customer_phone }}" ==
        "") {
        if ("{{ @$invoice->customer_id }}" == null || "{{ @$invoice->customer_id }}" ==
          "") {
          Swal.fire('Customer Requires to Print Invoice',
            'Customer is not specified. Please edit the vehicle and choose a customer.', 'info');
        } else {
          Swal.fire({
            title: 'Enter Customer WhatsApp Number',
            input: 'text',
            inputAttributes: {
              autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Save',
            showLoaderOnConfirm: true,
            preConfirm: (phone) => {
              if (validatePhoneNumber(phone)) {
                var phone_input = $("<input>").attr("type", "hidden").attr("name", "phone").val(
                  phone);
                var customer_id = $("<input>").attr("type", "hidden").attr("name",
                  "customer_id").val("{{ @$invoice->customer_id }}");
                $("#updateCustomerPhone").append($(phone_input));
                $("#updateCustomerPhone").append($(customer_id));
                $("#updateCustomerPhone").submit();
              } else {
                Swal.fire("Please enter a valid phone number.");
              }
            },
            allowOutsideClick: () => !Swal.isLoading()
          });
        }
      } else {
        $('.bd-example-modal-sm').modal('show');
      }
    }

    function printInvoice() {
      if ("{{ @$invoice->customer_phone }}" == null || "{{ @$invoice->customer_phone }}" ==
        "") {
        if ("{{ @$invoice->customer_id }}" == null || "{{ @$invoice->customer_id }}" ==
          "") {
          Swal.fire('Customer Requires to Print Invoice',
            'Customer is not specified. Please edit the vehicle and choose a customer.', 'info');
        } else {
          Swal.fire({
            title: 'Enter customer phone',
            input: 'text',
            inputAttributes: {
              autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Save',
            showLoaderOnConfirm: true,
            preConfirm: (phone) => {
              if (validatePhoneNumber(phone)) {
                var phone_input = $("<input>").attr("type", "hidden").attr("name", "phone").val(
                  phone.replace(/\s/g, ""));
                var customer_id = $("<input>").attr("type", "hidden").attr("name",
                  "customer_id").val("{{ @$invoice->customer_id }}");
                $("#updateCustomerPhone").append($(phone_input));
                $("#updateCustomerPhone").append($(customer_id));
                $("#updateCustomerPhone").submit();
              } else {
                Swal.fire("Please enter a valid phone number.");
              }
            },
            allowOutsideClick: () => !Swal.isLoading()
          });
        }
      } else {
        window.print();
      }
    }

    function validatePhoneNumber(input_str) {
      var regex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
      if (regex.test(input_str.replace(/\s/g, ""))) {
        return true;
      } else {
        return false;
      }
    }
  </script>

  <script type="text/javascript">
    function validate(evt) {
      var theEvent = evt || window.event;
      // Handle paste
      if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
      } else {
        // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
      }
      var regex = /[0-9]|\./;
      if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
      }
    }
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      $(".btnEditPay").on("click", function() {
        $("#edited_pay_amount").val($(this).data("val"));
        $("#iiiId").val($(this).data("iiiid"));
      });
    });
  </script>

  <script type="text/javascript">
    $('.show_delete_confirm').click(function(event) {
      var form = $(this).closest("form");
      event.preventDefault();
      Swal.fire({
        title: 'Are you sure you want to delete?',
        text: "This amount will be deleted from accounting as-well",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      $("#btn_cancel_edit_bill").on('click', function() {
        $(".edit-modal").modal('toggle');
      });
    });
  </script>

  <script type="text/javascript">
    function updatePayAmount() {
      Swal.fire({
        title: 'Do you want to save the changes?',
        text: 'Updating the payment will update the relevant transactions and an email will triggers to accouting team.',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Save',
        denyButtonText: `Don't save`,
      }).then((result) => {
        if (result.isConfirmed) {
          $("#updatePayAmount").submit();
        } else if (result.isDenied) {
          Swal.fire('Changes are not saved', '', 'warning')
        }
      });
    }
  </script>
@stop --}}
