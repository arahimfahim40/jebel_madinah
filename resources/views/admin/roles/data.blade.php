<table class="table table-bordered table-hover content-table bg-white" >
    <thead class="bg-info">
        <tr>
            <th>#</th>
            <th>name</th>
            <th>Number Of Permissions</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php $id = 1; ?>
        @foreach ($roles as $i => $r)
            <tr id="searchBody">
                <td>{{ $i + 1 }}</td>
                <td>{{ ucfirst($r->name) }}</td>
                <td>{{ $r->permissions_count }}</td>
                <td>{{ (new DateTime($r->created_at))->format('Y-m-d H:i')  }} </td>
                <td>{{ (new DateTime($r->updated_at))->format('Y-m-d H:i')  }} </td>
                <td>
                    <div style="display: flex; justify-content: space-around; align-items: center;">
                        @can('role-edit')
                        <a href="{{ route('roles.edit',$r->id) }}"> <i class="fa fa-edit" style="font-size:16px; cursor:pointer;"></i> </a>
                        @endcan
                        @can('role-view')
                        <a href="{{ route('roles.show',$r->id) }}"> <i class="fa fa-eye" style="font-size:16px; cursor:pointer;"></i> </a>
                        @endcan
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot class="bg-info">
        <tr>
            <th>#</th>
            <th>name</th>
            <th>Number Of Permissions</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>

@if ($roles instanceof \Illuminate\Pagination\LengthAwarePaginator)
    {{ $roles->appends(Request::All())->links() }}
@endif



