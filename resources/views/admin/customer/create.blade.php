@extends('template.app')

@section('title','Customer Lists')

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
                    <header>Create Customer</header>
                </div>
                <div class="card-body" id="bar-parent">
                    <form method="post" action="{{ route('admin.customer.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-6">

                                {{-- Name --}}
                                <div class="form-group">
                                    <label for="name">Customer Name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter farmer name" value="{{ old('name') }}">
                                </div>


                                {{-- Phone 1 --}}
                                <div class="form-group">
                                    <label for="phone1">Phone</label>
                                    <input type="text" name="phone" class="form-control" id="phone1" placeholder="Enter Phone number" value="{{ old('phone') }}">
                                </div>

                            </div>


                            <div class="col-md-6 col-sm-6">


                                {{-- Address --}}
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea name="address" id="address" class="form-control">{{old('address')}}</textarea>
                                </div>



                            </div>
                        </div>


                        <a class="btn deepPink-bgcolor m-t-15 waves-effect" href="{{ route('admin.customer.index') }}">BACK</a>
                        <button type="submit" class="btn btn-success m-t-15 waves-effect">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('admin/assets/plugins/select2/js/select2.js') }}" ></script>
    <script src="{{ asset('admin/assets/js/pages/select2/select2-init.js') }}" ></script>

    <!-- data time -->
    <script src="{{ asset('admin/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"  charset="UTF-8"></script>
    <script src="{{ asset('admin/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker-init.js') }}"  charset="UTF-8"></script>
@endpush
