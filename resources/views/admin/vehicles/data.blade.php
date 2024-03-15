
<table class="table table-bordered table-hover content-table" >
    <thead class="bg-info">
        <tr>
            <th>#</th>
            <th>Action</th>
            <th>ID</th>
            <th>Causer ID</th>
            <th>Caused By</th>
            <th>Caused At</th>
            <th>View Changes</th>
            <th>Year</th>
            <th>Container Number</th>
            <th>Title Received Date</th>
            <th>Title Number</th>
            <th>Title State</th>
            <th>Purchase Date</th>
            <th>Pickup Date</th>
            <th>Deliver Date</th>
            <th>Note</th>
            <th>Color</th>
            <th>Model</th>
            <th>VIN</th>
            <th>Weight</th>
            <th>CBM</th>
            <th>Value</th>
            <th>Licence Number</th>
            <th>Storage Amount</th>
            <th>Check Number</th>
            <th>Add Charges</th>
            <th>Lot Number</th>
            <th>HT Number</th>
            <th>C Remark</th>
            <th>Make</th>
            <th>Towed From</th>
            <th>Tow Amount</th>
            <th>Status</th>
            <th>Vehicle Type</th>
            <th>Payment Date</th>
            <th>Shipas</th>
            <th>Port of Loading ID</th>
            <th>Buyer Number</th>
            <th>Photos Link</th>
            <th>Storage Cost</th>
            <th>Vehicle Price</th>
            <th>Auction Fee</th>
            <th>Tow Amounts</th>
            <th>Dismantal Cost</th>
            <th>Ship Cost</th>
            <th>Dubai Custom Cost</th>
            <th>Dubai Storage Cost</th>
            <th>Dubai Demurage</th>
            <th>Other Cost</th>
            <th>Sales Cost</th>
            <th>Profit</th>
            <th>Percent Profit</th>
            <th>Auction</th>
        </tr>
    </thead>
    <tbody>
        <?php $id = 1; ?>
        @foreach ($vehicles as $index => $item)
            <tr id="searchBody">
                <td>{{ $index + 1 }}</td>
                <td><!-- Action column content --></td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->causer_id }}</td>
                <td>{{ $item->caused_by }}</td>
                <td>{{ $item->caused_at }}</td>
                <td><!-- View Changes column content --></td>
                <td>{{ $item->year }}</td>
                <td>{{ $item->container_number }}</td>
                <td>{{ $item->title_received_date }}</td>
                <td>{{ $item->title_number }}</td>
                <td>{{ $item->title_state }}</td>
                <td>{{ $item->purchase_date }}</td>
                <td>{{ $item->pickup_date }}</td>
                <td>{{ $item->deliver_date }}</td>
                <td>{{ $item->note }}</td>
                <td>{{ $item->color }}</td>
                <td>{{ $item->model }}</td>
                <td>{{ $item->vin }}</td>
                <td>{{ $item->weight }}</td>
                <td>{{ $item->cbm }}</td>
                <td>{{ $item->value }}</td>
                <td>{{ $item->licence_number }}</td>
                <td>{{ $item->storage_amount }}</td>
                <td>{{ $item->check_number }}</td>
                <td>{{ $item->add_charges }}</td>
                <td>{{ $item->lot_number }}</td>
                <td>{{ $item->htnumber }}</td>
                <td>{{ $item->c_remark }}</td>
                <td>{{ $item->make }}</td>
                <td>{{ $item->towed_from }}</td>
                <td>{{ $item->tow_amount }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->vehicle_type }}</td>
                <td>{{ $item->payment_date }}</td>
                <td>{{ $item->shipas }}</td>
                <td>{{ $item->port_of_loading_id }}</td>
                <td>{{ $item->buyer_number }}</td>
                <td>{{ $item->photos_link }}</td>

                <td>{{ $item->storage_cost }}</td>
                <td>{{ $item->vehicle_price }}</td>
                <td>{{ $item->auction_fee }}</td>
                <td>{{ $item->tow_amounts }}</td>
                <td>{{ $item->dismantal_cost }}</td>
                <td>{{ $item->ship_cost }}</td>
                <td>{{ $item->dubai_custom_cost }}</td>
                <td>{{ $item->dubai_storage_cost }}</td>
                <td>{{ $item->dubai_demurage }}</td>
                <td>{{ $item->other_cost }}</td>
                <td>{{ $item->sales_cost }}</td>
                <td>{{ $item->profit }}</td>
                <td>{{ $item->percent_profit }}</td>
                <td>{{ $item->auction }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Action</th>
            <th>ID</th>
            <th>Causer ID</th>
            <th>Caused By</th>
            <th>Caused At</th>
            <th>View Changes</th>
            <th>Year</th>
            <th>Container Number</th>
            <th>Title Received Date</th>
            <th>Title Number</th>
            <th>Title State</th>
            <th>Purchase Date</th>
            <th>Pickup Date</th>
            <th>Deliver Date</th>
            <th>Note</th>
            <th>Color</th>
            <th>Model</th>
            <th>VIN</th>
            <th>Weight</th>
            <th>CBM</th>
            <th>Value</th>
            <th>Licence Number</th>
            <th>Storage Amount</th>
            <th>Check Number</th>
            <th>Add Charges</th>
            <th>Lot Number</th>
            <th>HT Number</th>
            <th>C Remark</th>
            <th>Make</th>
            <th>Towed From</th>
            <th>Tow Amount</th>
            <th>Status</th>
            <th>Vehicle Type</th>
            <th>Payment Date</th>
            <th>Shipas</th>
            <th>Port of Loading ID</th>
            <th>Buyer Number</th>
            <th>Photos Link</th>
            <th>Storage Cost</th>
            <th>Vehicle Price</th>
            <th>Auction Fee</th>
            <th>Tow Amounts</th>
            <th>Dismantal Cost</th>
            <th>Ship Cost</th>
            <th>Dubai Custom Cost</th>
            <th>Dubai Storage Cost</th>
            <th>Dubai Demurage</th>
            <th>Other Cost</th>
            <th>Sales Cost</th>
            <th>Profit</th>
            <th>Percent Profit</th>
            <th>Auction</th>
        </tr>
    </tfoot>
</table>


{{-- @if ($vehicles instanceof \Illuminate\Pagination\LengthAwarePaginator)
    {{ $vehicles->appends(Request::all())->links() }}
@endif --}}


