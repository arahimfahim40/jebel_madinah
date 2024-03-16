<div class="site-overlay"></div>
{{--<?php
$locations = DB::table('locations')
    ->whereNull('deleted_at')
    ->get();
?>--}}
<div class="site-sidebar">
    <div class="custom-scroll custom-scroll-light">
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('dashboard_admin') }}" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="fa fa-home"></i></span>
                    <span class="s-text">Dashboard</span>
                </a>
            </li>

        
                <li class="with-sub vehicle_section">
                    <a href="/all_vehicles_admin" class="waves-effect  waves-light vehicles"
                        onclick="event.preventDefault(); !window.vehicle_section && get_admin_sidebar_sub_count('Vehicle')">
                        <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                        <span class="tag tag-purple t_all_vehicle">0</span>
                        <span class="s-icon"><i class="fa fa-car"></i></span>
                        <span class="s-text">Vehicles</span>
                    </a>
                    <ul>
                        
                            <li>
                                <a href="{{ url('add_vehicle') }}">Add new</a>
                            </li>
                        <li>
                            <a href="{{ route('tow_cost_report_admin') }}" class="waves-effect  waves-light">
                                <span class="s-text">Tow Cost Report</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('all_vehicle_admin') }}">All
                                <span class="tag tag-warning t_all_vehicle" style="float:right;">0</span>
                            </a>
                        </li>
                        <li><a href="{{ route('on_theway_vehicle_admin') }}" id="on_the_way">On the way <span
                                    class="tag tag-warning t_on_the_way" style="float:right;">0</span></a>
                        </li>
                        <li><a href="{{ route('pending_vehicle_admin') }}" id="pending">Pending <span
                                    class="tag tag-warning t_pending" style="float:right;">0</span></a>
                        </li>
                        <li><a href="{{ route('onhand_notitle_vehicle_admin') }}" id="on_hand_no">On hand no/title
                                <span class="tag tag-warning t_on_hand_no_title" style="float:right;">0</span></a>
                        </li>
                        <li><a href="{{ route('onhand_withtitle_vehicle_admin') }}" id="on_hand_with">On hand
                                with/title <span class="tag tag-warning t_on_hand_with_title"
                                    style="float:right;">0</span></a>
                        </li>
                        <li class="with-sub vehicle_inventory_section">
                            <a href="/on_inventory_vehicle_admin" id="on_inventory"
                                onclick="event.preventDefault(); !window.vehicle_inventory_section && get_admin_sidebar_sub_count('VehicleInventory')">Inventory
                                <span class="tag tag-warning t_on_inventory" style="float:right;">0</span>
                            </a>
                            <ul>
                                <li><a href="{{ route('on_inventory_vehicle_admin') }}">All
                                        <span class="tag tag-info t_on_inventory" style="float:right;">0</span></a>
                                </li>
                                {{-- @foreach ($locations as $loca)
                                    <li>
                                        <a
                                            href="{{ url('on_inventory_vehicle_admin') }}?location_id={{ $loca->id }}">{{ $loca->location }}
                                            <span class="tag tag-info t_on_inventory_{{ $loca->id }}"
                                                style="float:right;">0</span>
                                        </a>
                                    </li>
                                @endforeach --}}
                            </ul>
                        </li>

                        <!-- For Halfcut vehicles -->
                        <li class="with-sub vehicle_halfcut_section">
                            <a href="/onhand_onhalfcut_vehicle_admin" class="waves-effect  waves-light"
                                onclick="event.preventDefault(); !window.vehicle_halfcut_section && get_admin_sidebar_sub_count('VehicleHalfcut')">
                                <span class="tag tag-warning t_halfcut"
                                    style="float:right; border-radius: 3px;">0</span>
                                <span class="s-text">HalfCut</span>
                            </a>
                            <ul>
                                <li><a href="{{ route('onhand_onhalfcut_vehicle_admin') }}">All
                                        <span class="tag tag-info t_halfcut" style="float:right;">0</span></a>
                                </li>
                                {{--@foreach ($locations as $loca)
                                    <li>
                                        <a
                                            href="{{ url('onhand_onhalfcut_vehicle_admin') }}?location_id={{ $loca->id }}">{{ $loca->location }}
                                            <span class="tag tag-info t_halfcut_{{ $loca->id }}"
                                                style="float:right;">0</span>
                                        </a>
                                    </li>
                                @endforeach --}}

                                <li class="with-sub halfcut_summary_section">
                                    <a href="/onhand_onhalfcut_vehicle_admin/onhand_onhalfcut_vehicle_summary"
                                        class="waves-effect waves-light"
                                        onclick="event.preventDefault(); !window.halfcut_summary_section && get_admin_sidebar_sub_count('HalfcutSummary')">
                                        <span class="tag tag-warning t_halfcut_summary"
                                            style="float:right; border-radius: 3px;">0</span>
                                        <span class="s-icon"><i class="fa fa-scribd"></i></span>
                                        Summary
                                        <span class="s-caret pull-right"><i class="fa fa-angle-down"></i></span>
                                    </a>

                                    <ul>
                                        <li>
                                            <a href="/onhand_onhalfcut_vehicle_admin/onhand_onhalfcut_vehicle_summary">All
                                                <span class="tag tag-info t_halfcut_summary_"
                                                    style="float:right;">0</span>
                                            </a>
                                        </li>
                                        {{-- @foreach ($locations as $loca)
                                            <li>
                                                <a
                                                    href="\onhand_onhalfcut_vehicle_admin/onhand_onhalfcut_vehicle_summary?status=5&location_id={{ $loca->id }}">{{ $loca->location }}
                                                    <span class="tag tag-info t_halfcut_summary_{{ $loca->id }}"
                                                        style="float:right;">0</span>
                                                </a>
                                            </li>
                                        @endforeach --}}
                                    </ul>
                                </li>
                            </ul>
                        </li>


                        <li><a href="{{ route('shipped_vehicle_admin') }}" id="shipped">Shipped <span
                                    class="tag tag-warning t_shipped" style="float:right;">0</span></a>
                        </li>
                        <li><a href="{{ route('shipped_atloading_vehicles') }}" id="shipped">Atloading In Yard <span
                                    class="tag tag-warning t_shipped_at_loading" style="float:right;">0</span></a>
                        </li>
                        <li><a href="{{ route('vehicle_cost_analysis_admin') }}">Cost anlysis</a>
                        </li>
                        <li><a href="{{ route('dateline_vehicle_admin') }}">Datelines</a></li>

                        <li class="with-sub">
                            <a href="/vehicle_summary" class="waves-effect waves-light"
                                onclick="getVehicleSummaryCounts(event);">
                                <span class="tag tag-warning" style="float:right; border-radius: 3px;"></span>
                                <span class="s-icon"><i class="fa fa-scribd"></i></span>
                                <span class="s-text">Summary</span>
                                <span class="s-caret pull-right"><i class="fa fa-angle-down"></i></span>
                            </a>
                            <ul>
                                <li>
                                    <a href="{{ url('vehicle_summary') }}">All
                                        <span class="tag tag-info" style="float:right;" id="vl-all">0</span>
                                    </a>
                                </li>
                                @foreach ($locations as $loca)
                                    <li>
                                        <a
                                            href="{{ url('vehicle_summary') }}?status=8&location_id={{ $loca->id }}">{{ $loca->location }}
                                            <span class="tag tag-info" style="float:right;"
                                                id="vl-{{ $loca->id }}">0</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                    </ul>
                </li>
            @endif
            @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'shipment-management']))
                <li class="with-sub shipment_section">
                    <a href="/shipment_admin" class="waves-effect  waves-light"
                        onclick="event.preventDefault(); !window.shipment_section && get_admin_sidebar_sub_count('Shipment');">
                        <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                        <span class="tag tag-danger t_all_shipment">0</span>
                        <span class="s-icon"><i class="ti-package"></i></span>
                        <span class="s-text">Shipments</span>
                    </a>
                    <ul>
                        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'add-shipment']))
                            <li>
                                <a href="{{ url('add_shipment') }}">Add new</a>
                            </li>
                        @endif
                        <li><a href="{{ route('shipment_admin', ['10', '10', '1']) }}">All <span
                                    class="tag tag-warning t_all_shipment" style="float:right;">0</span>
                            </a></li>
                        <li><a href="{{ route('shipment_admin_draft_check') }}">
                                Draft Check
                                <span class="tag tag-warning t_all_shipment" style="float:right;">0</span>
                            </a></li>
                        <li><a href="{{ route('shipment_admin', ['3', '10', '1']) }}">Pending <span
                                    class="tag tag-warning t_pending_shipment" style="float:right;">0</span></a>
                        </li>


                        <li class="with-sub shipment_atloading_section">
                            <a href="/shipment_admin/0" class="waves-effect  waves-light"
                                onclick="event.preventDefault(); !window.shipment_atloading_section && get_admin_sidebar_sub_count('ShipmentAtLoading');">
                                <span class="tag tag-warning t_loading_shipment"
                                    style="float:right; border-radius: 3px;">0</span>
                                <span class="s-icon"><i class="fa fa-circle-o"></i></span>
                                <span class="s-text">At loading</span>
                            </a>
                            <ul>
                                <li><a href="{{ route('shipment_admin', ['0', '10', '1']) }}">All <span
                                            class="tag tag-info t_loading_shipment" style="float:right;">0</span></a>
                                </li>
                                @foreach ($locations as $loca)
                                    <li>
                                        <a href="{{ route('shipment_admin', [0, $loca->id, '1']) }}">{{ $loca->location }}
                                            <span class="tag tag-info t_loading_shipment_{{ $loca->id }}"
                                                style="float:right;">0</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="{{ route('shipment_admin', ['6', '10', '1']) }}">At The Dock <span
                                    class="tag tag-danger t_at_the_dock_shipment" style="float:right;">0</span></a>
                        </li>

                        <li class="with-sub shipment_checked_section">
                            <a href="/shipment_admin/4" class="waves-effect  waves-light"
                                onclick="event.preventDefault(); !window.shipment_checked_section && get_admin_sidebar_sub_count('ShipmentChecked');">
                                <span class="tag tag-warning t_checked_shipment"
                                    style="float:right; border-radius: 3px;">0</span>
                                <span class="s-icon"><i class="fa fa-circle-o"></i></span>
                                <span class="s-text">Checked</span>
                            </a>
                            <ul>
                                <li><a href="{{ route('shipment_admin', ['4', '10', '1']) }}">All
                                        <span class="tag tag-info t_checked_shipment"
                                            style="float:right;">0</span></a>
                                </li>
                                @foreach ($locations as $loca)
                                    <li>
                                        <a href="{{ route('shipment_admin', ['4', $loca->id, '1']) }}">{{ $loca->location }}
                                            <span class="tag tag-info t_checked_shipment_{{ $loca->id }}"
                                                style="float:right;">0</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        <li><a href="{{ route('shipment_admin', ['5', '10', '1']) }}">Final checked
                                <span class="tag tag-info t_final_checked_shipment" style="float:right;">0</span>
                            </a>
                        </li>

                </li>
                <li><a href="{{ route('shipment_admin', ['9', '10', '1']) }}">Submit Si <span
                            class="tag tag-danger t_submit_si_shipment" style="float:right;">0</span></a>
                </li>
                <li><a href="{{ route('shipment_admin', ['1', '10', '1']) }}">On the way <span
                            class="tag tag-warning t_on_the_way_shipment" style="float:right;">0</span> </a>
                </li>
                <li><a href="{{ route('shipment_admin', ['2', '10', '1']) }}">Arrived
                        <span class="tag tag-warning t_arrived_shipment" style="float:right;">0</span></a>
                </li>

                <!-- For Advanced Booking  -->
                <li class="with-sub shipment_advanced_booking_section">
                    <a href="{{ route('booking_admin', ['1', '10', '10']) }}" class="waves-effect  waves-light"
                        onclick="event.preventDefault(); !window.shipment_checked_section && get_admin_sidebar_sub_count('ShipmentAdvancedBooking');">
                        <span class="tag tag-warning t_advanced_booking"
                            style="float:right; border-radius: 3px;">0</span>
                        <span class="s-icon"><i class="fa fa-circle-o"></i></span>
                        <span class="s-text">Advanced Booking</span>
                    </a>
                    <ul>
                        <li><a href="{{ route('all_vessel') }}">Vessels <span class="tag tag-info t_vessels"
                                    style="float:right;">0</span></a>
                        </li>
                        <li><a href="{{ route('excel_sheet_view') }}">Excel Sheet View <span
                                    class="tag tag-info t_vessels" style="float:right;"></span></a>
                        </li>
                        <li><a href="{{ route('booking_admin', ['1', '10', '10']) }}">All <span
                                    class="tag tag-info t_advanced_booking" style="float:right;">0</span></a>
                        </li>

                        @foreach ($locations as $loca)
                            <li>
                                <a href="{{ route('booking_admin', ['1', '10', $loca->id]) }}">{{ $loca->location }}
                                    <span class="tag tag-info t_advanced_booking_{{ $loca->id }}"
                                        style="float:right;">0</span>
                                </a>
                            </li>
                        @endforeach

                        <li class="with-sub advanced_booking_summary_section">
                            <a href="/booking_summary" class="waves-effect waves-light"
                                onclick="event.preventDefault(); !window.advanced_booking_summary_section && get_admin_sidebar_sub_count('AdvancedBookingSummary');">
                                <span class="tag tag-warning" style="float:right; border-radius: 3px;"></span>
                                <span class="s-icon"><i class="fa fa-scribd"></i></span>
                                <span class="s-text">Summary</span>
                                <span class="s-caret pull-right"><i class="fa fa-angle-down"></i></span>
                            </a>
                            <ul>
                                <li>
                                    <a href="{{ url('booking_summary') }}">All
                                        <span class="tag tag-info t_booking_summary_all" style="float:right;">0</span>
                                    </a>
                                </li>
                                @foreach ($locations as $loca)
                                    <li>
                                        <a href="{{ url('booking_summary') }}?location_id={{ $loca->id }}">{{ $loca->location }}
                                            <span class="tag tag-info t_booking_summary_{{ $loca->id }}"
                                                style="float:right;" id="booking-{{ $loca->id }}">0</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="{{ route('archive_shipment_admin') }}">Title Archive<span
                            class="tag tag-purple t_title_archive_shipment" style="float:right;">0</span></a></li>

                <li><a href="{{ route('pending_archive_shipment_admin') }}">Pending Archive<span
                            class="tag tag-default t_pending_title_archive_shipment" style="float:right;">0</span></a>
                </li>

                <!-- For Clearance container -->
                <li class="with-sub shipment_clearance_section">
                    <a href="{{ route('shipment_admin', ['7', '10', '1']) }}" class="waves-effect  waves-light"
                        onclick="event.preventDefault(); !window.shipment_clearance_section && get_admin_sidebar_sub_count('ShipmentClearance');">
                        <span class="tag tag-warning t_clearance_shipment"
                            style="float:right; border-radius: 3px;">0</span>
                        <span class="s-icon"><i class="fa fa-circle-o"></i></span>
                        <span class="s-text">Clearance</span>
                    </a>
                    <ul>
                        <li><a href="{{ route('shipment_admin', ['7', '10', '1']) }}">All <span
                                    class="tag tag-info t_clearance_shipment" style="float:right;">0</span></a>
                        </li>
                        @foreach ($locations as $loca)
                            <li>
                                <a href="{{ route('shipment_admin', [7, $loca->id, '1']) }}">{{ $loca->location }}
                                    <span class="tag tag-info t_shipment_clearance_{{ $loca->id }}"
                                        style="float:right;">0</span>
                                    {{ DB::table('containers')->where('status', 7)->where('port_loading', $loca->id)->count() }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li>
                    <a href="{{ route('shipment_summary') }}">Summary</a>
                </li>
        </ul>
        </li>
        @endif
        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'invoices-management']))
            <li class="with-sub invoice_section">
                <a href="/invoice_admin/5" class="waves-effect  waves-light"
                    onclick="event.preventDefault(); !window.invoice_section && get_admin_sidebar_sub_count('Invoice');">
                    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                    <span class="tag tag-success t_all_invoice">0</span>
                    <span class="s-icon"><i class="ti-gallery"></i></span>
                    <span class="s-text">Invoices</span>
                </a>
                <ul>
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'add-invoice']))
                        <li>
                            <a href="{{ route('add_invoice_admin') }}">Add new</a>
                        </li>
                    @endif
                    <li><a href="{{ route('invoice_admin', '5') }}">All
                            <span class="tag tag-success t_all_invoice" style="float:right;">0</span>
                        </a></li>
                    <li><a href="{{ route('invoice_admin', '4') }}">Pending
                            <span class="tag tag-warning t_pending_invoice" style="float:right;">0</span></a>
                    </li>
                    <li><a href="{{ route('invoice_admin', '0') }}">Open
                            <span class="tag tag-warning t_open_invoice" style="float:right;">0</span>
                        </a></li>
                    <li><a href="{{ route('invoice_admin', '2') }}">Past Due
                            <span class="tag tag-info t_past_due_invoice" style="float:right;">0</span>
                        </a></li>
                    <li><a href="{{ route('invoice_admin', '3') }}">Paid
                            <span class="tag tag-success t_paid_invoice" style="float:right;">0</span>
                        </a></li>
                </ul>
            </li>
        @endif

        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'checks-management']))
            <li class="with-sub check_section">
                <a href="/checks_admin/5" class="waves-effect  waves-light"
                    onclick="event.preventDefault(); !window.check_section && get_admin_sidebar_sub_count('Checks');">
                    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                    <span class="tag tag-success t_all_checks">0</span>
                    <span class="s-icon"><i class="ti-gallery"></i></span>
                    <span class="s-text">Checks</span>
                </a>
                <ul>
                    <li><a href="{{ route('checks_admin', '5') }}">All
                            <span class="tag tag-success t_all_checks" style="float:right;">0</span>
                        </a></li>

                    <li><a href="{{ route('checks_admin', '1') }}">Open
                            <span class="tag tag-warning t_open_check" style="float:right;">0</span>
                        </a></li>

                    <li><a href="{{ route('checks_admin', '2') }}">Paid
                            <span class="tag tag-success t_paid_check" style="float:right;">0</span>
                        </a></li>

                    <li><a href="{{ route('checks_admin', '3') }}">Due
                            <span class="tag tag-success t_due_check" style="float:right;">0</span>
                        </a></li>
                </ul>
            </li>
        @endif

        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'mix-shipping-management']))
        <li class="with-sub mix_shipping_section">
            <a href="/mix_shipping" class="waves-effect  waves-light" onclick="event.preventDefault(); !window.mix_shipping_section && get_admin_sidebar_sub_count('MixShipping');">
                <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                <span class="s-icon"><i class="ti-package"></i></span>
                <span class="s-text">Mix Shipping</span>
            </a>
            <ul>
                <li>
                    <a href="{{ route('mix_shipping_containers') }}">Containers
                        <span class="tag tag-warning t_mix_container" style="float:right;">0</span>
                    </a>
                </li>
                @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'mix-shipping-view-invoice']))
                <li class="with-sub mix_shipping_invoice_section">
                    <a href="/mix_shipping/invoices/" class="waves-effect  waves-light" onclick="event.preventDefault(); !window.mix_shipping_invoice_section && get_admin_sidebar_sub_count('MixShippingInvoice');">
                        <span class="s-caret pull-right"><i class="fa fa-angle-down"></i></span>
                        <span class=" mx-1 tag tag-success t_mix_all_invoice pull-right">0</span>
                        <span class="s-text">Invoices</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('mix_shipping_invoice', 'all') }}">All
                                <span class="tag tag-purple  t_mix_all_invoice" style="float:right;">0</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('mix_shipping_invoice', 'pending') }}">Pending
                                <span class="tag tag-warning t_mix_pending_invoice" style="float:right;">0</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('mix_shipping_invoice', 'open') }}">Open
                                <span class="tag tag-info t_mix_open_invoice" style="float:right;">0</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('mix_shipping_invoice', 'past due') }}">Past Due
                                <span class="tag tag-primary t_mix_past_due_invoice" style="float:right;">0</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('mix_shipping_invoice', 'paid') }}">Paid
                                <span class="tag tag-success t_mix_paid_invoice" style="float:right;">0</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                <li>
                    <a href="{{ route('mix_shipping_settings') }}">Settings</a>
                </li>
            </ul>
        </li>
        @endif




        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'report-center']))
            <li class="with-sub">
                <a href="#" class="waves-effect  waves-light">
                    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                    <span class="s-icon"><i class="ti-bar-chart-alt"></i></span>
                    <span class="s-text">Report center</span>
                </a>
                <ul>
                    <li><a href="{{ route('customer_report') }}">Customer report</a></li>
                    <li><a href="{{ route('dind_customer_report') }}">Customer report (Dir/InDir)</a></li>
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'vehicle-report']))
                        <li class="with-sub">
                            <a href="/vehicle_report" class="waves-effect waves-light" onclick="event.preventDefault();">
                                <span class="tag tag-warning" style="float:right; border-radius: 3px;"></span>
                                <span class="s-text">Vehicle reports</span>
                                <span class="s-caret pull-right"><i class="fa fa-angle-down"></i></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('vehicle_report') }}">Vehicle report</a></li>
                                <li><a href="{{ route('vehicle_graph_report') }}">Graph report</a></li>
                                <li><a href="{{ route('vehicle_delivery_report') }}">Delivery Date report</a></li>
                            </ul>
                        </li>
                    @endif
                    <li><a href="{{ route('shipment_report') }}">Shipment report</a></li>
                    <li><a href="{{ route('invoice_report') }}">Invoice report</a></li>
                </ul>
            </li>
        @endif

        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-general-settings']))
            <li class="with-sub">
                <a href="#" class="waves-effect  waves-light">
                    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                    <span class="s-icon"><i class="ti-settings"></i></span>
                    <span class="s-text">General Settings</span>
                </a>
                <ul>
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'customer-management']))
                        <li>
                            <a href="{{ route('company_admin') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="ti-layout-tab"></i></span>
                                <span class="s-text">Companies</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'customer-management']))
                        <li>
                            <a href="{{ route('customer_admin') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-users"></i></span>
                                <span class="s-text">Customers</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'rates-management']))
                        <li class="with-sub">
                            <a href="/rates" class="waves-effect waves-light" onclick="DisableLink(event);">
                                <span class="tag tag-warning" style="float:right; border-radius: 3px;"></span>
                                <span class="s-icon"><i class="fa fa-scribd"></i></span>
                                <span class="s-text">Rates</span>
                                <span class="s-caret pull-right"><i class="fa fa-angle-down"></i></span>
                            </a>
                            <ul>
                                <li>
                                    <a href="{{ route('shipping_rate_admin') }}">Shipping Rates</a>
                                <li><a href="{{ route('towing_rate_admin') }}">Towing Rates</a></li>
                        </li>
                </ul>
            </li>
        @endif

        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'setting']))
            <li class="with-sub">
                <a href="#" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="fa fa-cog"></i></span>
                    <span class="s-text">Settings</span>
                    <span class="s-caret pull-right"><i class="fa fa-angle-down"></i></span>
                </a>
                <ul>
                    <li><a href="{{ route('location_admin') }}">Locations</a></li>
                    <li><a href="{{ route('status_admin') }}">Status</a></li>
                </ul>
            </li>
        @endif
        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'company-management']))
            <li>
                <a href="{{ route('pgl_profile') }}" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="ti-calendar"></i></span>
                    <span class="s-text">PGL Profile</span>
                </a>
            </li>
        @endif
        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'view-supplier']))
            <li class="with-sub">
                <a href="{{ route('suppliers') }}" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="fa fa-users"></i></span>
                    <span class="s-text">Suppliers</span>
                </a>
            </li>
        @endif
        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'user-management']))
            <li class="with-sub">
                <a href="{{ route('user_admin') }}" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="fa fa-users"></i></span>
                    <span class="s-text">Users</span>
                </a>
            </li>
        @endif
        </ul>
        </li>
        @endif

        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-logs-management']))
            <li class="with-sub">
                <a href="#" class="waves-effect  waves-light">
                    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                    <span class="s-icon"><i class="fa fa-history"></i></span>
                    <span class="s-text">PGl Logs</span>
                </a>
                <ul>
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-logs-vehicle']))
                        <li class="with-sub">
                            <a href="{{ route('view_vehicle_logs') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-history "></i></span>
                                <span class="s-text">Vehicle Logs</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-logs-shipment']))
                        <li class="with-sub">
                            <a href="{{ route('view_shipment_logs') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-history "></i></span>
                                <span class="s-text">Shipment Logs</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-logs-invoice']))
                        <li class="with-sub">
                            <a href="{{ route('view_invoice_logs') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-history "></i></span>
                                <span class="s-text">Invoice Logs</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-logs-company']))
                        <li class="with-sub">
                            <a href="{{ route('view_company_logs') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-history "></i></span>
                                <span class="s-text">Company Logs</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-logs-customer']))
                        <li class="with-sub">
                            <a href="{{ route('view_customer_logs') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-history "></i></span>
                                <span class="s-text">Customer Logs</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-logs-shipping-rate']))
                        <li class="with-sub">
                            <a href="{{ route('view_rate_logs') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-history "></i></span>
                                <span class="s-text">Shipping Rate Logs</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-logs-towing-rate']))
                        <li class="with-sub">
                            <a href="{{ route('view_towing_rate_logs') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-history "></i></span>
                                <span class="s-text">Towing Rate Logs</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-logs-location']))
                        <li class="with-sub">
                            <a href="{{ route('view_location_logs') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-history "></i></span>
                                <span class="s-text">Location Logs</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-logs-status']))
                        <li class="with-sub">
                            <a href="{{ route('view_status_logs') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-history "></i></span>
                                <span class="s-text">Status Logs</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-logs-user']))
                        <li class="with-sub">
                            <a href="{{ route('view_user_logs') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-history "></i></span>
                                <span class="s-text">User Logs</span>
                            </a>
                        </li>
                    @endif
                    <!-- @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-logs-permission']))
<li class="with-sub">
                            <a href="{{ route('view_permission_logs') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-history "></i></span>
                                <span class="s-text">Permission Logs</span>
                            </a>
                        </li>
@endif -->
                </ul>
            </li>
        @endif
        <!--seperate-->

        <!-- For Trashed -->
        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-trashes-management']))
            <li class="with-sub">
                <a href="#" class="waves-effect  waves-light">
                    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                    <span class="s-icon"><i class="fa fa-trash"></i></span>
                    <span class="s-text">PGl Trash</span>
                </a>
                <ul>
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-trash-vehicle']))
                        <li class="with-sub">
                            <a href="{{ route('view_vehicle_trash') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Vehicle Trash</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-trash-shipment']))
                        <li class="with-sub">
                            <a href="{{ route('view_shipment_trash') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Shipment Trash</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-trash-invoice']))
                        <li class="with-sub">
                            <a href="{{ route('view_invoice_trash') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Invoice Trash</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-trash-company']))
                        <li class="with-sub">
                            <a href="{{ route('view_company_trash') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Company Trash</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-trash-customer']))
                        <li class="with-sub">
                            <a href="{{ route('view_customer_trash') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Customer Trash</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-trash-shipping-rates']))
                        <li class="with-sub">
                            <a href="{{ route('view_shipping_rates_trash') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Shipping Rate Trash</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-trash-towing-rates']))
                        <li class="with-sub">
                            <a href="{{ route('view_towing_rates_trash') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Towing Rate Trash</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-trash-location']))
                        <li class="with-sub">
                            <a href="{{ route('view_location_trash') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Location Trash</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-trash-status']))
                        <li class="with-sub">
                            <a href="{{ route('view_status_trash') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Status Trash</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-trash-user']))
                        <li class="with-sub">
                            <a href="{{ route('view_status_user') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Status User</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- end For Trashed -->


        <!-- PGLA software. -->
        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'account-management']))
            <li class="divider"></li><br>
            <li class="menu-title compact-hide">
                <h4><span>
                        <center>-------- PGLA --------</center>
                    </span></h4>
            </li>
            <li>
                <a href="{{ route('accounting_dashboard') }}" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="fa fa-dashboard"></i></span>
                    <span class="s-text">Dashboard</span>
                </a>
            </li>
            @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'account-operation']))
                <li class="with-sub">
                    <a href="#" class="waves-effect  waves-light vehicles">
                        <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                        <span class="s-icon"><i class="fa fa-credit-card"></i></span>
                        <span class="s-text">Operation</span>
                    </a>
                    <ul>
                        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'add-transaction']))
                            <li><a href="{{ route('create_transaction') }}">Add Transaction</a></li>
                        @endif
                        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'add-transfer']))
                            <li><a href="{{ route('create_transfer') }}">Add Transfer</a></li>
                        @endif
                        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'add-account']))
                            <li><a href="{{ route('create_account') }}">Add Account</a></li>
                        @endif
                        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'add-category']))
                            <li><a href="{{ route('create_category') }}">Add Category</a></li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'expense-managment']))
                <li class="with-sub expenses_section">
                    <a href="{{ url('banking_expences') . '/' . '0' }}" class="waves-effect  waves-light expenses"
                        onclick="event.preventDefault(); !window.expenses_section && get_admin_sidebar_sub_count('Expenses');">
                        <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                        <span class="s-icon"><i class="fa fa-money"></i></span>
                        <span class="tag tag-purple t_all_transfer" style="float:right;border-radius: 10px;">0</span>
                        <span class="tag tag-primary t_all_transaction"
                            style="float:right;border-radius: 10px;">0</span>
                        <span class="s-text">Expenses</span>
                    </a>
                    <ul>
                        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'view-expense']))
                            <li>
                                <a href="{{ url('banking_expences') . '/' . '0' }}">
                                    <span class="tag tag-purple t_all_transfer"
                                        style="float:right;border-radius: 10px;">0</span>
                                    <span class="tag tag-primary t_all_transaction"
                                        style="float:right;border-radius: 10px;">0</span>
                                    All
                                </a>
                            </li>
                            <li>
                                <a
                                    href="{{ url('banking_expences') . '/' . config('constants.transaction_status_db.Pending') }}">
                                    <span class="tag tag-purple t_pending_transfer"
                                        style="float:right;border-radius: 10px;">0</span>
                                    <span class="tag tag-primary t_pending_transaction"
                                        style="float:right;border-radius: 10px;">0</span>
                                    Pending
                                </a>
                            </li>
                            <li>
                                <a
                                    href="{{ url('banking_expences') . '/' . config('constants.transaction_status_db.Reviewed') }}">
                                    <span class="tag tag-purple t_reviewed_transfer"
                                        style="float:right;border-radius: 10px;">0</span>
                                    <span class="tag tag-primary t_reviewed_transaction"
                                        style="float:right;border-radius: 10px;">0</span>
                                    Reviewed
                                </a>
                            </li>
                            <li>
                                <a
                                    href="{{ url('banking_expences') . '/' . config('constants.transaction_status_db.Canceled') }}">
                                    <span class="tag tag-purple t_cancelled_transfer"
                                        style="float:right;border-radius: 10px;">0</span>
                                    <span class="tag tag-primary t_cancelled_transaction"
                                        style="float:right;border-radius: 10px;">0</span>
                                    Canceled
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'transaction-settings']))
                <li>
                    <a href="{{ route('banking_settings') }}" class="waves-effect  waves-light">
                        <span class="s-icon"><i class="ti-settings"></i></span>
                        <span class="s-text">Settings</span>
                    </a>
                </li>
            @endif
            @if (Auth::guard('admin')->user()->hasPermissions(['Admin']))
                <li>
                    <a href="{{ route('accounting_report') }}" class="waves-effect  waves-light">
                        <span class="s-icon"><i class="ti-files"></i></span>
                        <span class="s-text">Reporting</span>
                    </a>
                </li>
            @endif

            @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgla-logs-management']))
                <li class="with-sub">
                    <a href="#" class="waves-effect  waves-light">
                        <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                        <span class="s-icon"><i class="fa fa-history"></i></span>
                        <span class="s-text">PGLA Logs</span>
                    </a>
                    <ul>
                        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgla-logs-transaction']))
                            <li class="with-sub">
                                <a href="{{ route('view_transaction_logs') }}" class="waves-effect  waves-light">
                                    <span class="s-icon"><i class="fa fa-history "></i></span>
                                    <span class="s-text">Transaction Logs</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgla-logs-transfer']))
                            <li class="with-sub">
                                <a href="{{ route('view_transfer_logs') }}" class="waves-effect  waves-light">
                                    <span class="s-icon"><i class="fa fa-history "></i></span>
                                    <span class="s-text">Transfer Logs</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgla-logs-account']))
                            <li class="with-sub">
                                <a href="{{ route('view_account_logs') }}" class="waves-effect  waves-light">
                                    <span class="s-icon"><i class="fa fa-history "></i></span>
                                    <span class="s-text">Account Logs</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgla-logs-category']))
                            <li class="with-sub">
                                <a href="{{ route('view_category_logs') }}" class="waves-effect  waves-light">
                                    <span class="s-icon"><i class="fa fa-history "></i></span>
                                    <span class="s-text">Category Logs</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

        @endif

        <!-- PGLA Trashd -->

        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgla-trash-management']))
            <li class="with-sub">
                <a href="#" class="waves-effect  waves-light">
                    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                    <span class="s-icon"><i class="fa fa-trash"></i></span>
                    <span class="s-text">PGlA Trash</span>
                </a>
                <ul>
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-trash-transaction']))
                        <li class="with-sub">
                            <a href="{{ route('view_vehicle_transactions') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Transaction Trash</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-trash-transfer']))
                        <li class="with-sub">
                            <a href="{{ route('view_vehicle_transfer') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Transfer Trash</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-trash-account']))
                        <li class="with-sub">
                            <a href="{{ route('view_trashed_account') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Account Trash</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pgl-trash-category']))
                        <li class="with-sub">
                            <a href="{{ route('view_trashed_categories') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Category Trash</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- End -->


        <!--pglc software-->
        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'log-management']))
            <li class="divider"></li><br>
            <li class="menu-title compact-hide">
                <h4><span>-------- PGLC --------</span></h4>
            </li>
            @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglc-dashboard']))
                <li class="with-sub">
                    <a href="{{ route('pglc_dashboard') }}" class="waves-effect waves-light">
                        <span class="s-icon"><i class="ti-anchor"></i></span>
                        <span class="s-text">Dashboard</span>
                    </a>
                </li>
            @endif
            <li class="with-sub">
                <a href="#" class="waves-effect  waves-light">
                    {{-- <span class="s-caret"><i class="fa fa-angle-down"></i></span>  --}}
                    <span class="s-icon"><i class="fa fa-cube"></i></span>
                    <span class="tag tag-purple t_all_clear_invoice">0</span>
                    <span class="s-text dropdown-toggle" title="Operation Department">Operation Department</span>
                </a>
                <ul>
                    <li><a href="{{ route('clear_log_list') }}">Clear Log</a></li>
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'create-invoice-log']))
                        <li><a href="{{ route('create_invoice_list') }}">Create Clear Log Invoice</a></li>
                        <li><a href="{{ route('delivery_invoice_list') }}">Create Delivery Invoice</a></li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'create-vcc-charges']))
                        <li><a href="{{ route('create_single_vcc') }}">Create VCC Charges</a></li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'create-exit-claim-charges']))
                        <li><a href="{{ route('create_ecc') }}">Create Exit Claim Charges</a></li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'create-detention-charges']))
                        <li><a href="{{ route('create_detention') }}">Create Detention Charges</a></li>
                    @endif
                </ul>
            </li>
        @endif
        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'finance-management']))
            <li class="with-sub clearance_section">
                <a href="{{ route('invoices_list_admin', '1') }}" class="waves-effect  waves-light"
                    onclick="event.preventDefault(); !window.clearance_section && get_admin_sidebar_sub_count('Clearance');">
                    {{-- <span class="s-caret"><i class="fa fa-angle-down"></i></span>  --}}
                    <span class="tag tag-primary t_all_delivery_invoices">0</span>
                    <span class="tag tag-purple t_all_log_invoices">0</span>
                    <span class="s-icon"><i class="fa fa-cube"></i></span>
                    <span class="s-text dropdown-toggle" title="Operation Department">Finance Department</span>
                </a>
                <ul>
                    <li><a href="{{ route('invoices_list_admin', '1') }}">All Invoice</a></li>
                    <li><a href="{{ route('invoices_list_admin', '2') }}"><span
                                class="tag tag-primary t_delivery_pending_invoice"
                                style="float:right;border-radius: 10px;">0</span><span
                                class="tag tag-purple t_pending_invoice"
                                style="float:right;border-radius: 10px;">0</span>Pending Invoice</a></li>
                    <li><a href="{{ route('invoices_list_admin', '3') }}"><span
                                class="tag tag-primary t_delivery_open_invoice"
                                style="float:right;border-radius: 10px;">0</span><span
                                class="tag tag-purple t_open_invoice"
                                style="float:right;border-radius: 10px;">0</span>Open Invoice</a></li>
                    <li><a href="{{ route('invoices_list_admin', '4') }}"><span
                                class="tag tag-primary t_delivery_past_due_invoice"
                                style="float:right;border-radius: 10px;">0</span><span
                                class="tag tag-purple t_past_due_invoice"
                                style="float:right;border-radius: 10px;">0</span>Past Due Invoice</a></li>
                    <li><a href="{{ route('invoices_list_admin', '5') }}"><span
                                class="tag tag-primary t_delivery_paid_invoice"
                                style="float:right;border-radius: 10px;">0</span><span
                                class="tag tag-purple t_paid_invoice"
                                style="float:right;border-radius: 10px;">0</span>Paid Invoice</a></li>
                </ul>
            </li>
        @endif
        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglc-report-view']))
            <li class="with-sub">
                <a href="/pglc_reports" class="waves-effect  waves-light" onclick="event.preventDefault();">
                    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                    <span class="s-icon"><i class="ti-files"></i></span>
                    <span class="s-text" title="Clearance Reports">Reporting</span>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('pglc_clear_log_reports') }}">Log Invoice Report</a>
                    </li>
                    <li>
                        <a href="{{ route('pglc_delivery_reports') }}">Delivery Invoice Report</a>
                    </li>
                    <li>
                        <a href="{{ route('pglc_single_vcc_reports') }}">Single VCC Invoice Report</a>
                    </li>
                    <li>
                        <a href="{{ route('pglc_exit_claim_reports') }}">Exit Claim Invoice Report</a>
                    </li>
                    <li>
                        <a href="{{ route('pglc_detention_reports') }}">Detention Charges Report</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglc-logs-management']))
            <li class="with-sub">
                <a href="#" class="waves-effect  waves-light">
                    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                    <span class="s-icon"><i class="fa fa-history"></i></span>
                    <span class="s-text">PGLC Logs</span>
                </a>
                <ul>
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglc-logs-clear-log']))
                        <li class="with-sub">
                            <a href="{{ route('view_clear_log_logs') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-history "></i></span>
                                <span class="s-text">Clear Log Logs</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglc-logs-log-invoice']))
                        <li class="with-sub">
                            <a href="{{ route('view_log_invoice_logs') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-history "></i></span>
                                <span class="s-text">Clear Log Invoice Logs</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglc-logs-delivery-invoice']))
                        <li class="with-sub">
                            <a href="{{ route('view_delivery_invoice_logs') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-history "></i></span>
                                <span class="s-text">Delivery Invoice Logs</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglc-logs-vcc-charges']))
                        <li class="with-sub">
                            <a href="{{ route('view_single_vcc_logs') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-history "></i></span>
                                <span class="s-text">VCC Logs</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglc-logs-exit-claim-charges']))
                        <li class="with-sub">
                            <a href="{{ route('view_exit_claim_logs') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-history "></i></span>
                                <span class="s-text">Exit Claim Charges Logs</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglc-logs-detention-charges']))
                        <li class="with-sub">
                            <a href="{{ route('view_detention_charge_logs') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-history "></i></span>
                                <span class="s-text">Detention Charges Logs</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- end pglc software. -->

        <!-- For Trashed -->
        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglc-trashes-management']))
            <li class="with-sub">
                <a href="#" class="waves-effect  waves-light">
                    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                    <span class="s-icon"><i class="fa fa-trash"></i></span>
                    <span class="s-text">PGlC Trash</span>
                </a>
                <ul>
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglc-trash-clear-log']))
                        <li class="with-sub">
                            <a href="{{ route('view_clear_log_trash') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Clear Log Trash</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglc-trash-log-invoice']))
                        <li class="with-sub">
                            <a href="{{ route('view_log_invoice_trash') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Log Invoice Trash</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglc-trash-delivery-invoice']))
                        <li class="with-sub">
                            <a href="{{ route('view_delivery_invoice_trash') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Delivery Invoice Trash</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglc-trash-single-vcc-invoice']))
                        <li class="with-sub">
                            <a href="{{ route('view_singlvcc_invoice_trash') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Single VCC Invoice Trash</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglc-trash-exit-claim-invoice']))
                        <li class="with-sub">
                            <a href="{{ route('view_exit_claim_trash') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Exit Claim Charges Invoice Trash</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglc-trash-detention-charges']))
                        <li class="with-sub">
                            <a href="{{ route('view_detention_charges_trash') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Detention Charges Trash</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- end For Trashed -->

        <!-- Pglu software. -->
        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'used-cars-management']))
            <li class="divider"></li><br>
            <li class="menu-title compact-hide">
                <h4><span>-------- PGLU --------</span></h4>
            </li>
            <li>
                <a href="{{ route('pglu_dashbord') }}" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="ti-anchor"></i></span>
                    <span class="s-text">Dashboard</span>
                </a>
            </li>
            @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'view-united-cars']))
                <li class="with-sub used_cars_section">
                    <a href="#" class="waves-effect  waves-light vehicles"
                        onclick="event.preventDefault(); !window.used_cars_section && get_admin_sidebar_sub_count('UsedCars');">
                        <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                        <span class="tag tag-success t_all_usedcars">0</span>
                        <span class="s-icon"><i class="fa fa-car"></i></span>
                        <span class="s-text">Used Cars</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('all_united_car_list') }}">All
                                <span class="tag tag-success t_all_usedcars" style="float:right;">0</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="{{ url('united_cars_by_selling_satatus' . '/' . 'pending') }}">Pending
                                <span class="tag tag-success t_pending_united_cars" style="float:right;">0</span>
                            </a>
                        </li>
                        <li>
                            <a
                                href="{{ url('united_cars_by_selling_satatus' . '/' . config('constants.selling_status_db.yet_to_sell')) }}">Yet
                                To Sell
                                <span class="tag tag-success t_yet_to_sell_united_cars" style="float:right;">0</span>
                            </a>
                        </li>
                        <li>
                            <a
                                href="{{ url('united_cars_by_selling_satatus' . '/' . config('constants.selling_status_db.no_advanced')) }}">No
                                Advance
                                <span class="tag tag-success t_no_advance_united_cars" style="float:right;">0</span>
                            </a>
                        </li>
                        <li>
                            <a
                                href="{{ url('united_cars_by_selling_satatus' . '/' . config('constants.selling_status_db.advance_paid')) }}">Advance
                                Paid
                                <span class="tag tag-success t_advance_paid_united_cars" style="float:right;">0</span>
                            </a>
                        </li>

                        <li>
                            <a
                                href="{{ url('united_cars_by_selling_satatus' . '/' . config('constants.selling_status_db.completed')) }}">Completed
                                <span class="tag tag-success t_completed_united_cars" style="float:right;">0</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'view-used-car-inventory']))
                <li class="with-sub inventory_section">
                    <a href="{{ url('pglu_inventory' . '/' . 'inventory') }}" class="waves-effect  waves-light"
                        onclick="event.preventDefault(); !window.inventory_section && get_admin_sidebar_sub_count('Inventory');">
                        <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                        <span class="tag tag-success t_all_pglu_inventory">0</span>
                        <span class="s-icon"><i class="fa fa-archive"></i></span>
                        <span class="s-text">Inventory</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ url('pglu_inventory' . '/' . 'inventory') }}">Inventory
                                <span class="tag tag-success t_inventory" style="float:right;">0</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('pglu_inventory' . '/' . 'repairing') }}">Repairing
                                <span class="tag tag-success t_repairing" style="float:right;">0</span>
                            </a>
                        </li>
                        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'view-used-car-inventory-archive']))
                            <li>
                                <a href="{{ url('pglu_inventory' . '/' . 'archived') }}">Archived Inventory
                                    <span class="tag tag-success t_archived_inventories" style="float:right;">0</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            <li>
                <a href="{{ route('pglu_customer_report') }}" class="waves-effect waves-light">
                    <span class="s-icon"><i class="fa fa-file"></i></span>
                    <span class="s-text">Customer Report</span>
                </a>
            </li>

            <li>
                <a href="{{ route('all_united_car_invoice') }}" class="waves-effect waves-light">
                    <span class="s-icon"><i class="fa fa-file"></i></span>
                    <span class="s-text">Invoice Report</span>
                </a>
            </li>

            @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglu-general-settings']))
                <li class="with-sub">
                    <a href="#" class="waves-effect  waves-light">
                        <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                        <span class="s-icon"><i class="ti-settings"></i></span>
                        <span class="s-text">General Settings</span>
                    </a>
                    <ul>
                        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'view-used-cars-customers']))
                            <li>
                                <a href="{{ route('unitedCustomers') }}" class="waves-effect waves-light">
                                    <span class="s-icon"><i class="fa fa-users"></i></span>
                                    <span class="s-text">Customers</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'view-used-car-companies']))
                            <li>
                                <a href="{{ route('pgl_used_cars_company') }}" class="waves-effect waves-light">
                                    <span class="s-icon"><i class="fa fa-bank"></i></span>
                                    <span class="s-text">Companies</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'view-used-car-purchasers']))
                            <li>
                                <a href="{{ route('usedCarPurchaser') }}" class="waves-effect waves-light">
                                    <span class="s-icon"><i class="fa fa-universal-access"></i></span>
                                    <span class="s-text">Purchasers</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'view-used-car-yards']))
                            <li>
                                <a href="{{ route('pucYard') }}" class="waves-effect waves-light">
                                    <span class="s-icon"><i class="fa fa-columns"></i></span>
                                    <span class="s-text">Yards</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglu-logs-management']))
                <li class="with-sub">
                    <a href="#" class="waves-effect  waves-light">
                        <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                        <span class="s-icon"><i class="fa fa-history"></i></span>
                        <span class="s-text">PGLU Logs</span>
                    </a>
                    <ul>
                        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglu-logs-used-car']))
                            <li class="with-sub">
                                <a href="{{ route('view_used_car_logs') }}" class="waves-effect  waves-light">
                                    <span class="s-icon"><i class="fa fa-history "></i></span>
                                    <span class="s-text">Used Car Logs</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglu-logs-inventory']))
                            <li class="with-sub">
                                <a href="{{ route('view_inventory_logs') }}" class="waves-effect  waves-light">
                                    <span class="s-icon"><i class="fa fa-history "></i></span>
                                    <span class="s-text">Inventory Logs</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglu-logs-payment']))
                            <li class="with-sub">
                                <a href="{{ route('view_payment_logs') }}" class="waves-effect  waves-light">
                                    <span class="s-icon"><i class="fa fa-history "></i></span>
                                    <span class="s-text">Payments Logs</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglu-logs-customer']))
                            <li class="with-sub">
                                <a href="{{ route('view_united_customer_logs') }}"
                                    class="waves-effect  waves-light">
                                    <span class="s-icon"><i class="fa fa-history "></i></span>
                                    <span class="s-text">United Customer Logs</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglu-logs-purchaser']))
                            <li class="with-sub">
                                <a href="{{ route('view_united_purchaser_logs') }}"
                                    class="waves-effect  waves-light">
                                    <span class="s-icon"><i class="fa fa-history "></i></span>
                                    <span class="s-text">Purchasers Logs</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglu-logs-yard']))
                            <li class="with-sub">
                                <a href="{{ route('view_united_yard_logs') }}" class="waves-effect  waves-light">
                                    <span class="s-icon"><i class="fa fa-history "></i></span>
                                    <span class="s-text">Yards Logs</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
        @endif

        <!-- For Trashed -->
        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglu-trashes-management']))
            <li class="with-sub">
                <a href="#" class="waves-effect  waves-light">
                    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                    <span class="s-icon"><i class="fa fa-trash"></i></span>
                    <span class="s-text">PGlU Trash</span>
                </a>
                <ul>
                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglu-trash-used-cars']))
                        <li class="with-sub">
                            <a href="{{ route('view_used_cars_trash') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Used Car Trash</span>
                            </a>
                        </li>
                    @endif

                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglu-trash-inventory-cars']))
                        <li class="with-sub">
                            <a href="{{ route('view_inventory_trash') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Inventory Trash</span>
                            </a>
                        </li>
                    @endif

                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglu-trash-united-customers']))
                        <li class="with-sub">
                            <a href="{{ route('view_unitedCustomers_trash') }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">United Customers Trash</span>
                            </a>
                        </li>
                    @endif

                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglu-trash-companies']))
                        <li class="with-sub">
                            <a href="{{ route('view_companies_trash') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Companies Trash</span>
                            </a>
                        </li>
                    @endif

                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglu-trash-purchases']))
                        <li class="with-sub">
                            <a href="{{ route('view_purchases_trash') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Purchases Trash</span>
                            </a>
                        </li>
                    @endif

                    @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'pglu-trash-yard']))
                        <li class="with-sub">
                            <a href="{{ route('view_yard_trash') }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="fa fa-trash "></i></span>
                                <span class="s-text">Yards Trash</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- end For Trashed -->

        <!-- WhatsApp Messages | Customer messages. -->
        @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'customer-whatsapp-messages-management']))
            <li class="divider"></li><br>
            <li class="menu-title compact-hide">
                <h4><span>
                        <center>----- WhatsApp -----</center>
                    </span></h4>
            </li>
            <!-- <li>
                        <a href="" class="waves-effect  waves-light">
                            <span class="s-icon"><i class="fa fa-dashboard"></i></span>
                            <span class="s-text">Dashboard</span>
                        </a>
                    </li> -->
            @if (Auth::guard('admin')->user()->hasPermissions(['Admin', 'view-cus-whats-messages']))
                <li class="with-sub">
                    <a href="#" class="waves-effect  waves-light vehicles">
                        <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                        <span class="s-icon"><i class="fa fa-whatsapp"></i></span>
                        <!-- <span class="tag tag-purple all_transfers" style="float:right;border-radius: 10px;">0</span> -->
                        <!-- <span class="tag tag-primary all_transactions" style="float:right;border-radius: 10px;">0</span> -->
                        <span class="s-text">Messages</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ url('cus-whatsapp-messages') . '/' . '0' }}">
                                <!-- <span class="tag tag-purple all_transfers" style="float:right;border-radius: 10px;">0</span> -->
                                <!-- <span class="tag tag-primary all_transactions" style="float:right;border-radius: 10px;">0</span> -->
                                All
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('cus-whatsapp-messages') . '/' . '1' }}">
                                <!-- <span class="tag tag-purple pending_transfers" style="float:right;border-radius: 10px;">0</span> -->
                                <!-- <span class="tag tag-primary pending_transactions" style="float:right;border-radius: 10px;">0</span> -->
                                Pending
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('cus-whatsapp-messages') . '/' . '2' }}">
                                <!-- <span class="tag tag-purple reviewed_transfers" style="float:right;border-radius: 10px;">0</span> -->
                                <!-- <span class="tag tag-primary reviewed_transactions" style="float:right;border-radius: 10px;">0</span> -->
                                Reviewed
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        @endif

        <br><br><br><br><br><br>
        <!-- end pglu software. -->
        </ul><br><br><br>
    </div>
</div>
