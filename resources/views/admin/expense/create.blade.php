<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Create - Expense')

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
                    <header>Create Expense</header>
                </div>
                <div class="card-body " id="bar-parent">
                    <form method="post" action="{{ route('admin.expense.store') }}">
                        @csrf

                        {{-- Expense Head --}}
                        <div class="form-group">
                            <label>Select Expense Head</label>
                            <select name="expensehead_id" class="form-control select2 ">
                                @foreach ($expenseheads as $expensehead)
                                    <option value="{{$expensehead->id}}">{{$expensehead->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Amount --}}
                        <div class="form-group">
                            <label for="amount">Expense Amount</label>
                            <input type="number" name="amount" class="form-control" id="amount" placeholder="Enter expense amount">
                        </div>

                        {{-- Description --}}
                        <div class="form-group">
                            <label for="description">Expense Description</label>
                            <input type="textarea" name="description" class="form-control" id="description" placeholder="Enter expense description">
                        </div>

                        {{-- Recipent --}}
                        <div class="form-group">
                            <label for="recipient_name">Expense Recipent Nmae</label>
                            <input type="text" name="recipient_name" class="form-control" id="recipient_name" placeholder="Enter expense recipient name">
                        </div>

                        <div class="row">
                            <div class="col-6">
                                {{-- Name --}}
                                <div class="form-group">
                                    <label>Select Expense Given Name</label>
                                    <select name="user_id" class="form-control select2 ">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                {{-- Collection Date --}}
                                <div class="form-group">
                                    <label class="">Expense Date</label>
                                    <div class="input-group date form_date" data-date="{{ Carbon::now() }}" data-date-format="dd MM yyyy" data-link-field="dtp_input1">
                                        <input class="form-control" size="16" type="text" name="expense_date" value="{{ \Carbon\Carbon::now()->format('d M Y') }}">
                                        <span class="input-group-addon ml-2">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    <input type="hidden" id="dtp_input1" value="" />
                                </div>
                            </div>
                        </div>



                        <a class="btn deepPink-bgcolor m-t-15 waves-effect" href="{{ route('admin.expense.index') }}">BACK</a>
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
    <!-- date time -->
    <script src="{{ asset('admin/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"  charset="UTF-8"></script>
    <script src="{{ asset('admin/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker-init.js') }}"  charset="UTF-8"></script>
@endpush
