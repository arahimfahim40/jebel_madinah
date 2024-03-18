
<table class="table table-bordered table-hover content-table bg-white" >
    <thead class="bg-info">
        <tr>
            <th>#</th>
            <th>Action</th>
            <th>Photos</th>
            <th>Vehicle Description</th>
            <th>VIN#</th>
            <th>Lot#</th>
            <th>Container#</th>
            <th>Title Received Date</th>
            <th>Title Number</th>
            <th>Title State</th>
            <th>Purchase Date</th>
            <th>Pickup Date</th>
            <th>Deliver Date</th>
            <th>Point of Loading</th>
            <th>Weight</th>
            <th>CBM</th>
            <th>Licence Number</th>
            <th>HT Number</th>
            <th>C Remark</th>
            {{-- <th>Note</th> --}}
            <th>Towed From</th>
            <th>Status</th>
            <th>Vehicle Type</th>
            <th>Payment Date</th>
            <th>Shipas</th>
            <th>Buyer Number</th>
            
            <th>Vehicle Price</th>
            <th>Auction</th>
        </tr>
    </thead>
    <tbody>
        <?php $id = 1; ?>
        @foreach ($vehicles as $index => $item)
            <tr id="searchBody">
                <td>{{ $index + 1 }}</td>
                <td></td>
                <td class="column">
                    <?php
                    $label = 'tag-success';
                    if (strpos(@$item->photos_link, 'http') === false) {
                        $label = '';
                    }
                    ?>
                    <a href="{{ $item->photos_link }}" target="_blank" style="text-align: center; font-size:30px;">
                        <span class="ti-image  <?= $label ?>">
                            <p style="display: none">{{ $item->photos_link }}</p>
                        </span>
                    </a>
                </td>
                <td>{{ $item->year }} {{ $item->make }} {{ $item->model }} {{ $item->color }}</td>
                <td>{{ $item->vin }}</td>
                <td>{{ $item->lot_number }}</td>
                <td>{{ $item->container_number }}</td>
                <td class="text-nowrap">{{ $item->title_received_date }}</td>
                <td>{{ $item->title_number }}</td>
                <td>{{ $item->title_state }}</td>
                <td class="text-nowrap">{{ $item->purchase_date }}</td>
                <td class="text-nowrap">{{ $item->pickup_date }}</td>
                <td class="text-nowrap">{{ $item->deliver_date }}</td>
                <td>{{ @$item->location->name }}</td>
                <td>{{ $item->weight }}</td>
                <td>{{ $item->cbm }}</td>
                <td>{{ $item->licence_number }}</td>
                <td>{{ $item->htnumber }}</td>
                <td>{{ $item->c_remark }}</td>
                {{-- <td>{{ $item->note }}</td> --}}
                <td>{{ $item->towed_from }}</td>
                <td>
                    @if($item->status == 'pending')
                        <span class="tag tag-secondary" >{{ucwords(str_replace('_', ' ', $item->status))}}</span>
                    @elseif ($item->status == 'on_the_way')
                        <span class="tag tag-warning" >{{ucwords(str_replace('_', ' ', $item->status))}}</span>
                    @elseif ($item->status == 'on_hand_no_title')
                        <span class="tag tag-danger" >{{ucwords(str_replace('_', ' ', $item->status))}}</span>
                    @elseif ($item->status == 'on_hand_with_title')
                        <span class="tag tag-info" >{{ucwords(str_replace('_', ' ', $item->status))}}</span>
                    @elseif ($item->status == 'shipped')
                        <span class="tag tag-success" >{{ucwords(str_replace('_', ' ', $item->status))}}</span>
                    @endif
                </td>
                <td>{{ $item->vehicle_type }}</td>
                <td class="text-nowrap">{{ $item->payment_date }}</td>
                <td>{{ $item->shipas }}</td>
                
                <td>{{ $item->buyer_number }}</td>
                <td>{{ $item->vehicle_price }}</td>
                <td>{{ $item->auction }}</td>
               
                
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Action</th>
            <th>Photos</th>
            <th>Vehicle Description</th>
            <th>VIN#</th>
            <th>Lot#</th>
            <th>Container#</th>
            <th>Title Received Date</th>
            <th>Title Number</th>
            <th>Title State</th>
            <th>Purchase Date</th>
            <th>Pickup Date</th>
            <th>Deliver Date</th>
            <th>Point of Loading</th>
            <th>Weight</th>
            <th>CBM</th>
            <th>Licence Number</th>
            <th>HT Number</th>
            <th>C Remark</th>
            {{-- <th>Note</th> --}}
            <th>Towed From</th>
            <th>Status</th>
            <th>Vehicle Type</th>
            <th>Payment Date</th>
            <th>Shipas</th>
            <th>Buyer Number</th>
            <th>Vehicle Price</th>
            <th>Auction</th>
        </tr>
    </tfoot>
</table>

@if ($vehicles instanceof \Illuminate\Pagination\LengthAwarePaginator)
    {{ $vehicles->appends(Request::All())->links() }}
@endif


