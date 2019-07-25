<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Create - Invoice')

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
                    <header>Invoice</header>
                </div>
                <div class="card-body " id="bar-parent">
                    <form method="post" action="{{ route('admin.farmerinvoice.store') }}">
                        @csrf

                        {{-- Category --}}
                        <div class="form-group">
                            <label for="category">Invoice Name</label>
                            <input type="text" name="category" class="form-control" id="category" placeholder="Enter invoice name">
                        </div>
                        
                        <a class="btn deepPink-bgcolor m-t-15 waves-effect" href="{{ route('admin.farmerinvoice.index') }}">BACK</a>
                        <button type="submit" class="btn btn-success m-t-15 waves-effect">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    
@endpush
