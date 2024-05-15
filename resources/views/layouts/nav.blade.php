<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #232732 !important;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand align-items-center justify-content-center" href="{{ route('dashboard.index') }}">
        <img class="img-fluid" style="width:10rem; margin-top:-10px;" src="{{ asset('media/mamilots_white.png') }}">
        <div class="sidebar-brand-text" style="margin-top: 10vw"><br><sub style="font-size: 8px;">INVENTORY MANAGEMENT
                SYSTEM</sub> </div>
    </a>

    <div style="margin-top: -6px;"><br></div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item mt-5 @if (Route::is('dashboard.index')) active @endif"">
        <div class="custom-nav-link sidebar-option shadow">
            <a class="nav-link" href="{{ route('dashboard.index') }}">
                <img src="{{ asset('..\media\dashboard.png') }}" style="width: 40px;" class="mr-1">
                <span style="color: #222831 !important;">Dashboard</span>
            </a>
        </div>
    </li>

    <!-- Nav Item - Products -->
    <li
        class="nav-item mt-3 @if (Route::is('product.index')) active @elseif (Route::is('product.scan')) active @elseif (Route::is('product.edit')) active  @elseif (Route::is('product.scan.decrease')) active @endif">
        <div class="custom-nav-link sidebar-option shadow">
            <a class="nav-link" href="{{ route('product.index') }}">
                <img src="{{ asset('..\media\inventory.png') }}" style="width: 40px;" class="mr-1">
                <span style="color: #222831 !important;">Products</span></a>
        </div>
    </li>

    <!-- Nav Item - Raw Materials -->
    <li class="nav-item mt-3  @if (Route::is('material.index')) active @endif">
        <div class="custom-nav-link sidebar-option shadow">
            <a class="nav-link" href="{{ route('material.index') }}">
                <img src="{{ asset('..\media\material.png') }}" style="width: 40px;" class="mr-1">
                <span style="color: #222831 !important;">Raw Materials</span></a>
        </div>
    </li>

    <!-- Nav Item - Suppliers -->
    <li
        class="nav-item mt-3  @if (Route::is('supplier.index')) active @elseif (Route::is('supplier.edit')) active @endif">
        <!--must create for SUPPLIERS-->
        <div class="custom-nav-link sidebar-option shadow">
            <a class="nav-link" href="{{ route('supplier.index') }}"> <!--must also create for SUPPLIERS-->
                <img src="{{ asset('..\media\supplier.png') }}" style="width: 40px;" class="mr-1">
                <span style="color: #222831 !important;">Suppliers</span></a>
        </div>
    </li>

    <!-- Nav Item - Employees -->
    <li
        class="nav-item mt-3  @if (Route::is('employee.index')) active @elseif (Route::is('employee.view')) active @elseif (Route::is('employee.edit')) active @endif">
        <div class="custom-nav-link sidebar-option shadow">
            <a class="nav-link" href="{{ route('employee.index') }}">
                <img src="{{ asset('..\media\employee.png') }}" style="width: 40px;" class="mr-1">
                <span style="color: #222831 !important;">Users</span></a>
        </div>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline  mt-5">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
