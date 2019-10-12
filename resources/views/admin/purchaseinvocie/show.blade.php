@extends('template.app')
@section('title','Invoice')

@push('css')

@endpush

@section('content')
    <div class="page-bar">

    </div>

    <div class="row">
        <div class="col-12">
            <div class="white-box">
                <h3><b>PURCAHSE</b> <span class="pull-right">#{{ $invoice->purchase_no }}</span></h3>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <address>
                                <img src="{{ asset(Config::get('app.company.logo')) }}" width="100px" height="auto" style="margin: 0">
                                {{--                                <h4 style="margin: 0">--}}
                                {{--                                    {{ Config::get('app.company.name') }}--}}
                                {{--                                </h4>--}}
                                <p class="text-muted m-l-5">
                                    {{ Config::get('app.address.house') }} , {{ Config::get('app.address.road') }} , {{ Config::get('app.address.sector') }}
                                    <br>
                                    {{ Config::get('app.address.area') }} , {{ Config::get('app.address.city') }}
                                    <br>
                                    {{ Config::get('app.address.post') }}
                                </p>
                            </address>
                        </div>
                        <div class="pull-right text-right">
                            <address>
                                <p class="addr-font-h3">From,</p>
                                <p class="font-bold addr-font-h4">{{ $invoice->company->name }}</p>
                                @if(!empty($invoice->company->address))
                                    <p class="text-muted m-l-30">
                                        {{ $invoice->company->address ?? 'N/A' }}
                                    </p>
                                @endif
                                <p class="m-t-30">
                                    <b>Invoice Date :</b> <i class="fa fa-calendar"></i> {{ \Carbon\Carbon::parse($invoice->purchase_date)->format('D-M-Y') }}
                                </p>
                                <p>
                                    <b>Phone  :</b> {{ $invoice->company->phone1 ?? $invoice->company->phone2 }}
                                </p>
                            </address>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive m-t-40">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-right">Product Name</th>
                                    <th class="text-right">Price</th>
                                    <th class="text-right">Quantity</th>
                                    <th class="text-right">Discount</th>
                                    <th class="text-right">Amount</th>
                                </tr>
                                </thead>
                                @php
                                    $i = 1;
                                @endphp
                                <tbody>
                                @foreach($invoice->purchaseitems as $item)

                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td class="text-right">{{ $item->product->product_name }}</td>
                                        <td class="text-right">{{ $item->cost_price }}</td>
                                        <td class="text-right">{{ $item->quantity }}</td>
                                        <td class="text-right">{{ $item->discount }}</td>
                                        <td class="text-right">{{ $item->total_cost }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="pull-right m-t-30 text-right">
                            <p>Sub - Total amount: {{ $invoice->sub_total }} BDT</p>
                            <p>Discount : {{ $invoice->discount }} BDT </p>
                            {{--                            <p>Tax (10%) : $14 </p>--}}
                            <hr>
                            <h3><b>Total :</b> {{ $invoice->grand_total }} BDT</h3> </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="text-right">
                            <button class="btn btn-danger" type="submit"> Proceed to payment </button>
                            <button onclick="javascript:window.print();" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')


@endpush
