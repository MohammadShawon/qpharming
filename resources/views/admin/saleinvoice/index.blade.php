
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
        <div class="col-12">
            <div class="btn-group">
                <a href="{{ route('admin.sales.create') }}" id="addRow1" class="btn btn-primary"
                   style="font-size:14px; padding: 6px 12px;">
                    Create Invoice <i style="color:white;" class="fa fa-plus"></i>
                </a>

            </div>
            <div class="card card-box">

            </div>
        </div>
    </div>


@endsection
