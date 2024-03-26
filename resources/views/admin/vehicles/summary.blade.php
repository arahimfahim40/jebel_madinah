@extends('admin.layout.main')
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
        .text-center {
            text-align: center;
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
                    
                    <div class="form-group col-md-2 col-lg-2 col-sm-3 col-xs-12" style="float:right;">
                        <select class="form-control" id="vehicleStatus">
                            <option value="">All</option>
                            <option value="4categories">4 Category Vehicle</option>
                            <option value="pending">Pending</option>
                            <option value="on_the_way">On The Way</option>
                            <option value="on_hand_no_title">On Hand No Title</option>
                            <option value="on_hand_with_title">On Hand With Title</option>
                        </select>
                    </div>
                    <div style="float: right; padding-top: 8px;">
                        <div class="text text-warning"><b>Vehicle Summary</b></div>
                    </div>
                </div>
                <div class="site table-responsive" id="user_data">
                    @include('admin.vehicles.summary_data')
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
        updateVehicleSummary(page);
    });
    // search section 
    $('#search').on('keyup', function(e) {
        if (e.which == 13) {
            updateVehicleSummary();
        }
    });
    // Change Pagination
    $('#vehicleStatus').change(function() {
        updateVehicleSummary();
    });
    // Appliy Filtering
    $('#submit_filter').click(function() {
        updateVehicleSummary();
    });

    function updateVehicleSummary(page=0) {
        $('#searchBody').html(
            "<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src='img/loading.gif' alt='Loading ...'> </div> "
        );
        var request = $.ajax({
            url: "{{ route('vehicles.summary') }}",
            method: "GET",
            data: {
                searchValue: $('#search').val(),
                vehicleStatus: $('#vehicleStatus').val(),
            },
        });
        request.done(function(msg) {
            $('#searchBody').html('');
            $('#user_data').html(msg);
        });
        request.fail(function(jqXHR, textStatus) {
            $('#searchBody').html('');
            $('#user_data').append(textStatus);
        });
    }

</script>
@endpush
