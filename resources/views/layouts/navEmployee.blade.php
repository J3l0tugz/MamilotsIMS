<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #232732 !important;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand align-items-center justify-content-center" href="{{ route('dashboard.indexEmployee') }}">
        <img class="img-fluid" style="width:10rem; margin-top:-10px;" src="{{ asset('media/mamilots_white.png') }}">
        <div class="sidebar-brand-text" style="margin-top: 10vw"><br><sub style="font-size: 8px;">INVENTORY MANAGEMENT
                SYSTEM</sub> </div>
    </a>

    <div style="margin-top: -6px;"><br></div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item mt-5 @if (Route::is('dashboard.indexEmployee')) active @endif"">
        <div class="custom-nav-link sidebar-option shadow">
            <a class="nav-link" href="{{ route('dashboard.indexEmployee') }}">
                <img src="{{ asset('..\media\dashboard.png') }}" style="width: 40px;" class="mr-1">
                <span style="color: #222831 !important;">Dashboard</span>
            </a>
        </div>
    </li>

    <!-- Nav Item - Products -->
    <li
        class="nav-item mt-3 @if (Route::is('product.indexEmployee')) active @elseif (Route::is('product.scanEmployee')) active @elseif (Route::is('product.editEmployee')) active @elseif (Route::is('product.scan.decreaseEmployee')) active @endif">
        <div class="custom-nav-link sidebar-option shadow">
            <a class="nav-link" href="{{ route('product.indexEmployee') }}">
                <img src="{{ asset('..\media\inventory.png') }}" style="width: 40px;" class="mr-1">
                <span style="color: #222831 !important;">Products</span></a>
        </div>
    </li>

    <!-- Nav Item - Raw Materials -->
    <li class="nav-item mt-3  @if (Route::is('material.indexEmployee')) active @endif">
        <div class="custom-nav-link sidebar-option shadow">
            <a class="nav-link" href="{{ route('material.indexEmployee') }}">
                <img src="{{ asset('..\media\material.png') }}" style="width: 40px;" class="mr-1">
                <span style="color: #222831 !important;">Raw Materials</span></a>
        </div>
    </li>

    <!-- Nav Item - Suppliers -->
    <li
        class="nav-item mt-3  @if (Route::is('supplier.indexEmployee')) active @elseif (Route::is('supplier.edit')) active @endif">
        <!--must create for SUPPLIERS-->
        <div class="custom-nav-link sidebar-option shadow">
            <a class="nav-link" href="{{ route('supplier.indexEmployee') }}"> <!--must also create for SUPPLIERS-->
                <img src="{{ asset('..\media\supplier.png') }}" style="width: 40px;" class="mr-1">
                <span style="color: #222831 !important;">Suppliers</span></a>
        </div>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline  mt-5">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
