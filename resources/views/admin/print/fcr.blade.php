@extends('template.print')
@section('title','FCR Calculation')

@section('css')
    <style>
        table{
            border: 1px solid #000;
            width: 100%;
        }
        table>thead{
            border-bottom: 1px solid #000;
        }
        table>tbody{
            border: 1px solid #000;
        }
        #table1{
            border-collapse: collapse;
        }
        #table2{
            border-collapse: collapse;
        }
        table tr td{
            padding: 5px;
            border: 1px solid #000;
        }
    </style>
@endsection
@section('content')
    <h4 style="text-align: center;color: #d33333">FCR Calculation - {{ $farmer->name }}(Batch No - {{ $fcr->batch_number }})</h4>
    <div style="float: left; width: 35%; margin-right: 2%">

        <table id="table1">
            <thead>
            <tr>
                <th>Key</th>
                <th>Value</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Total Given Chicks</td>
                <td>{{ $fcr->given_chicks_quantity }} Pc</td>
            </tr>
            <tr>
                <td>Chicks Rate</td>
                <td>{{ $fcr->chicks_rate }} Tk</td>
            </tr>
            <tr>
                <td>Total Sold Quantity</td>
                <td>{{ $fcr->sold_quantity }} Pc</td>
            </tr>
            <tr>
                <td>Total Sold Kg</td>
                <td>{{ $fcr->sold_kg }} Kg</td>
            </tr>
            <tr>
                <td>Average Weight</td>
                <td>{{ $fcr->average_weight }} Kg</td>
            </tr>
            <tr>
                <td>Farm Loose Quantity</td>
                <td>{{ $fcr->farm_loose_quantity }} Pc</td>
            </tr>
            <tr>
                <td>Farm Loose Kg</td>
                <td>{{ $fcr->farm_loose_kg }} Kg</td>
            </tr>
            <tr>
                <td>Farm Stock Quantity</td>
                <td>{{ $fcr->farm_stock_quantity }} Pc</td>
            </tr>
            <tr>
                <td>Farm Stock Kg</td>
                <td>{{ $fcr->farm_stock_kg }} Kg</td>
            </tr>
            <tr>
                <td>Cartoon Dead</td>
                <td>{{ $fcr->cartoon_dead }} Pc</td>
            </tr>
            <tr>
                <td>Farm Dead</td>
                <td>{{ $fcr->farm_dead }} Pc</td>
            </tr>
            <tr>
                <td>Missing Quantity</td>
                <td>{{ $fcr->missing_quantity }} Pc</td>
            </tr>
            <tr>
                <td>Missing Kg</td>
                <td>{{ $fcr->missing_kg }} Kg</td>
            </tr>
            <tr>
                <td>Bonus Chicks</td>
                <td>{{ $fcr->bonus_chicks }} Pc</td>
            </tr>
            <tr>
                <td>Bonus Chicks Money</td>
                <td>{{ $fcr->bonus_chicks_money }} Tk</td>
            </tr>
            <tr>
                <td>Excess Dead</td>
                <td>{{ $fcr->excess_dead }} Pc</td>
            </tr>

            </tbody>
        </table>

    </div>
    <div style="float: left; width: 35%; margin-right: 2%">

        <table>
            <thead>
            <tr>
                <th>Key</th>
                <th>Value</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Farm Loose Cutting</td>
                <td>{{ $fcr->farm_loose_cutting }} Tk</td>
            </tr>
            <tr>
                <td>Farm Stock Cutting</td>
                <td>{{ $fcr->farm_stock_cutting }} Tk</td>
            </tr>
            <tr>
                <td>Excess Dead Cutting</td>
                <td>{{ $fcr->excess_dead_cutting }} Tk</td>
            </tr>

            <tr>
                <td>Excess Feed Cutting</td>
                <td>{{ $fcr->excess_feed_cutting }} Tk</td>
            </tr>
            <tr>
                <td>Report Book Cutting</td>
                <td>{{ $fcr->report_book_cutting }} Tk</td>
            </tr>
            <tr>
                <td>Transport Cost</td>
                <td>{{ $fcr->transport_cost }} Tk</td>
            </tr>
            <tr>
                <td>Stamp Cost</td>
                <td>{{ $fcr->stamp_cost }} Tk</td>
            </tr>
            <tr>
                <td>Advance Payment</td>
                <td>{{ $fcr->advance_payment }} Tk</td>
            </tr>

            <tr>
                <td>Previous Due</td>
                <td>{{ $fcr->previous_due }} Tk</td>
            </tr>
            <tr>
                <td>Others Cutting</td>
                <td>{{ $fcr->others_cutting }} Tk</td>
            </tr>



            </tbody>
        </table>

        <div>
            <p style="font-weight: bold;text-decoration: underline; margin-top: 100px; text-align: center">Authorised Signature</p>
        </div>


    </div>
    <div style="float: left; width: 24%">
        <table>
            <thead>
            <tr>
                <th>Key</th>
                <th>Value</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Total Feed Eaten</td>
                <td>{{ $fcr->feed_eaten_sacks }} Sacks</td>
            </tr>
            <tr>
                <td>FCR</td>
                <td>{{ $fcr->fcr }} Points</td>
            </tr>
            <tr>
                <td>Commission Rate</td>
                <td>{{ $fcr->commission_rate }} Tk</td>
            </tr>
            <tr>
                <td>Selling Rate</td>
                <td>{{ $fcr->commission_rate }} Tk</td>
            </tr>
            <tr>
                <td>Loose Rate</td>
                <td>{{ $fcr->farm_loose_rate }} Tk</td>
            </tr>
            <tr>
                <td>Sub Total</td>
                <td>{{ $fcr->sub_total }} Tk</td>
            </tr>
            <tr>
                <td>Total Cutting Amount</td>
                <td>{{ $fcr->total_cutting_amount }} Tk</td>
            </tr>
            <tr>
                <td>Total Amount</td>
                <td>{{ $fcr->grand_total }} Tk</td>
            </tr>
            </tbody>
        </table>
        <div>
            <p style="font-weight: bold;text-decoration: underline; margin-top: 150px; text-align: center">Farmer Signature</p>
        </div>
    </div>





@endsection
