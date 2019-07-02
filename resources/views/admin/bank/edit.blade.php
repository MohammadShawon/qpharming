<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Update - Bank')

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
                    <header>Update Bank</header>
                </div>
                <div class="card-body " id="bar-parent">
                    <form method="post" action="{{ route('admin.bank.update', $bank->id) }}">
                        @csrf
                        @method('PATCH')

                        {{-- Bank Name --}}
                        <div class="form-group">
                            <label for="bank_name">Bank Name</label>
                            <input type="text" name="bank_name" class="form-control" id="bank_name" value="{{ $bank->bank_name }}">
                        </div>

                        {{-- Account Name --}}
                        <div class="form-group">
                            <label for="account_name">Account Name</label>
                            <input type="text" name="account_name" class="form-control" id="account_name" value="{{ $bank->account_name }}">
                        </div>

                        {{-- Account Number --}}
                        <div class="form-group">
                            <label for="account_number">Account Number</label>
                            <input type="text" name="account_number" class="form-control" id="account_number" value="{{ $bank->account_number }}">
                        </div>

                        {{-- Opening Balance --}}
                        <div class="form-group">
                            <label for="opening_balance">Opening Balance</label>
                            <input type="text" name="opening_balance" class="form-control" id="opening_balance" value="{{ $bank->opening_balance }}">
                        </div>
                        
                        <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.bank.index') }}">BACK</a>
                        <button type="submit" class="btn btn-success m-t-15 waves-effect">UPDATE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    
@endpush
