@extends('admin.layout.main')
@section('title', 'Invoices')
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
            
            {{-- <div class="site pt-2">
                    <div id="filter_form">
                        <div class="col-md-2 mb-1">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" class="form-control" name="status">
                                    <option value="all">All</option>
                                    @foreach (\App\Models\Invoice::INVOICE_STATUS as $invoice_status)
                                        <option value="{{$invoice_status}}" {{$status == $invoice_status ? 'selected': ''}}>{{ ucwords(str_replace('_', ' ', $invoice_status)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class=" col-md-3 mb-1">
                            <div class=" form-group">
                                <label for="from_date">From</label>
                                <input id="from_date" type="date" name="from_date" class="form-control">
                            </div>
                        </div>
                        <div class=" col-md-3 mb-1">
                            <div class=" form-group">
                                <label for="to_date">To</label>
                                <input id="to_date" type="date" name="to_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-1 mb-1">
                            <div  style="margin-top: 26px;">
                                <button class="btn btn-warning waves-effect waves-light" id="submit_filter">
                                    <b><i class="fa fa-filter"></i></b><span class="pl-1">Filter</span>
                                </button>
                            </div>
                        </div>
                            
                    </div>
                </div> --}}

                <div style="clear: both;"></div>
                <div class="form-group col-md-3 col-lg-3 col-sm-6 col-xs-12" style="margin:1%;margin-left:0px;">
                    <input type="text" name="search" class="form-control b-a" placeholder="Search for ..."
                        id="search">
                </div>
                <div class="form-group col-md-1 col-lg-1 col-sm-2 col-xs-12" style="margin:1%;float: right;">
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
                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12 text-right"
                    style="margin-top:1.5%;float: right;text-align: right;">
                    <div class="text text-warning"><b>{{ ucwords(str_replace('_', ' ', $status ? $status : 'All')) }} Invoices</b></div>
                </div>
                <div class="site table-responsive" id="user_data">
                    @include('admin.invoices.data')
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@push('js')
<script type="text/javascript">
    function getProperties(id) {
        $('#logProperties').modal('toggle');
        $('#properties_loading').show();
        $("#log_data").html('');

        $.ajax("{{ route('invoices.index') }}", {
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
                url: "{{ route('invoices.index') }}",
                method: "GET",
                data: {
                    page: page,
                    // status: $('#status option:selected').val(),
                    status: "{{ $status }}",
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
@endpush
