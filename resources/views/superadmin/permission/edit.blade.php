<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Update - Permission')

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
                    <header>Update Permission</header>
                </div>
                <div class="card-body " id="bar-parent">
                    <form method="post" action="{{ route('super-admin.permission.update', $permission->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="simpleFormEmail">Permission Name</label>
                            <input type="text" name="permission" class="form-control" id="simpleFormEmail" value="{{ $permission->name }}">
                        </div>
                        
                        <a class="btn deepPink-bgcolor m-t-15 waves-effect" href="{{ route('super-admin.permission.index') }}">BACK</a>
                        <button type="submit" class="btn btn-success m-t-15 waves-effect">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    
@endpush
