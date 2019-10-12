<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Create Daily Report')

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
    <div class="row ">
        <div class="col-md-12 col-sm-12">
            <div class="card card-box">
                <div class="card-head text-white " style="background-color:#3FCC7E;">
                    <header>Create Today Record</header>
                </div>
                <div class="card-body" id="bar-parent">
                    <form method="post" action="#">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="simpleFormEmail">Age</label>
                                    <input type="number" name="age" class="form-control" id="simpleFormEmail" placeholder="Enter chick age" value="{{ old('age') }}">
                                </div>

                                <div class="form-group">
                                    <label for="simpleFormEmail">Today Died</label>
                                    <input type="number" name="died" class="form-control" id="simpleFormEmail" placeholder="Enter today died chick" value="{{ old('died') }}">
                                </div>

                                <div class="form-group">
                                    <label for="simpleFormEmail">Total Feed Eater (kg)</label>
                                    <input type="number" name="feed_kg" class="form-control" id="simpleFormEmail" placeholder="Enter total feed eaten in kg" value="{{ old('feed_kg') }}">
                                </div>
                                <div class="form-group">
                                    <label for="simpleFormEmail">Total Feed Eater (Sack)</label>
                                    <input type="number" name="feed_sack" class="form-control" id="simpleFormEmail" placeholder="Enter total feed in sack" value="{{ old('feed_sack') }}">
                                </div>
                            </div>

                        
                            <div class="col-md-6 col-sm-6">

                                
                                <div class="form-group">
                                    <label for="simpleFormEmail">Total Feed Left</label> 
                                    <input type="number" name="feed_left" class="form-control" id="simpleFormEmail" placeholder="Enter left feed" value="{{ old('feed_left') }}">
                                </div>
                                <div class="form-group">
                                    <label for="simpleFormEmail">Per Pics Weight</label>
                                    <input type="number" name="chick_weight" class="form-control" id="simpleFormEmail" placeholder="Enter chick weight" value="{{ old('chick_weight') }}">
                                </div>
                                <div class="form-group">
                                    <label for="simpleFormEmail">Sickness</label>
                                    <input type="text" name="sickness" class="form-control" id="simpleFormEmail" placeholder="Enter sickness" value="{{ old('sickness') }}">
                                </div>
                                <div class="form-group">
                                    <label for="simpleFormEmail">Comments</label>
                                    <textarea name="comments" id="simpleFormEmail" class="form-control">{{old('comments')}}</textarea>
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
                        
                        <a class="btn deepPink-bgcolor m-t-15 waves-effect" href="{{ route('admin.farmer.index') }}">BACK</a>
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
