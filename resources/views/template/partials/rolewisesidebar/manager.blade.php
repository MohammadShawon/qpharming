            <ul class="sidemenu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler">
                        <span></span>
                    </div>
                </li>
                <li class="sidebar-user-panel">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ asset('admin/assets/img/user-avator.png') }}" class="img-circle user-img-circle" alt="User Image" />
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
                    <li class="nav-item start {{ Request::is('info*') ? 'active' : '' }}">
                        <a href="/info/branch" class="nav-link nav-toggle">
                            <i class="material-icons">people</i>
                            <span class="title">Branch - Info</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('farmer*') ? 'active' : '' }}">
                        <a href="{{ route('admin.farmer.index') }}" class="nav-link nav-toggle"> <i class="material-icons">person_outline</i>
                            <span class="title">@lang('dashboard.farmer')</span>
                        </a>
                    </li>


                    <li class="nav-item {{ Request::is('customer*') ? 'active' : '' }}">
                        <a href="{{ route('admin.customer.index') }}" class="nav-link nav-toggle"> <i class="material-icons">person_outline</i>
                            <span class="title">@lang('dashboard.customer')</span>
                        </a>
                    </li>
                
                

                {{-- <li class="nav-item {{ Request::is('user*')||Request::is('role*')||Request::is('permission*') ? 'active' : '' }}">
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
                </li> --}}
                    <li class="nav-item {{ Request::is('farmer*') ? 'active' : '' }}">
                    <a href="{{ route('admin.farmer.index') }}" class="nav-link nav-toggle"> <i class="material-icons">person_outline</i>
                        <span class="title">@lang('dashboard.farmer')</span> 
                    </a>
                </li>
            </ul>