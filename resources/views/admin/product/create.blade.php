<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Create - Product')

@push('css')
   <!--select2-->
   <link href="{{ asset('admin/assets/plugins/select2/css/select2.css') }}" rel="stylesheet" type="text/css" />
   <link href="{{ asset('admin/assets/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
   

@endpush

@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            
        </div>
    </div>
    <div class="row ">
        <div class="col-md-12 col-sm-12">
            <div class="card card-box">
                <div class="card-head text-white " style="background-color:#3FCC7E;">
                    <header>Create Product</header>
                </div>
                <div class="card-body" id="bar-parent">
                    <form method="post" action="{{ route('admin.product.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-6">

                                {{-- Product Name --}}
                                <div class="form-group">
                                    <label for="product_name">Name</label>
                                    <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Enter Products's name" value="{{ old('product_name') }}">
                                </div>

                                {{-- Sub-Category --}}
                                <div class="form-group">
                                    <label>Select SubCategory</label>
                                    <select name="sub_category" class="form-control  select2 " >
                                        @foreach ($subCategories as $subCategory)
                                            <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- S.K.U --}}
                                <div class="form-group">
                                    <label for="sku">S.K.U</label>
                                    <input type="text" name="sku" class="form-control" id="sku" placeholder="Enter sku number" value="{{ old('sku') }}">
                                </div>

                                {{-- Barcode --}}
                                <div class="form-group">
                                    <label for="barcode">Generate Barcode</label>
                                    <input id="barcode" type="text" name="barcode" class="form-control" id="simpleFormEmail" placeholder="Generate Barcode" >
                                </div>
                            </div>

                        
                            <div class="col-md-6 col-sm-6">

                                {{-- Base Unit ID --}}
                                <div class="form-group">
                                    <label for="simpleFormEmail">Base Unit ID</label>
                                    <select name="unit_id" class="form-control  select2 " >
                                        @foreach ($baseUnits as $baseUnit)
                                            <option value="{{ $baseUnit->id }}">{{ $baseUnit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Size --}}
                                <div class="form-group">
                                    <label for="size">Size</label>
                                    <input type="text" name="size" class="form-control" id="size" placeholder="Enter Size of the product" value="{{ old('size') }}">
                                </div>

                                {{-- Quantity --}}
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="text" name="quantity" class="form-control" id="quantity" placeholder="Enter Quantity of the product" value="{{ old('quantity') }}">
                                </div>

                                {{-- Description --}}
                                <div class="form-group">
                                    <label for="description">Description</label> 
                                    <textarea name="description" id="description" class="form-control">{{old('description')}}</textarea>
                                </div>
                                

                                
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            <label class="">Ending Date</label>
                            <div class="input-group date form_datetime" data-date="{{ Carbon::now() }}" data-date-format="dd MM yyyy  HH:ii p" data-link-field="dtp_input1">
                                <input class="form-control" size="16" type="text" name="ending_date" value="{{ old('ending_date') }}">
                                <span class="input-group-addon ml-2">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                            <input type="hidden" id="dtp_input1" value="" />
                        </div> --}}

                        {{-- <div class="form-group">
                            <label for="simpleFormEmail">Status</label>
                            <input type="text" name="status" class="form-control" id="simpleFormEmail" placeholder="Enter farmer status" value="{{ old('status') }}">
                        </div> --}}
                        
                        <a class="btn deepPink-bgcolor m-t-15 waves-effect" href="{{ route('admin.product.index') }}">BACK</a>
                        <button type="submit" class="btn btn-success m-t-15 waves-effect">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!--select2-->
    <script src="{{ asset('admin/assets/plugins/select2/js/select2.js') }}" ></script>
    <script src="{{ asset('admin/assets/js/pages/select2/select2-init.js') }}" ></script>
   
@endpush
