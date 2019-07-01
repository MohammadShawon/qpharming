<?php
use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Create - Company')

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
                <header>Create Company</header>
            </div>
            <div class="card-body " id="bar-parent">
                <form method="post" action="{{ route('admin.company.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-6">

                            {{-- Company Name --}}
                            <div class="form-group">
                                <label for="company">Company Name</label>
                                <input type="text" name="company" class="form-control" id="company" placeholder="Enter Company name">
                            </div>

                            {{-- Representative Name --}}
                            <div class="form-group">
                                <label for="representative_name">Representative Name</label>
                                <input type="text" name="representative_name" class="form-control" id="representative_name" placeholder="Enter Representative Name">
                            </div>
                            
                            {{-- Phone 1 --}}
                            <div class="form-group">
                                <label for="phone1">Phone </label>
                                <input type="text" name="phone1" class="form-control" id="phone1" placeholder="Enter Phone number">
                            </div>


                            {{-- Alternative Phone --}}
                            <div class="form-group">
                                <label for="phone2">Alternative Phone</label>
                                <input type="text" name="phone2" class="form-control" id="phone2" placeholder="Enter Alternative Phone number">
                            </div>
                            
                        </div>
                        <div class="col-md-6 col-sm-6">

                            {{-- Email --}}
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email address">
                            </div>

                            {{-- Address --}}
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" name="address" placeholder="Enter address" id="address"></textarea>
                                
                            </div>

                            {{-- Balance --}}
                            <div class="form-group">
                                <label for="opening_balance">Opening Balance</label>
                                <input type="number" name="opening_balance" class="form-control" id="opening_balance" placeholder="Enter Opening Balance">
                            </div>
                            
                            {{-- Date --}}
                            <div class="form-group">
                                <label class="">Starting Date</label>
                                <div class="input-group date form_datetime" data-date="{{ Carbon::now() }}" data-date-format="dd MM yyyy HH:ii p" data-link-field="dtp_input1">
                                    <input class="form-control" size="16" type="text" name="starting_date" value="{{ Carbon::now()->toDayDateTimeString() }}">
                                    <span class="input-group-addon ml-2">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                                <input type="hidden" id="dtp_input1" value="" />
                            </div>
                            
                            
                            {{-- <div class="form-group">
                                <label class="">Ending Date</label>
                                <div class="input-group date form_datetime" data-date="{{ Carbon::now() }}" data-date-format="dd MM yyyy HH:ii p" data-link-field="dtp_input1">
                                    <input class="form-control" size="16" type="text" name="ending_date" value="{{ old('ending_date') }}">
                                    <span class="input-group-addon ml-2">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                                <input type="hidden" id="dtp_input1" value="" />
                            </div> --}}
                            
                            
                        </div>
                    </div>
                    <a class="btn deepPink-bgcolor m-t-15 waves-effect" href="{{ route('admin.company.index') }}">BACK</a>
                            <button type="submit" class="btn btn-success m-t-15 waves-effect">SUBMIT</button>
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
