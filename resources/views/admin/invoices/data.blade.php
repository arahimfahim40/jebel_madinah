<table class="table table-bordered table-hover content-table bg-white">
  <thead class="bg-info">
    <tr>
      <th>#</th>
      @can('invoice-change-status')
        <th><input class="checkbox_all" onclick="checkAll(this)" type="checkbox" style=" width:25px; height:20px;"></th>
      @endcan
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
      <th>Action</th>
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
        <td>{{ $index + 1 }}</td>
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

        <td style="max-width: 160px;">{{ $item->description }}</td>
        <td>
          <div style="display: flex; align-items: center; gap: 5px;">
            <a href="{{ route('invoices.show', $item->id) }}" target="_blank" style="cursor: pointer;"
              class="btn btn-success btn-circle btn-sm waves-effect waves-light">
              <i class="fa fa-eye"></i>
            </a>
            @can('invoice-view')
              <a target="_blank" class="btn btn-warning btn-circle btn-sm waves-effect waves-light"
                href="{{ route('invoice_pdf', $item->id) }}" style="align-content: center;">
                <i class="fa fa-file-pdf-o"></i>
              </a>
            @endcan
            @can('invoice-edit')
              <a href="{{ route('invoices.edit', $item->id) }}" class="btn btn-info btn-circle btn-sm"
                style="align-content: center;">
                <span class="fa fa-pencil"></span>
              </a>
            @endcan

            @can('payment-add')
              <button onclick="addPayment(`{{ $item->id }}`)" class="btn btn-info btn-circle btn-sm">
                <span class="fa fa-credit-card"></span>
              </button>
            @endcan
            @can('invoice-delete')
              <form method="POST" id="invoice_delete_{{ $item->id }}"
                action="{{ route('invoices.destroy', $item->id) }}" style="display: inline-block; margin: 0;">
                @method('delete')
                @csrf
                <a onclick="confirmDeleteInvoice('{{ $item->id }}')"
                  style="cursor:pointer; display: flex; align-items: center;">
                  <i class="fa fa-trash-o" style="font-size:16px; color:red; margin: 0;"></i>
                </a>
              </form>
            @endcan
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <th>#</th>
      @can('invoice-change-status')
        <th><input class="checkbox_all" onclick="checkAll(this)" type="checkbox" style=" width:25px; height:20px;"></th>
      @endcan
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
      <th>Action</th>
    </tr>
  </tfoot>
</table>

@if ($invoices instanceof \Illuminate\Pagination\LengthAwarePaginator)
  {{ $invoices->appends(Request::All())->links() }}
@endif

<script>
  function confirmDeleteInvoice(slug) {
    if (confirm('Invoice will be deleted. Continue?')) {
      document.getElementById('invoice_delete_' + slug).submit();
    }
  }

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
      });

      request.fail(function(jqXHR, textStatus) {
        alert('Failed to delete payment: ' + jqXHR.responseJSON.message);
      });
    }
  }
</script>
