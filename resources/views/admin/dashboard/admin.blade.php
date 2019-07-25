@extends('template.app')

@section('title', __('dashboard.dashboard'))

@section('content')

    <div class="page-bar">
        <div class="page-title-breadcrumb">

        </div>
    </div>

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
         <div class="col-sm-12">
            <div class="card-box">
                <div class="card-head">
                    <header>This Month Cost</header>
                </div>
                <div class="card-body ">
                <div class="state-overview">
                                <div class="row">
                                    <div class="col-xl-3 col-md-6 col-12">
                                      <div class="info-box bg-blue">
                                        <span class="info-box-icon push-bottom"><i class="material-icons">group</i></span>
                                        <div class="info-box-content">
                                          <span class="info-box-text">Chick Cost</span>
                                          <span class="info-box-number">25,560৳</span>
                                          <div class="progress">
                                            <div class="progress-bar" style="width: 45%"></div>
                                          </div>
                                          <span class="progress-description">
                                                45% Increase
                                              </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                      </div>
                                      <!-- /.info-box -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-xl-3 col-md-6 col-12">
                                      <div class="info-box bg-orange">
                                        <span class="info-box-icon push-bottom"><i class="material-icons">person</i></span>
                                        <div class="info-box-content">
                                          <span class="info-box-text">Feed Cost</span>
                                          <span class="info-box-number">15,560৳</span>
                                          <div class="progress">
                                            <div class="progress-bar" style="width: 40%"></div>
                                          </div>
                                          <span class="progress-description">
                                                40% Increase
                                              </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                      </div>
                                      <!-- /.info-box -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-xl-3 col-md-6 col-12">
                                      <div class="info-box bg-purple">
                                        <span class="info-box-icon push-bottom"><i class="material-icons">content_cut</i></span>
                                        <div class="info-box-content">
                                          <span class="info-box-text">Medicin Cost</span>
                                          <span class="info-box-number">5,560৳</span>
                                          <div class="progress">
                                            <div class="progress-bar" style="width: 85%"></div>
                                          </div>
                                          <span class="progress-description">
                                                85% Increase
                                              </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                      </div>
                                      <!-- /.info-box -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-xl-3 col-md-6 col-12">
                                      <div class="info-box bg-success">
                                        <span class="info-box-icon push-bottom"><i class="material-icons">monetization_on</i></span>
                                        <div class="info-box-content">
                                          <span class="info-box-text">Total Cost</span>
                                          <span class="info-box-number">31,560৳</span><span>$</span>
                                          <div class="progress">
                                            <div class="progress-bar" style="width: 50%"></div>
                                          </div>
                                          <span class="progress-description">
                                                50% Increase
                                              </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                      </div>
                                      <!-- /.info-box -->
                                    </div>
                                    <!-- /.col -->
                                  </div>
    </div>
                </div>
            </div>
         </div>
    </div>

        
    <div class="row">
        <div class="col-md-4">
                           <div class="card card-box">
                                  <div class="card-head">
                                      <header>Activity Logs</header>
                                  </div>
                                  <div class="card-body no-padding height-9">
<div class="row">
                        <ul class="docListWindow small-slimscroll-style">
                           @foreach ($audits as $audit)

                          @php
                            $sparateAuditableType = explode("App\Models\\", $audit->auditable_type);
                            if ($audit->event == 'created') {
                               $eventTextColor = 'text-success';
                            } elseif ($audit->event == 'deleted') {
                               $eventTextColor = 'text-danger';
                            }
                            elseif ($audit->event == 'updated') {
                               $eventTextColor = 'text-info';
                            }else{
                               $eventTextColor = 'text-primary';
                            }
                            
                          @endphp
                          <li>
                            <b>{{ $audit->user->name }} <span class="{{$eventTextColor}}">{{ $audit->event }}</span></b>
                             {{ $sparateAuditableType[1] }}
                               <code class="pull-right" style="font-size: 12px"> {{ str_replace(['minutes', 'minute', 'second', 'seconds'], ['mins', 'min', 'sec', 'secs'], $audit->created_at->diffForHumans()) }}</code>
                             
                          </li>
                          @endforeach
                        </ul>
                           <div class="full-width text-center p-t-10" >
                                {{ $audits->links() }}
                            </div>
                       </div>
                                </div>
                              </div>
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
                                        <img src="{{ asset('admin/assets/img/user-avator.png') }}" alt="" width="40" height="40">
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
    </div>

      
@endsection
