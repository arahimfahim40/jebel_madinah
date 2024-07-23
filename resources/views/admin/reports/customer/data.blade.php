<table class="table table-bordered table-hover content-table">
  <thead class="bg-info">
    <tr class="table-header-footer bordered">
      <th>No</th>
      <th>Customer</th>
      <th>Total Invoice</th>
      <th>Total Paid</th>
      <th>Total Discount</th>
      <th>Due Balance</th>
      <th>Total Vehicles</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @php
      $total = 0;
      $total_received = 0;
      $total_due_balance = 0;
    @endphp
    @forelse($customerReport as $item)
      @php

      @endphp
      <tr class="bordered">
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->customer_name }}</td>

        <td>@money($item->total_invoice)</td>
        <td>@money($item->total_paid)</td>
        <td>@money($item->total_discount)</td>
        <td>@money($item->total_due_balance)</td>
        <td>{{ @$item->total_vehicles }}</td>
        <td>
          <a target="_blank" class="btn btn-info btn-circle btn-sm waves-effect waves-light"
            href="{{ route('customers.reports.view', $item->id) }}" style="align-content: center;">
            <i class="fa fa-eye"></i>
          </a>
          <a target="_blank" class="btn btn-warning btn-circle btn-sm waves-effect waves-light"
            href="{{ route('customers.reports.pdf', $item->id) }}" style="align-content: center;">
            <i class="fa fa-file-pdf-o"></i>
          </a>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="12">
          <center class="alert alert-warning">No Data</center>
        </td>
      </tr>
    @endforelse
  </tbody>
  <tfoot>
    <tr class="table-header-footer bordered">

      <th colspan="2">
        <h5 style="text-align: center;">Total</h5>
      </th>

      <th>@money($customerReport->sum('total_invoice'))</th>
      <th>@money($customerReport->sum('total_paid'))</th>
      <th>@money($customerReport->sum('total_discount'))</th>
      <th>@money($customerReport->sum('total_due_balance'))</th>
      <th>{{ @$customerReport->sum('total_vehicles') }}</th>
      <th>Actions</th>
    </tr>
  </tfoot>
</table>
