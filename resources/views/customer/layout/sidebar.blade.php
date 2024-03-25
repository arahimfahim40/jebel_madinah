<div class="site-overlay"></div>
<div class="site-sidebar">
    <div class="custom-scroll custom-scroll-light">
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('customer.home.index') }}" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="fa fa-home"></i></span>
                    <span class="s-text">Dashboard</span>
                </a>
            </li>
            <li class="with-sub vehicles_section">
                <a href="/customer/vehicles" class="waves-effect  waves-light"
                    onclick="event.preventDefault(); !window.vehicles_section && get_customer_sidebar_sub_count('Vehicle');">
                    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                    <span class="tag tag-success t_all_vehicle">0</span>
                    <span class="s-icon"><i class="fa fa-car"></i></span>
                    <span class="s-text">Vehicles</span>
                </a>
                <ul>
                    <li><a href="{{ route('customer.vehicles.index') }}">All
                            <span class="tag tag-success t_all_vehicle" style="float:right;">0</span>
                        </a></li>
                    <li><a href="{{ route('customer.vehicles.index') }}?status=on_the_way">On The Way
                            <span class="tag tag-warning t_on_the_way_vehicle" style="float:right;">0</span></a>
                    </li>
                    <li><a href="{{ route('customer.vehicles.index') }}?status=on_hand_no_title">On Hand No Title
                            <span class="tag tag-danger t_on_hand_no_title_vehicle" style="float:right;">0</span>
                        </a></li>
                    <li><a href="{{ route('customer.vehicles.index') }}?status=on_hand_with_title">On Hand With Title
                            <span class="tag tag-info t_on_hand_with_title_vehicle" style="float:right;">0</span>
                        </a></li>
                    <li><a href="{{ route('customer.vehicles.index') }}?status=shipped">Shipped
                            <span class="tag tag-success t_shipped_vehicle" style="float:right;">0</span>
                        </a></li>

                    <li><a href="{{ route('customer.vehicles.cost_analysis') }}">Cost anlysis</a></li>
                    <li><a href="{{ route('customer.vehicles.dateline') }}">Datelines</a></li>
                    
                    <li class="with-sub">
                        <a href="#" class="waves-effect waves-light"
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
                            @foreach (getLocations() as $location)
                                <li>
                                    <a
                                        href="{{ route('vehicles.summary') }}?location_id={{ $location->id }}">{{ $location->name }}
                                        <span class="tag tag-info" style="float:right;"
                                            id="vl-{{ $location->id }}">0</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    
                </ul>
            </li>

            {{-- Invoice Section --}}
            <li class="with-sub invoice_section">
                <a href="/invoice_admin/5" class="waves-effect  waves-light"
                    onclick="event.preventDefault(); !window.invoice_section && get_admin_sidebar_sub_count('Invoice');">
                    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                    <span class="tag tag-success t_all_invoice">0</span>
                    <span class="s-icon"><i class="fa fa-file-text-o"></i></span>
                    <span class="s-text">Invoices</span>
                </a>
                <ul>
                    
                    <li><a href="{{ route('customer.invoices.index') }}">All
                            <span class="tag tag-success t_all_invoice" style="float:right;">0</span>
                        </a></li>
                    <li><a href="{{ route('customer.invoices.index') }}">Open
                            <span class="tag tag-warning t_open_invoice" style="float:right;">0</span>
                        </a></li>
                    <li><a href="{{ route('customer.invoices.index') }}">Past Due
                            <span class="tag tag-info t_past_due_invoice" style="float:right;">0</span>
                        </a></li>
                    <li><a href="{{ route('customer.invoices.index') }}">Paid
                            <span class="tag tag-success t_paid_invoice" style="float:right;">0</span>
                        </a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
