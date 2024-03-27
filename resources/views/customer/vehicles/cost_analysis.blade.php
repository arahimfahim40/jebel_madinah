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
        .bg-color-total{
            background-color: #ddd;
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
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="300">300</option>
                            <option value="500">500</option>
                            <option value="500">1000</option>
                        </select>
                    </div>
                    <div style="float: right; padding-top: 8px;">
                        <div class="text text-warning"><b>Cost Analysis Vehicles</b></div>
                    </div>
                </div>
                <div class="site table-responsive" id="user_data">
                    @include('customer.vehicles.cost_analysis_data')
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
        $('#content_loader').html(
            "<div style='position:fixed; margin-top:15%; margin-left:40%;'><img width='100px' src='/img/loading.gif' alt='Loading ...'> </div> "
        );
        var request = $.ajax({
            url: "{{ route('customer.vehicles.cost_analysis') }}",
            method: "GET",
            data: {
                page: page,
                status: "{{ request()->status }}",
                location_id: "{{ request()->location_id }}",
                customer_id: "{{ request()->customer_id }}",
                searchValue: $('#search').val(),
                paginate: $("#showEntry").val()
            },
        });
        request.done(function(msg) {
            $('#content_loader').html('');
            $('#user_data').html(msg);
        });
        request.fail(function(jqXHR, textStatus) {
            $('#content_loader').html('');
            $('#user_data').append(textStatus);
        });
    }

</script>
@endpush
