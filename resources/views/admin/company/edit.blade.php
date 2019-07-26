<?php
use Carbon\Carbon;
?>
@extends('template.app')
@section('title', 'Update - Company')
@push('css')
<link href="{{ asset('admin/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }} " rel="stylesheet" media="screen">
<!--select2-->
<link href="{{ asset('admin/assets/plugins/select2/css/select2.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin/assets/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-12 col-sm-12">
        <div class="card card-box">
            <div class="card-head text-white " style="background-color:#3FCC7E;">
            <header>Update Company</header>
        </div>
        <div class="card-body " id="bar-parent">
            <form method="post" action="{{ route('admin.company.update', $company) }}">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-6 col-sm-6">

                        {{-- Company Name --}}
                        <div class="form-group">
                            <label for="company">Company Name</label>
                            <input type="text" name="company" class="form-control" id="company" value="{{ $company->name }}">
                        </div>

                        {{-- Representative Name --}}
                        <div class="form-group">
                            <label for="representative_name">Representative Name</label>
                            <input type="text" name="representative_name" class="form-control" id="representative_name" value="{{ $company->representative_name }}">
                        </div>

                        {{-- Phone 1 --}}
                        <div class="form-group">
                            <label for="phone1">Phone </label>
                            <input type="text" name="phone1" class="form-control" id="phone1" value="{{ $company->phone1 }}">
                        </div>

                         {{-- Phone 2 --}}
                        <div class="form-group">
                            <label for="phone2">Alternative Phone</label>
                            <input type="text" name="phone2" class="form-control" id="phone2" value="{{ $company->phone2 }}">
                        </div>

                        {{-- Email --}}
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ $company->email }}">
                        </div>
                        
                    </div>
                    
                    <div class="col-md-6 col-sm-6">
                        
                        {{-- Address --}}
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="textarea" name="address" class="form-control" id="address" value="{{ $company->address }}">
                        </div>

                        {{-- Balance --}}
                        <div class="form-group">
                            <label for="opening_balance">Opening Balance</label>
                            <input type="text" name="opening_balance" class="form-control" id="opening_balance" value="{{ $company->opening_balance }}" onkeyup="this.value=this.value.replace(/^\.|[^\d\.]/g,'')">
                        </div>

                         {{-- Starting Date --}}
                        <div class="form-group">
                            <label>Starting Date</label>
                            <div class="input-group date form_datetime" data-date="{{ Carbon::now() }}">
                                <input class="form-control" size="16" type="text" name="starting_date" value="{{ Carbon::parse($company->starting_date)->toDayDateTimeString() }}">
                                <span class="input-group-addon ml-2">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                        </div>

                        {{-- Ending Date  --}}
                        <div class="form-group">
                            <label>Ending Date</label>
                            <div class="input-group date form_datetime" data-date="{{ Carbon::now() }}" data-date-format="dd MM yyyy HH:ii p" data-link-field="dtp_input1">
                                <input class="form-control" size="16" type="text" name="ending_date" >
                                <span class="input-group-addon ml-2">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="type">Business Type</label>
                                    <select name="type" id="type" class="form-control select2">
                                        @foreach(['medicine' => 'Medicine', 'feed' => 'Feed', 'chick' => 'Chick','other' => 'Other'] AS $key => $value)
                                            <option value="{{ $key }}" {{ $company->type === $key ? "selected" : "" }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                {{-- Status --}}
                                <div class="form-group">
                                    <label >Status</label>
                                    <select class="form-control" name="status">
                                        @foreach(["active" => "Active", "inactive" => "Inactive", "disabled" => "Disabled"] AS $key => $value)
                                            <option value="{{$key}}"
                                                {{ $company->status == $key ? "selected" : "" }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.company.index') }}">BACK</a>
                <button type="submit" class="btn btn-success m-t-15 waves-effect">UPDATE</button>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
@push('js')
<!-- data time -->
<script src="{{ asset('admin/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"  charset="UTF-8"></script>
<script src="{{ asset('admin/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker-init.js') }}"  charset="UTF-8"></script>
<!--select2-->
<script src="{{ asset('admin/assets/plugins/select2/js/select2.js') }}" ></script>
<script src="{{ asset('admin/assets/js/pages/select2/select2-init.js') }}" ></script>
@endpush
