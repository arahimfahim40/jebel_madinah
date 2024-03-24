
<table class="table table-bordered table-hover content-table bg-white" >
    <thead class="bg-info">
        <tr>
            <th>#</th>
            <th>Name</th>
            @can('vehicle-edit')
            <th>Edit</th>
            @endcan
            @can('vehicle-delete')
            <th>Delete</th>
            @endcan
        </tr>
    </thead>
    <tbody>
        <?php $id = 1; ?>
        @foreach ($locations as $index => $item)
            <tr id="searchBody">
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->name }}</td>
                @can('vehicle-edit')
                <td>
                    <a href="{{ route('vehicles.edit', $item->id) }}"  class="btn btn-info btn-circle btn-sm column"><span class="fa fa-edit"></span></a>
                </td>
                @endcan
                @can('vehicle-delete')
                <td>
                    <a href="{{ route('vehicles.edit', $item->id) }}"  class="btn btn-danger btn-circle btn-sm column"><span class="fa fa-trash"></span></a>
                </td>
                @endcan
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Name</th>
            @can('vehicle-edit')
            <th>Edit</th>
            @endcan
            @can('vehicle-delete')
            <th>Delete</th>
            @endcan
        </tr>
    </tfoot>
</table>

@if ($locations instanceof \Illuminate\Pagination\LengthAwarePaginator)
    {{ $locations->appends(Request::All())->links() }}
@endif


