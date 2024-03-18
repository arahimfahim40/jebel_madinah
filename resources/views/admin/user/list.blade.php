@extends('admin.layout.main')
@section('title', "User List")
@section('style')
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

@stop
@section('content')
<div class="site-content"> 
    <div class="content-area py-1">
        <div class="container-fluid" > 

        {{-- @include('errors') --}}

            <div class="card shadow">
                <div class="card-body">
                    <div class="row pt-1 pr-1 pl-1">
                        <div class="col-md-12 form-group">
                            <select id='user_type_filter' class="form-control" style="width: 150px !important; display: inline; height: 33px;">
                                <option value="" disabled selected hidden>Filter by Type</option>
                                <option value="">All</option>
								{{--@foreach($uertype as $ut)
									<option value="{{$ut->id}}">{{ucfirst($ut->type)}}</option>
								@endforeach --}}
                            </select>
                            <select id='user_status_filter' class="form-control" style="width: 150px !important; display: inline; height: 33px;">
                                <option value="" disabled selected hidden>Filter by Status</option>
                                <option value="">All</option>
                                <option value="active">Active</option>
                                <option value="deactive">Deactive</option>
                            </select>
                            <button type="button" class="btn btn-secondary btn-outline-infos waves-effect waves-light" onclick="exportUser();" style="height:33px; margin-top:-5px;">
                                <i class="fa fa-download"></i> Export
                            </button>
                           
                                <button type="button" class="btn btn-secondary btn-outline-infos waves-effect waves-light" data-toggle="modal" data-target="#add_user" style="height: 33px; margin-top:-5px;">
                                    <i class="fa fa-plus"></i> Add
                                </button>
                        </div>
                    </div>
                </div>
            </div>

			@include('admin.user.create')
        
            <table class="table table-bordered" id="tbl_user">
				<thead class="bg-info">
					<tr>
						<th width="5px;">#</th>
						<th width="40px">Photo</th>
						<th>Name</th>
						<th>Email</th>
						<th>Type</th>
						<th>Time Zone</th>
						<th width="50px">Status</th>
						<th width="50px"><center>Edit</center></th>
						<th width="50px"><center>Delete</center></th>
					</tr>
				</thead>
				<tbody id="usersTBody"></tbody>
				<tfoot class="bg-info">
					<tr>
						<th>#</th>
						<th>Photo</th>
						<th>Name</th>
						<th>Email</th>
						<th>Type</th>
						<th>Time Zone</th>
						<th>Status</th>
						<th><center>Edit</center></th>
						<th><center>Delete</center></th>
					</tr>
				</tfoot>
			</table>

        </div>
    </div>
</div>
@stop

@section('js')
	<script type="text/javascript" src="{{asset('assets/dropify/dist/js/dropify.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/js/forms-upload.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/user/export_user.js')}}"></script>

    <script type="text/javascript">
		(() => {
			userList();
			$.fn.dataTable.ext.errMode = 'none';
            $('#tbl_user').on( 'error.dt', function(e, settings, techNote, message) {
				console.log( 'An error has been reported by DataTables: ', message );
			}).DataTable();
			$("input[type='search']").attr("placeholder", "Search...");
		})();
        function userList() {
            var userTable = $('#tbl_user').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('user.index') }}",
                    data: function (data) {
                        data.user_type_filter = $('#user_type_filter').val(),
                        data.user_status_filter = $('#user_status_filter').val(),
                        data.search = $('input[type="search"]').val()
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'photo', name: 'photo', orderable: false, searchable: false },
                    { data: 'username', name: 'username', orderable: true, searchable: false },
                    { data: 'email', name: 'email', orderable: false, searchable: false },
                    { data: 'type', name: 'type', orderable: false, searchable: false },
                    { data: 'timezone', name: 'timezone', orderable: false, searchable: false },
                    { data: 'status', name: 'status', orderable: false, searchable: false },
                    { data: 'edit', name: 'edit', orderable: false, searchable: false },
                    { data: 'delete', name: 'delete', orderable: false, searchable: false },
                ],
                lengthMenu: [
                    [20, 50, 100, 500, 1000, -1],
                    [20, 50, 100, 500, 1000, 'All'],
                ],
                language: {
                    "lengthMenu": "_MENU_",
                    "loadingRecords": "<i class='fa fa-spinner fa-spin' style='font-size:50px; color: #20b9ae;'></i>",
                    "processing":     "<i class='fa fa-spinner fa-spin' style='font-size:50px; color: #20b9ae;'></i>",
                    "search":         "",
                    "zeroRecords":    "No matching records found",
                    "paginate": {
                        "first":      "First",
                        "last":       "Last",
                        "next":       "<i class='fa fa-angle-double-right'></i>",
                        "previous":   "<i class='fa fa-angle-double-left'></i>"
                    },
                }
            });
            $('#user_type_filter').change(function() {
                userTable.draw();
            });
            $("#user_status_filter").change(function() {
                userTable.draw();
            });
        }
        function deleteUser($id) {
            if (1) {
                if (confirm("Are you sure you want to delete this user?")) {
                    window.location.href = "{{url('delete_user_admin')}}/"+$id;
                }
            } else {
                Swal.fire("Error!", "You cannot perform this operation.", "error");
            }
        }
        function editUser($id) {
            if (1) {
                window.location.href = "{{url('edit_user_admin')}}/" + $id;
            } else {
                Swal.fire("Error", "You cannot perform this operation.", "error");
            }
        }
    </script>
@stop
