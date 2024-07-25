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
    padding: 6px;
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

<div class="site-content">
  <div class="content-area py-1">
    <div class="container-fluid bg-white">

      @include('errors')
      <div id="header-title"
        style="display: flex; flex-direction: column; justify-content: space-between; align-items:center; padding: 10px;">
        <div style="text-align: center;">
          <img src="{{ asset('/img/logo.webp') }}" width="160px">
        </div>
        <div style="display: inline; text-align:center; margin-top: -10px;">
          <div style="font-size: 24px; font-weight: bold;">JABAL AL MADINAH</div>
          <div style="font-size: 18px; font-weight: bold;">Customer Statement Report</div>
        </div>
        <div style="width: 200px;"></div>
      </div>
      <div id="searchResult" class="table-responsive">
        <table class="table table-bordered table-hover content-table">
          <thead class="bg-info">
            <tr class="table-header-footer bordered">
              <th colspan="12" style="text-align: center; font-family: Vazirmatn; font-size: 20px;">
                <div style="display: flex; flex-direction: row; justify-content: space-between; align-items:center;">
                  <span style="padding: 0 5px;">{{ @$invoices[0]->customer->name }}</span>
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
                <td style="max-width: 120px;">{{ $item->vehicles->pluck('vin')->join(' | ') }}</td>
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
