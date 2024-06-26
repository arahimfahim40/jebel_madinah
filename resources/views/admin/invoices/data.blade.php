
<table class="table table-bordered table-hover content-table bg-white" >
    <thead class="bg-info">
        <tr>
            <th>#</th>
            <!-- <th>Edit</th> -->
            <th>Customer</th>
            <th>Exchange Rate</th>
            <th>MOVE TO OPEN</th>
            <th>INVOICE DATE</th>
            <th>DUE DATE</th>
            <th>Status</th>
            <th>DISCOUNT</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $id = 1; ?>
        @foreach ($invoices as $index => $item)
            <tr id="searchBody">
                <td>{{ $index + 1 }}</td>
                <!-- <td>
                    <a href="{{ route('invoices.edit', $item->id) }}" class="btn btn-info btn-circle waves-effect waves-light"><span class="fa fa-pencil"></span>
                    </a>
                </td> -->
                <td>{{ $item->customer->name }}</td>
                <td>{{ $item->exchange_rate }}</td>
                <td>{{ $item->move_to_open_date }}</td>
                <td>{{ $item->invoice_date }}</td>
                <td>{{ $item->invoice_due_date }}</td>
                <td>
                    @if($item->status == 'paid')
                        <span class="tag tag-success" >{{ucwords(str_replace('_', ' ', $item->status))}}</span>
                    @elseif($item->status == 'past_due')
                        <span class="tag tag-danger" >{{ucwords(str_replace('_', ' ', $item->status))}}</span>
                    @elseif($item->status == 'open')
                        <span class="tag tag-info" >{{ucwords(str_replace('_', ' ', $item->status))}}</span>
                    @else
                        <span class="tag tag-secondary" >{{ucwords(str_replace('_', ' ', $item->status))}}</span>
                    @endif
                </td>
                <td>{{ $item->discount }}</td>
                <td>{{ $item->description }}</td>
                <td>
                    <div style="display: flex; align-items: center; gap: 5px;">
                        <button href="#" target="_blank" style="cursor: pointer;" onclick="invoice_view_modal('{{ $item->id }}')" class="btn btn-success btn-circle btn-sm waves-effect waves-light">
                            <i class="fa fa-eye"></i>
                        </button>
                        <a target="_blank" class="btn btn-warning btn-circle btn-sm waves-effect waves-light" href="{{route('invoice_pdf',$item->id)}}" style="align-content: center;">
                            <i class="fa fa-file-pdf-o"></i>
                        </a>
                        <a href="{{ route('invoices.edit', $item->id) }}" class="btn btn-info btn-circle btn-sm" style="align-content: center;">
                            <span class="fa fa-pencil"></span>
                        </a>
                        <button onclick="addPayment(`{{ $item->id }}`)" class="btn btn-info btn-circle btn-sm">
                            <span class="fa fa-credit-card"></span>
                        </button>
                        <form method="POST" id="invoice_delete_{{ $item->id }}" action="{{ route('invoices.destroy',$item->id)}}" style="display: inline-block; margin: 0;">
                            @method('delete')
                            @csrf
                            <a onclick="confirmDeleteInvoice('{{ $item->id }}')" style="cursor:pointer; display: flex; align-items: center;">
                                <i class="fa fa-trash-o" style="font-size:16px; color:red; margin: 0;"></i>
                            </a>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <!-- <th>Edit</th> -->
            <th>Customer</th>
            <th>Exchange Rate</th>
            <th>MOVE TO OPEN</th>
            <th>INVOICE DATE</th>
            <th>DUE DATE</th>
            <th>Status</th>
            <th>DISCOUNT</th>
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


