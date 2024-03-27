<table class="table table-bordered table-hover content-table bg-white" >
    <thead class="bg-info">
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Time Zone</th>
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
        @foreach ($users as $i => $u)
            <tr id="searchBody">
                <td>{{ $i + 1 }}</td>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ @$u->time_zones->name }}</td>
                <td>
                    @if($u->active == 1)
                        <span class="tag tag-success" >Active</span>
                    @else
                        <span class="tag tag-warning" >Deactive</span>
                    @endif
                </td>
                <td>{{ @$u->createdBy->name }}</td>
                <td>{{ @$u->updatedBy->name }}</td>
                <td>{{ (new DateTime($u->created_at))->format('Y-m-d H:i')  }} </td>
                <td>{{ (new DateTime($u->updated_at))->format('Y-m-d H:i')  }} </td>
                <td>
                    <div style="display: flex; justify-content: space-around; align-items: center;">
                        @can('user-edit')
                            <a href="{{ route('users.edit',$u->id) }}"> <i class="fa fa-edit" style="font-size:16px; cursor:pointer;"></i> </a>
                        @endcan
                        <a href="{{ route('users.show',$u->id) }}"> <i class="fa fa-eye" style="font-size:16px; cursor:pointer;"></i> </a>
                        @can('user-delete')
                        <form method="POST" id="delete_{{ $u->id }}" action="{{ route('users.destroy',$u->id)}}">
                            @method('delete')
                            @csrf
                            <a onclick="confirmDelete('{{ $u->id }}')" > <i class="fa fa-trash-o" style="font-size:16px; color:red; cursor:pointer;" ></i></a>
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
            <th>Full Name</th>
            <th>Email</th>
            <th>Time Zone</th>
            <th>Status</th>
            <th>Created By</th>
            <th>Updated By</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>

@if ($users instanceof \Illuminate\Pagination\LengthAwarePaginator)
    {{ $users->appends(Request::All())->links() }}
@endif

  <script>
    function confirmDelete(slug) {
        
        if (confirm('Data will be deleted. Continue?')) {
            console.log("Confirmed.",slug);
            document.getElementById('delete_' + slug).submit();
        }
    }
</script>