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
                <h3 class="text-white box-title"><a href="{{ route('admin.branch.index') }}">Branch</a> <span class="pull-right"><i class="fa fa-caret-up"></i> {{ $branches->count() }}</span></h3>
                {{-- <div id="sparkline7"><canvas style="display: inline-block; width: 267px; height: 70px; vertical-align: top;"></canvas></div> --}}
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="analysis-box m-b-0 bg-b-danger">
                <h3 class="text-white box-title"><a href="{{ route('admin.user.index') }}">Employee</a> <span class="pull-right"><i class="fa fa-caret-up"></i> {{ $users->count() }}</span></h3>
                {{-- <div id="sparkline12"><canvas style="display: inline-block; width: 367px; height: 70px; vertical-align: top;"></canvas></div> --}}
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="analysis-box m-b-0 bg-b-cyan">
                <h3 class="text-white box-title"><a href="{{ route('admin.farmer.index') }}">Farmer</a> <span class="pull-right"><i class="fa fa-caret-up"></i> {{ DB::table('farmers')->count() }}</span></h3>
                {{-- <div id="sparkline9"><canvas style="display: inline-block; width: 267px; height: 70px; vertical-align: top;"></canvas></div> --}}
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="analysis-box m-b-0 bg-b-blue">
                <h3 class="text-white box-title"><a href="{{ route('admin.product.index') }}">Product</a><span class="pull-right"><i class="fa fa-caret-up"></i> {{ DB::table('products')->count() }}</span></h3>
                {{-- <div id="sparkline16" class="text-center"><canvas style="display: inline-block; width: 215px; height: 70px; vertical-align: top;"></canvas></div> --}}
            </div>
        </div>
    </div>
    <div class="row">
         <div class="col-sm-12">
            <div class="card-box">
                <div class="card-head">
                    <header>Stock Values</header>
                </div>
                <div class="card-body ">
                <div class="state-overview">
                                <div class="row">
                                    <div class="col-xl-3 col-md-6 col-12">
                                      <div class="info-box bg-blue">
                                        <span class="info-box-icon push-bottom"><i class="material-icons">group</i></span>
                                        <div class="info-box-content">
                                          <span class="info-box-text">Chick Amount</span>
                                          <span class="info-box-number">{{ App\Helpers\Helpers::totalChicksQuantity() }} Pcs</span>
                                          <div class="progress">
                                            <div class="progress-bar" style="width: 45%"></div>
                                          </div>
                                          <span class="progress-description">
                                                {{ $chicks->products->count() ?? 0 }} Items
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
                                          <span class="info-box-text">Feed Amount</span>
                                          <span class="info-box-number"> {{ App\Helpers\Helpers::totalFeedQuantity() }}Pcs</span>
                                          <div class="progress">
                                            <div class="progress-bar" style="width: 40%"></div>
                                          </div>
                                          <span class="progress-description">
                                                {{ $feeds->products->count()??0 }} Items
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
                                          <span class="info-box-text">Medicine Amount</span>
                                          <span class="info-box-number">{{ App\Helpers\Helpers::totalMedicineQuantity()  }} Pcs</span>
                                          <div class="progress">
                                            <div class="progress-bar" style="width: 85%"></div>
                                          </div>
                                          <span class="progress-description">
                                                {{ $medicines->products->count() ?? 0 }} Items
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
                                          <span class="info-box-text">Total Stock</span>
                                          <span class="info-box-number"> {{ App\Helpers\Helpers::totalStock() }}Pcs</span><span></span>
                                          <div class="progress">
                                            <div class="progress-bar" style="width: 50%"></div>
                                          </div>
                                          <span class="progress-description">
                                                {{ DB::table('products')->count() }} Items
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
                    <header>Payments & Collection</header>
                </div>
                <div class="card-body ">
                    <div class="state-overview">
                        <div class="row">
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="info-box bg-orange">
                                    <span class="info-box-icon push-bottom"><i class="material-icons">monetization_on</i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Payment</span>
                                        <span class="info-box-number">{{ \App\Helpers\Payments::totalDailyPayment() ?? 0 }} Tk</span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 45%"></div>
                                        </div>
                                        <span class="progress-description">
                                            Today
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="info-box bg-b-black">
                                    <span class="info-box-icon push-bottom"><i class="material-icons">monetization_on</i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Payment</span>
                                        <span class="info-box-number">{{ \App\Helpers\Payments::totalPayment() ?? 0 }} Tk</span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 40%"></div>
                                        </div>
                                        <span class="progress-description">
                                                Total
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="info-box bg-orange">
                                    <span class="info-box-icon push-bottom"><i class="material-icons">monetization_on</i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Collection</span>
                                        <span class="info-box-number">{{ \App\Helpers\Collections::dailyTotalCollection() ?? 0 }} Tk</span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 100%"></div>
                                        </div>
                                        <span class="progress-description">
                                                Today
                                        </span>

                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="info-box bg-b-black">
                                    <span class="info-box-icon push-bottom"><i class="material-icons">monetization_on</i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Collection</span>
                                        <span class="info-box-number">{{ \App\Helpers\Collections::totalCollection() ?? 0 }} Tk</span><span></span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 100%"></div>
                                        </div>
                                        <span class="progress-description">
                                                Total
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

                        <div class="full-width text-center p-t-10">
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
                                                {{$userRoles->name . ')'}}
                                            @endforeach
                                        </div>
                                        <div>
                                                <span class="clsAvailable">
                                                    {{$user->branch->name ?? ''}}
                                                </span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="full-width text-center p-t-10" >
                            <a href="{{ route('admin.user.index') }}" class="btn purple btn-outline btn-circle margin-0">View All</a>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>



@endsection
