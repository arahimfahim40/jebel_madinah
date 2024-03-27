<div id="content_loader"></div>
<table class="table table-bordered table-hover content-table bg-white" >
    <thead class="bg-info">
        <tr>
            <th>#</th>
            @can('vehicle-edit')
            <th>Edit</th>
            @endcan
            <th>Vehicle Description</th>
            <th>VIN#</th>
            <th>Customer</th>
            <th>Container#</th>
            <th>Towing Charge</th>
            <th>Clearance Charge</th>
            <th>Ship Charge</th>
            <th>Storage Charge</th>
            <th>Custom Charge</th>
            <th>TDS Charge</th>
            <th>Other Charge</th>
            <th style="border-left: 2px solid #555;">Towing Cost</th>
            <th>Clearance Cost</th>
            <th>Ship Cost</th>
            <th>Storage Cost</th>
            <th>Custom Cost</th>
            <th>TDS Cost</th>
            <th>Other Cost</th>
            <th>Total Charge</th>
            <th>Total Cost</th>
            <th>Profit/Loss</th>
        </tr>
    </thead>
    <tbody>
        <?php $id = 1; ?>
        @foreach ($vehicles as $index => $item)
        @php
        $totalCharge = @$item->towing_charge
            + @$item->clearance_charge
            + @$item->ship_charge
            + @$item->storage_charge
            + @$item->custom_charge
            + @$item->tds_charge
            + @$item->other_charge;
        $totalCost = @$item->towing_cost
            + @$item->clearance_cost
            + @$item->ship_cost
            + @$item->storage_cost
            + @$item->custom_cost
            + @$item->tds_cost
            + @$item->other_cost;
        @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                @can('vehicle-edit')
                <td>
                    <a href="{{ route('vehicles.edit', $item->id) }}"  class="btn btn-info btn-circle btn-sm column"><span class="fa fa-edit"></span></a>
                </td>
                @endcan
                <td>{{ $item->year }} {{ $item->make }} {{ $item->model }} {{ $item->color }}</td>
                <td>{{ $item->vin }}</td>
                <td>{{ @$item->customer->name }}</td>
                <td>{{ $item->container_number }}</td>

                <td>@money($item->towing_charge)</td>
                <td>@money($item->clearance_charge)</td>
                <td>@money($item->ship_charge)</td>
                <td>@money($item->storage_charge)</td>
                <td>@money($item->custom_charge)</td>
                <td>@money($item->tds_charge)</td>
                <td>@money($item->other_charge)</td>
                <td style="border-left: 2px solid #555;">@money($item->towing_cost)</td>
                <td>@money($item->clearance_cost)</td>
                <td>@money($item->ship_cost)</td>
                <td>@money($item->storage_cost)</td>
                <td>@money($item->custom_cost)</td>
                <td>@money($item->tds_cost)</td>
                <td>@money($item->other_cost)</td>
                <th class="bg-color-total">@money($totalCharge)</th>
                <th class="bg-color-total">@money($totalCost)</th>
                <th>@money($totalCharge - $totalCost)</th>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            @php
                $totalCharges =  @$vehicles->sum('towing_charge')
                    + @$vehicles->sum('clearance_charge')
                    + @$vehicles->sum('ship_charge')
                    + @$vehicles->sum('storage_charge')
                    + @$vehicles->sum('custom_charge')
                    + @$vehicles->sum('tds_charge')
                    + @$vehicles->sum('other_charge');
                $totalCosts = @$vehicles->sum('towing_cost')
                    + @$vehicles->sum('clearance_cost')
                    + @$vehicles->sum('ship_cost')
                    + @$vehicles->sum('storage_cost')
                    + @$vehicles->sum('custom_cost')
                    + @$vehicles->sum('tds_cost')
                    + @$vehicles->sum('other_cost');
            @endphp
            <th>#</th>
            @can('vehicle-edit')
            <th>Edit</th>
            @endcan
            <th>Vehicle Description</th>
            <th>VIN#</th>
            <th>Customer</th>
            <th>Container#</th>
            <th>@money($vehicles->sum('towing_charge'))</th>
            <th>@money($vehicles->sum('clearance_charge'))</th>
            <th>@money($vehicles->sum('ship_charge'))</th>
            <th>@money($vehicles->sum('storage_charge'))</th>
            <th>@money($vehicles->sum('custom_charge'))</th>
            <th>@money($vehicles->sum('tds_charge'))</th>
            <th>@money($vehicles->sum('other_charge'))</th>
            <th style="border-left: 2px solid #555;">@money($vehicles->sum('towing_cost'))</th>
            <th>@money($vehicles->sum('clearance_cost'))</th>
            <th>@money($vehicles->sum('ship_cost'))</th>
            <th>@money($vehicles->sum('storage_cost'))</th>
            <th>@money($vehicles->sum('custom_cost'))</th>
            <th>@money($vehicles->sum('tds_cost'))</th>
            <th>@money($vehicles->sum('other_cost'))</th>
            <th>@money($totalCharges)</th>
            <th>@money($totalCosts)</th>
            <th>@money($totalCharges - $totalCosts)</th>
        </tr>
    </tfoot>
</table>

@if ($vehicles instanceof \Illuminate\Pagination\LengthAwarePaginator)
    {{ $vehicles->appends(Request::All())->links() }}
@endif


