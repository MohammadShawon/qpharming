
@extends('template.app')
@section('title', 'Sale Invoice')

@push('css')
    {!! Html::script('js/angular.min.js', array('type' => 'text/javascript')) !!}
    {!! Html::script('js/sale.js', array('type' => 'text/javascript')) !!}

@endpush

@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">

        </div>
    </div>
    <div class="row">

    </div>


@endsection
