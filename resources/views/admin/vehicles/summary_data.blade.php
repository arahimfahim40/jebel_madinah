<div id="content_loader"></div>
<table class="table table-bordered table-hover content-table bg-white" >
    <thead class="bg-info">
        <tr>
            <th>#</th>
            <th>Customer Name</th>
            <th>Pending</th>
            <th>On The Way</th>
            <th>On Hand No Title</th>
            <th>On Hand With Title</th>
            <th>Shipped</th>
            <th>Total</th>

        </tr>
    </thead>
    <tbody>
        @php
            $count = 1;
        @endphp
        @foreach ($vehicleSummary as $index => $item)
            <tr>
                <td>{{ $count++ }}</td>
                <td>{{ $item->customer_name ? $item->customer_name : 'Unknown' }}</td>
                <td>
                    <a href="{{route('vehicles.index')}}?status=pending&customer_id={{ $item->customer_id }}&location_id={{ request()->location_id }}">
                        {{ $item->pending }}
                    </a>
                </td>
                <td>
                    <a href="{{route('vehicles.index')}}?status=on_the_way&customer_id={{ $item->customer_id }}&location_id={{ request()->location_id }}">
                        {{ $item->on_the_way }}
                    </a>
                </td>
                <td>
                    <a href="{{route('vehicles.index')}}?status=on_hand_no_title&customer_id={{ $item->customer_id }}&location_id={{ request()->location_id }}">
                        {{ $item->on_hand_no_title }}
                    </a>
                </td>
                <td>
                    <a href="{{route('vehicles.index')}}?status=on_hand_with_title&customer_id={{ $item->customer_id }}&location_id={{ request()->location_id }}">
                        {{ $item->on_hand_with_title }}
                    </a>
                </td>
                <td>
                    <a href="{{route('vehicles.index')}}?status=shipped&customer_id={{ $item->customer_id }}&location_id={{ request()->location_id }}">
                        {{ $item->shipped }}
                    </a>
                </td>
                <th class="text-center">
                    <a href="{{route('vehicles.index')}}?customer_id={{ $item->customer_id }}&location_id={{ request()->location_id }}">
                        {{ $item->pending + $item->on_the_way + $item->on_hand_no_title + $item->on_hand_with_title + $item->shipped }}
                    </a>
                </th>
                
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th class="text-center" colspan="2">Total</th>
            <th class="text-center">
                <a href="{{route('vehicles.index')}}?status=pending&location_id={{ request()->location_id }}">
                    {{ $vehicleSummary->sum('pending') }}
                </a>
            </th>
            <th class="text-center">
                <a href="{{route('vehicles.index')}}?status=on_the_way&location_id={{ request()->location_id }}">
                    {{ $vehicleSummary->sum('on_the_way') }}
                </a>
            </th>
            <th class="text-center">
                <a href="{{route('vehicles.index')}}?status=on_hand_no_title&location_id={{ request()->location_id }}">
                    {{ $vehicleSummary->sum('on_hand_no_title') }}
                </a>
            </th>
            <th class="text-center">
                <a href="{{route('vehicles.index')}}?status=on_hand_with_title&location_id={{ request()->location_id }}">
                    {{ $vehicleSummary->sum('on_hand_with_title') }}
                </a>
            </th>
            <th class="text-center">
                <a href="{{route('vehicles.index')}}?status=shipped&location_id={{ request()->location_id }}">
                    {{ $vehicleSummary->sum('shipped') }}
                </a>
            </th>
            <th class="text-center">
                <a href="{{route('vehicles.index')}}?location_id={{ request()->location_id }}">
                    {{ $vehicleSummary->sum('pending') + $vehicleSummary->sum('on_the_way') + $vehicleSummary->sum('on_hand_no_title')+ $vehicleSummary->sum('on_hand_with_title')+ $vehicleSummary->sum('shipped') }}
                </a>
            </th>
        </tr>
    </tfoot>
</table>



