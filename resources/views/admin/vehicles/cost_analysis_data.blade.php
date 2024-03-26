
<table class="table table-bordered table-hover content-table bg-white" >
    <thead class="bg-info">
        <tr>
            <th>#</th>
            @can('vehicle-edit')
            <th>Edit</th>
            @endcan
            <th>Vehicle Description</th>
            <th>VIN#</th>
            <th>Customer</th>
            <th>Container#</th>
        </tr>
    </thead>
    <tbody>
        <?php $id = 1; ?>
        @foreach ($vehicles as $index => $item)
            <tr id="searchBody">
                <td>{{ $index + 1 }}</td>
                @can('vehicle-edit')
                <td>
                    <a href="{{ route('vehicles.edit', $item->id) }}"  class="btn btn-info btn-circle btn-sm column"><span class="fa fa-edit"></span></a>
                </td>
                @endcan
                <td>{{ $item->year }} {{ $item->make }} {{ $item->model }} {{ $item->color }}</td>
                <td>{{ $item->vin }}</td>
                <td>{{ @$item->customer->name }}</td>
                <td>{{ $item->container_number }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            @can('vehicle-edit')
            <th>Edit</th>
            @endcan
            <th>Vehicle Description</th>
            <th>VIN#</th>
            <th>Customer</th>
            <th>Container#</th>
        </tr>
    </tfoot>
</table>

@if ($vehicles instanceof \Illuminate\Pagination\LengthAwarePaginator)
    {{ $vehicles->appends(Request::All())->links() }}
@endif


