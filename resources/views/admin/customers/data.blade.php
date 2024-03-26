<table class="table table-bordered table-hover content-table bg-white" >
    <thead class="bg-info">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Created By</th>
            <th>Updated By</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $id = 1; ?>
        @foreach ($customers as $i => $c)
            <tr id="searchBody">
                <td>{{ $i + 1 }}</td>
                <td>{{ $c->name }}</td>
                <td>{{ $c->email }}</td>
                <td>{{ $c->phone }}</td>
                <td>{{ $c->status }}</td>
                <td>{{ @$c->createdBy->name }}</td>
                <td>{{ @$c->updatedBy->name }}</td>
                <td>{{ (new DateTime($c->created_at))->format('Y-m-d H:i')  }} </td>
                <td>{{ (new DateTime($c->updated_at))->format('Y-m-d H:i')  }} </td>
                <td>
                    <div style="display: flex; justify-content: space-around; align-items: center;">
                        @can('customer-edit')
                            <a href="{{ route('customers.edit',$c->id) }}"> <i class="fa fa-edit" style="font-size:16px; cursor:pointer;"></i> </a>
                        @endcan
                        <a href="{{ route('customers.show',$c->id) }}"> <i class="fa fa-eye" style="font-size:16px; cursor:pointer;"></i> </a>
                        @can('customer-delete')
                        <form method="POST" id="delete_{{ $c->id }}" action="{{ route('customers.destroy',$c->id)}}">
                            @method('delete')
                            @csrf
                            <a onclick="confirmDelete('{{ $c->id }}')" > <i class="fa fa-trash-o" style="font-size:16px; color:red; cursor:pointer;" ></i></a>
                        </form>
                        @endcan
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot class="bg-info">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Created By</th>
            <th>Updated By</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>

@if ($customers instanceof \Illuminate\Pagination\LengthAwarePaginator)
    {{ $customers->appends(Request::All())->links() }}
@endif


<script>
    function confirmDelete(slug) {
        if (confirm('Data will be deleted. Continue?')) {
            console.log("Confirmed.",slug);
            document.getElementById('delete_' + slug).submit();
        }
    }
</script>