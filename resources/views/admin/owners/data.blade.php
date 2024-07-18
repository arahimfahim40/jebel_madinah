<table class="table table-bordered table-hover content-table bg-white">
  <thead class="bg-info">
    <tr>
      <th>#</th>
      <th>Name</th>
      @can('owner-edit')
        <th>Edit</th>
      @endcan
      @can('owner-delete')
        <th>Delete</th>
      @endcan
    </tr>
  </thead>
  <tbody>
    <?php $id = 1; ?>
    @foreach ($owners as $index => $item)
      <tr id="searchBody">
        <td>{{ $index + 1 }}</td>
        <td>{{ $item->name }}</td>
        @can('owner-edit')
          <td>
            <button class="btn btn-info btn-circle btn-sm column" id="editbtn"
              onClick="updateOwner( '{{ $item->name }}', '{{ route('owners.update', $item->id) }}' )">
              <i class="fa fa-edit"></i>
            </button>
          </td>
        @endcan
        @can('owner-delete')
          <td>
            <form method="POST" id="delete_{{ $item->id }}" action="{{ route('owners.destroy', $item->id) }}">
              @method('delete')
              @csrf
              <a onclick="confirmDelete('{{ $item->id }}')"
                class="btn btn-danger btn-circle btn-sm column text-white"> <span class="fa fa-trash"></span></a>
            </form>
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

@if ($owners instanceof \Illuminate\Pagination\LengthAwarePaginator)
  {{ $owners->appends(Request::All())->links() }}
@endif
