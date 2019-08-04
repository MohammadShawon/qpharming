<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Create - Farmer Batch')

@push('css')
   <!--select2-->
   <link href="{{ asset('admin/assets/plugins/select2/css/select2.css') }}" rel="stylesheet" type="text/css" />
   <link href="{{ asset('admin/assets/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

   <!-- date time -->
   <link href="{{ asset('admin/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }} " rel="stylesheet" media="screen">
@endpush

@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">

        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-6">
            <div class="card card-box">
                <div class="card-head text-white " style="background-color:#3FCC7E;">
                    <header>Create Farmer Batch</header>
                </div>
                <div class="card-body" id="bar-parent">
                    <form method="post" action="{{ url('/farmer/'.$farmer->id.'/batch') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-sm-12">

                                {{-- Name --}}
                                <div class="form-group">
                                    <label for="name">Farmer Name</label>
                                    <input type="text" value="{{$farmer->name}}" class="form-control" id="name" placeholder="Enter farmer name" value="{{ old('name') }}" readonly>
                                    <input type="hidden" name="farmer_id" value="{{$farmer->id}}">
                                </div>



                                {{-- Batch Name --}}
                                <div class="form-group">
                                    <label for="batch_name">Batch Name</label>
                                    <input type="text" name="batch_name" class="form-control" id="batch_name" placeholder="Enter Batch Name">
                                </div>

                                {{-- Batch Number --}}
                                <div class="form-group">
                                    <label for="batch_number">Batch Number</label>
                                    <input type="text" name="batch_number" value="{{ date("F").'-'}}" class="form-control" id="batch_number" >
                                </div>
                                {{-- Chicks Quantity --}}
                                <div class="form-group">
                                    <label for="chicks">Chicks Quantity</label>
                                    <input type="text" name="chicks_quantity" value="0" class="form-control" id="chicks" >
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        {{-- Batch Status --}}
                                        <div class="form-group">
                                            <label for="simpleFormEmail">Status</label>
                                            <select class="form-control" name="status">
                                                @foreach(["active" => "Active", "inactive" => "Inactive", "disabled" => "Disabled"] AS $key => $value)
                                                    <option value="{{$key}}" {{ $farmer->status == $key ? "selected" : "" }}>{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="">Batch Date</label>
                                            <div class="input-group date form_datetime" data-date="{{ \Carbon\Carbon::now() }}" data-date-format="dd MM yyyy HH:ii p" data-link-field="dtp_input1">
                                                <input class="form-control" size="16" type="text" name="batch_date" value="{{ \Carbon\Carbon::now()->toDayDateTimeString() }}">
                                                <span class="input-group-addon ml-2">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                            </div>
                                            <input type="hidden" id="dtp_input1" value="" />
                                        </div>
                                    </div>

                                </div>




                            </div>

                        </div>

                        <a class="btn deepPink-bgcolor m-t-15 waves-effect" href="{{ url('/farmer/'.$farmer->id) }}">BACK</a>
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

    <!-- data time -->
    <script src="{{ asset('admin/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"  charset="UTF-8"></script>
    <script src="{{ asset('admin/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker-init.js') }}"  charset="UTF-8"></script>
@endpush
