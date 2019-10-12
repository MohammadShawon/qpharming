@extends('template.app')
@section('title', 'Company Ledger')

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
            <div class="card card-topline-red">
                <div class="card-head" style="text-align: center;">
                    <header>
                        {{ $company->name }} Ledger
                    </header>
                </div>
                <div class="card-body">
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
                                                <p class="sbold addr-font-h1" data-counter="counterup" data-value="{{ $company->opening_balance }}">{{ $company->opening_balance }}</p>
                                                <p>Opening Balance</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="overview-panel deepPink-bgcolor">
                                            <div class="symbol">
                                                <i class="fa fa-reply"></i>
                                            </div>
                                            <div class="value white">
                                                <p class="sbold addr-font-h1" data-counter="counterup" data-value="{{ $records->sum('grand_total') }}">{{ $records->sum('grand_total') }}</p>
                                                <p>Total Bill</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="overview-panel orange">
                                            <div class="symbol">
                                                <i class="fa fa-handshake-o"></i>
                                            </div>
                                            <div class="value white">
                                                <p class="sbold addr-font-h1" data-counter="counterup" data-value="{{ $records->sum('payment') }}">{{ $records->sum('payment') }}</p>
                                                <p>Total Paid</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="overview-panel blue-bgcolor">
                                            <div class="symbol">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                            <div class="value white">
                                                <p class="sbold addr-font-h1" data-counter="counterup" data-value="{{ ($records->sum('grand_total') + $company->opening_balance) - $records->sum('payment') }}">{{ ($records->sum('grand_total') + $company->opening_balance) - $records->sum('payment') }}</p>
                                                <p>Total Payable</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
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
