<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Update - Product')

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
                    <header>Update Product</header>
                </div>
                <div class="card-body" id="bar-parent">
                    <form method="post" action="{{ route('admin.product.update', $product) }}">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6 col-sm-6">

                                {{-- Product Name --}}
                                <div class="form-group">
                                    <label for="product_name">Name</label>
                                    <input type="text" name="product_name" class="form-control" id="product_name" value="{{ $product->product_name }}">
                                </div>

                                {{-- Sub-Category --}}
                                <div class="form-group">
                                    <label>Select SubCategory</label>
                                    <select name="sub_category" class="form-control  select2 " >
                                        @foreach ($subCategories as $subCategory)
                                            <option
                                            {{ $product->subcategory_id === $subCategory->id ? 'selected':''}}
                                            value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- Sub-Category --}}
                                <div class="form-group">
                                    <label>Select Company</label>
                                    <select name="company_id" class="form-control  select2 " >
                                        @foreach ($companies as $company)
                                            <option
                                                {{ $product->comapny_id === $company->id ? 'selected':''}}
                                                value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- S.K.U --}}
                                <div class="form-group">
                                    <label for="sku">S.K.U</label>
                                    <input type="text" name="sku" class="form-control" id="sku" value="{{ $product->sku }}">
                                </div>

                                {{-- Barcode --}}
                                <div class="form-group">
                                    <label for="barcode">Generate Barcode</label>
                                    <input id="barcode" type="text" name="barcode" class="form-control" id="simpleFormEmail" value="{{ $product->barcode }}" >
                                </div>

                            </div>


                            <div class="col-md-6 col-sm-6">

                                {{-- Base unit ID --}}
                                <div class="form-group">
                                    <label for="unit_id">Base Unit ID</label>
                                    <input type="text" name="unit_id" class="form-control" id="unit_id" value="{{ $product->base_unit_id }}">
                                </div>


                                {{-- Size --}}
                                <div class="form-group">
                                    <label for="size">Size</label>
                                    <input type="text" name="size" class="form-control" id="size" placeholder="Enter alternativee phone number" value="{{ $product->size }}">
                                </div>


                                {{-- Description --}}
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control">{{ $product->description }}</textarea>
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
                        <button type="submit" class="btn btn-success m-t-15 waves-effect">UPDATE</button>
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
