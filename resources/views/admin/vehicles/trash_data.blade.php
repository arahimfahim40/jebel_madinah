<div id="content_loader"></div>
<table class="table table-bordered table-hover content-table bg-white">
  <thead class="bg-info">
    <tr>
      <th>#</th>
      @can('vehicle-change-status')
        <th><input class="checkbox_all" onclick="checkAll(this)" type="checkbox" style=" width:25px; height:20px;"></th>
      @endcan
      <th>Vehicle Description</th>
      <th>VIN#</th>
      <th>Lot#</th>
      <th>Container#</th>
      <th>Owner</th>
      <th>Status</th>
      <th>Auction</th>
      <th>Buyer Number</th>
      <th>Vehicle Cost</th>
      <th>Restore</th>

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
        @can('vehicle-change-status')
          <td>
            <input name="status[{{ $item->id }}]" type="checkbox" style="width:25px; height:20px;" class="checkbox"
              data-id="{{ $item->id }}" data-status="{{ $item->status }}" />
          </td>
        @endcan
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
        <td>
          @can('vehicle-delete')
            @if ($item->status != 'sold')
              <a onclick="deleteVehicle('{{ $item->id }}')"
                style="cursor:pointer; display: flex; align-items: center;">
                <i class="fa fa-trash-restore" style="font-size:16px; color:red; margin: 0;"></i>
              </a>
            @endif
          @endcan
        </td>
      </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <th>#</th>
      @can('vehicle-change-status')
        <th><input class="checkbox_all" onclick="checkAll(this)" type="checkbox" style=" width:25px; height:20px;"></th>
      @endcan
      <th>Vehicle Description</th>
      <th>VIN#</th>
      <th>Lot#</th>
      <th>Container#</th>
      <th>Owner</th>
      <th>Status</th>
      <th>Auction</th>
      <th>Buyer Number</th>
      <th>Vehicle Cost</th>
      <th>Restore</th>

    </tr>
  </tfoot>
</table>

@if ($vehicles instanceof \Illuminate\Pagination\LengthAwarePaginator)
  {{ $vehicles->appends(Request::All())->links() }}
@endif
