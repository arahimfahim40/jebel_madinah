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
                <div class="form-group col-md-3 col-lg-3 col-sm-6 col-xs-12" >
                    <input type="text" name="search" class="form-control" placeholder="Search for ..." id="search">
                </div>
                <div class="form-group col-md-6">
                    @can('role-create')
                    <a href="{{ route('roles.create') }}" class="btn btn-secondary btn-outline-info waves-effect waves-light" style="height: 33px; ">
                        <i class="fa fa-plus"></i> Add
                    </a>
                    @endcan
                </div>
                <div class="form-group col-md-1 col-lg-1 col-sm-2 col-xs-12" style="float:right;">
                    <select class="form-control" id="showEntry">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="300">300</option>
                        <option value="500">500</option>
                        <option value="500">1000</option>
                    </select>
                </div>
                <div style="float: right; padding-top: 8px;">
                    <div class="text text-warning"><b>Roles</b></div>
                </div>
            </div>
            <div class="site table-responsive" id="role_data">
                @include('admin.roles.data')
            </div>
        </div>
    </div>
</div>
@stop

@push('js')
<script type="text/javascript">
    // Go to Pagination page
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        updateVehicleList(page);
    });
    // search section 
    $('#search').on('keyup', function(e) {
        if (e.which == 13) {
            updateVehicleList();
        }
    });
    // Change Pagination
    $('#showEntry').change(function() {
        updateVehicleList();
    });
    // Appliy Filtering
    $('#submit_filter').click(function() {
        updateVehicleList();
    });

    function updateVehicleList(page=0) {
        $('#searchBody').html(
            "<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src='img/loading.gif' alt='Loading ...'> </div> "
        );
        var request = $.ajax({
            url: "{{ route('roles.index') }}",
            method: "GET",
            data: {
                page: page,
                searchValue: $('#search').val(),
                paginate: $("#showEntry").val(),
            },
        });
        request.done(function(msg) {
            $('#searchBody').html('');
            $('#role_data').html(msg);
        });
        request.fail(function(jqXHR, textStatus) {
            $('#searchBody').html('');
            $('#role_data').append(textStatus);
        });
    }

</script>
@endpush


