<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Update - Category')

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
                    <header>Category</header> 
                </div>
                <div class="card-body " id="bar-parent">
                    <form method="post" action="{{ route('admin.category.update', $category->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="simpleFormEmail">Category Name</label>
                            <input type="text" name="category" class="form-control" id="simpleFormEmail" 
                            value="{{ $category->name }}">
                        </div>
                        
                        <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.category.index') }}">BACK</a>
                        <button type="submit" class="btn btn-success m-t-15 waves-effect">UPDATE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    
@endpush
