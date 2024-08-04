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

    .bordered,
    .bordered th,
    .bordered td {
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

    .table-header-footer {
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
          <div class="form-group col-md-3 col-lg-3 col-sm-6 col-xs-12" style="margin:1%;margin-left:0px;">
            <input type="text" name="search" class="form-control b-a" placeholder="Search for ..." id="search">
          </div>

          <div class="form-group col-md-1 col-lg-1 col-sm-2 col-xs-12" style="margin:1%;float: right;">
            <select class="form-control" id="showEntry">
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
            <div class="text text-warning"><b>{{ ucwords(str_replace('_', ' ', $status ? $status : 'All')) }} Invoices</b>
            </div>
          </div>
          <div class="site table-responsive" id="invoice_data">
            @include('admin.invoices.trash_data')
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
      updateInvoiceList(page);
    });
    // search section 
    $('#search').on('keyup', function(e) {
      if (e.which == 13) {
        updateInvoiceList();
      }
    });
    // Change Pagination
    $('#showEntry').change(function() {
      updateInvoiceList();
    });
    // Appliy Filtering
    $('#submit_filter').click(function() {
      updateInvoiceList();
    });

    function updateInvoiceList(page = 0) {
      $('#content_loader').html(
        "<div style='position:fixed; margin-top:15%; margin-left:40%;'><img width='100px' src='/img/loading.gif' alt='Loading ...'> </div> "
      );
      var request = $.ajax({
        url: "{{ route('invoices.trash_list') }}",
        method: "GET",
        data: {
          page: page,
          searchValue: $('#search').val(),
          paginate: $("#showEntry").val()
        },
      });
      request.done(function(msg) {
        $('#content_loader').html('');
        $('#invoice_data').html(msg);
      });
      request.fail(function(jqXHR, textStatus) {
        $('#content_loader').html('');
        $('#invoice_data').append(textStatus);
      });
    }
    function restoreInvoice(invoice_id) {
      if (confirm('Invoice will be restored. Are you sure?')) {
        $('#content_loader').html(
          "<div style='position:fixed; margin-top:15%; margin-left:40%;'><img width='100px' src='/img/loading.gif' alt='Loading ...'> </div> "
        );
        var request = $.ajax({
          url: "{{ url('/admin/invoices_restore') }}" + '/' + invoice_id,
          method: "GET",
          data: {
            _token: '{{ csrf_token() }}',
          },
        });
        request.done(function(msg) {
          $('#content_loader').html('');
          updateInvoiceList();
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: msg.message,
            showConfirmButton: false,
            timer: 4000
          });
        });
        request.fail(function(jqXHR, textStatus) {
          $('#content_loader').html('');
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
