<style>
    table,
    tr {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    .th1,
    .td1 {
        border: 1px solid #0a0a0a;
        text-align: left;
        padding: 3px;
        border-collapse: collapse !important;
    }

    #tr1:nth-child(even) {
        background-color: #dddddd;
    }

    #customers {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        font-size: 11px;
        padding: 3px !important;
    }

    th {
        background-color: #d9edf7;
        /* background-color: lightblue; */
        color: #222;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-10 col-md-offset-1 ">
                <table id="customers">
                    <tr>
                        <td rowspan="5">
                            <img src="{{ asset('img/logo.webp') }}" height="100px">
                        </td>
                        <th style="background-color: unset;">Peace Global Logistics</th>
                        <th style="background-color: unset;">Mix Shipping Invoice</th>
                    </tr>
                    @php
                    <!-- $names = $invoice->vehicles->flatMap(function ($vehicle) {
                        return $vehicle->charges->pluck('name');
                    })->unique()->toArray(); -->
                    $currency = 'AED';
                    @endphp
                    <?php
                    $total_amount_aed = 0;
                    $due_balance = 0;
                    foreach ($invoice->vehicles as $vehicle) {
                        $total_amount_aed += round(($vehicle->freight + $vehicle->clearance + $vehicle->tow_amount + $vehicle->vat_and_custom + $vehicle->charges->sum('value')) * $invoice->exchange_rate, 2);
                    }
                    $due_balance = $total_amount_aed; ?>
                    <tr>
                        <td>{{ A Street }} <br>
                            {{ B City }}, {{ C State }}, {{ D Zip Code }}
                            <br>test@als.com
                        </td>
                        <td>INV#: <b>{{ sprintf("ALSMS%'.04d\n", @$invoice->id) }}</b>
                            <br>Issue Date: {{ @$invoice->invoice_date }}
                            <br>Due Date: {{ @$invoice->invoice_due_date }}
                            <?php $today = Carbon\Carbon::parse(Carbon\Carbon::today());
                            $inv_date_due = Carbon\Carbon::parse(@$invoice->invoice_due_date);
                            ?>
                            <br>Past Due Days:
                            {{ $today > $invoice_date_due && $due_balance > 0 ? $today->diffInDays($invoice_date_due) : '' }}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            Payment Date:
                            {{ join(', ', array_unique($invoice->vehicles->pluck('payment_date')->toArray())) }}
                            <br>
                            Payment Received :
                            <!-- {{ $invoice->vehicles->count() > 0 ? number_format(@$invoice->vehicles->sum('payment_amount'), 2) . ' ' . $currency : '' }} -->
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <th style=" text-align: left;">Bill TO: </th>
                        <th style=" text-align: left;">Balance Due: {{ number_format($due_balance, 2) }} {{ $currency }}
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2">{{ @$invoice->customer->name }}
                            <!-- <br>
                            {{ @$invoice->company->customer_address }}, {{ @$invoice->company->comp_city }},
                            {{ @$invoice->company->zip_code }}
                            <br>
                            {{ @$invoice->company->country }} &nbsp;Phone: {{ @$invoice->company->customer_phone }} -->
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th style="text-align: center;" colspan="4">Cargo Information</th>
                    </tr>
                    <tr>
                        <td colspan="2">Container Number:&nbsp;&nbsp;E ContainerN
                            <br>
                            Booking Number:&nbsp;&nbsp;F BNum <br>
                            Origin:&nbsp;&nbsp; G Org
                            <br>
                            Destination:&nbsp;&nbsp;H Dest
                        </td>
                        <td colspan="2">Consignee:&nbsp;&nbsp;I Consignee <br>
                            Carrier Name:&nbsp;&nbsp;J Carrier <br>
                            ETD:&nbsp;&nbsp;K ETD <br>
                            ETA:&nbsp;&nbsp;L ETA </td>
                    </tr>
                </table>

                <div id="yoba">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <th class="td1">#</th>
                                <th class="td1">Description</th>
                                <th class="td1">Freight</th>
                                <th class="td1">Towing</th>
                                <th class="td1">10%Vat & Custom</th>
                                <!-- <th class="td1">Clearance</th> -->
                                <!-- @foreach (@$names as $name)
                                    <th class="td1">{{ @$allCharges[$name] }}</th>
                                @endforeach -->
                                <th class="td1">Sub Total</th>
                            </tr>
                            <?php
                            
                            $totalFreight = 0;
                            $totalTow_amount = 0;
                            $totalVatAndCustom = 0;
                            $totalClearance = 0;
                            $dynamicCharges = [];
                            $TotalAmounUSD = 0;
                            $TotalAmounAED = 0;
                            ?>

                            @foreach ($invoice->vehicles as $key => $vehicle)
                                <tr>
                                    <td class="td1">{{ $key + 1 }}</td>
                                    <td class="td1" style="min-width: 30vw;">
                                        {{ $vehicle->vehicle->year }}&nbsp;{{ $vehicle->vehicle->make }}&nbsp;{{ $vehicle->vehicle->model }}
                                        <br><b>VIN:</b>{{ $vehicle->vehicle->vin }}
                                        <br><b>Lot#:</b>{{ $vehicle->vehicle->lot_number }}
                                        <br><b>Auction City:</b>{{ $vehicle->vehicle->auction_city }}
                                        <div style="font-size: 10px;"><b>Description:</b>{!! nl2br($vehicle->description) !!}</div>
                                    </td>
                                    <td class="td1" style="text-align:right;">${{ $vehicle->shiping_charge }}</td>
                                    <td class="td1" style="text-align:right;">${{ $vehicle->tow_charge }}</td>
                                    <td class="td1" style="text-align:right;">
                                        ${{ number_format($vehicle->custom_charge, 2) }}</td>
                                    <!-- <td class="td1" style="text-align:right;">
                                        ${{ number_format($vehicle->clearance, 2) }}</td> -->
                                    <!-- @php 
                                    $vehicleNameCharges = @$vehicle->charges->pluck('value', 'name')->toArray();
                                    @endphp
                                    @foreach ($names as $key1 => $name)
                                        @php
                                            $dynamicCharges[$name] = @$dynamicCharges[$name] + @$vehicleNameCharges[$name];
                                        @endphp
                                        <td class="td1" style="text-align:right;">
                                            ${{ number_format(@$vehicleNameCharges[$name], 2) }}
                                        </td>
                                    @endforeach -->
                                    <td class="td1" style="text-align:right;">
                                        ${{ number_format($vehicle->shiping_charge + $vehicle->tow_charge + $vehicle->custom_charge , 2) }}
                                    </td>
                                </tr>
                                <?php
                                $totalFreight = $totalFreight + $vehicle->shiping_charge;
                                $totalTow_amount = $totalTow_amount + $vehicle->tow_charge;
                                $totalVatAndCustom = $totalVatAndCustom + $vehicle->custom_charge;
                                $TotalAmounUSD += $vehicle->shiping_charge + $vehicle->tow_charge + $vehicle->custom_charge;
                                $TotalAmounAED += round(($vehicle->shiping_charge + $vehicle->tow_charge + $vehicle->custom_charge) * $invoice->exchange_rate, 2);
                                ?>
                            @endforeach
                            <tr>
                                <th class="td1"></th>
                                <th class="td1">Sub Total</th>
                                <th style=" text-align:right;" class="td1">${{ number_format(@$totalFreight, 2) }}
                                </th>
                                <th style=" text-align:right;" class="td1">
                                    ${{ number_format(@$totalTow_amount, 2) }}
                                </th>
                                <th style=" text-align:right;" class="td1">
                                    ${{ number_format(@$totalVatAndCustom, 2) }}</th>
                                <!-- @foreach ($names as $key1 => $name)
                                    <th style=" text-align:right;" class="td1">
                                        ${{ number_format(@$dynamicCharges[$name], 2) }}
                                    </th>
                                @endforeach -->
                                <!-- </th> -->
                                <th style=" text-align:right;" class="td1">
                                    ${{ number_format(@$totalFreight + $totalTow_amount + $totalVatAndCustom, 2) }}
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100%" style="border: 1px solid #0a0a0a;">
                        <tbody>
                            <tr>
                                <th>QTY($)</th>
                                <th>Rate</th>
                                <th>Amount</th>
                                @if (@$invoice->discount > 0)
                                    <th>Discount</th>
                                @endif
                                <th>Total</th>
                            </tr>
                            <tr>
                                <th>${{ number_format(@$TotalAmounUSD, 2) }}</th>
                                <th>{{ $invoice->exchange_rate }}</th>
                                <th>{{ number_format(@$TotalAmounAED, 2) }}  {{ $currency }}</th>
                                @if (@$invoice->discount > 0)
                                    <th>{{ number_format((float) $invoice->discount, 2) }}  {{ $currency }}</th>
                                @endif
                                <th>{{ number_format($TotalAmounAED - (float) $invoice->discount, 2) }}  {{ $currency }}
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100%">
                        <tbody>
                            @if ($invoice->description)
                                <tr style="background-color: #eaf4f4; color: black;">
                                    <th
                                        style="padding-left:10px; padding-right:10px; width:100%; padding-top: 10px; padding-bottom: 5px;">
                                        <span style="text-align:left;">Additional Note
                                            : {{ $invoice->description }}
                                        </span>
                                    </th>
                                </tr>
                            @endif
                            <tr style="background-color: #eaf4f4; color: black;">
                                <td
                                    style="padding-left:35% !important; width:100% !important; padding-top: 10px !important; padding-bottom: 10px !important;">
                                    <b>Wire Transfer Information:</b><br>
                                    Account Name: A L S C SHIPPING LLC <br />
                                    Account Number: 3708433485501 <br />
                                    Currency: AED <br />
                                    BIC Code: MEBLAEADXXX <br />
                                    IBAN: AE030340003708433485501 <br />
                                    Bank Name : Emirates Islamic <br />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100%">
                        <tbody>
                            <tr>
                                <th style="background-color: #eaf4f4;">Phone: <br>
                                    M Phone
                                </th>
                                <th style="background-color: #eaf4f4;">Fax:
                                    <br>N Fax
                                </th>
                                <th style="background-color: #eaf4f4;">
                                    Website:<br>O Web</th>
                                <th style="background-color: #eaf4f4;">
                                    Facebook:<br>P Fb</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
