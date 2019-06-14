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
                            <p> 
                                @foreach ( auth()->user()->roles as $role)
                                    {{ $role->name }}
                                @endforeach
                            </p>
                            {{-- <a href="#"><i class="fa fa-circle user-online"></i><span class="txtOnline"> @lang('dashboard.online')</span></a> --}}
                        </div>
                    </div>
                </li>
                <li class="nav-item start {{ Request::is('dashboard*') ? 'active' : '' }}">
                    <a href="/dashboard" class="nav-link nav-toggle">
                        <i class="material-icons">dashboard</i>
                        <span class="title">@lang('dashboard.dashboard')</span>
                        <span class="selected"></span>
                        <span class="arrow open"></span>
                    </a>
                </li>

                @if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin'))
                   
                   <li class="nav-item {{ Request::is('farmer*') ? 'active' : '' }}">
                    <a href="{{ route('admin.farmer.index') }}" class="nav-link nav-toggle"> <i class="material-icons">person_outline</i>
                        <span class="title">@lang('dashboard.farmer')</span> 
                    </a>
                </li>

                <li class="nav-item {{ Request::is('user*')||Request::is('role*')||Request::is('permission*') ? 'active' : '' }}">
                    <a href="#" class="nav-link nav-toggle">
                         <i class="material-icons">group</i>
                         <span class="title">Branches</span>
                         <span class="arrow"></span>
                     </a>
                        <ul class="sub-menu">
                            @foreach($branches as $branch)
                            <li class="nav-item {{ Request::is('branch*') ? 'active' : '' }}">
                            <a href="{{ route('admin.user.index') }}" class="nav-link nav-toggle"> <i class="material-icons">person</i>
                                <span class="title">{{ $branch->name }}</span> 
                            </a>
                        </li>
                        @endforeach
                     </ul>
                </li>

                <li class="nav-item {{ Request::is('area*')||Request::is('branch*')||Request::is('category*')||Request::is('sub-category*')||Request::is('company*') ? 'active' : '' }}">
                    <a href="#" class="nav-link nav-toggle">
                         <i class="material-icons">build</i>
                         <span class="title">Utility's</span>
                         <span class="arrow"></span>
                     </a>
                        <ul class="sub-menu">
                                <li class="nav-item {{ Request::is('area*') ? 'active' : '' }}">
                            <a href="{{ route('admin.area.index') }}" class="nav-link nav-toggle"> <i class="material-icons">event</i>
                                <span class="title">@lang('dashboard.area')</span> 
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('branch*') ? 'active' : '' }}">
                            <a href="{{ route('admin.branch.index') }}" class="nav-link nav-toggle"> <i class="material-icons">event</i>
                                <span class="title">@lang('dashboard.branch')</span> 
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('category*') ? 'active' : '' }}">
                            <a href="{{ route('admin.category.index') }}" class="nav-link nav-toggle"> <i class="material-icons">toc</i>
                                <span class="title">@lang('dashboard.category')</span> 
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('sub-category*') ? 'active' : '' }}">
                            <a href="{{ route('admin.sub-category.index') }}" class="nav-link nav-toggle"> <i class="material-icons">toc</i>
                                <span class="title">@lang('dashboard.sub-category')</span> 
                            </a>
                        </li>

                        <li class="nav-item {{ Request::is('company*') ? 'active' : '' }}">
                            <a href="{{ route('admin.company.index') }}" class="nav-link nav-toggle"> <i class="material-icons">location_city</i>
                                <span class="title">Company</span> 
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('product*') ? 'active' : '' }}">
                            <a href="{{ route('admin.product.index') }}" class="nav-link nav-toggle"> <i class="material-icons">location_city</i>
                                <span class="title">Product</span> 
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('product-price*') ? 'active' : '' }}">
                            <a href="{{ route('admin.product-price.index') }}" class="nav-link nav-toggle"> <i class="material-icons">location_city</i>
                                <span class="title">Product-Price</span> 
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('unit*') ? 'active' : '' }}">
                            <a href="{{ route('admin.unit.index') }}" class="nav-link nav-toggle"> <i class="material-icons">location_city</i>
                                <span class="title">Unit</span> 
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('unit-convert*') ? 'active' : '' }}">
                            <a href="{{ route('admin.unit-convert.index') }}" class="nav-link nav-toggle"> <i class="material-icons">location_city</i>
                                <span class="title">Unit Convert</span> 
                            </a>
                        </li>
                     </ul>
                </li>
                
                <li class="nav-item {{ Request::is('user*')||Request::is('role*')||Request::is('permission*') ? 'active' : '' }}">
                    <a href="#" class="nav-link nav-toggle">
                         <i class="material-icons">group</i>
                         <span class="title">User Management</span>
                         <span class="arrow"></span>
                     </a>
                     <ul class="sub-menu">
                            <li class="nav-item {{ Request::is('user*') ? 'active' : '' }}">
                            <a href="{{ route('admin.user.index') }}" class="nav-link nav-toggle"> <i class="material-icons">person</i>
                                <span class="title">User</span> 
                            </a>
                        </li>

                        <li class="nav-item {{ Request::is('role*') ? 'active' : '' }}">
                            <a href="{{ route('super-admin.role.index') }}" class="nav-link nav-toggle"> <i class="material-icons">device_hub</i>
                                <span class="title">Role</span> 
                            </a>
                        </li>
                        @if(Auth::user()->hasRole('superadmin'))
                        <li class="nav-item {{ Request::is('permission*') ? 'active' : '' }}">
                            <a href="{{ route('super-admin.permission.index') }}" class="nav-link nav-toggle"> <i class="material-icons">device_hub</i>
                                <span class="title">Permission</span> 
                            </a>
                        </li>
                        @endif
                     </ul>
                </li>
                @endif

                @if(Auth::user()->hasRole('manager'))
                    <li class="nav-item {{ Request::is('farmer*') ? 'active' : '' }}">
                    <a href="{{ route('admin.farmer.index') }}" class="nav-link nav-toggle"> <i class="material-icons">person_outline</i>
                        <span class="title">@lang('dashboard.farmer')</span> 
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
