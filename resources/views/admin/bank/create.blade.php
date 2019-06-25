<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Create - Bank')

@push('css')
   
@endpush

@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-6">
            <div class="card card-box">
                <div class="card-head text-white " style="background-color:#3FCC7E;">
                    <header>Create Bank</header>
                </div>
                <div class="card-body " id="bar-parent">
                    <form method="post" action="{{ route('admin.bank.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="simpleFormEmail">Bank Name</label>
                            <input type="text" name="bank_name" class="form-control" id="simpleFormEmail" 
                            placeholder="Enter Bank Name" value="{{ old('bank_name') }}">
                        </div>
                        <div class="form-group">
                            <label for="simpleFormEmail">Account Name</label>
                            <input type="text" name="account_name" class="form-control" id="simpleFormEmail" placeholder="Enter Account Name"
                            value="{{ old('account_name') }}">
                        </div><div class="form-group">
                            <label for="simpleFormEmail">Account Number</label>
                            <input type="text" name="account_number" class="form-control" id="simpleFormEmail" 
                            placeholder="Enter Account Number"
                            value="{{ old('account_number') }}">
                        </div>
                        <div class="form-group">
                            <label for="simpleFormEmail">Opening Balance</label>
                            <input type="text" name="opening_balance" class="form-control" id="simpleFormEmail" 
                            placeholder="Enter Opening Balance"
                            value="{{ old('opening_balance') }}">
                        </div>
                        
                        <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.bank.index') }}">BACK</a>
                        <button type="submit" class="btn btn-success m-t-15 waves-effect">CREATE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    
@endpush
