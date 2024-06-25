
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
                    <button href="#" target="_blank" style="cursor: pointer;" onclick="invoice_view_modal('{{ $item->id }}')" class="btn btn-success btn-circle btn-sm waves-effect waves-light">
                        <i class="fa fa-eye"></i>
                    </button>
                    <a target="_blank"  class="btn btn-warning btn-circle btn-sm waves-effect waves-light" href="{{route('invoice_pdf',$item->id)}}" style="align-content: center;"><i class="fa fa-file-pdf-o"></i></a>
                    <a href="{{ route('invoices.edit', $item->id) }}" class="btn btn-info btn-circle btn-sm" style="align-content: center;"><span class="fa fa-pencil"></span></a>
                    <button
                        onclick="updatePayment(`{{ $item->id }}`)"
                        class="btn btn-info btn-circle btn-sm">
                        <span class="fa fa-credit-card"></span>
                    </button>
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


