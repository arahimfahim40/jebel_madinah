<div id="content_loader"></div>
<table class="table table-bordered table-hover content-table bg-white">
  <thead class="bg-info">
    <tr>
      <th>#</th>
      <th>Vehicle Description</th>
      <th>VIN#</th>
      <th>Lot#</th>
      <th>Container#</th>
      <th>Owner</th>
      <th>Status</th>
      <th>Auction</th>
      <th>Buyer Number</th>
      <th>Vehicle Cost</th>
      @can('vehicle-restore')
        <th>Restore</th>
      @endcan

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
        $vehicleTotalCost = $totalUSD * \App\Models\Invoice::EXCHANGE_RATE + @$item->clearance_cost;
      @endphp
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $item->year }} {{ $item->make }} {{ $item->model }} {{ $item->color }}</td>
        <td>{{ $item->vin }}</td>
        <td>{{ $item->lot_number }}</td>
        <td>{{ $item->container_number }}</td>
        <td>{{ @$item->owner->name }}</td>
        <td>
          @if ($item->status == 'on_the_way')
            <span class="tag tag-warning">{{ ucwords(str_replace('_', ' ', $item->status)) }}</span>
          @elseif ($item->status == 'inventory')
            <span class="tag tag-info">{{ ucwords(str_replace('_', ' ', $item->status)) }}</span>
          @elseif ($item->status == 'sold')
            <span class="tag tag-success">{{ ucwords(str_replace('_', ' ', $item->status)) }}</span>
          @endif
        </td>
        <td>{{ $item->auction_name }}</td>
        <td>{{ $item->buyer_number }}</td>
        <td>@money($vehicleTotalCost, AED)</td>
        @can('vehicle-restore')
          <td>
            <a onclick="restoreVehicle('{{ $item->id }}')" style="cursor:pointer; display: flex; align-items: center;">
              <i class="fa fa-undo" style="font-size:16px; color:red; margin: 0;"> </i>
            </a>
          </td>
        @endcan
      </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <th>#</th>
      <th>Vehicle Description</th>
      <th>VIN#</th>
      <th>Lot#</th>
      <th>Container#</th>
      <th>Owner</th>
      <th>Status</th>
      <th>Auction</th>
      <th>Buyer Number</th>
      <th>Vehicle Cost</th>
      @can('vehicle-restore')
        <th>Restore</th>
      @endcan

    </tr>
  </tfoot>
</table>

@if ($vehicles instanceof \Illuminate\Pagination\LengthAwarePaginator)
  {{ $vehicles->appends(Request::All())->links() }}
@endif
