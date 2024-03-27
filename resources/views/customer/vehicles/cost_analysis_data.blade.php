<div id="content_loader"></div>
<table class="table table-bordered table-hover content-table bg-white" >
    <thead class="bg-info">
        <tr>
            <th>#</th>
            <th>Vehicle Description</th>
            <th>VIN#</th>
            <th>Customer</th>
            <th>Container#</th>
            <th>Towing Cost</th>
            <th>Clearance Cost</th>
            <th>Ship Cost</th>
            <th>Storage Cost</th>
            <th>Custom Cost</th>
            <th>TDS Cost</th>
            <th>Other Cost</th>
            <th>Total Cost</th>
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
        @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
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
                <th class="bg-color-total">@money($totalCharge)</th>
               
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
            @endphp
            <th>#</th>
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
            <th>@money($totalCharges)</th>
        </tr>
    </tfoot>
</table>

@if ($vehicles instanceof \Illuminate\Pagination\LengthAwarePaginator)
    {{ $vehicles->appends(Request::All())->links() }}
@endif


