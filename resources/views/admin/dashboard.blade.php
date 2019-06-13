@extends('template.app')

@section('title', __('dashboard.dashboard'))

@section('content')
    
<div class="page-bar">
    <div class="page-title-breadcrumb">
        
    </div>
</div>
<div class="row">

    @if (Auth::user()->hasRole('admin'))
        @include('admin.dashboard.admin')
    @endif
    
    @if (Auth::user()->hasRole('manager'))
        @include('admin.dashboard.manager')
    @endif
    

</div>
    
@endsection
