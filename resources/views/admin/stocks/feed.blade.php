@extends('template.app')
@section('title', 'Feed Stock')

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
            <div class="card-box">
                <div class="row p-b-20">
                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="info-box bg-success">
                            <span class="info-box-icon push-bottom"><i class="material-icons">monetization_on</i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Stock</span>
                                <span class="info-box-number"> <b>{{ $feeds->sum('quantity') }}</b></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="info-box bg-purple">
                            <span class="info-box-icon push-bottom"><i class="material-icons">monetization_on</i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Sold</span>
                                <span class="info-box-number"> <b> {{ $feeds->sum('sold') }}</b></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="info-box bg-b-black">
                            <span class="info-box-icon push-bottom"><i class="material-icons">monetization_on</i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Current Stock</span>
                                <span class="info-box-number"> <b> {{ $feeds->sum('stock') }}</b></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-topline-red">
                <div class="card-head" style="text-align: center;">
                    <header>
                        Feed - Stock
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
