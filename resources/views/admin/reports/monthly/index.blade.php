@extends('template.app')
@section('title', 'Chicks Stock')

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
    <div class="row">
        <div class="col-8">

            <div class="card card-box">
                <form action="" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-6">

                                <div class="form-group">
                                    <label class="">From Date</label>
                                    <div class="input-group date form_date" data-date="{{ \Carbon\Carbon::now() }}" data-date-format="dd MM yyyy" data-link-field="dtp_input1">
                                        <input class="form-control" size="16" type="text" name="batch_date" value="{{ \Carbon\Carbon::now()->format('d M Y') }}">
                                        <span class="input-group-addon ml-2">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    <input type="hidden" id="dtp_input1" value="" />
                                </div>

                        </div>
                        <div class="col-6">
                                <div class="form-group">
                                    <label class="">To Date</label>
                                    <div class="input-group date form_date" data-date="{{ \Carbon\Carbon::now() }}" data-date-format="dd MM yyyy" data-link-field="dtp_input1">
                                        <input class="form-control" size="16" type="text" name="batch_date" value="{{ \Carbon\Carbon::now()->format('d M Y') }}">
                                        <span class="input-group-addon ml-2">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    <input type="hidden" id="dtp_input1" value="" />
                                </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="radio radio-aqua">
                            <input id="top-sheet" name="category" value="topsheet" type="radio" checked="checked">
                            <label for="top-sheet">
                                Top Sheet
                            </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="radio radio-aqua">
                            <input id="sales" name="category" value="sales" type="radio">
                            <label for="sales">
                                Sales
                            </label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="radio radio-aqua">
                            <input id="purchase" name="category" value="purchase" type="radio">
                            <label for="purchase">
                                Purchase
                            </label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="radio radio-aqua">
                            <input id="accounts" name="category" value="accounts" type="radio">
                            <label for="accounts">
                                Accounts
                            </label>
                        </div>
                    </div>

                    <div class="col-6 center">
                        <button type="submit" class="btn btn-success m-t-15 waves-effect">SUBMIT</button>
                    </div>

                </form>
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
