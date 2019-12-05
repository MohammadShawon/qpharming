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

        <div class="row justify-content-center">

                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="given_chicks_quantity">Given Chicks Quantity</label>
                                <input type="text" id="given_chicks_quantity" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="chicks_rate"> Chicks Rate</label>
                                <input type="text" id="chicks_rate" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="sold_quantity"> Sold Quantity</label>
                                <input type="text" id="sold_quantity" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="sold_kg"> Sold Kg</label>
                                <input type="text" id="sold_kg" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="average_weight">Average Weight Per Chicks</label>
                                <input type="text" id="average_weight" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="farm_loose_quantity">Farm Loose Quantity</label>
                                <input type="text" id="farm_loose_quantity" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="farm_loose_kg">Farm Loose Kg</label>
                                <input type="text" id="farm_loose_kg" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="farm_stock_quantity">Farm Stock Quantity</label>
                                <input type="text" id="farm_stock_quantity" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="farm_stock_kg">Farm Stock Kg</label>
                                <input type="text" id="farm_stock_kg" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="missing_quantity">Missing Quantity</label>
                                <input type="text" id="missing_quantity" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="missing_kg">Missing Kg</label>
                                <input type="text" id="missing_kg" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="cartoon_dead">Cartoon Dead</label>
                                <input type="text" id="cartoon_dead" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="farm_dead">Farm Dead</label>
                                <input type="text" id="farm_dead" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="excess_dead">Excess Dead</label>
                                <input type="text" id="excess_dead" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="bonus_chicks">Bonus Chicks</label>
                                <input type="text" id="bonus_chicks" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="bonus_chicks_money">Bonus Chicks Money</label>
                                <input type="text" id="bonus_chicks_money" class="form-control">
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="farm_loose_cutting">Farm Loose Cutting</label>
                                <input type="text" id="farm_loose_cutting" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="farm_stock_cutting">Farm Stock Cutting</label>
                                <input type="text" id="farm_stock_cutting" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="excess_dead_cutting">Excess Dead Cutting</label>
                                <input type="text" id="excess_dead_cutting" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="missing_chicks_cutting">Missing Chicks Cutting</label>
                                <input type="text" id="missing_chicks_cutting" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="excess_feed_cutting">Excess Feed Cutting(KG)</label>
                                <input type="text" id="excess_feed_cutting" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="report_book_cutting">Report Book Cutting</label>
                                <input type="text" id="report_book_cutting" class="form-control" value="30" required>
                            </div>

                            <div class="form-group">
                                <label for="transport_cost">Transport Cost</label>
                                <input type="text" id="transport_cost" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="stamp_cost">Stamp Cost</label>
                                <input type="text" id="stamp_cost" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="advance_payment">Advance Payment Cutting</label>
                                <input type="text" id="advance_payment" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="previous_due">Previous Due Cutting</label>
                                <input type="text" id="previous_due" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="others_cutting">Others Cutting</label>
                                <input type="text" id="others_cutting" class="form-control">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="feed_eaten_sacks">Feed Eaten Sacks Quantity</label>
                                <input type="text" id="feed_eaten_sacks" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="fcr">FCR Amount</label>
                                <input type="text" id="fcr" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="commission_rate">Commission Rate  </label>
                                <input type="text" id="commission_rate" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="selling_rate">Selling Rate  </label>
                                <input type="text" id="selling_rate" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="farm_loose_rate">Farm Loose Rate  </label>
                                <input type="text" id="farm_loose_rate" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="sub_total">Sub Total </label>
                                <input type="text" id="sub_total" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="total_cutting_amount">Total Cutting Amount </label>
                                <input type="text" id="total_cutting_amount" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="grand_total">Grand Total </label>
                                <input type="text" id="grand_total" class="form-control">
                            </div>


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
