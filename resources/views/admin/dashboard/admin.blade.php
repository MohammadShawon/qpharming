<div class="col-md-8">
        
    </div>

    <div class="col-lg-4 col-md-12 col-sm-12 col-12">
        <div class="card card-box">
            <div class="card-head">
                <header>Employee List</header>
            </div>
            <div class="card-body ">
                <div class="row">
                    <ul class="docListWindow small-slimscroll-style">
                        @foreach ($users as $user)
                        @if(!Auth::user()->hasRole('superadmin'))
                                @if ($loop->first) @continue @endif
                            @endif
                            <li>
                                <div class="prog-avatar">
                                    <img src="assets/img/user/user1.jpg" alt="" width="40" height="40">
                                </div>
                                <div class="details">
                                    <div class="title">
                                        <a href="#">{{$user->name}}</a> -(@foreach ($user->roles as $userRoles)
                                            {{$userRoles->name}}
                                        @endforeach)
                                    </div>
                                        <div>
                                            <span class="clsAvailable">{{$user->branch->name}}</span>
                                        </div>
                                </div>
                            </li>
                        @endforeach
                        
                        
                    </ul>
                       <div class="full-width text-center p-t-10" >
                            <a href="#" class="btn purple btn-outline btn-circle margin-0">View All</a>
                        </div>
                   </div>
                </div>
            </div>
       </div>
   </div>