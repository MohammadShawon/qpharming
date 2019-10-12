<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Update - Invoice')

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
                    <header>Update Invoice</header> 
                </div>
                <div class="card-body " id="bar-parent">
                    <form method="post" action="{{ route('admin.farmerinvoice.update') }}">
                        @csrf
                        @method('PATCH')


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    
@endpush
