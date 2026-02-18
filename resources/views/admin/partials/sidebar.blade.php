<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

    <!-- Sidebar Brand -->
    <div class="sidebar-brand">
        <a href="{{ Auth::check() && Auth::user()->role === 'super_admin'
            ? route('superadmin.dashboard')
            : route('user.dashboard') }}"
            class="brand-link">

            <img src="{{ asset('assets/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow">

            <span class="brand-text fw-light">AdminLTE 4</span>
        </a>
    </div>
    <!-- /Sidebar Brand -->

    <!-- Sidebar Wrapper -->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                data-accordion="false">

                @auth

                    {{-- SUPER ADMIN MENU --}}
                    @if (Auth::user()->role === 'super_admin')
                        {{-- Add Super Admin menus here --}}

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-people"></i>
                                <p>
                                    All Customers
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('admin.users.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    {{-- ADMIN MENU (Customer Admins) --}}
                    @if (Auth::user()->role === 'admin')
                        {{-- Roles & Permissions --}}
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link" target="_blank">
                                <i class="nav-icon bi bi-shield-lock"></i>
                                <p>Roles & Permissions</p>
                            </a>
                        </li>

                        {{-- Users --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-people"></i>
                                <p>
                                    Staff
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('user.create') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('user.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-building"></i>
                                <p>
                                    Add Company
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('company.create') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('company.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Companies</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-building"></i>
                                <p>
                                    Add Product
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('products.create') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('products.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-building"></i>
                                <p>
                                    Add Ledgers
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('ledgers.create') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('ledgers.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-building"></i>
                                <p>
                                    Add BookingEntry
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('booking_entries.create') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('booking_entries.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-building"></i>
                                <p>
                                    Reports
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                            <a href="{{ route('reports.lr_register') }}" class="nav-link">
                                <i class="nav-icon bi bi-cash-stack"></i>
                                <p>
                                    Lr Reports
                                    <!-- <i class="nav-arrow bi bi-chevron-right"></i> -->
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('reports.FrmBChallanReg') }}" class="nav-link">
                                <i class="nav-icon bi bi-cash-stack"></i>
                                <p>
                                    FTL Reports
                                    <!-- <i class="nav-arrow bi bi-chevron-right"></i> -->
                                </p>
                            </a>
                        </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-building"></i>
                                <p>
                                    FTL Report
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('billing-register.billing') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p> Billing Register (FTL)</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('lr-pending-register.pending') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>LR Pending (Challan)</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-building"></i>
                                <p>
                                    Brokers
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('brokers.create') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('brokers.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-building"></i>
                                <p>
                                    Loading Challan
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('loading-challan.create') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('loading-challan.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-building"></i>
                                <p>
                                    Freight Challan
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('freight-challan.create') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('freight-challan.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- Vendors --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-truck"></i>
                                <p>
                                    Vendors
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('vendors.create') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('vendors.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- Domestic --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box"></i>
                                <p>
                                    Domestic
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('domestic.shipment.create') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('domestic.shipment.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- Branches --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-diagram-3-fill"></i>
                                <p>
                                    Branches
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('branches.create') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('branches.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- Customers --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                    Customer Master
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('customers.create') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('customers.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-truck"></i>
                                <p>
                                    Vehicles
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('vehicles.create') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('vehicles.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-person-badge"></i>
                                <p>
                                    Drivers
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('drivers.create') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('drivers.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-cash-stack"></i>
                                <p>
                                    Add Expense
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('add-expenses.create') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('add-expenses.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-cash-stack"></i>
                                <p>
                                    Add Hire Register
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('vehicle_hires.create') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('vehicle_hires.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('domestic.shipment.reports') }}" class="nav-link">
                                <i class="nav-icon bi bi-cash-stack"></i>
                                <p>
                                    Reports
                                    <!-- <i class="nav-arrow bi bi-chevron-right"></i> -->
                                </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{ route('vendor.payment.report') }}" class="nav-link">
                                <i class="nav-icon bi bi-cash-stack"></i>
                                <p>
                                    Vendor Payment Report
                                    <!-- <i class="nav-arrow bi bi-chevron-right"></i> -->
                                </p>
                            </a>
                        </li>
                    @endif

                    {{-- USER MENU --}}
                    @if (Auth::user()->role === 'user')
                        {{-- Vendors --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-truck"></i>
                                <p>
                                    Vendors
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('vendors.create') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('vendors.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- Domestic --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box"></i>
                                <p>
                                    Domestic
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('domestic.shipment.create') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('domestic.shipment.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- Branches --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-diagram-3-fill"></i>
                                <p>
                                    Branches
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('branches.create') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('branches.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- Customers --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                    Customer Master
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('customers.create') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('customers.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-truck"></i>
                                <p>
                                    Vehicles
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('vehicles.create') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('vehicles.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-person-badge"></i>
                                <p>
                                    Drivers
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('drivers.create') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('drivers.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-cash-stack"></i>
                                <p>
                                    Add Expense
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('add-expenses.create') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('add-expenses.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-cash-stack"></i>
                                <p>
                                    Add Hire Register
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('vehicle_hires.create') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>Add New</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('vehicle_hires.index') }}" class="nav-link">
                                        <i class="bi bi-circle"></i>
                                        <p>All Record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('vendor.payment.report') }}" class="nav-link">
                                <i class="nav-icon bi bi-cash-stack"></i>
                                <p>
                                    Vendor Payment Report
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                        </li>
                    @endif

                @endauth

            </ul>
        </nav>
    </div>
    <!-- /Sidebar Wrapper -->

</aside>
