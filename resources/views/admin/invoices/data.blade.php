
<table class="table table-bordered table-hover content-table bg-white" >
    <thead class="bg-info">
        <tr>
            <th>#</th>
            <th>Action</th>
            <th>Customer</th>
            <th>Exchange Rate</th>
            <th>MOVE TO OPEN</th>
            <th>INVOICE DATE</th>
            <th>DUE DATE</th>
            <th>Status</th>
            <th>DISCOUNT</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <?php $id = 1; ?>
        @foreach ($invoices as $index => $item)
            <tr id="searchBody">
                <td>{{ $index + 1 }}</td>
                <td><a target="_blank"  class="btn btn-warning btn-circle btn-sm" href="{{route('invoice_pdf',$item->id)}}"><i class="fa fa-file-pdf-o"></i></a></td>
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
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Action</th>
            <th>Customer</th>
            <th>Exchange Rate</th>
            <th>MOVE TO OPEN</th>
            <th>INVOICE DATE</th>
            <th>DUE DATE</th>
            <th>Status</th>
            <th>DISCOUNT</th>
            <th>Description</th>
        </tr>
    </tfoot>
</table>

@if ($invoices instanceof \Illuminate\Pagination\LengthAwarePaginator)
    {{ $invoices->appends(Request::All())->links() }}
@endif


