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
    </style>
@endpush
@section('content')
<div class="site-content">
    <div class="content-area py-1">
        <div class="container-fluid">
            <div class=" bg-white table-responsive">
                <div class="form-group col-md-3 col-lg-3 col-sm-6 col-xs-12" style="margin:1%;margin-left:0px;">
                    <input type="text" name="search" class="form-control b-a" placeholder="Search for ..."
                        id="search">
                </div>
                <div class="form-group col-md-1 col-lg-1 col-sm-2 col-xs-12" style="margin:1%;float: right;">
                    <select class="form-control" id="showEntry">
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="300">300</option>
                        <option value="500">500</option>
                    </select>
                </div>
                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12 text-right"
                    style="margin-top:1.5%;float: right;text-align: right;">
                    <div class="text text-warning"><b>Clear Log Logs</b></div>
                </div>
                <div class="site table-responsive" id="user_data">
                    @include('admin.vehicles.data')
                </div>
            </div>
        </div>
    </div>
</div>
@stop
{{-- @section('js')
<script type="text/javascript">
    function getProperties(id) {
        $('#logProperties').modal('toggle');
        $('#properties_loading').show();
        $("#log_data").html('');

        $.ajax("{{ route('vehicles.index') }}", {
            data: {
                id: id
            },
            success: function(data, status, xhr) {
                $('#properties_loading').hide();

                $("#log_data").html(data);
            },
            error: function(jqXhr, textStauts, errorMessage) {
                $('#properties_loading').hide();

                $.notify("Server error", {
                    className: "error",
                    clickToHide: true,
                    autoHide: true,
                    globalPosition: 'top right'
                });
            }
        });
    }
    $(document).ready(function() {
        // Go to Pagination page
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            searchLogs(page);
        });
        // search section 
        $('#search').on('keyup', function(e) {
            if (e.which == 13) {
                searchLogs();
            }
        });
        // Change Pagination
        $('#showEntry').change(function() {
            searchLogs();
        });
        // Appliy Filtering
        $('#submit_filter').click(function() {
            searchLogs();
        });

        function searchLogs(page=0) {
            $('#searchBody').html(
                "<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src='img/loading.gif' alt='Loading ...'> </div> "
            );
            var request = $.ajax({
                url: "{{ route('vehicles.index') }}",
                method: "GET",
                data: {
                    page: page,
                    action_type: $('#action_type').val(),
                    causer_id: $('#causer_id').val(),
                    from_date: $('#from_date').val(),
                    to_date: $('#to_date').val(),
                    searchValue: $('#search').val(),
                    paginate: $("#showEntry").val()
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
    
    });
</script>
@stop --}}
