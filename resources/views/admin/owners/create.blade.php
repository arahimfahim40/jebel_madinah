<div class="modal" id="createOwner">
  <div class="modal-dialog ">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" style="float:left;">Create Vehicle Owners</h4>
        <button type="button" class="close" data-dismiss="modal" style="float:right;">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('owners.store') }}" method="post">
          @csrf
          <div class="form-group mt-1">
            <label for="name" class="font-weight-bold">Owner Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
              placeholder="Enter Owner name" required />
          </div>
          <div class="row mt-2">
            <div class="col-md-12">
              <button type="submit" class="btn btn-success btn-rounded" style="float:right; margin-left:5px;">
                <i class="fa fa-floppy-o"></i> Save
              </button>
              <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" style="float:right;">
                <i class="fa fa-times"></i> Cancel
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
