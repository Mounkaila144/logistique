<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <span class="fs-20  fw-bold">Solution logistique</span>
            </span>
            <span class="logo-lg">
                <span class="fs-20  fw-bold">Solution logistique</span>
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
               <span class="fs-20 text-white fw-bold">Solution logistique</span>
            </span>
            <span class="logo-lg">
                <span class="fs-20 text-white fw-bold">Solution logistique</span>
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>@lang('translation.menu')</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="dashboard-analytics" >
                        <i class="ri-dashboard-2-line"></i> <span>@lang('translation.dashboards')</span>
                    </a>
                </li> <!-- end Dashboard Menu -->


                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('clients.index') }}" >
                        <i class="mdi mdi-truck-minus"></i> <span>Clients</span>
                    </a>
                </li>

 <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('camions.index') }}" >
                        <i class="ri-account-circle-line"></i> <span>Camions</span>
                    </a>
                </li>





            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
