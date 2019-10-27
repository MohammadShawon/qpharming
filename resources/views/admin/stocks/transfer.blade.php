@extends('template.app')
@section('title', 'Stock Transfer')

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
        <div class="col-12">
            <div class="card card-topline-red">
                <div class="card-head" style="text-align: center;">
                    <header>
                        Stock Transfer
                    </header>
                </div>
                <div class="card-body">
                 <div class="row">
                     <div class="col-6">
                         <form method="post" action="{{ route('admin.stocks.transfer.store') }}">
                             @csrf

                             {{-- Select Branch --}}
                             <div class="form-group">
                                 <label for="branch_id">Select Branch</label>
                                 <select id="branch_id" name="branch_id" class="form-control select2 ">
                                     @foreach ($branches as $branch)
                                         <option value="{{$branch->id}}">{{$branch->name}}</option>
                                     @endforeach
                                 </select>
                             </div>

                             {{-- Select Item --}}
                             <div class="form-group">
                                 <label for="product_id">Select Product</label>
                                 <select id="product_id" name="product_id" class="form-control select2 ">
                                     @foreach ($products as $product)
                                         <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                     @endforeach
                                 </select>
                             </div>
                             <div class="row">
                                 <div class="col-6">
                                     {{-- Quantity --}}
                                     <div class="form-group">
                                         <label for="quantity">Quantity</label>
                                         <input type="number" name="quantity" class="form-control" id="quantity" placeholder="" autocomplete="off" autofocus>
                                     </div>
                                 </div>
                             </div>

                                                          <a class="btn deepPink-bgcolor m-t-15 waves-effect" href="{{ route('admin.dashboard') }}">BACK</a>
                             <button type="submit" class="btn btn-success m-t-15 waves-effect">SUBMIT</button>
                         </form>
                     </div>
                 </div>
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

    <!-- sweet aleart -->
    <script src="{{ asset('admin/assets/js/sweetalert.min.js') }}"></script>
@endpush
