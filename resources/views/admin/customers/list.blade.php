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
            @include('errors') 
            <div class="bg-white table-responsive">
            <div style="clear: both;"></div>
                    <div class="row pt-1 pr-1 pl-1">
                        <div class="col-md-12 form-group">
                            <select id='user_status_filter' class="form-control" style="width: 150px !important; display: inline; height: 33px;">
                                <option value="" disabled selected hidden>Filter by Status</option>
                                <option value="">All</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            <!-- <button type="button" class="btn btn-secondary btn-outline-infos waves-effect waves-light" onclick="exportUser();" style="height:33px; margin-top:-5px;">
                                <i class="fa fa-download"></i> Export
                            </button> -->
                           
                            <!-- <button type="button" class="btn btn-secondary btn-outline-infos waves-effect waves-light float-right" data-toggle="modal" data-target="#add_user" style="height: 33px; margin-top:-5px;">
                                <i class="fa fa-plus"></i> Add
                            </button> -->
                            @can('customer-create')
                            <a href="{{ route('customer.create') }}" class="btn btn-secondary btn-outline-info waves-effect waves-light" style="height: 33px; margin-top:-5px;">
                                <i class="fa fa-plus"></i> Add
                            </a>
                            @endcan
                        </div>
                    </div>
                <div class="site table-responsive" id="customer_data">
                    @include('admin.customers.data')
                </div>
            </div>
			
        </div>
    </div>
</div>
@stop

