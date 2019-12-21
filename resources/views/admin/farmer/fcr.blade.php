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
    <div id="fcr">
        <div class="row">
            <div class="col-12">
                <h2 class="font-weight-bolder font-weight-bolder text-center mt-0 mb-2"><b>
                        {{ env('COMPANY_NAME','QBYTESOFT') }} <span class="label label-rouded label-danger">{{ auth()->user()->branch->name }}</span></b>
                </h2>
            </div>
        </div>
        {{--Profile Quick Links--}}
        <div class="row justify-content-center">
            {{--Farmer Profile--}}
            <div class="col-12 justify-content-center">

                <div class="card mt-0">
                    <div class="card-body no-padding">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <b>ID</b> <a class="pull-right">{{ $farmer->id}}</a>
                                </td>
                                <td>
                                    <b>Name: </b> <a class="pull-right">{{ $farmer->name }}</a>
                                </td>
                                <td>
                                    <b>Phone</b> <a class="pull-right">{{ $farmer->phone1??$farmer->phone2 }}</a>
                                </td>
                                <td>
                                    <b>Address</b> <a class="pull-right">{{ $farmer->address}}</a>
                                </td>
                                <td>
                                    <b>Total Cost</b>
                                    <a class="pull-right">
                                        {{ \App\Helpers\Farmers::totalCost($farmer->id) }}
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{ route('admin.farmer.fcr_calculate.store', $farmer->id) }}" method="post">
            @csrf
        <div class="row justify-content-center">

                <div class="col-12">
                    <h3 class="font-weight-bolder font-weight-bolder text-center mt-0 mb-2">
                        FCR Calculation Form
                    </h3>
                </div>
            <input type="hidden" name="farmer_id" value="{{ $batch->farmer_id }}">
            <input type="hidden" name="batch_number" value="{{ $batch->batch_number }}">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="given_chicks_quantity">Given Chicks Quantity</label>
                                <input type="text" id="given_chicks_quantity" name="given_chicks_quantity" :value="given_chicks_quantity= {{ $batch->chicks_quantity }}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="chicks_rate"> Chicks Rate</label>
                                <input type="text" id="chicks_rate" name="chicks_rate" :value="chicks_rate= {{ $product->selling_price }}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="sold_quantity"> Sold Quantity</label>
                                <input type="text" id="sold_quantity" name="sold_quantity" v-model:number="sold_quantity" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="sold_kg"> Sold Kg</label>
                                <input type="text" id="sold_kg" name="sold_kg" v-model:number="sold_kg" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="average_weight">Average Weight Per Chicks</label>
                                <input type="text" id="average_weight" name="average_weight" :value="average_weight" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="farm_loose_quantity">Farm Loose Quantity</label>
                                <input type="text" id="farm_loose_quantity" name="farm_loose_quantity" v-model:number="farm_loose_quantity" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="farm_loose_kg">Farm Loose Kg</label>
                                <input type="text" id="farm_loose_kg" name="farm_loose_kg" v-model:number="farm_loose_kg" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="farm_stock_quantity">Farm Stock Quantity</label>
                                <input type="text" id="farm_stock_quantity" name="farm_stock_quantity" v-model:number="farm_stock_quantity" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="farm_stock_kg">Farm Stock Kg</label>
                                <input type="text" id="farm_stock_kg" name="farm_stock_kg" v-model:number="farm_stock_kg" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="cartoon_dead">Cartoon Dead</label>
                                <input type="text" id="cartoon_dead" name="cartoon_dead" v-model:number="cartoon_dead" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="farm_dead">Farm Dead</label>
                                <input type="text" id="farm_dead" v-model:number="farm_dead" name="farm_dead" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="missing_quantity">Missing Quantity</label>
                                <input type="text" id="missing_quantity" name="missing_quantity" :value="missing_quantity" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="missing_kg">Missing Kg</label>
                                <input type="text" id="missing_kg" name="missing_kg" :value="missing_kg" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="bonus_chicks">Bonus Chicks</label>
                                <input type="text" id="bonus_chicks" name="bonus_chicks" :value="bonus_chicks" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="bonus_chicks_money">Bonus Chicks Money</label>
                                <input type="text" id="bonus_chicks_money" name="bonus_chicks_money" :value="bonus_chicks_money" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="excess_dead">Excess Dead</label>
                                <input type="text" id="excess_dead" name="excess_dead" :value="excess_dead" class="form-control">
                            </div>




                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                                    <div class="form-group">
                                        <label for="farm_loose_cutting">Farm Loose Cutting</label>
                                        <input type="text" id="farm_loose_cutting" name="farm_loose_cutting" :value="farm_loose_cutting" class="form-control">
                                    </div>


                            <div class="form-group">
                                <label for="farm_stock_cutting">Farm Stock Cutting</label>
                                <input type="text" id="farm_stock_cutting" name="farm_stock_cutting" :value="farm_stock_cutting" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="excess_dead_cutting">Excess Dead Cutting</label>
                                <input type="text" id="excess_dead_cutting" name="excess_dead_cutting" :value="excess_dead_cutting" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="missing_chicks_cutting">Missing Chicks Cutting</label>
                                <input type="text" id="missing_chicks_cutting" name="missing_chicks_cutting" :value="missing_chicks_cutting" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="excess_feed_cutting">Excess Feed Cutting(KG)</label>
                                <input type="text" id="excess_feed_cutting" name="excess_feed_cutting" v-model:number="excess_feed_cutting" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="report_book_cutting">Report Book Cutting</label>
                                <input type="text" id="report_book_cutting" name="report_book_cutting" class="form-control" v-model:number="report_book_cutting" required>
                            </div>

                            <div class="form-group">
                                <label for="transport_cost">Transport Cost</label>
                                <input type="text" id="transport_cost" name="transport_cost" v-model:number="transport_cost" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="stamp_cost">Stamp Cost</label>
                                <input type="text" id="stamp_cost" name="stamp_cost" v-model:number="stamp_cost" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="advance_payment">Advance Payment Cutting</label>
                                <input type="text" id="advance_payment" name="advance_payment" v-model:number="advance_payment" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="previous_due">Previous Due Cutting</label>
                                <input type="text" id="previous_due" name="previous_due" v-model:number="previous_due" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="others_cutting">Others Cutting</label>
                                <input type="text" id="others_cutting" name="others_cutting" v-model:number="others_cutting" class="form-control">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="feed_eaten_sacks">Feed Eaten Sacks Quantity</label>
                                <input type="text" id="feed_eaten_sacks" name="feed_eaten_sacks" v-model:number="feed_eaten_sacks" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="fcr">FCR Amount</label>
                                <input type="text" id="fcr" name="fcr" :value="fcr" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="commission_rate">Commission Rate  </label>
                                <input type="text" id="commission_rate" name="commission_rate" :value="commission_rate" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="selling_rate">Selling Rate  </label>
                                <input type="text" id="selling_rate" name="selling_rate" v-model:number="selling_rate" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="farm_loose_rate">Farm Loose Rate  </label>
                                <input type="text" id="farm_loose_rate" name="farm_loose_rate" v-model:number="farm_loose_rate" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="sub_total">Sub Total </label>
                                <input type="text" id="sub_total" name="sub_total" :value="sub_total" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="total_cutting_amount">Total Cutting Amount </label>
                                <input type="text" id="total_cutting_amount" name="total_cutting_amount" :value="total_cutting_amount" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="grand_total">Grand Total </label>
                                <input type="text" id="grand_total" name="grand_total" :value="grand_total" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-sm btn-success"> Save </button>
                        </div>
                    </div>
                </div>
        </div>
        </form>


    </div>
@endsection
@push('js')
    <script>
        let farmer = {
            'id': '{{ $batch->farmer_id }}',
            'batch_number': '{{ $batch->batch_number }}'
        }
    </script>

    {{--<script src="{{ asset('admin/assets/js/pages/table/table_data.js') }}" ></script>--}}



@endpush
