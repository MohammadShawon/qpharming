<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">
        <!-- logo start -->
        <div class="page-logo">
            <a href="/dashboard">
{{--             <img alt="" src="{{ asset('admin/assets/img/logo.png')}}"> --}}
            <span class="logo-default" >@lang('dashboard.smile')</span> </a>
        </div>
        <!-- logo end -->
        <ul class="nav navbar-nav navbar-left in">
            <li><a href="#" class="menu-toggler sidebar-toggler"><i class="icon-menu"></i></a></li>
        </ul>
            <form class="search-form-opened" action="#" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="@lang('dashboard.search')" name="query">
                <span class="input-group-btn">
                    <a href="javascript:;" class="btn submit">
                        <i class="icon-magnifier"></i> 
                    </a>
                </span>
            </div>
        </form>
        <!-- start mobile menu -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            <span></span>
        </a>
        <!-- end mobile menu -->
        <!-- start header menu -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- start language menu -->
                <li class="dropdown language-switch">
                    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> {{-- <img src="{{ asset('admin/assets/img/flags/gb.png')}}" class="position-left" alt=""> --}} @lang('dashboard.language')<span class="fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu animated tada">
                        <li>
                            <a href="{{ url('locale/bn') }}" class="deutsch"><img src="{{ asset('admin/assets/img/flags/bd.png')}}" alt="">{{ " ".__('dashboard.bangla') }}</a>
                        </li>
                        <li>
                            <a href="{{ url('locale/en') }}" class="english"><img src="{{ asset('admin/assets/img/flags/gb.png')}}" alt=""> English</a>
                        </li>
                    </ul>
                </li>
                <!-- end language menu -->
                <!-- start notification dropdown -->
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="fa fa-bell-o"></i>
                        @if(Auth::user()->unreadNotifications->count())
                        <span class="badge headerBadgeColor1"> 
                            {{ Auth::user()->unreadNotifications->count() }}
                        </span>
                         @endif
                    </a>
                    <ul class="dropdown-menu animated swing">
                        <li class="external">
                            <h3><span class="bold">Notifications</span></h3>
                        <span class="notification-label defaul-bgcolor">
                            <a href="{{ url('/markallasread') }}">Mark all as Read</a>
                        </span>
                        </li>
                        <li>
                            <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
                                @foreach(Auth::user()->unreadNotifications as $notification)
                                <li>
                                @if($notification->type == 'App\Notifications\FarmerCreateNotification')
                                
                                <a href="/{{ $notification->data['route'] }}" class="text-success">
                                        <span class="time">{{ str_replace(['minutes', 'minute', 'second', 'seconds'], ['mins', 'min', 'sec', 'secs'], $notification->created_at->diffForHumans()) }}</span>
                                        <span class="details">
                                        <span><mark>{{ $notification->data['farmer_name'] }}</mark></span> registered as a farmer in {{ $notification->data['branch_name'] }}</span>
                                    </a>
                                @endif
                                @if($notification->type == 'App\Notifications\UserCreateNotification')
                                
                                <a href="/{{ $notification->data['route'] }}" class="text-success">
                                        <span class="time">{{ str_replace(['minutes', 'minute', 'second', 'seconds'], ['mins', 'min', 'sec', 'secs'], $notification->created_at->diffForHumans()) }}</span>
                                        <span class="details">
                                        <span><mark>{{ $notification->data['user_name'] }}</mark></span> registered as a user</span>
                                    </a>
                                @endif
                                </li>
                                @endforeach
                            </ul>
                            <div class="dropdown-menu-footer">
                                <a href="{{ url('/notifications') }}"> All notifications </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- end notification dropdown -->
                <!-- start message dropdown -->{{-- 
                    <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge headerBadgeColor2"> 2 </span>
                    </a>
                    <ul class="dropdown-menu animated slideInDown">
                        <li class="external">
                            <h3><span class="bold">Messages</span></h3>
                            <span class="notification-label cyan-bgcolor">New 2</span>
                        </li>
                        <li>
                            <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
                                <li>
                                    <a href="#">
                                        <span class="photo">
                                            <img src="{{ asset('admin/assets/img/user/user2.jpg')}}" class="img-circle" alt=""> </span>
                                        <span class="subject">
                                            <span class="from"> Sarah Smith </span>
                                            <span class="time">Just Now </span>
                                        </span>
                                        <span class="message"> Jatin I found you on LinkedIn... </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo">
                                            <img src="{{ asset('admin/assets/img/user/user3.jpg')}}" class="img-circle" alt=""> </span>
                                        <span class="subject">
                                            <span class="from"> John Deo </span>
                                            <span class="time">16 mins </span>
                                        </span>
                                        <span class="message"> Fwd: Important Notice Regarding Your Domain Name... </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo">
                                            <img src="{{ asset('admin/assets/img/user/user1.jpg')}}" class="img-circle" alt=""> </span>
                                        <span class="subject">
                                            <span class="from"> Rajesh </span>
                                            <span class="time">2 hrs </span>
                                        </span>
                                        <span class="message"> pls take a print of attachments. </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo">
                                            <img src="{{ asset('admin/assets/img/user/user8.jpg')}}" class="img-circle" alt=""> </span>
                                        <span class="subject">
                                            <span class="from"> Lina Smith </span>
                                            <span class="time">40 mins </span>
                                        </span>
                                        <span class="message"> Apply for Ortho Surgeon </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo">
                                            <img src="{{ asset('admin/assets/img/user/user5.jpg')}}" class="img-circle" alt=""> </span>
                                        <span class="subject">
                                            <span class="from"> Jacob Ryan </span>
                                            <span class="time">46 mins </span>
                                        </span>
                                        <span class="message"> Request for leave application. </span>
                                    </a>
                                </li>
                            </ul>
                            <div class="dropdown-menu-footer">
                                <a href="#"> All Messages </a>
                            </div>
                        </li>
                    </ul>
                </li> --}}
                <!-- end message dropdown -->
                    <!-- start manage user dropdown -->
                    <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        {{-- <img alt="" class="img-circle " src="{{ asset('admin/assets/img/dp.jpg')}}" /> --}}
                            <span class="username username-hide-on-mobile"> {{ auth()->user()->name }} </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default animated jello">
                        <li>
                            <a href="{{ route('admin.user.show', auth()->user()->id) }}">
                                <i class="icon-user"></i> Profile </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-settings"></i> Settings
                            </a>
                            {{-- 
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-directions"></i> Help
                            </a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="lock_screen.html">
                                <i class="icon-lock"></i> Lock
                            </a>
                        </li> --}}
                        <li>

                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="icon-logout"></i> Log Out 
                            </a>
                             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                 @csrf
                             </form>


                            
                        </li>
                    </ul>
                </li>
                <!-- end manage user dropdown -->
            </ul>
        </div>
    </div>
</div>
