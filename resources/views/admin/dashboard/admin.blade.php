<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="analysis-box m-b-0 bg-b-purple">
            <h3 class="text-white box-title">Branch <span class="pull-right"><i class="fa fa-caret-up"></i> {{ $branches->count() }}</span></h3>
            {{-- <div id="sparkline7"><canvas style="display: inline-block; width: 267px; height: 70px; vertical-align: top;"></canvas></div> --}}
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="analysis-box m-b-0 bg-b-danger">
            <h3 class="text-white box-title">Employee <span class="pull-right"><i class="fa fa-caret-up"></i> {{ $users->count() }}</span></h3>
            {{-- <div id="sparkline12"><canvas style="display: inline-block; width: 367px; height: 70px; vertical-align: top;"></canvas></div> --}}
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="analysis-box m-b-0 bg-b-cyan">
            <h3 class="text-white box-title">Farmer <span class="pull-right"><i class="fa fa-caret-up"></i> 765</span></h3>
            {{-- <div id="sparkline9"><canvas style="display: inline-block; width: 267px; height: 70px; vertical-align: top;"></canvas></div> --}}
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="analysis-box m-b-0 bg-b-blue">
            <h3 class="text-white box-title">Chiken <span class="pull-right"><i class="fa fa-caret-up"></i> 570323</span></h3>
            {{-- <div id="sparkline16" class="text-center"><canvas style="display: inline-block; width: 215px; height: 70px; vertical-align: top;"></canvas></div> --}}
        </div>
    </div>
</div>

<div class="row">
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
                                            <span class="clsAvailable">
                                                {{$user->branch->name}}</span>
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
</div>