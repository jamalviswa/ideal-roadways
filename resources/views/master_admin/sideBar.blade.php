<div class="left side-menu">
    <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
        <i class="ion-close"></i>
    </button>

    <div class="left-side-logo d-block d-lg-none">
        <div class="text-center">
            
            <a href="{{route('master_admin_dashboard')}}" class="logo"><img src="{{asset('assets/images/logo-dark.png')}}" height="80" alt="logo"></a>
        </div>
    </div>

    <div class="sidebar-inner slimscrollleft">
        
        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{route('master_admin_dashboard')}}" class="waves-effect">
                        <i class="dripicons-meter"></i>
                        <span> Dashboard<!--  <span class="badge badge-success badge-pill float-right">3</span> --></span>
                    </a>
                </li>
                <li class="">
                    <a href="{{route('search_truck')}}" ><i class="fa fa-search"></i> <span>Search Truck</span> </a>
                </li>
                @if(Auth::user()->role!='admin')
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-home"></i> <span>Branch </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('branch_add')}}">Add Branch</a></li>
                        <li><a href="{{route('branch_view')}}">View Branch</a></li>
                    </ul>
                </li>
                @endif
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-truck"></i> <span>Transport </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('transport_add')}}">Add Transport</a></li>
                        <li><a href="{{route('transport_view')}}">View Transport</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-shopping-cart"></i> <span>Load </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('load-add')}}">Add Load</a></li>
                        <li><a href="{{route('load-view')}}">View Load</a></li>
                        <li><a href="{{route('cancel-view')}}">View Cancel Load</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-book"></i> <span>Load Booking</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('booking')}}">Add Booking</a></li>
                        <li><a href="{{route('view-booking')}}">View Booking</a></li>
                        <li><a href="{{route('view-booking-cancel')}}">View Cancel Booking</a></li>

                    </ul>
                </li>

            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>