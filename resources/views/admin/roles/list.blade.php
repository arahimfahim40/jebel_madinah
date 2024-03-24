@extends('admin.layout.main')
@section('title', "Role List")
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
            @include('errors') 
            <div class="bg-white table-responsive">
            <div style="clear: both;">  </div>
            <div class="row pt-1 pr-1 pl-1">
                <div class="col-md-12 form-group">
                    <!-- <button type="button" class="btn btn-secondary btn-outline-success waves-effect waves-light float-right" data-toggle="modal" data-target="#create_user" style="height: 33px; margin-top:-5px;">
                        <i class="fa fa-plus"></i> Add
                    </button> -->
                    @can('role-create')
                    <a href="{{ route('role.create') }}" class="btn btn-secondary btn-outline-info waves-effect waves-light" style="height: 33px; margin-top:-5px;">
                        <i class="fa fa-plus"></i> Add
                    </a>
                    @endcan
                </div>
            </div>
            <div class="site table-responsive" id="user_data">
                @include('admin.roles.data')
            </div>
        </div>
    </div>
</div>
@stop