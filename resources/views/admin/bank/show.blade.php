<?php
use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Bank Ledger')

@push('css')
    <!-- data tables -->
    <link href="{{ asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css')}} " rel="stylesheet" type="text/css"/>
@endpush

@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-topline-red">
                <div class="card-head" style="text-align: center;">
                    <header>
                        {{ $bank->bank_name }} - Ledger
                    </header>
                </div>
                <div class="card-body ">
                    <div class="row p-b-20">
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="info-box bg-orange">
                                <span class="info-box-icon push-bottom"><i class="material-icons">monetization_on</i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Payments</span>
                                    <span class="info-box-number"> <b>{{ number_format($payments->sum('payment_amount'),2,'.',',') }} Tk</b></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="info-box bg-purple">
                                <span class="info-box-icon push-bottom"><i class="material-icons">monetization_on</i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Collections</span>
                                    <span class="info-box-number"> <b> {{ number_format($collections->sum('collection_amount'),2,'.',',') }} Tk</b></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="info-box bg-b-black">
                                <span class="info-box-icon push-bottom"><i class="material-icons">monetization_on</i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Current Balance</span>
                                    <span class="info-box-number"> <b> {{ number_format(($collections->sum('collection_amount') + $bank->opening_balance) - $payments->sum('payment_amount'),2,'.',',') }} Tk</b></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                    </div>
                    <div class="row">
                        {!! $dataTable->table() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- data tables -->
    <script src="{{ asset('admin/assets/plugins/datatables/jquery.dataTables.min.js') }}" ></script>
    <script src="{{ asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js') }}" ></script>
    <script src="{{ asset('admin/assets/js/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/vendor/datatables/buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}


    <!-- sweet aleart -->
    <script src="{{ asset('admin/assets/js/sweetalert.min.js') }}"></script>
@endpush



