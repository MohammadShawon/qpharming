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
        <div class="col-sm-12">
                                <div class="card-box">
                                    <div class="card-head">
                                        <header>Salary Status</header>
                                    </div>
                                    <div class="card-body ">
                                    <div class = "mdl-tabs mdl-js-tabs">
                                       <div class = "mdl-tabs__tab-bar tab-left-side">
                                          <a href = "#tab4-panel" class = "mdl-tabs__tab tabs_three is-active">Branch Managers</a>
                                          <a href = "#tab5-panel" class = "mdl-tabs__tab tabs_three">Employee</a>
                                          <a href = "#tab6-panel" class = "mdl-tabs__tab tabs_three">Other</a>
                                       </div>
                                       <div class = "mdl-tabs__panel is-active p-t-20" id = "tab4-panel">
                                       <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Name</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Ammount</th>
                                                        <th>Payment Method</th>
                                                    </tr>
                                                    <tr>
                                                        <td class="patient-img sorting_1">
                                                            <img src="assets/img/user/user6.jpg" alt="">
                                                        </td>
                                                        <td>John Deo</td>
                                                        <td>05-01-2017</td>
                                                        <td><span class="label label-danger">Unpaid</span></td>
                                                        <td>1200৳</td>
                                                        <td>Cash</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="patient-img sorting_1">
                                                            <img src="assets/img/user/user4.jpg" alt="">
                                                        </td>
                                                        <td>Eugine Turner</td>
                                                        <td>04-01-2017</td>
                                                        <td><span class="label label-success">Paid</span></td>
                                                        <td>1400৳</td>
                                                        <td>bKash</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="patient-img sorting_1">
                                                            <img src="assets/img/user/user2.jpg" alt="">
                                                        </td>
                                                        <td>Jacqueline Howell</td>
                                                        <td>03-01-2017</td>
                                                        <td><span class="label label-warning">Pending</span></td>
                                                        <td>1100৳</td>
                                                        <td>Cash</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-center">
                                            <button class="btn btn-outline-primary btn-round btn-sm">Load
                                                More</button>
                                        </div>
                                       </div>
                                       <div class = "mdl-tabs__panel p-t-20" id = "tab5-panel">
                                            <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Name</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Ammount</th>
                                                        <th>Payment Method</th>
                                                    </tr>
                                                    <tr>
                                                        <td class="patient-img sorting_1">
                                                            <img src="assets/img/user/user1.jpg" alt="">
                                                        </td>
                                                        <td>Eugine Turner</td>
                                                        <td>04-01-2017</td>
                                                        <td><span class="label label-success">Paid</span></td>
                                                        <td>7000৳</td>
                                                        <td>Rocket</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="patient-img sorting_1">
                                                            <img src="assets/img/user/user4.jpg" alt="">
                                                        </td>
                                                        <td>Jacqueline Howell</td>
                                                        <td>03-01-2017</td>
                                                        <td><span class="label label-warning">Pending</span></td>
                                                        <td>5000৳</td>
                                                        <td>Cash</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="patient-img sorting_1">
                                                            <img src="assets/img/user/user5.jpg" alt="">
                                                        </td>
                                                        <td>Jayesh Parmar</td>
                                                        <td>03-01-2017</td>
                                                        <td><span class="label label-danger">Unpaid</span></td>
                                                        <td>4000৳</td>
                                                        <td>Cash</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-center">
                                            <button class="btn btn-outline-primary btn-round btn-sm">Load
                                                More</button>
                                        </div>
                                       </div>
                                       <div class = "mdl-tabs__panel p-t-20" id = "tab6-panel">
                                            <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Name</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Ammount</th>
                                                        <th>Payment Method</th>
                                                    </tr>
                                                    <tr>
                                                        <td class="patient-img sorting_1">
                                                            <img src="assets/img/user/user8.jpg" alt="">
                                                        </td>
                                                        <td>Jane Elliott</td>
                                                        <td>06-01-2017</td>
                                                        <td><span class="label label-primary">Paid</span></td>
                                                        <td>3000৳</td>
                                                        <td>bKash</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="patient-img sorting_1">
                                                            <img src="assets/img/user/user7.jpg" alt="">
                                                        </td>
                                                        <td>Jacqueline Howell</td>
                                                        <td>03-01-2017</td>
                                                        <td><span class="label label-warning">Pending</span></td>
                                                        <td>4500৳</td>
                                                        <td>Cash</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="patient-img sorting_1">
                                                            <img src="assets/img/user/user9.jpg" alt="">
                                                        </td>
                                                        <td>Jacqueline Howell</td>
                                                        <td>03-01-2017</td>
                                                        <td><span class="label label-primary">Paid</span></td>
                                                        <td>5500৳</td>
                                                        <td>DBBL</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-center">
                                            <button class="btn btn-outline-primary btn-round btn-sm">Load
                                                More</button>
                                        </div>
                                       </div>
                                    </div>
                                    </div>
                                </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
                           <div class="card card-box">
                                  <div class="card-head">
                                      <header>Chicks Survey</header>
                                      <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                     </div>
                                  </div>
                                  <div class="card-body no-padding height-9">
                                    <div class="row">
                                        <canvas id="canvas1"></canvas>
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
@endsection
