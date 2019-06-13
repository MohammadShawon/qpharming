@extends('template.app')

@section('title', __('dashboard.dashboard'))

@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">@lang('dashboard.dashboard')</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">@lang('dashboard.home')</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">@lang('dashboard.dashboard')</li>
            </ol>
        </div>
    </div>
   <div class="row">
       @if(Auth::user()->hasRole('superadmin'))
       @include('admin.dashboard.admin')

       @endif

       @if(Auth::user()->hasRole('admin'))
       @include('admin.dashboard.manager')
       @endif
   </div>
    <div class="state-overview">
        <div class="row">
            
        </div>
    </div>
@endsection
