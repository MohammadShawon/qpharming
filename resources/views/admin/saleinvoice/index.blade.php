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
            <div class="btn-group">
                <a href="{{ route('admin.sales.create') }}" id="addRow1" class="btn btn-primary"
                   style="font-size:14px; padding: 6px 12px;">
                    Create Invoice <i style="color:white;" class="fa fa-plus"></i>
                </a>

            </div>
            <div class="card card-topline-red">
                <div class="card-head" style="text-align: center;">
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
