<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Create - Collection')

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
                    <header>Create Collection</header>
                </div>
                <div class="card-body" id="bar-parent">
                    <form method="post" action="{{ route('admin.collection.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-6">

                                <div class="form-group">
                                    <label>Select Bank</label>
                                    <select name="bank_id" class="form-control  select2 " >
                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Select PurposeHead</label>
                                    <select name="purposehead_id" class="form-control  select2 " >
                                        @foreach ($purposeheads as $purposehead)
                                            <option value="{{ $purposehead->id }}">{{ $purposehead->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Select Company</label>
                                    <select name="company_id" class="form-control  select2 " >
                                        @foreach ($companies as $company)
                                            <option></option>
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Select Farmer</label>
                                    <select name="farmer_id" class="form-control  select2 " >
                                        @foreach ($farmers as $farmer)
                                            <option></option>
                                            <option value="{{ $farmer->id }}">{{ $farmer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="simpleFormEmail">Collection Amount</label>
                                    <input type="text" name="collection_amount" class="form-control" id="simpleFormEmail" placeholder="Enter collection Amount" value="{{ old('collection_amount') }}">
                                </div>
                                
                            </div>
                        
                            <div class="col-md-6 col-sm-6">

                                <div class="form-group">
                                    <label for="simpleFormEmail">Collection Type</label>
                                    <input type="text" name="collection_type" class="form-control" id="simpleFormEmail" placeholder="Enter collection type" value="{{ old('collection_type') }}">
                                </div>
                                <div class="form-group">
                                    <label for="simpleFormEmail">Bank name</label>
                                    <input type="text" name="bank_name" class="form-control" id="simpleFormEmail" placeholder="Enter bank name" value="{{ old('bank_name') }}">
                                </div> 
                                <div class="form-group">
                                    <label for="simpleFormEmail">Given By</label>
                                    <input type="text" name="given_by" class="form-control" id="simpleFormEmail" placeholder="Enter giver name" value="{{ old('given_by') }}">
                                </div>
                                <div class="form-group">
                                    <label for="simpleFormEmail">Remarks</label> 
                                    <textarea name="remarks" id="simpleFormEmail" class="form-control">{{old('remarks')}}</textarea>
                                </div>
                                

                                <div class="form-group">
                                    <label class="">Collection Date</label>
                                    <div class="input-group date form_datetime" data-date="{{ Carbon::now() }}" data-date-format="dd MM yyyy HH:ii p" data-link-field="dtp_input1">
                                        <input class="form-control" size="16" type="text" name="collection_date" value="{{ old('collection_date') }}">
                                        <span class="input-group-addon ml-2">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    <input type="hidden" id="dtp_input1" value="" />
                                </div>
                            </div>
                        </div>
                       
                        
                        <a class="btn deepPink-bgcolor m-t-15 waves-effect" href="{{ route('admin.collection.index') }}">BACK</a>
                        <button type="submit" class="btn btn-success m-t-15 waves-effect">SUBMIT</button>
                        
                    </form>
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
@endpush
