<?php
use Carbon\Carbon;
?>
@extends('template.app')
@section('title', 'Update - Company')
@push('css')
<link href="{{ asset('admin/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }} " rel="stylesheet" media="screen">
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
            <header>Company</header>
        </div>
        <div class="card-body " id="bar-parent">
            <form method="post" action="{{ route('admin.company.update', $company->id) }}">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="simpleFormEmail">Company Name</label>
                            <input type="text" name="company" class="form-control" id="simpleFormEmail" value="{{ $company->name }}">
                        </div>
                        <div class="form-group">
                            <label for="simpleFormEmail">Representative Name</label>
                            <input type="text" name="representative_name" class="form-control" id="simpleFormEmail" value="{{ $company->representative_name }}">
                        </div>
                        <div class="form-group">
                            <label for="simpleFormEmail">Phone </label>
                            <input type="number" name="phone1" class="form-control" id="simpleFormEmail" value="{{ $company->phone1 }}">
                        </div>
                        <div class="form-group">
                            <label for="simpleFormEmail">Alternative Phone</label>
                            <input type="number" name="phone2" class="form-control" id="simpleFormEmail" value="{{ $company->phone2 }}">
                        </div>
                        <div class="form-group">
                            <label for="simpleFormEmail">Email</label>
                            <input type="email" name="email" class="form-control" id="simpleFormEmail" value="{{ $company->email }}">
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="simpleFormEmail">Address</label>
                            <input type="textarea" name="address" class="form-control" id="simpleFormEmail" value="{{ $company->address }}">
                        </div>
                        <div class="form-group">
                            <label for="simpleFormEmail">Opening Balance</label>
                            <input type="number" name="opening_balance" class="form-control" id="simpleFormEmail" value="{{ $company->opening_balance }}">
                        </div>
                        <div class="form-group">
                            <label>Starting Date</label>
                            <div class="input-group date form_datetime" data-date="{{ Carbon::now() }}">
                                <input class="form-control" size="16" type="text" name="starting_date" value="{{ Carbon::parse($company->starting_date)->format('Y-m-d H:i') }}">
                                <span class="input-group-addon ml-2">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Ending Date</label>
                            <div class="input-group date form_datetime" data-date="{{ Carbon::now() }}" data-date-format="dd MM yyyy HH:ii p" data-link-field="dtp_input1">
                                <input class="form-control" size="16" type="text" name="ending_date" value="{{ Carbon::parse($company->ending_date)->format('Y-m-d H:i') }}">
                                <span class="input-group-addon ml-2">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                        </div>
                        
                        <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.company.index') }}">BACK</a>
                        <button type="submit" class="btn btn-success m-t-15 waves-effect">UPDATE</button>
                    </div>
                </div>
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
@endpush
