<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Update - Collection')

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
                    <header>Update Collection</header>
                </div>
                <div class="card-body" id="bar-parent">
                    <form method="post" action="{{ route('admin.collection.update', $collection->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6 col-sm-6">

                                {{-- Bank  --}}
                                <div class="form-group">
                                    <label>Select Bank</label>
                                    <select name="bank_id" class="form-control  select2 " >
                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}"
                                                {{ $bank->id == $collection->bank_id ? 'selected' : ''}}>
                                                {{ $bank->bank_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                {{-- Collection Type --}}
                                <div class="form-group">
                                    <label for="collection_type">Collection Type</label>
                                    <select name="collection_type" class="form-control  select2 " id="collection_type">

                                        <option {{ $collection->collection_type == 'cash' ? 'selected' :  '' }} value="cash">Cash</option>
                                        <option {{ $collection->collection_type == 'check' ? 'selected' :  '' }} value="check">Check</option>
                                        <option {{ $collection->collection_type == 'bank' ? 'selected' :  '' }} value="bank">Bank | Bkash | Rocket | Nagad</option>
                                    </select>
                                </div>


                                {{-- Bank --}}
                                <div class="form-group bank">
                                    <label for="bank_name">Bank name</label>
                                    <input type="text" name="bank_name" class="form-control" id="bank_name" placeholder="Enter bank name" value="{{ $collection->bank_name }}">
                                </div> 

                               {{-- Purpose Head --}}
                               <div class="form-group">
                                    <label for="collect_type">Purpose Head</label>
                                    <select name="collect_type" class="form-control  select2 " id="collect_type">
                                        <option {{ $collection->collect_type == 'egg' ? 'selected' : ''}} value="egg">Egg Sell</option>
                                        <option {{ $collection->collect_type == 'hen' ? 'selected' : ''}} value="hen">Hen Sell</option>
                                        <option {{ $collection->collect_type == 'farmer' ? 'selected' : ''}} value="farmer">Farmer</option>
                                    </select>
                                </div>

                                {{-- Farmer --}}
                                <div class="form-group">
                                    <label>Select Farmer</label>
                                    <select name="farmer_id" class="form-control  select2 " >
                                        @foreach ($farmers as $farmer)
                                        <option value=""></option>
                                            <option value="{{ $farmer->id }}"
                                                {{ $farmer->id == $collection->farmer_id ? 'selected' : ''}} >
                                                {{ $farmer->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                               
                                
                            </div>
                        
                            <div class="col-md-6 col-sm-6">

                                 {{-- Collection Amount --}}
                                 <div class="form-group">
                                    <label for="simpleFormEmail">Collection Amount</label>
                                    <input type="text" name="collection_amount" class="form-control" id="simpleFormEmail" placeholder="Enter Collection Amount" value="{{ $collection->collection_amount }}">
                                </div>

                                
                                <div class="form-group">
                                    <label for="simpleFormEmail">Given By</label>
                                    <input type="text" name="given_by" class="form-control" id="simpleFormEmail" placeholder="Enter Giver name" value="{{ $collection->given_by }}">
                                </div>
                                <div class="form-group">
                                    <label for="simpleFormEmail">Remarks</label> 
                                    <textarea name="remarks" id="simpleFormEmail" class="form-control">{{ $collection->remarks }}</textarea>
                                </div>
                                

                                <div class="form-group">
                                    <label class="">Collection Date</label>
                                    <div class="input-group date form_datetime" data-date="{{ Carbon::now() }}" data-date-format="dd MM yyyy HH:ii p" data-link-field="dtp_input1">
                                        <input class="form-control" size="16" type="text" name="collection_date" value="{{ $collection->collection_date }}">
                                        <span class="input-group-addon ml-2">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    <input type="hidden" id="dtp_input1" value="" />
                                </div>
                            </div>
                        </div>
                       
                        
                        <a class="btn deepPink-bgcolor m-t-15 waves-effect" href="{{ route('admin.collection.index') }}">BACK</a>
                        <button type="submit" class="btn btn-success m-t-15 waves-effect">UPDATE</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    {{--Custom Select show hide--}}
    <script src="{{ asset('js/collection-form.js') }}"></script>
    <!--select2-->
    <script src="{{ asset('admin/assets/plugins/select2/js/select2.js') }}" ></script>
    <script src="{{ asset('admin/assets/js/pages/select2/select2-init.js') }}" ></script>

    <!-- data time -->
    <script src="{{ asset('admin/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"  charset="UTF-8"></script>
    <script src="{{ asset('admin/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker-init.js') }}"  charset="UTF-8"></script>
@endpush
