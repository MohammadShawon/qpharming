<div class="sidebar-container">
    <div class="sidemenu-container navbar-collapse collapse fixed-menu">
        <div id="remove-scroll">
            <ul class="sidemenu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler">
                        <span></span>
                    </div>
                </li>
                <li class="sidebar-user-panel">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ asset('admin/assets/img/dp.jpg') }}" class="img-circle user-img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p> {{ auth()->user()->username}}</p>
                            <a href="#"><i class="fa fa-circle user-online"></i><span class="txtOnline"> @lang('dashboard.online')</span></a>
                        </div>
                    </div>
                </li>
                <li class="nav-item start {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="/admin/dashboard" class="nav-link nav-toggle">
                        <i class="material-icons">dashboard</i>
                        <span class="title">@lang('dashboard.dashboard')</span>
                        <span class="selected"></span>
                        <span class="arrow open"></span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('admin/area') ? 'active' : '' }}">
                    <a href="{{ route('admin.area.index') }}" class="nav-link nav-toggle"> <i class="material-icons">event</i>
                        <span class="title">@lang('dashboard.area')</span> 
                    </a>
                </li>
               @role('superadmin')
                    <li class="nav-item {{ Request::is('admin/branch') ? 'active' : '' }}">
                    <a href="{{ route('admin.branch.index') }}" class="nav-link nav-toggle"> <i class="material-icons">event</i>
                        <span class="title">@lang('dashboard.branch')</span> 
                    </a>
                </li>
               @endrole

               @role('admin')
                    <li class="nav-item {{ Request::is('admin/branch') ? 'active' : '' }}">
                    <a href="{{ route('admin.branch.index') }}" class="nav-link nav-toggle"> <i class="material-icons">event</i>
                        <span class="title">@lang('dashboard.branch')</span> 
                    </a>
                </li>
               @endrole
                <li class="nav-item {{ Request::is('admin/category') ? 'active' : '' }}">
                    <a href="{{ route('admin.category.index') }}" class="nav-link nav-toggle"> <i class="material-icons">apps</i>
                        <span class="title">@lang('dashboard.category')</span> 
                    </a>
                </li>
                <li class="nav-item {{ Request::is('admin/sub-category') ? 'active' : '' }}">
                    <a href="{{ route('admin.sub-category.index') }}" class="nav-link nav-toggle"> <i class="material-icons">apps</i>
                        <span class="title">@lang('dashboard.sub-category')</span> 
                    </a>
                </li>

                <li class="nav-item {{ Request::is('admin/company') ? 'active' : '' }}">
                    <a href="{{ route('admin.company.index') }}" class="nav-link nav-toggle"> <i class="material-icons">apps</i>
                        <span class="title">Company</span> 
                    </a>
                </li>
                <li class="nav-item {{ Request::is('admin/farmer') ? 'active' : '' }}">
                    <a href="{{ route('admin.farmer.index') }}" class="nav-link nav-toggle"> <i class="material-icons">apps</i>
                        <span class="title">@lang('dashboard.farmer')</span> 
                    </a>
                </li>
                <li class="nav-item">
                    <a href="event.html" class="nav-link nav-toggle"> <i class="material-icons">event</i>
                        <span class="title">Event Management</span>

                    </a>
                </li>
                <li class="nav-item {{ Request::is('admin/farmer') ? 'active' : '' }}">
                    <a href="{{ route('admin.farmer.index') }}" class="nav-link nav-toggle"> <i class="material-icons">apps</i>
                        <span class="title">Farmer</span> 
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
