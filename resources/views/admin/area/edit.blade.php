<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Update - Area')

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
                    <header>Update AREA</header>
                </div>
                <div class="card-body " id="bar-parent">
                    <form method="post" action="{{ route('admin.area.update', $area->id) }}">
                        @csrf
                        @method('PATCH')

                        {{-- Area --}}
                        <div class="form-group">
                            <label for="simpleFormEmail">Area Name</label>
                            <input type="text" name="area" class="form-control" id="simpleFormEmail" 
                            value="{{ $area->name }}">
                        </div>
                        
                        <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.area.index') }}">BACK</a>
                        <button type="submit" class="btn btn-success m-t-15 waves-effect">UPDATE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    
@endpush
