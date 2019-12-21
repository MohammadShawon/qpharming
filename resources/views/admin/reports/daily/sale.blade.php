@extends('template.print')
@section('title','Daily Sale Report')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/print.css') }}">
    @endsection
@section('content')
    <h4 class="text-center">Sales Report of ({{ \Carbon\Carbon::parse($request_date)->format('d-M-Y') }})</h4>
<table class="table table-bordered">
        <thead>
            <tr>
                <th>Sr.</th>
                <th>Date</th>
                <th>Inv. No.</th>
                <th>Name</th>
                <th>Type</th>
                <th>Sub Total</th>
                <th>Discount</th>
                <th>Grand Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach($sales as $sale)
                <tr>
                    <td style="width: 5%">{{ $i++ }}</td>
                    <td style="width: 15%;">{{ Carbon\Carbon::parse($sale->date)->format('d-M-Y') }}</td>
                    <td>{{ $sale->sale_no }}</td>
                    <td>{{ !empty($sale->customer_id) ? App\Models\Customer::find($sale->customer_id)->name : App\Models\Farmer::find($sale->farmer_id)->name }}</td>
                    <td>{{ !empty($sale->type) ? ucfirst($sale->type) : 'Credit' }}</td>
                    <td>{{ !empty($sale->type) ? $sale->sub_total : $sale->grand_total }}</td>
                    <td>{{ !empty($sale->discount) ? $sale->discount : '0.00' }}</td>
                    <td style="width: 15%">{{ $sale->grand_total }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5"></td>
                <td>Total = {{ $sales->sum('sub_total') }}</td>
                <td>Dis = {{ $sales->sum('discount') }}</td>
                <td>{{ $sales->sum('grand_total') }}</td>
            </tr>
        </tfoot>

    </table>
@endsection
