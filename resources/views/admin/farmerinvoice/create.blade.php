@extends('template.app')

@section('title', 'Farmer Invoice')

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
            <div class="text-center">
                <div class="btn-group btn-group-solid">
                    <button type="button" class="btn btn-lg btn-success" id="invoice_button">Invoice</button>
                    <button type="button" class="btn  btn-lg btn-warning" id="payment_button">Payment</button>
                </div>
            </div>
        </div>
        <div class="col-12 payment">
            <div class="card card-box">
                <div class="card-head text-black" style="background-color:#3FCC7E;">
                    <header>Farmer Payment</header>
                </div>
                <div class="card-body">
                    <div class="row">
                        {!! Form::open(['route' => ['admin.payment.advance','id' => $farmer->id],'method' => 'POST']) !!}
                        <div class="row">
                            <div class="col-md-6 col-12">

                                {{--  Purpose Head  --}}
                                <div class="form-group">
                                    <label for="purpose_head">Select PurposeHead</label>
                                    <select name="purposehead_id" id="purpose_head" class="form-control select2" >
                                        @foreach ($purposeheads as $purposehead)
                                            <option value="{{ $purposehead->id }}">{{ $purposehead->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- Amount --}}
                                <div class="form-group">
                                    <label for="payment_amount">Payment Amount</label>
                                    <input type="text" name="payment_amount" class="form-control" id="payment_amount" value="{{ old('payment_amount') }}" autocomplete="off">
                                </div>
                                {{-- Reference --}}

                                <div class="form-group">
                                    <label for="reference">Reference / Bill / Receipt No</label>
                                    <input type="text" name="reference" class="form-control" id="reference" value="{{ old('reference') }}" autocomplete="off">
                                </div>


                            </div>

                            <div class="col-md-6 col-12">


                                <div class="form-group">
                                    <label for="simpleFormEmail">Receivd By</label>
                                    <input type="text" name="received_by" class="form-control" id="simpleFormEmail" value="{{ old('received_by') }}">
                                </div>



                                <div class="form-group">
                                    <label class="">Payment Date</label>
                                    <div class="input-group date form_datetime" data-date="{{ \Carbon\Carbon::now() }}" data-date-format="dd MM yyyy HH:ii p" data-link-field="dtp_input1">
                                        <input class="form-control" size="16" type="text" name="payment_date" value="{{ \Carbon\Carbon::now()->format('d M Y h:i a') }}">
                                        <span class="input-group-addon ml-2">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    <input type="hidden" id="dtp_input1" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                {!! Form::submit('Complete',['class' => 'btn btn-success pull-right']) !!}
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 invoice">
            <div class="card card-box">
                <div class="card-head text-white " style="background-color:#3FCC7E;">
                    <header>Farmer Invoice</header>
                </div>
                <div class="card-body" id="bar-parent">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="text-center">
                                {{ env('COMPANY_NAME','QBYTESOFT') }}
                                <span class="label label-rouded label-danger">{{ auth()->user()->branch->name }}</span>
                            </h3>
                        </div>
                    </div>
                    {!! Form::open(['url' => '/farmer/'.$farmer->id.'/invoice','method' => 'POST']) !!}
                    {{--          Form ROw 1          --}}
                    <div class="row">
                        <div class="col-12 col-md-2 col-sm-4">
                            <div class="form-group">
                                <label for="invoice_id">Invoice No.</label>
                                <input type="text" class="form-control" value="@if ($invoice) {{ $invoice->id + 1 }} @else {{ 1 }} @endif" readonly>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 col-sm-4">
                            <div class="form-group">
                                <label for="user_id">Employee Name</label>
                                <input type="text" id="user_id" class="form-control" value="{{ Auth::user()->name }}" readonly>
                                <input type="hidden" name="user_d" value="{{ Auth::user()->id }}">
                            </div>
                        </div>
                        <div class="col-12 col-sm-4 col-md-2">
                            <div class="form-group">
                                <label for="batch_number">Batch name</label>
                                <input type="text" id="batch_number" class="form-control" value="{{ $farmer->farmerbatches->where('status','active')->first()->batch_name ?? 'N/A' }}" readonly>
                                <input type="hidden" name="batch_number" value="{{ $farmer->farmerbatches->where('status','active')->first()->batch_number ?? 'N/A' }}">
                            </div>

                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group">

                                <label for="farmer_id">Farmer Name</label>
                                <input type="text" id="farmer_id" class="form-control" value="{{ $farmer->name }}" readonly>
                                <input type="hidden" value="{{ $farmer->id }}" name="farmer_id">
                            </div>
                        </div>

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


                    </div>

                    {{--           Form Row 2             --}}
                    <div class="row">



                    </div>
                    {{--          Row 3          --}}
                    <div class="row p-t-20" ng-controller="SearchItemCtrl">
                        <!-- Product Search  -->
                        <div class="col-xs-12 col-3">
                            <div class="form-group">
                                <label>Product Search</label>
                                <input ng-model="searchKeyword" class="form-control underlined">

                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <tr ng-repeat="item in items  | filter: searchKeyword | limitTo:10">

                                        <td width="80%">@{{item.product_name}}</td>
                                        <td ><button class="btn btn-primary btn-xs" type="button" ng-click="addSaleTemp(item, newsaletemp)"><span class="glyphicon glyphicon-share-alt" aria-hidden="true">&#x2705;</span></button></td>

                                    </tr>
                                </table>
                            </div>
                        </div>


                        <!-- Sale Items table -->

                        <div class="col-9">
                            <!-- product list Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        {{--<th>{{trans('sale.product_id')}}</th>--}}
                                        <th>Product name</th>
                                        <th>Size</th>
                                        <th>Selling Price</th>
                                        <th>Quantity</th>
                                        <th>Discount</th>
                                        <th>Total</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    <tr ng-repeat="newsaletemp in saletemp">
                                        {{--<td>@{{newsaletemp.product_id}}</td>--}}
                                        <td>@{{newsaletemp.product.product_name}}</td>
                                        <td>@{{ newsaletemp.product.size }}</td>
                                        <td><input type="text" style="text-align:center" autocomplete="off" ng-change="updateSaleTemp(newsaletemp)" ng-model="newsaletemp.selling_price" size="8"></td>
                                        <td width="15%"><input type="number" style="text-align:center;width: 100%" autocomplete="off" ng-change="updateSaleTemp(newsaletemp)" ng-model="newsaletemp.quantity"></td>
                                        <td><input type="text" style="text-align:center" autocomplete="off" ng-change="updateSaleTemp(newsaletemp)" ng-model="newsaletemp.discount" size="2"></td>
                                        <td>@{{  (newsaletemp.selling_price * newsaletemp.quantity) - newsaletemp.discount | currency:'Tk'}}</td>
                                        <td><button class="btn btn-danger btn-xs" type="button" ng-click="removeSaleTemp(newsaletemp.id)"><span class="fa fa-remove" aria-hidden="true"></span></button></td>
                                    </tr>
                                    <tfoot>
                                    <tr>
                                        <td colspan="3">
                                        </td>
                                        <td class="text-center">
                                            <b>
                                                TQ: @{{ sumQuantity(saletemp) }}
                                            </b>

                                        </td>
                                        <td>
                                            <b>
                                                TD: @{{ sumDiscount(saletemp) }}
                                            </b>

                                        </td>
                                        <td>
                                            <b>
                                                TA: @{{ sum(saletemp) | number:2 }}
                                            </b>
                                            <input type="hidden" name="sub_total" value="@{{ sum(saletemp) }}">
                                        </td>
                                        <td></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="invoiceDiscount">Discount</label>
                                                <input type="text" ng-model="invoiceDiscount" ng-init="invoiceDiscount=0" autocomplete="off" class="form-control" id="invoiceDiscount" name="invoiceDiscount">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="payment">Paid Amount</label>
                                                <input type="text" ng-model="payment" id="payment" ng-init="payment=0" class="form-control" name="payment" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="totalInvoiceAmount">Total Invoice Amount</label>
                                                <input type="text" value="@{{ sum(saletemp) - invoiceDiscount | number:2 }}" class="form-control" name="grand_total" id="totalInvoiceAmount" readonly style="font-weight: bold;text-align: center;font-size: 32px">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="remarks">Remarks</label>
                                                <input type="text" name="remarks" class="form-control" id="remarks">
                                            </div>

                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="amountDue">Amount Due</label>
                                                <input type="text" id="amountDue" class="form-control" value="@{{ (sum(saletemp) - discount) - payment }}" readonly style="font-size: 18px;font-weight: bold; text-align: center">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                {!! Form::submit('Complete Sale',['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-success btn-block form-control','style' => 'margin-left:10px;margin-top:30px;']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script>
        $(document).ready(function () {
            $(".payment").hide();
            $("#payment_button").click(function () {
                $(".payment").show('fast');
                $(".invoice").hide('fast');
            });

            $("#invoice_button").click(function () {
                $(".payment").hide('fast');
                $(".invoice").show('fast');
            })
        })
    </script>

@endpush
