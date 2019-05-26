<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Update - Farmer')

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
                    <header>Update Farmer</header>
                </div>
                <div class="card-body " id="bar-parent">
                    <form method="post" action="{{ route('admin.farmer.update', $farmer->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="simpleFormEmail">Farmer Name</label>
                                    <input type="text" name="name" class="form-control" id="simpleFormEmail" placeholder="Enter farmer name" value="{{ $farmer->name }}">
                                </div>

                                <div class="form-group">
                                    <label>Select Branch</label>
                                    <select name="branch" class="form-control  select2 " >
                                        @foreach ($branches as $branch)
                                            <option 
                                            {{ $branch->id == $farmer->branch->id ? 'selected' : ''}}
                                            value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="simpleFormEmail">Phone</label>
                                    <input type="text" name="phone1" class="form-control" id="simpleFormEmail" placeholder="Enter farmer phone number" value="{{ $farmer->phone1 }}">
                                </div>

                                <div class="form-group">
                                    <label for="simpleFormEmail">Alternative Phone</label>
                                    <input type="text" name="phone2" class="form-control" id="simpleFormEmail" placeholder="Enter alternaive phone" value="{{ $farmer->phone2 }}">
                                </div>

                                <div class="form-group">
                                    <label for="simpleFormEmail">Email</label>
                                    <input type="email" name="email" class="form-control" id="simpleFormEmail" placeholder="Enter farmer email" value="{{ $farmer->email }}">
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6">

                                <div class="form-group">
                                    <label for="simpleFormEmail">Address</label> 
                                    <textarea name="address" id="simpleFormEmail" class="form-control">{{$farmer->address}}</textarea>
                                </div>

                                

                                <div class="form-group">
                                    <label for="simpleFormEmail">Opening Balance</label>
                                    <input type="text" name="opening_balance" class="form-control" id="simpleFormEmail" placeholder="Enter farmer opening balance" value="{{ $farmer->opening_balance }}">
                                </div>

                                <div class="form-group">
                                    <label class="">Starting Date</label>
                                    <div class="input-group date form_datetime" data-date="{{ Carbon::now() }}" data-date-format="dd MM yyyy HH:ii p" data-link-field="dtp_input1">
                                        <input class="form-control" size="16" type="text" name="starting_date" 
                                        value="{{ Carbon::parse($farmer->starting_date)->toDayDateTimeString(), }}">
                                        <span class="input-group-addon ml-2">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="">Ending Date</label>
                                    <div class="input-group date form_datetime" data-date="{{ Carbon::now() }}" data-date-format="dd MM yyyy  HH:ii p" data-link-field="dtp_input1">
                                        <input class="form-control" size="16" type="text" name="ending_date" value="{{ old('ending_date') }}">
                                        <span class="input-group-addon ml-2">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="simpleFormEmail">Status</label>
                                    <input type="text" name="status" class="form-control" id="simpleFormEmail" placeholder="Enter farmer status" value="{{ $farmer->status }}">
                                </div>
                            </div>
                        </div>
                        
                        <a class="btn deepPink-bgcolor m-t-15 waves-effect" href="{{ route('admin.farmer.index') }}">BACK</a>
                        <button type="submit" class="btn btn-success m-t-15 waves-effect">Update</button>
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




