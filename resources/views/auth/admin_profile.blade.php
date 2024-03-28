@extends('admin.layout.main')
@section('title', "Customer List")
@push('css')
	<link rel="stylesheet" href="{{asset('assets/css/custom-datatable.css')}}">
	<link rel="stylesheet" href="{{asset('assets/dropify/dist/css/dropify.min.css')}}">
    <style type="text/css">
		.dataTables_filter {
            float: left !important;
            margin-left: 0px !important;
        }
        user-status {
            padding: 5px 15px; 
            border: 1px solid #c3bbbb; 
            border-radius: 20px; 
            text-align: center; 
        }
		.active-user {
            background: #3ba53bd6;
			color: white;
        }
        .active-user:before {
        font-family: 'FontAwesome';
            content: '\f00c';
            padding-right: 10px;
        }
		.deactive-user {
            background: #d92424b8;
			color: white;
        }
        .deactive-user:before {
        font-family: 'FontAwesome';
            content: '\f00d';
            padding-right: 10px;
        }
		.user-image {
			width: 50px;
			height: 50px;
			border-radius: 50%;
			border: 1px solid #45b9ae;
		}
    </style>

@endpush
@section('content')
<div class="site-content"> 
    <div class="content-area py-1">
        <div class="container-fluid" > 
            <div class="row mt-3">
            
                <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12"></div>
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 bg-white rounded shadow">
                    @include('errors')
                    <form id="create-customer" class="px-3" action="{{ route('users.change_password')}}" method="post">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <img src="{{asset('img/shipping.png')}}" class="rounded mx-auto d-block" height="200" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <h2 class="my-2" style="text-align: center;"> {{ ucfirst($user->name)}}</h2>   
                            </div>
                        </div>
                        <div class="my-2"> <h4 class="border-bottom">User Credential</h4> </div>
                        <div class="form-group">
                            <label for="email" class="font-weight-bold">Email </label>
                            <input type="text" name="email" readonly id="email" class="form-control" value="{{$user->email}}" required />
                        </div>
                        <div class="form-group">
                            <label for="old_password" class="font-weight-bold">Old Password </label>
                            <input type="password" name="old_password" id="old_password" class="form-control" minlength="6" placeholder="Enter Old Password" required />
                        </div>
                        <div class="form-group">
                            <label for="new_password" class="font-weight-bold">New Password </label>
                            <input type="password" name="new_password" id="new_password" class="form-control" minlength="6" placeholder="Enter New Password" required />
                        </div>
                        <div class="row mb-3 mt-2">
                            <div class="col-md-12 pt-1">
                                <button type="submit" class="btn btn-success btn-rounded px-2" style="float:right; margin-left:5px;">
                                    <i class="fa fa-pencil"></i> &nbsp; Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12"></div>
            </div>
        </div>
    </div>
</div>
@stop
