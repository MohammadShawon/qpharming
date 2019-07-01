<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Update - Unit')

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
                    <header>Update UNIT</header>
                </div>
                <div class="card-body " id="bar-parent">
                    <form method="post" action="{{ route('admin.unit.update', $unit->id) }}">
                        @csrf
                        @method('PATCH')

                        {{-- Unit --}}
                        <div class="form-group">
                            <label for="simpleFormEmail">Unit Name</label>
                            <input type="text" name="unit" class="form-control" id="simpleFormEmail" 
                            value="{{ $unit->name }}">
                        </div>
                        
                        <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.unit.index') }}">BACK</a>
                        <button type="submit" class="btn btn-success m-t-15 waves-effect">UPDATE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    
@endpush
