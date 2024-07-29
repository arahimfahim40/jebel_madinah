@extends('admin.layout.main')
@section('title', 'Customer Reports View')
@section('style')
  <link href="{{ asset('assets\vazirmatn-v33.003/Vazirmatn-Variable-font-face.css') }}" rel="stylesheet">
  <style>
    .content-table {
      font-family: 'Comic Sans MS';
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
@stop
@section('content')

  <div class="site-content">
    <div class="content-area py-1">
      <div class="container-fluid bg-white">

        @include('errors')
        <div id="header-title"
          style="display: flex; flex-direction: column; justify-content: space-between; align-items:center; padding: 10px;">
          <div>
            <img src="{{ asset('/img/logo.webp') }}" height="140px">
          </div>
          <div style="display: inline; text-align:center; margin-top: -10px;">
            <div style="font-size: 24px; font-weight: bold;">JABAL AL MADINAH</div>
            <div style="font-size: 18px; font-weight: bold;">Customer Statement Report</div>
          </div>
          {{-- <div style="width: 200px;"></div> --}}
        </div>
        <div id="searchResult" class="table-responsive">
          <table class="table table-bordered table-hover content-table">
            <thead class="bg-info">
              <tr class="table-header-footer bordered">
                <th colspan="13" style="text-align: center; font-family: Vazirmatn; font-size: 20px;">
                  <div style="display: flex; flex-direction: row; justify-content: space-between; align-items:center;">
                    <a class="btn btn-warning mx-1 text-white" href="{{ route('customers.reports.pdf', @$customer->id) }}"
                      style="float: left; border-radius: 5px;">
                      <i class="fa fa-file-pdf-o"></i> PDF
                    </a>
                    <span style="padding: 0 5px;">{{ @$customer->name }}</span>
                    <div style="width: 80px;"></div>
                  </div>
                </th>
              </tr>
              <tr class="table-header-footer bordered">
                <th>No</th>
                <th>INV#</th>
                <th>Vin</th>
                <th>Invoice Date</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Amount</th>
                <th>Discount</th>
                <th>Total paid</th>
                <th>Payment Date</th>
                <th>Due Balance</th>
                <th>Age</th>
              </tr>
            </thead>
            <tbody>
              @php
                $total = 0;
                $total_received = 0;
                $total_due_balance = 0;
              @endphp
              @forelse($invoices as $item)
                @php
                  $soldPrice = $item->vehicles->sum('sold_price');
                  $paymentAmount = $item->payments->sum('payment_amount');
                  $due_balance = $soldPrice - $item->discount - $paymentAmount;
                @endphp
                <tr class="bordered">
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ 'JAM' . str_pad($item->id, 6, '0', STR_PAD_LEFT) }}</td>
                  <td style="max-width: 150px;">{{ $item->vehicles->pluck('vin')->join(' | ') }}</td>
                  <td>{{ $item->invoice_date }}</td>
                  <td>{{ $item->invoice_due_date }}</td>
                  <td>
                    @if ($item->status == 'paid')
                      <span class="tag tag-success">{{ ucwords(str_replace('_', ' ', $item->status)) }}</span>
                    @elseif($item->status == 'past_due')
                      <span class="tag tag-danger">{{ ucwords(str_replace('_', ' ', $item->status)) }}</span>
                    @elseif($item->status == 'open')
                      <span class="tag tag-info">{{ ucwords(str_replace('_', ' ', $item->status)) }}</span>
                    @else
                      <span class="tag tag-secondary">{{ ucwords(str_replace('_', ' ', $item->status)) }}</span>
                    @endif
                  </td>
                  <td>@money($soldPrice)</td>
                  <td>{{ $item->discount }}</td>
                  <td>@money($paymentAmount)</td>
                  <td>
                    {{ $item->payments->pluck('payment_date')->join(' | ') }}
                  </td>
                  <td>@money($soldPrice - $item->discount - $paymentAmount)</td>
                  <td>
                    @php
                      $age = '';
                      if ((int) $due_balance > 0) {
                          $today = now();
                          $inv_date_ude = now()->parse($item->invoice_due_date);
                          if ($today > $inv_date_ude) {
                              $age = '<span class="tag tag-danger">' . $today->diffInDays($inv_date_ude) . '</span>';
                          }
                      }
                    @endphp
                    {!! $age !!}
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="12">
                    <center class="alert alert-warning">No Data</center>
                  </td>
                </tr>
              @endforelse
            </tbody>
            <tfoot>
              <tr class="table-header-footer bordered">
                <th>No</th>
                <th>INV#</th>
                <th>Vin</th>
                <th>Invoice Date</th>
                <th>Due Date</th>
                <th>Status</th>

                <th>@money(
                    $invoices->sum(function ($invoice) {
                        return $invoice->vehicles->sum('sold_price');
                    })
                )</th>
                <th>@money($invoices->sum('discount'))</th>
                <th>@money(
                    $invoices->sum(function ($invoice) {
                        return $invoice->payments->sum('payment_amount');
                    })
                )</th>
                <th>Payment Date</th>
                <th>@money(
                    $invoices->sum(function ($invoice) {
                        return $invoice->vehicles->sum('sold_price') - $invoice->discount - $invoice->payments->sum('payment_amount');
                    })
                )</th>
                <th>Age</th>
              </tr>
            </tfoot>
          </table>
          <table width="100%" class="mb-3 mx-1 content-table">
            <tbody>
              <tr>
                <td style="width: 33%;">
                  <div style="display: flex; vertical-align: center; align-items: center">
                    <span style="padding-right: 5px; font-weight:bold;">Phone:</span> +00000000000
                  </div>
                </td>
                <td style="width: 33%;">
                  <div style="display: flex; vertical-align: center; align-items: center">
                    <span style="padding-right: 5px; font-weight:bold;">Email:</span> email@example.com
                  </div>
                </td>
                <td>
                  <div style="display: flex; vertical-align: center; align-items: center">
                    <span style="padding-right: 5px; font-weight:bold;">Address:</span> Adresse line, UAE
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
@stop

@section('js')

  <script>
    function checkAll(checkbox) {
      if (checkbox.checked == true) {
        $(".checkbox").prop('checked', true);
      } else {
        $(".checkbox").prop('checked', false);
      }
    }

    function changeStatus() {
      var idsArr = [];
      $(".checkbox:checked").each(function() {
        idsArr.push($(this).attr('data-id'));
      });

      if (idsArr.length <= 0) {
        Swal.fire({
          position: 'center',
          icon: 'info',
          title: "Please select atleast one record to change the status.",
          showConfirmButton: false,
          timer: 4000
        });
      } else {
        $('#clearance_change_status_modal').modal('show');
      }
    }

    function submitForm() {
      var status = $(".inv_status:checked").val();
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
        // Create a form element
        var form = $('<form>', {
          action: '/clearance_status_change',
          method: 'POST'
        });

        var moveToPaidFlag = true;
        $(".checkbox:checked").each(function() {
          // Create an input element
          var input = $('<input>', {
            type: 'input',
            name: `status[${$(this).attr('data-id')}]`,
            value: status
          });
          if (status == 4 && $(this).attr('data-balance') != 0) {
            moveToPaidFlag = false;
          }
          // Append the input element to the form
          form.append(input);
        });

        if (moveToPaidFlag == true) {
          var csrfToken = '{{ csrf_token() }}'; // Retrieve the CSRF token value from Laravel
          var csrfInput = $('<input>', {
            type: 'hidden',
            name: '_token',
            value: csrfToken
          });
          form.append(csrfInput);

          // Append the form to the document body
          $('body').append(form);

          // Submit the form
          form.submit();
        } else {
          Swal.fire({
            position: 'center',
            icon: 'info',
            title: "At last one of your invoices due balance is not zero and you can move it to paid!",
            showConfirmButton: false,
            timer: 4000
          });
          return;
        }
      }
    }
  </script>
@endsection
