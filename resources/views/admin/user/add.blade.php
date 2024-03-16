<!-- <div class="modal fade" id="add_user">
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
                        <label for="username">Full name <span class="text-danger">*</span></label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="enter user name"  />
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
                            <label for="user-type">Choose User Privilege <span class="text-danger">*</span></label>
                            <select name="usert" id="user-type"  class="form-control" required>
                                <option value="" hidden selected disabled>--- Privilege ---</option>
                                {{--@foreach($uertype as $usertype)
                                    <option value="{{$usertype->id}}">{{ucfirst($usertype->type)}}</option>
                                @endforeach--}}
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="usert-timezone">Choose User Timezone <span class="text-danger">*</span></label>
                            <select name="timezone" id="user-timezone" class="form-control s2s_timezone" required>
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
 -->
 <?php
$permissions = DB::table('permissions')->get();

dd("Permissions:",$permissions);
?>

 <div class="modal fade" id="add_user">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">User Register Form</h4>
            </div>
            <div class="modal-body">
            <form action="{{url('add_user_admin')}}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
                <ul class="nav nav-pills nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active font-weight-bold" data-toggle="pill" href="#home">User Informations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" data-toggle="pill" href="#menu1">Roles & Permissions</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="home" class="container tab-pane active"><br>
                        <h3>User Information</h3>
                        <div>
                            <div class="form-group">
                                <label for="username">Full name <span class="text-danger">*</span></label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="enter user name"  />
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
                                    <label for="user-type">Choose User Privilege <span class="text-danger">*</span></label>
                                    <select name="usert" id="user-type"  class="form-control" required>
                                        <option value="" hidden selected disabled>--- Privilege ---</option>
                                        {{--@foreach($uertype as $usertype)
                                            <option value="{{$usertype->id}}">{{ucfirst($usertype->type)}}</option>
                                        @endforeach--}}
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="usert-timezone">Choose User Timezone <span class="text-danger">*</span></label>
                                    <select name="timezone" id="user-timezone" class="form-control s2s_timezone" required>
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
                    </div>
                    <div id="menu1" class="container tab-pane fade"><br>
                        <h3>Roles & Permissions</h3>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

