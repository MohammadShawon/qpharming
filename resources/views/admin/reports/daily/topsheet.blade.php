@extends('template.print')
@section('title', 'Daily TopSheet')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/print.css') }}">
@endsection
@section('content')
    <h4 class="text-center">Top Sheet of ({{ \Carbon\Carbon::parse($request_date)->format('d-M-Y') }})</h4>

    <div class="container">
        <div class="row">
            <div class="col-xs-6">
                <h5 class="sub-header">Purchase</h5>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Company</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($purchases as $purchase)
                            <tr>
                                <td>{{ 'PUR-'. $purchase->purchase_no }}</td>
                                <td style="width: 15%;">{{ Carbon\Carbon::parse($purchase->purchase_date)->format('d-M-Y') }}</td>
                                <td>{{ $purchase->company->name }}</td>
                                <td style="width: 15%">{{ $purchase->grand_total }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2">Total</td>
                            <td colspan="2" class="text-right">{{ $purchases->sum('grand_total') }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="col-xs-6">
                <h5 class="sub-header">Sales</h5>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="">#</th>
                            <th class="">Date</th>
                            <th class="">Name</th>
                            <th class="">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sales as $sale)
                            <tr>
                                <td>{{ $sale->sale_no }}</td>
                                <td style="width: 15%;">{{ Carbon\Carbon::parse($sale->date)->format('d-M-Y') }}</td>
                                <td>{{ !empty($sale->customer_id) ? App\Models\Customer::find($sale->customer_id)->name : App\Models\Farmer::find($sale->farmer_id)->name }}</td>
                                <td style="width: 15%">{{ $sale->grand_total }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2">Total</td>
                            <td colspan="2" class="text-right">{{ $sales->sum('grand_total') }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>


                <div id="clearfix"></div>
            </div>
        </div>
        <div class="row">
            <h4 class="text-center">Accounts</h4>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Origin</th>
                    <th>Heads</th>
                    <th>Company</th>
                    <th>Farmer</th>
                    <th>Employee</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Recipient</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach($accounts as $account)
                    <tr>
                        <td style="font-size: 10px;font-weight: bold; width: 15%">
                            {{ \Carbon\Carbon::parse($account->Date)->format('d-M-Y') }}
                        </td>
                        <td>
                            {{ $account->Origin }}
                        </td>
                        <td>
                            @if ($account->Origin === 'Expense')
                                {{ !empty($account->Heads) ? App\Models\ExpenseHead::find($account->Heads)->name : 'N/A' }}
                            @else
                                {{ !empty($data->Heads) ? App\Models\PurposeHead::find($account->Heads)->name : 'N/A' }}
                            @endif
                        </td>
                        <td>
                            {{ !empty($data->Company) ? App\Models\Company::find($account->Company)->company_name : 'N/A' }}
                        </td>
                        <td>
                            {{ !empty($account->farmer_id) ? App\Models\Farmer::find($account->farmer_id)->name : 'N/A' }}
                        </td>
                        <td>
                            {{ !empty($account->Employee) ? App\Models\User::find($account->Employee)->name : 'N/A' }}
                        </td>
                        <td>
                            {{ $account->Category }}
                        </td>
                        <td>
                            {{ $account->Origin === 'Collection' ? '+ '.$account->Amount : '- '.$account->Amount }}
                        </td>
                        <td>
                            {{ $account->Recipient }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3">
                        T. Expense = {{ number_format($accounts->where('Origin','Expense')->sum('Amount'),2) }}
                    </td>
                    <td colspan="3">
                        T. Payment = {{ number_format($accounts->where('Origin','Payments')->sum('Amount'),2) }}
                    </td>
                    <td colspan="3">
                        T. Collection = {{ number_format($accounts->where('Origin','Collection')->sum('Amount'),2) }}
                    </td>

                </tr>
                </tfoot>

            </table>
        </div>
    </div>

@endsection

