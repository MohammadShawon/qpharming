@extends('template.print')
@section('title','Daily Sale Report')

@section('content')
    <h4 class="text-center">Accounts Report of ({{ \Carbon\Carbon::parse($request_date)->format('d-M-Y') }})</h4>
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
@endsection
