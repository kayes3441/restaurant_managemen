@extends('master.print.master')

@section('invoice')
    Balance Summary
@endsection
@section('date')
    {{date('Y-m-d')}}
@endsection
@section('detail')
    <div class="row justify-content-between mb-4">
        <div class="col-auto">
            <div class="invoice-left"><b>Start Date:</b> {{$start_date}}
            </div>
            <div class="invoice-left"><b>End Date:</b> {{$end_date}}
            </div>
        </div>
    </div>
@endsection
@section('table')

    <table class="invoice-table">
        <thead>
        <tr class="text-primary">
            <th colspan="2" class="text-center f-s-small">Assets</th>
            <th colspan="2" class="text-center f-s-small">Liabilities</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Cash</td><td class="text-right">{{$current_cash}}</td>
            <td>Supplier's Payable</td><td class="text-right">{{$payment}}</td></tr>
        <tr>
            <td>Bank Balanced</td><td class="text-right">{{$bank_balance}}</td>
            <td></td><td class="text-right"></td>
        </tr>
        <tr>
            <td>Customer's Receivable</td><td class="text-right">{{$receive}}</td>
            <td></td><td class="text-right"></td>
        </tr>
        <tr>
            <td>Present Stock</td><td class="text-right">{{$stock}}</td>
            <td></td><td></td></tr>
        {{--    <tr>--}}
        {{--        <td>Advance Purchase</td><td class="text-right"></td>--}}
        {{--        <td></td><td></td>--}}
        {{--    </tr>--}}
        <tr>
            <th class="text-center f-s-small">Total</th><td class="text-right f-s-small">{{$current_cash+$bank_balance+$receive+$stock}}</td>
            <th class="text-center f-s-small">Total</th><td class="text-right f-s-small">{{$payment}}</td>
        </tr>
        </tbody>
    </table>
    <div class="row justify-content-between">
        <div class="col-auto">
            <div class="invoice-left"><b></b>
                <p class="mb-0"></p></div>
        </div>
    </div>
@endsection
@section('back')
    {{route('balance.summary.page')}}
@endsection
