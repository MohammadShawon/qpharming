@extends('template.app')
@section('title', 'Sale Invoice')

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
        <div class="col-12">

            <div class="state-overview">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="overview-panel purple">
                            <div class="symbol">
                                <i class="fa fa-ticket usr-clr"></i>
                            </div>
                            <div class="value white">
                                <p class="sbold addr-font-h1" data-counter="counterup" data-value="{{ $invoices->sum('sub_total') }}">{{ $invoices->sum('sub_total') }}</p>
                                <p>Invoice Amount</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="overview-panel deepPink-bgcolor">
                            <div class="symbol">
                                <i class="fa fa-reply"></i>
                            </div>
                            <div class="value white">
                                <p class="sbold addr-font-h1" data-counter="counterup" data-value="{{ $invoices->sum('discount') }}">{{ $invoices->sum('discount') }}</p>
                                <p>Discount</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="overview-panel orange">
                            <div class="symbol">
                                <i class="fa fa-handshake-o"></i>
                            </div>
                            <div class="value white">
                                <p class="sbold addr-font-h1" data-counter="counterup" data-value="{{ $invoices->sum('grand_total') }}">{{ $invoices->sum('grand_total') }}</p>
                                <p>Grand Total</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="overview-panel blue-bgcolor">
                            <div class="symbol">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <div class="value white">
                                <p class="sbold addr-font-h1" data-counter="counterup" data-value="{{ $invoicePayments->sum('payment') }}">{{ $invoicePayments->sum('payment') }}</p>
                                <p>Paid</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-topline-red">
                <div class="card-head text-center">
                    <div class="btn-group pull-left">
                        <a href="{{ route('admin.sales.create') }}" id="addRow1" class="btn btn-primary"
                           style="font-size:14px; padding: 6px 12px;">
                            Create Invoice <i style="color:white;" class="fa fa-plus"></i>
                        </a>
                    </div>
                    <header>
                        Invoices List - ({{ \DB::table('sales')->count() + \DB::table('farmer_invoices')->count() }})
                    </header>
                </div>
                <div class="card-body">

                    {!! $dataTable->table() !!}
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
