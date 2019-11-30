<?php
use Carbon\Carbon;
?>
@extends('template.app')
@section('title', 'FCR Calculation Dashboard')
@push('css')
    <!-- data tables -->
    <link href="{{ asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css')}} " rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <div id="app">
        <div class="row">
            <div class="col-12">
                <h2 class="font-weight-bolder font-weight-bolder text-center"><b>
                        {{ env('COMPANY_NAME','QBYTESOFT') }} <span class="label label-rouded label-danger">{{ auth()->user()->branch->name }}</span></b>
                </h2>
            </div>
        </div>
        {{--Profile Quick Links--}}
        <div class="row justify-content-center">

            {{--Farmer Profile--}}
            <div class="col-md-6 justify-content-center">

                <div class="card">
                    <div class="card-body no-padding height-9">

                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"> Farmer Profile </div>
                        </div>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>ID</b> <a class="pull-right">{{ $farmer->id}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Name</b> <a class="pull-right">{{ $farmer->name }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Phone</b> <a class="pull-right">{{ $farmer->phone1??$farmer->phone2 }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Address</b> <a class="pull-right">{{ $farmer->address}}</a>
                            </li>

                            <li class="list-group-item">
                                <b>Total Cost</b>
                                <a class="pull-right">
                                    {{ \App\Helpers\Farmers::totalCost($farmer->id) }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


        </div>


    </div>
@endsection
@push('js')
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- data tables -->
    <script src="{{ asset('admin/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js') }}" ></script>
    <!-- data time -->
    <script src="{{ asset('admin/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"  charset="UTF-8"></script>
    <script src="{{ asset('admin/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker-init.js') }}"  charset="UTF-8"></script>
    {{--<script src="{{ asset('admin/assets/js/pages/table/table_data.js') }}" ></script>--}}
    <!-- sweet aleart -->
    <script src="{{ asset('admin/assets/js/sweetalert.min.js') }}"></script>
    <script type="text/javascript">
        function deleteFarmerBatch(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
            })
            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById("delete-form-"+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your Farmer Batch is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>



@endpush
