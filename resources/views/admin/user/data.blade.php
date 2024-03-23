<table class="table table-bordered table-hover content-table bg-white" >
    <thead class="bg-info">
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Time Zone</th>
            <th>Status</th>
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
                <td>
                    <div style="display: flex; justify-content: space-around; align-items: center;">
                        <a href="{{ route('user.edit',$u->id) }}"> <i class="fa fa-edit" style="font-size:16px; cursor:pointer;"></i> </a>
                        <i class="fa fa-trash-o" style="font-size:16px; color:red; cursor:pointer;" data-toggle="modal" data-target="#deleteUser"></i>
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
            <th>Action</th>
        </tr>
    </tfoot>
</table>

@if ($users instanceof \Illuminate\Pagination\LengthAwarePaginator)
    {{ $users->appends(Request::All())->links() }}
@endif

<div class="modal fade" id="deleteUser">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">This action is not reversible.</h4>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <div style="display: flex; justify-content: space-around; align-items: center;">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><i class="fa fa-times" style="font-size:16px;" ></i> Cancel</button>
                <button type="button" class="btn btn-outline-danger"><i class="fa fa-trash-o" style="font-size:16px;"></i> Delete</button>
            </div>
        </div>
      </div>
    </div>
  </div>