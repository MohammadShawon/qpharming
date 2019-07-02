<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Update Purpose Head')

@push('css')
   <!--select2-->
   <link href="{{ asset('admin/assets/plugins/select2/css/select2.css') }}" rel="stylesheet" type="text/css" />
   <link href="{{ asset('admin/assets/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-6">
            <div class="card card-box ">
                <div class="card-head text-white " style="background-color:#3FCC7E;">
                    <header>Update Purpose - Head</header>
                </div>
                <div class="card-body " id="bar-parent">
                    <form method="post" action="{{ route('admin.purposehead.update', $purposehead->id) }}">
                        @csrf
                        @method('PATCH')

                        {{-- Purpose Head  name --}}
                        <div class="form-group">
                            <label for="name">Purspose Head Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter branch name" value="{{ $purposehead->name}}">
                        </div>
                        
                        <a class="btn deepPink-bgcolor m-t-15 waves-effect" href="{{ route('admin.purposehead.index') }}">BACK</a>
                        <button type="submit" class="btn btn-success m-t-15 waves-effect">UPDATE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!--select2-->
    <script src="{{ asset('admin/assets/plugins/select2/js/select2.js') }}" ></script>
    <script src="{{ asset('admin/assets/js/pages/select2/select2-init.js') }}" ></script>
@endpush
