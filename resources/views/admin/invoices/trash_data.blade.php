<table class="table table-bordered table-hover content-table bg-white">
  <thead class="bg-info">
    <tr>
      <th>#</th>
      <th>INV#</th>
      <th>Customer</th>
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
      <th>Description</th>
      @can('invoice-restore')
      <th>Restore</th>
    @endcan
    </tr>
  </thead>
  <tbody>
    <?php $id = 1; ?>
    @foreach ($invoices as $index => $item)
      @php
        $soldPrice = $item->vehicles->sum('sold_price');
        $paymentAmount = $item->payments->sum('payment_amount');
        $due_balance = $soldPrice - $item->discount - $paymentAmount;
      @endphp
      <tr id="searchBody">
        <td>{{ $index + 1 }}</td>
        @can('vehicle-change-status')
          <td>
            <input name="status[{{ $item->id }}]" type="checkbox" style="width:25px; height:20px;" class="checkbox"
              data-id="{{ $item->id }}" data-status="{{ $item->status }}" />
          </td>
        @endcan
        <td>{{ 'JAM' . str_pad($item->id, 6, '0', STR_PAD_LEFT) }}</td>
        <td>{{ $item->customer->name }}</td>
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
        <td>@money($soldPrice, AED)</td>
        <td>@money($item->discount, AED)</td>
        <td>@money($paymentAmount, AED)</td>
        <td style="max-width: 160px;">
          {{ $item->payments->pluck('payment_date')->join(' | ') }}
        </td>
        <td>@money($soldPrice - $item->discount - $paymentAmount, AED)</td>
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

        <td style="max-width: 160px;">{{ $item->description }}</td>
        @can('invoice-restore')
        <td>
          <a onclick="restoreInvoice('{{ $item->id }}')" style="cursor:pointer; display: flex; align-items: center;">
            <i class="fa fa-undo" style="font-size:16px; color:red; margin: 0;"> </i>
          </a>
        </td>
      @endcan
      </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <th>#</th>
      <th>INV#</th>
      <th>Customer</th>
      <th>Vin</th>
      <th>Invoice Date</th>
      <th>Due Date</th>
      <th>Status</th>
      <th>Amount</th>
      <th>Total paid</th>
      <th>Payment Date</th>
      <th>Due Balance</th>
      <th>Discount</th>
      <th>Age</th>
      <th>Description</th>
      @can('invoice-restore')
      <th>Restore</th>
    @endcan
    </tr>
  </tfoot>
</table>

@if ($invoices instanceof \Illuminate\Pagination\LengthAwarePaginator)
  {{ $invoices->appends(Request::All())->links() }}
@endif
