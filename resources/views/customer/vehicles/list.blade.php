@extends('customer.layout.main')
@section('title', 'Vehicles')
@push('css')
    <link href="{{ asset('assets\vazirmatn-v33.003/Vazirmatn-Variable-font-face.css') }}" rel="stylesheet">
    <style>
        .content-table {
            /* font-family: 'Comic Sans MS'; */
            border-collapse: collapse;
            width: 100%;
            text-align: center;
        }
        #header-title {
            font-family: 'Times New Roman';
        }

        .content-table,
        th,
        td {
            padding: 0px 0px 0px 0px;
            font-size: 12px;
        }

        .bordered, .bordered th, .bordered td {
            border: 1px solid #ccc !important;
        }
        thead {
            position: sticky;
            top: 58px;
        }
        .wrapper,
        .site-content,
        .content-area,
        .table-responsive {
            overflow: unset;
        }
        .table-header-footer{
            background: #e9e8e8;
            color: black;
        }
    </style>
@endpush
@section('content')

<div class="site-content">
    <div class="content-area py-1">
        <div class="container-fluid">
            <div class=" bg-white table-responsive">
                
                @include('errors')
                <div style="clear: both;"></div>
                <div class="pt-1">
                    <div class="form-group col-md-3 col-lg-3 col-sm-6 col-xs-12" >
                        <input type="text" name="search" class="form-control b-a" placeholder="Search for ..." id="search">
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
                        <div class="text text-warning"><b>{{ ucwords(str_replace('_', ' ', $status ? $status : 'All')) }} Vehicles</b></div>
                    </div>
                </div>
                <div class="site table-responsive" id="vehicle_data">
                    @include('customer.vehicles.data')
                </div>
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
            url: "{{ route('customer.vehicles.index') }}",
            method: "GET",
            data: {
                page: page,
                status: "{{ $status }}",
                // from_date: $('#from_date').val(),
                // to_date: $('#to_date').val(),
                searchValue: $('#search').val(),
                paginate: $("#showEntry").val()
            },
        });
        request.done(function(msg) {
            $('#searchBody').html('');
            $('#vehicle_data').html(msg);
        });
        request.fail(function(jqXHR, textStatus) {
            $('#searchBody').html('');
            $('#vehicle_data').append(textStatus);
        });
    }



    function checkAll(checkbox) {
        if (checkbox.checked == true) {
            $(".checkbox").prop('checked', true);
            $(".checkbox_all").prop('checked', true);
        } else {
            $(".checkbox").prop('checked', false);
            $(".checkbox_all").prop('checked', false);
        }
    }

    function changeStatus(){
        var selectedVehicleIds = [];
        $(".checkbox:checked").each(function() {
            selectedVehicleIds.push($(this).attr('data-id'));
        });
        
        if (selectedVehicleIds.length <= 0) {
            Swal.fire({
                position: 'center',
                icon: 'info',
                title: "Please select atleast one record to change the status.",
                showConfirmButton: false,
                timer: 4000
            });
        }else{
            $('#vehicle_change_status_modal').modal('show');
        }
    }

    function submitForm(){
        var status = $(".vehicle_status:checked").val();
        if (status == null) {
            Swal.fire({
                position: 'center',
                icon: 'info',
                title: "Please select at least one status",
                showConfirmButton: false,
                timer: 4000
            });
            return;
        }else{
            var selectedVehicleIds = [];
            $(".checkbox:checked").each(function() {
                selectedVehicleIds.push($(this).attr('data-id'));
            });

            var request = $.ajax({
                url: "{{ route('vehicles.change_status') }}",
                method: "POST",
                data: {
                    selectedVehicleIds: selectedVehicleIds,
                    status: status,
                    _token: '{{ csrf_token() }}',
                },
            });
            request.done(function(msg) {
                $('#vehicle_change_status_modal').modal('hide');
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: msg.message,
                    showConfirmButton: false,
                    timer: 4000
                });
                updateVehicleList();
            });
            request.fail(function(jqXHR, textStatus) {
                $('#vehicle_change_status_modal').modal('hide');
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: jqXHR.responseJSON.message,
                    showConfirmButton: false,
                    timer: 4000
                });
            });
        }
    }

</script>
@endpush
