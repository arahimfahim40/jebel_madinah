<table class="table table-bordered table-hover content-table bg-white" >
    <thead class="bg-info">
        <tr>
            <th>#</th>
            <th>key</th>
            <th>Entity</th>
            <th>name</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
    <?php $id = 1; ?>
        @foreach ($permissions as $i => $p)
            <tr id="searchBody">
                <td>{{ $i + 1 }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ ucfirst($p->group_name) }}</td>
                <td>{{ ucfirst(explode("-",$p->name)[1]) }}</td>
                <td>{{ (new DateTime($p->created_at))->format('Y-m-d H:i')  }} </td>
                <td>{{ (new DateTime($p->updated_at))->format('Y-m-d H:i')  }} </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot class="bg-info">
        <tr>
            <th>#</th>
            <th>key</th>
            <th>Entity</th>
            <th>name</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </tfoot>
</table>

@if ($permissions instanceof \Illuminate\Pagination\LengthAwarePaginator)
    {{ $permissions->appends(Request::All())->links() }}
@endif