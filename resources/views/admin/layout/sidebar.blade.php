<div class="site-overlay"></div>
<div class="site-sidebar">
  <div class="custom-scroll custom-scroll-light">
    <ul class="sidebar-menu">
      @can('dashboard-view')
        <li>
          <a href="{{ route('user.home.index') }}" class="waves-effect  waves-light">
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
              </a>
            </li>
            <li><a href="{{ route('vehicles.index') }}?status=on_the_way">On The Way
                <span class="tag tag-warning t_on_the_way_vehicle" style="float:right;">0</span>
              </a>
            </li>
            <li><a href="{{ route('vehicles.index') }}?status=inventory">Inventory
                <span class="tag tag-info t_inventory_vehicle" style="float:right;">0</span>
              </a>
            </li>
            <li><a href="{{ route('vehicles.index') }}?status=sold">Sold
                <span class="tag tag-success t_sold_vehicle" style="float:right;">0</span>
              </a>
            </li>

            <li><a href="{{ route('vehicles.cost_analysis') }}">Cost anlysis</a></li>
            <li><a href="{{ route('vehicles.trash_list') }}">Trash List</a></li>

            {{-- @can('vehicle-summary')
              <li class="with-sub">
                <a href="#" class="waves-effect waves-light">
                  <span class="tag tag-warning" style="float:right; border-radius: 3px;"></span>
                  <span class="s-icon"><i class="fa fa-scribd"></i></span>
                  <span class="s-text">Summary</span>
                  <span class="s-caret pull-right"><i class="fa fa-angle-down"></i></span>
                </a>
                <ul>
                  <li><a href="{{ route('vehicles.summary') }}">All</a></li>
                  @foreach (getOwners() as $owner)
                    <li><a href="{{ route('vehicles.summary') }}?owner_id={{ $owner->id }}">{{ $owner->name }}</a>
                    </li>
                  @endforeach
                </ul>
              </li>
            @endcan --}}
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
            <li><a href="{{ route('invoices.index') }}?status=pending">Pending
                <span class="tag tag-warning t_pending_invoice" style="float:right;">0</span></a>
            </li>
            <li><a href="{{ route('invoices.index') }}?status=open">Open
                <span class="tag tag-warning t_open_invoice" style="float:right;">0</span>
              </a></li>
            <li><a href="{{ route('invoices.index') }}?status=past_due">Past Due
                <span class="tag tag-info t_past_due_invoice" style="float:right;">0</span>
              </a></li>
            <li><a href="{{ route('invoices.index') }}?status=paid">Paid
                <span class="tag tag-success t_paid_invoice" style="float:right;">0</span>
              </a></li>
          </ul>
        </li>
      @endcan
      @can('customer-report-view')
        <li>
          <a href="{{ route('customers.reports.list') }}" class="waves-effect  waves-light">
            <span class="s-icon"><i class="ti-file"></i></span>
            <span class="s-text">Customer Report</span>
          </a>
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
      @can('owner-view')
        <li>
          <a href="{{ route('owners.index') }}" class="waves-effect  waves-light">
            <span class="s-icon"><i class="fa fa-globe"></i></span>
            <span class="s-text">Vehicle Owners</span>
          </a>
        </li>
      @endcan
    </ul>
  </div>
</div>
