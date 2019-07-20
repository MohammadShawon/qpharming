@extends('template.app')

@section('title', 'Create Sale Invoice')

@push('css')
    <!--select2-->
    <link href="{{ asset('admin/assets/plugins/select2/css/select2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- date time -->
    <link href="{{ asset('admin/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }} " rel="stylesheet" media="screen">
    {!! Html::script('js/angular.min.js', array('type' => 'text/javascript')) !!}
    {!! Html::script('js/sale.js', array('type' => 'text/javascript')) !!}
@endpush

@section('content')

    <div class="page-bar">
        <div class="page-title-breadcrumb">

        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-box">
                <div class="card-head text-white " style="background-color:#3FCC7E;">
                    <header>Crete Sale Invoice</header>
                </div>
                <div class="card-body" id="bar-parent">
                    {!! Form::open(['route' => 'admin.sales.store','method' => 'POST']) !!}
                        {{--          Form ROw 1          --}}
                        <div class="row">
                            <div class="col-12 col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label for="invoice_id">Invoice No.</label>
                                    <input type="text" class="form-control" value="@if ($sale) {{ $sale->id + 1 }} @else {{ 1 }} @endif" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label for="user_id">Employee Name</label>
                                    <input type="text" id="user_id" class="form-control" value="{{ Auth::user()->name }}" readonly>
                                    <input type="hidden" name="user_d" value="{{ Auth::user()->id }}">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label for="branch_id">Branch Name</label>
                                    <input type="text" id="branch_id" class="form-control" value="{{ Auth::user()->branch->name }}" readonly>
                                    <input type="hidden" name="user_d" value="{{ Auth::user()->branch->id }}">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="form-group">

                                    <label for="customer_id">Select Customer</label>
                                    <select id="customer_id" name="customer_id" class="form-control  select2 " >
                                        @foreach ($customers as $customer=> $value)
                                            <option value="{{ $value }}">{{ $customer }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>

                        {{--           Form Row 2             --}}
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label class="">Bill Date</label>
                                    <div class="input-group date form_datetime" data-date="{{ Carbon\Carbon::now() }}" data-date-format="dd MM yyyy HH:ii p" data-link-field="dtp_input1">
                                        <input class="form-control" size="16" type="text" name="sale_date" value="{{ Carbon\Carbon::now()->toDayDateTimeString() }}">
                                        <span class="input-group-addon ml-2">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    <input type="hidden" id="dtp_input1" value="" />
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label class="">Due Date</label>
                                    <div class="input-group date form_datetime" data-date="{{ Carbon\Carbon::now() }}" data-date-format="dd MM yyyy HH:ii p" data-link-field="dtp_input2">
                                        <input class="form-control" size="16" type="text" name="due_date" value="{{ Carbon\Carbon::now()->toDayDateTimeString() }}">
                                        <span class="input-group-addon ml-2">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    <input type="hidden" id="dtp_input2" value="" />
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label for="payment_type">Payment Type</label>
                                    <select name="payment_type" id="payment_type" class="form-control">
                                        <option value="cash">Cash</option>
                                        <option value="bank">Bank</option>
                                        <option value="bkash">Bkash | Rocket</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="form-group bank">
                                    <label for="bank_name">Payment Details</label>
                                    <input type="text" name="bank" id="bank_name" class="form-control">
                                </div>
                            </div>
                        </div>
                        {{--          Row 3          --}}
                        <div class="row" ng-controller="SearchItemCtrl">
                            <!-- Product Search  -->
                            <div class="col-xs-12 col-3">
                                <div class="form-group">
                                    <label>Product Search</label>
                                    <input ng-model="searchKeyword" class="form-control underlined">

                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr ng-repeat="item in items  | filter: searchKeyword | limitTo:10">

                                            <td>@{{item.product_name}}</td>
                                            <td ><button class="btn btn-primary btn-xs" type="button" ng-click="addSaleTemp(item, newsaletemp)"><span class="glyphicon glyphicon-share-alt" aria-hidden="true">&#x2705;</span></button></td>

                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <!-- Sale Items table -->
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!--select2-->
    <script src="{{ asset('admin/assets/plugins/select2/js/select2.js') }}" ></script>
    <script src="{{ asset('admin/assets/js/pages/select2/select2-init.js') }}" ></script>

    <!-- data time -->
    <script src="{{ asset('admin/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"  charset="UTF-8"></script>
    <script src="{{ asset('admin/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker-init.js') }}"  charset="UTF-8"></script>

    <!-- Form Control Script -->
    <script src="{{ asset('js/sale-form.js') }}"></script>

@endpush
