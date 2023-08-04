@extends('master.print.master')

@section('invoice')
  Bank
@endsection
@section('date')
    {{date('Y-m-d')}}
@endsection
@section('table')
    <table class="invoice-table">
        <thead>
        <tr>
            <th>Date</th>
            <th>Type</th>
            <th>Withdrawal</th>
            <th>Deposit</th>
            <th>Balance</th>
        </tr>
        </thead>
        <tbody>
        @php($totalWithdrawal=0)
        @php($totalDeposit=0)
        <tr>
            <td colspan="4" class="text-center">Previous Bank Balance </td>
            <td>{{$previous_bank_balance}}</td>
        </tr>
        @foreach($bank_reports as $key=> $bank_report)
            <tr>
                <td>{{$bank_report['date']}}</td>
                <td>{{$bank_report['type']}}</td>
                <td>{{$bank_report['type'] =='Withdrawal'?$bank_report['amount'] :''}}</td>
                <td>{{$bank_report['type'] =='Deposit'?$bank_report['amount'] :''}}</td>
                <td>
                    @if($bank_report['type'] =='Withdrawal')
                        {{$previous_bank_balance-=$bank_report['amount']}}
                    @elseif($bank_report['type'] =='Deposit')
                        {{$previous_bank_balance+=$bank_report['amount']}}
                    @endif
                </td>
            </tr>
            @if($bank_report['type'] =='Withdrawal')
                @php($totalWithdrawal+=$bank_report['amount'])
            @elseif($bank_report['type'] =='Deposit')
                @php($totalDeposit+=$bank_report['amount'])
            @endif
        @endforeach
        </tbody>
    </table>

    <div class="row justify-content-between">
        <div class="col-auto">
            <div class="invoice-left"><b></b>
                <p class="mb-0"></p></div>
        </div>
        <div class="col-auto">
            <table class="total-table">
                <tr>
                    <th>Total Withdrawal</th>
                    <td>{{$totalWithdrawal}}</td>
                </tr>
                <tr>
                    <th>Total Deposit</th>
                    <td>{{$totalDeposit}}</td>
                </tr>

                <tr>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th>Balance</th>
                    <td>{{$previous_bank_balance}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
@section('back')
    {{route('bank.report.page')}}
@endsection
