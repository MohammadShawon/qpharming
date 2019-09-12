<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Create - Payment')

@push('css')
   <!--select2-->
   <link href="{{ asset('admin/assets/plugins/select2/css/select2.css') }}" rel="stylesheet" type="text/css" />
   <link href="{{ asset('admin/assets/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

   <!-- date time -->
   <link href="{{ asset('admin/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }} " rel="stylesheet" media="screen">
@endpush

@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">

        </div>
    </div>
    <div class="row ">
        <div class="col-md-12 col-sm-12">
            <div class="card card-box">
                <div class="card-head text-white " style="background-color:#3FCC7E;">
                    <header>Create Payment</header>
                </div>
                <div class="card-body" id="bar-parent">
                    <form method="post" action="{{ route('admin.payment.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                {{--   Payment Type --}}
                                <div class="form-group">
                                    <label for="payment_type">Payment Type</label>
                                    <select name="payment_type" class="form-control  select2 " id="payment_type">

                                        <option value="cash">Cash</option>
                                        <option value="check">Check</option>
                                        <option value="bank">Bank | Bkash | Rocket | Nagad</option>

                                    </select>

                                </div>

                                {{--     Bank Name--}}
                                <div class="form-group bank">
                                    <label for="bank_name">Bank name</label>
                                    <input type="text" name="bank_name" class="form-control" id="bank_name" placeholder="Enter bank name" value="{{ old('bank_name') }}">
                                </div>

                                {{--Payee Type--}}

                                <div class="form-group">
                                    <label for="payee_type">Payee Type</label>
                                    <select name="payee_type" class="form-control  select2 " id="payee_type">

                                        <option value="authority">Authority</option>
                                        <option value="farmer">Farmer</option>
                                        <option value="staff">Staff</option>
                                        <option value="company">Company</option>
                                        <option value="others">Others</option>

                                    </select>
                                </div>


                                {{--  Purpose Head  --}}
                                <div class="form-group">
                                    <label>Select PurposeHead</label>
                                    <select name="purposehead_id" class="form-control  select2 " >
                                        @foreach ($purposeheads as $purposehead)
                                            <option value="{{ $purposehead->id }}">{{ $purposehead->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{--   Company      --}}
                                <div class="form-group company">
                                    <label for="company">Select Company</label>
                                    <select name="company_id" id="company" class="form-control  select2 " >
                                        @foreach ($companies as $company)
                                            <option></option>
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{--  Farmer   --}}
                                <div class="form-group farmer">
                                    <label for="farmer">Select Farmer</label>
                                    <select name="farmer_id" id="farmer" class="form-control  select2 " >
                                        @foreach ($farmers as $farmer)
                                            <option></option>
                                            <option value="{{ $farmer->id }}">{{ $farmer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Staff --}}
                                <div class="form-group staff">
                                    <label for="staff">Select Staff</label>
                                    <select name="user_id" id="staff" class="form-control  select2 " >
                                        @foreach ($users as $user)
                                            <option></option>
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{--Pay Amount From--}}
                                <div class="form-group">
                                    <label>Pay From Account</label>
                                    <select name="bank_id" class="form-control  select2 " >
                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                        @endforeach
                                    </select>
                                </div>



                            </div>

                            <div class="col-md-6 col-sm-6">

                                {{-- Amount --}}
                                <div class="form-group">
                                    <label for="payment_amount">Payment Amount</label>
                                    <input type="text" name="payment_amount" class="form-control" id="payment_amount" placeholder="Enter Payment Amount" value="{{ old('payment_amount') }}">
                                </div>
                                {{-- Reference --}}

                                <div class="form-group">
                                    <label for="reference">Reference / Bill / Receipt No</label>
                                    <input type="text" name="reference" class="form-control" id="reference" placeholder="Enter reference" value="{{ old('reference') }}">
                                </div>

                                <div class="form-group">
                                    <label for="simpleFormEmail">Receivd By</label>
                                    <input type="text" name="received_by" class="form-control" id="simpleFormEmail" placeholder="Enter Reciever name" value="{{ old('received_by') }}">
                                </div>
                                <div class="form-group">
                                    <label for="simpleFormEmail">Remarks</label>
                                    <textarea name="remarks" id="simpleFormEmail" class="form-control">{{old('remarks')}}</textarea>
                                </div>


                                <div class="form-group">
                                    <label class="">Payment Date</label>
                                    <div class="input-group date form_date" data-date="{{ Carbon::now() }}" data-date-format="dd MM yyyy" data-link-field="dtp_input1">
                                        <input class="form-control" size="16" type="text" name="payment_date" value="{{ Carbon::now()->format('d M Y') }}">
                                        <span class="input-group-addon ml-2">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    <input type="hidden" id="dtp_input1" value="" />
                                </div>
                            </div>
                        </div>


                        <a class="btn deepPink-bgcolor m-t-15 waves-effect" href="{{ route('admin.payment.index') }}">BACK</a>
                        <button type="submit" class="btn btn-success m-t-15 waves-effect">SUBMIT</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    {{--Custom Select show hide--}}
    <script src="{{ asset('js/payment-form.js') }}"></script>
    <!--select2-->
    <script src="{{ asset('admin/assets/plugins/select2/js/select2.js') }}" ></script>
    <script src="{{ asset('admin/assets/js/pages/select2/select2-init.js') }}" ></script>

    <!-- data time -->
    <script src="{{ asset('admin/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"  charset="UTF-8"></script>
    <script src="{{ asset('admin/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker-init.js') }}"  charset="UTF-8"></script>
@endpush
