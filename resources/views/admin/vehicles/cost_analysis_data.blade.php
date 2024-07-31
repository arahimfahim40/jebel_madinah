<div id="content_loader"></div>
<table class="table table-bordered table-hover content-table bg-white">
  <thead class="bg-info">
    <tr>
      <th>#</th>
      @can('vehicle-edit')
        <th>Edit</th>
      @endcan
      <th>Vehicle Description</th>
      <th>VIN#</th>
      <th>Owner</th>
      <th>Container#</th>
      <th>Status</th>
      <th>Vehicle Price</th>
      <th>Towing Cost</th>
      <th>Ship Cost</th>
      <th>Storage Cost</th>
      <th>Custom Cost</th>
      <th>TDS Cost</th>
      <th>Other Cost</th>
      <th>Total USD</th>
      <th>Clearance Cost</th>
      <th>Total Costs</th>
      <th>Sold Price</th>
      <th>Profit/Loss</th>
    </tr>
  </thead>
  <tbody>
    <?php $id = 1; ?>
    @foreach ($vehicles as $index => $item)
      @php
        $totalUSD =
            @$item->vehicle_price +
            @$item->towing_cost +
            @$item->ship_cost +
            @$item->storage_cost +
            @$item->custom_cost +
            @$item->tds_cost +
            @$item->other_cost;
        $totalCost = $totalUSD * 3.685 + @$item->clearance_cost;
        $totalSoldPrice = @$item->sold_price;
      @endphp
      <tr>
        <td>{{ $index + 1 }}</td>
        @can('vehicle-edit')
          <td>
            <a href="{{ route('vehicles.edit', $item->id) }}" class="btn btn-info btn-circle btn-sm column"><span
                class="fa fa-edit"></span></a>
          </td>
        @endcan
        <td>{{ $item->year }} {{ $item->make }} {{ $item->model }} {{ $item->color }}</td>
        <td>{{ $item->vin }}</td>
        <td>{{ @$item->owner->name }}</td>
        <td>{{ $item->container_number }}</td>
        <td>
          @if ($item->status == 'on_the_way')
            <span class="tag tag-warning">{{ ucwords(str_replace('_', ' ', $item->status)) }}</span>
          @elseif ($item->status == 'inventory')
            <span class="tag tag-info">{{ ucwords(str_replace('_', ' ', $item->status)) }}</span>
          @elseif ($item->status == 'sold')
            <span class="tag tag-success">{{ ucwords(str_replace('_', ' ', $item->status)) }}</span>
          @endif
        </td>

        <td>@money($item->vehicle_price)</td>
        <td>@money($item->towing_cost)</td>
        <td>@money($item->ship_cost)</td>
        <td>@money($item->storage_cost)</td>
        <td>@money($item->custom_cost)</td>
        <td>@money($item->tds_cost)</td>
        <td>@money($item->other_cost)</td>
        <td>@money($totalUSD) <br> @money($totalUSD * 3.685, AED)</td>
        <td>@money($item->clearance_cost, AED)</td>
        <th class="bg-color-total">@money($totalCost, AED)</th>
        <th class="bg-color-total">@money($totalSoldPrice, AED)</th>
        <th>@money($totalSoldPrice - $totalCost, AED)</th>
      </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      @php
        $totalUSD =
            @$vehicles->sum('vehicle_price') +
            @$vehicles->sum('towing_cost') +
            @$vehicles->sum('ship_cost') +
            @$vehicles->sum('storage_cost') +
            @$vehicles->sum('custom_cost') +
            @$vehicles->sum('tds_cost') +
            @$vehicles->sum('other_cost');
        $totalCost = $totalUSD * 3.685 + @$vehicles->sum('clearance_cost');
        $totalSoldPrice = @$vehicles->sum('sold_price');

      @endphp
      <th>#</th>
      @can('vehicle-edit')
        <th>Edit</th>
      @endcan
      <th>Vehicle Description</th>
      <th>VIN#</th>
      <th>Customer</th>
      <th>Container#</th>
      <th>Status</th>
      <th>@money($vehicles->sum('vehicle_price'))</th>
      <th>@money($vehicles->sum('towing_cost'))</th>
      <th>@money($vehicles->sum('ship_cost'))</th>
      <th>@money($vehicles->sum('storage_cost'))</th>
      <th>@money($vehicles->sum('custom_cost'))</th>
      <th>@money($vehicles->sum('tds_cost'))</th>
      <th>@money($vehicles->sum('other_cost'))</th>
      <th>@money($totalUSD)</th>
      <th>@money($vehicles->sum('clearance_cost'), AED)</th>
      <th>@money($totalCost, AED)</th>
      <th>@money($totalSoldPrice, AED)</th>
      <th>@money($totalSoldPrice - $totalCost, AED)</th>
    </tr>
  </tfoot>
</table>

@if ($vehicles instanceof \Illuminate\Pagination\LengthAwarePaginator)
  {{ $vehicles->appends(Request::All())->links() }}
@endif
