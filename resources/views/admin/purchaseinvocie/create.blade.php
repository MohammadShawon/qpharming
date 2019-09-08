@extends('template.app')

@section('title', 'Create Sale Invoice')

@push('css')
    <!--select2-->
    <link href="{{ asset('admin/assets/plugins/select2/css/select2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- date time -->
    <link href="{{ asset('admin/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }} " rel="stylesheet" media="screen">
    {!! Html::script('js/angular.min.js', array('type' => 'text/javascript')) !!}
    {!! Html::script('js/purchase.js', array('type' => 'text/javascript')) !!}
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
                    <header>Create Purchase Invoice</header>
                </div>
                <div class="card-body" id="bar-parent">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="text-center">
                                {{ env('COMPANY_NAME','QBYTESOFT') }} <span class="label label-rouded label-danger">{{ auth()->user()->branch->name }}</span>
                            </h3>
                        </div>
                    </div>
                    {!! Form::open(['route' => 'admin.purchases.store','method' => 'POST']) !!}
                    {{--          Form ROw 1          --}}
                    <div class="row">
                        <div class="col-12 col-md-3 col-sm-4">
                            <div class="form-group">
                                <label for="invoice_id">Invoice No.</label>
                                <input type="text" class="form-control" value="@if ($purchase) {{ $purchase->id + 1 }} @else {{ 1 }} @endif" readonly>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 col-sm-4">
                            <div class="form-group">
                                <label for="user_id">Employee Name</label>
                                <input type="text" id="user_id" class="form-control" value="{{ Auth::user()->name }}" readonly>
                                <input type="hidden" name="user_d" value="{{ Auth::user()->id }}">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group">

                                <label for="company_id">Company Name</label>
                                <select id="company_id" name="company_id" class="form-control  select2 " required>
                                    <option value="0">Select Company</option>
                                    @foreach ($companies as $company=> $value)

                                        <option value="{{ $value }}">{{ $company }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label class="">Bill Date</label>
                                <div class="input-group date form_date" data-date="{{ Carbon\Carbon::now() }}" data-date-format="dd MM yyyy" data-link-field="dtp_input1">
                                    <input class="form-control" size="16" type="text" name="purchase_date" value="{{ Carbon\Carbon::now()->format('d M Y') }}">
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

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="payment_type">Payment Type</label>
                                <select name="payment_type" id="payment_type" class="form-control select2">
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

                                        <td width="80%">@{{item.product_name}} </td>
                                        <td ><button class="btn btn-primary btn-xs" type="button" ng-click="addReceivingTemp(item, newreceivingtemp)"><span class="glyphicon glyphicon-share-alt" aria-hidden="true">&#x2705;</span></button></td>

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
                                        <th>Cost Price</th>
                                        <th>Quantity</th>
                                        <th>Discount</th>
                                        <th>Total</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    <tr ng-repeat="newreceivingtemp in receivingtemp">
                                        {{--<td>@{{newsaletemp.product_id}}</td>--}}
                                        <td>@{{newreceivingtemp.product.product_name}}</td>
                                        <td>@{{ newreceivingtemp.product.size }}</td>
                                        <td><input type="text" style="text-align:center" autocomplete="off" ng-change="updateReceivingTemp(newreceivingtemp)" ng-model="newreceivingtemp.cost_price" size="8"></td>
                                        <td width="15%"><input type="number" style="text-align:center;width: 100%" autocomplete="off" ng-change="updateReceivingTemp(newreceivingtemp)" ng-model="newreceivingtemp.quantity"></td>
                                        <td><input type="text" style="text-align:center" autocomplete="off" ng-change="updateReceivingTemp(newreceivingtemp)" ng-model="newreceivingtemp.discount" size="2"></td>
                                        <td>@{{  (newreceivingtemp.cost_price * newreceivingtemp.quantity) - newreceivingtemp.discount | currency:'Tk'}}</td>
                                        <td><button class="btn btn-danger btn-xs" type="button" ng-click="removeReceivingTemp(newreceivingtemp.id)"><span class="fa fa-remove" aria-hidden="true"></span></button></td>
                                    </tr>
                                    <tfoot>
                                    <tr>
                                        <td colspan="3">
                                        </td>
                                        <td class="text-center">
                                            <b>
                                                TQ: @{{ sumQuantity(receivingtemp) }}
                                            </b>

                                        </td>
                                        <td>
                                            <b>
                                                TD: @{{ sumDiscount(receivingtemp) }}
                                            </b>

                                        </td>
                                        <td>
                                            <b>
                                                TA: @{{ sum(receivingtemp) | number:2 }}
                                            </b>
                                            <input type="hidden" name="sub_total" value="@{{ sum(receivingtemp) }}">
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
                                                <input type="text" ng-model="payment" id="payment" ng-init="payment=0" class="form-control" name="payment">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="totalInvoiceAmount">Total Invoice Amount</label>
                                                <input type="text" value="@{{ sum(receivingtemp) - invoiceDiscount | number:2 }}" class="form-control" id="totalInvoiceAmount" readonly style="font-weight: bold;text-align: center;font-size: 32px">
                                                <input type="hidden" name="grand_total" value="@{{ sum(receivingtemp) - invoiceDiscount }}">
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
                                                <input type="text" id="amountDue" class="form-control" value="@{{ (sum(receivingtemp) - discount) - payment }}" readonly style="font-size: 18px;font-weight: bold; text-align: center">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                {!! Form::submit('Complete Purchase',['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-success btn-block form-control','style' => 'margin-left:10px;margin-top:30px;']) !!}
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

@endpush
