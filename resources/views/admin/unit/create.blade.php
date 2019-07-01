<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Create - Unit')

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
                    <header>Create Unit</header>
                </div>
                <div class="card-body " id="bar-parent">
                    <form method="post" action="{{ route('admin.unit.store') }}">
                        @csrf
                        {{-- Unit --}}
                        <div class="form-group">
                            <label for="unit">Unit Name</label>
                            <input type="text" name="unit" class="form-control" id="unit" placeholder="Enter unit name">
                        </div>
                        
                        <a class="btn deepPink-bgcolor m-t-15 waves-effect" href="{{ route('admin.unit.index') }}">BACK</a>
                        <button type="submit" class="btn btn-success m-t-15 waves-effect">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    
@endpush
