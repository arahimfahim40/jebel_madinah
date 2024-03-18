<div class="modal fade" id="add_user">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">User Register Form</h4>
            </div>
            <form action="{{url('add_user_admin')}}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fullname">Full name <span class="text-danger">*</span></label>
                        <input type="text" name="fullname" id="fullname" class="form-control" placeholder="enter fullname"  />
                    </div>
                    <div class="form-group">
                        <label for="username">Username <span class="text-danger">*</span></label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="enter username"  />
                    </div>
                    <div class="form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="enter user email" required/>
                    </div>
                    <div class="form-group">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="enter user password" required/>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="timezone">Choose User Timezone <span class="text-danger">*</span></label>
                            <select name="timezone" id="timezone" class="form-control s2s_timezone" required>
                                <option value="" hidden selected disabled>--- Timezone ---</option>
                                
                            </select>
                        </div>
                    </div>
                    
                    <div class="box box-block bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h6>User Photo</h6>
                                <input type="file" id="input-file-now" class="dropify" name="photo" accept="image/png, image/gif, image/jpeg"/>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning btn-rounded" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info btn-rounded">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
