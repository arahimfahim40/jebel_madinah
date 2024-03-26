<div class="site-overlay"></div>
<div class="site-sidebar">
    <div class="custom-scroll custom-scroll-light">
        <ul class="sidebar-menu">
            @can('dashboard-view')
            <li>
                <a href="{{ route('home.index') }}" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="fa fa-home"></i></span>
                    <span class="s-text">Dashboard</span>
                </a>
            </li>
            @endcan
            @can('vehicle-view')
            <li class="with-sub vehicles_section">
                <a href="/admin/vehicles" class="waves-effect  waves-light"
                    onclick="event.preventDefault(); !window.vehicles_section && get_admin_sidebar_sub_count('Vehicle');">
                    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                    <span class="tag tag-success t_all_vehicle">0</span>
                    <span class="s-icon"><i class="fa fa-car"></i></span>
                    <span class="s-text">Vehicles</span>
                </a>
                <ul>
                    @can('vehicle-create')
                        <li>
                            <a href="{{ route('vehicles.create') }}">Add new</a>
                        </li>
                    @endcan
                    <li><a href="{{ route('vehicles.index') }}">All
                            <span class="tag tag-success t_all_vehicle" style="float:right;">0</span>
                        </a></li>
                    <li><a href="{{ route('vehicles.index') }}?status=pending">Pending
                            <span class="tag tag-secondary t_pending_vehicle" style="float:right;">0</span></a>
                    </li>
                    <li><a href="{{ route('vehicles.index') }}?status=on_the_way">On The Way
                            <span class="tag tag-warning t_on_the_way_vehicle" style="float:right;">0</span></a>
                    </li>
                    <li><a href="{{ route('vehicles.index') }}?status=on_hand_no_title">On Hand No Title
                            <span class="tag tag-danger t_on_hand_no_title_vehicle" style="float:right;">0</span>
                        </a></li>
                    <li><a href="{{ route('vehicles.index') }}?status=on_hand_with_title">On Hand With Title
                            <span class="tag tag-info t_on_hand_with_title_vehicle" style="float:right;">0</span>
                        </a></li>
                    <li><a href="{{ route('vehicles.index') }}?status=shipped">Shipped
                            <span class="tag tag-success t_shipped_vehicle" style="float:right;">0</span>
                        </a></li>

                    <li><a href="{{ route('vehicles.cost_analysis') }}">Cost anlysis</a></li>
                    
                    @can('vehicle-summary')
                    <li class="with-sub">
                        <a href="#" class="waves-effect waves-light">
                            <span class="tag tag-warning" style="float:right; border-radius: 3px;"></span>
                            <span class="s-icon"><i class="fa fa-scribd"></i></span>
                            <span class="s-text">Summary</span>
                            <span class="s-caret pull-right"><i class="fa fa-angle-down"></i></span>
                        </a>
                        <ul>
                            <li><a href="{{ route('vehicles.summary') }}">All</a></li>
                            @foreach (getLocations() as $location)
                                <li><a href="{{ route('vehicles.summary') }}?location_id={{ $location->id }}">{{ $location->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan

            {{-- Invoice Section --}}
            @can('invoice-view')
            <li class="with-sub invoice_section">
                <a href="/invoice_admin/5" class="waves-effect  waves-light"
                    onclick="event.preventDefault(); !window.invoice_section && get_admin_sidebar_sub_count('Invoice');">
                    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                    <span class="tag tag-success t_all_invoice">0</span>
                    <span class="s-icon"><i class="ti-receipt"></i></span>
                    <span class="s-text">Invoices</span>
                </a>
                <ul>
                    @can('invoice-create')
                        <li>
                            <a href="{{ route('invoices.create') }}">Add new</a>
                        </li>
                    @endcan
                    <li><a href="{{ route('invoices.index') }}">All
                            <span class="tag tag-success t_all_invoice" style="float:right;">0</span>
                        </a></li>
                    <li><a href="{{ route('invoices.index') }}">Pending
                            <span class="tag tag-warning t_pending_invoice" style="float:right;">0</span></a>
                    </li>
                    <li><a href="{{ route('invoices.index') }}">Open
                            <span class="tag tag-warning t_open_invoice" style="float:right;">0</span>
                        </a></li>
                    <li><a href="{{ route('invoices.index') }}">Past Due
                            <span class="tag tag-info t_past_due_invoice" style="float:right;">0</span>
                        </a></li>
                    <li><a href="{{ route('invoices.index') }}">Paid
                            <span class="tag tag-success t_paid_invoice" style="float:right;">0</span>
                        </a></li>
                </ul>
            </li>
            @endcan
            @can('user-view')
            <li>
                <a href="{{ route('users.index') }}" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="fa fa-users"></i></span>
                    <span class="s-text">Users</span>
                </a>
            </li>
            @endcan
            @can('customer-view')
            <li>
                <a href="{{ route('customers.index') }}" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="fa fa-users"></i></span>
                    <span class="s-text">Customers</span>
                </a>
            </li>
            @endcan
            @can('role-view')
            <li>
                <a href="{{ route('roles.index') }}" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="fa fa-shield"></i></span>
                    <span class="s-text">Roles</span>
                </a>
            </li>
            @endcan
            @can('permission-view')
            <li>
                <a href="{{ route('permissions.index') }}" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="fa fa-warning"></i></span>
                    <span class="s-text">Permissions</span>
                </a>
            </li>
            @endcan
            @can('location-view')
            <li>
                <a href="{{ route('locations.index') }}" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="fa fa-globe"></i></span>
                    <span class="s-text">Location</span>
                </a>
            </li>
            @endcan
        </ul>
    </div>
</div>
