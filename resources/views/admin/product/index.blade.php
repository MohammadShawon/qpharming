<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Product')

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
                <a href="{{ route('admin.product.create') }}" id="addRow1" class="btn btn-primary"
                style="font-size:14px; padding: 6px 12px;" >
                    Add New Product <i style="color:white;" class="fa fa-plus"></i>
                </a>

            </div>
            <div class="btn-group">
                <a href="#" id="addRow2" class="btn btn-success"
                   style="font-size:14px; padding: 6px 12px;" >
                    Import Bulk Product <i style="color:white;" class="fa fa-plus"></i>
                </a>
            </div>
            <div class="btn-group">
                <a href="{{ url('/files/products.csv') }}" id="addRow2" class="btn btn-warning"
                   style="font-size:14px; padding: 6px 12px;" >
                    Download Sample CSV <i style="color:white;" class="fa fa-plus"></i>
                </a>
            </div>

            <div class="card card-topline-red" id="importProduct">
                <div class="card-head" style="text-align: center;">
                    <header>PRODUCT IMPORT</header>

                </div>

                <div class="card-body">
                    {!! Form::open(['route' => 'admin.product.import','method' => 'post','enctype' => 'multipart/form-data']) !!}
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    {!! Form::file('csv',['class' => 'form-control','accept' => '.csv,.xlsx']) !!}

                                    @if($errors->has('csv'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('csv') }}</strong>
                                        </span>
                                    @endif
                                    <input type="hidden" name="header">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    {!! Form::submit('Upload',['class' => 'btn btn-success']) !!}
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>

            <div class="card card-topline-red">
                <div class="card-head" style="text-align: center;">
                    <header>PRODUCT</header><span class="btn btn-primary ml-3"> {{ DB::table('products')->count() }} </span>

                </div>
                <div class="card-body ">
                    <div class="row p-b-20">
                        <div class="col-md-6 col-sm-6 col-6">

                        </div>
                        <div class="col-md-6 col-sm-6 col-6">

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
    <script src="{{ asset('https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/vendor/datatables/buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}

    <!-- sweet aleart -->
    <script src="{{ asset('admin/assets/js/sweetalert.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $("#importProduct").hide();
            $("#addRow2").click(function () {
                $("#importProduct").toggle('slide');
            })
        })
    </script>


@endpush


