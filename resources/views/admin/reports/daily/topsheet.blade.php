@extends('template.app')
@section('title', 'Daily Report')

@push('css')


@endpush

@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">

        </div>
    </div>
    <div class="row">
        <div class="col-8">

            <div class="card-head text-center">
                <header>
                    Daily Report - {{ Carbon\Carbon::today()->format('d M Y') }}
                </header>
            </div>
            <div class="card card-box">

            </div>
        </div>
        <div class="col-4">

        </div>
    </div>


@endsection
