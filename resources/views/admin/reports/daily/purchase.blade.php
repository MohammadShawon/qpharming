@extends('template.print')
@section('title','Daily Purchase Report')

@section('content')
    <h4 class="text-center">Purchase Report of ({{ \Carbon\Carbon::parse($request_date)->format('d-M-Y') }})</h4>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Sr.</th>
        <th>Date</th>
        <th>Inv. No.</th>
        <th>Company</th>
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
    @foreach($purchases as $purchase)
        <tr>
            <td style="width: 5%">{{ $i++ }}</td>
            <td style="width: 15%;">{{ Carbon\Carbon::parse($purchase->purchase_date)->format('d-M-Y') }}</td>
            <td>{{ 'PUR-'. $purchase->purchase_no }}</td>
            <td>{{ $purchase->company->name }}</td>
            <td>{{ ucfirst($purchase->payment_type) }}</td>
            <td>{{ $purchase->sub_total }}</td>
            <td>{{ $purchase->discount }}</td>
            <td style="width: 15%">{{ $purchase->grand_total }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="5"></td>
        <td>Total = {{ $purchases->sum('sub_total') }}</td>
        <td>Dis = {{ $purchases->sum('discount') }}</td>
        <td>{{ $purchases->sum('grand_total') }}</td>
    </tr>
    </tfoot>

</table>

@endsection
