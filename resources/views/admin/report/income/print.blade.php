@extends('master.print.master')

@section('invoice')
    Income
@endsection
@section('date')
    {{date('Y-m-d')}}
@endsection
@section('table')
    <table class="invoice-table">
        <thead>
        <tr>
            <th>Date</th>
            <th>Sector Name</th>
            <th>Account</th>
            <th>Amount</th>

        </tr>
        </thead>
        <tbody>

        @php($total_income=0)
        @foreach($incomes as $income)
            <tr>
                <td>{{dateFormat($income->created_at,'Y-m-d')}}</td>
                <td>{{$income->sector->sector_name}}</td>
                <td>{{$income->accountChart->account_name}}</td>
                <td>TK.{{$income->amount}}</td>
            </tr>
            @php($total_income+=$income->amount)
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
                    <th>Total Income</th>
                    <td>{{$total_income}}</td>
                </tr>
                <tr>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td>{{$total_income}}</td>
                </tr>

            </table>
        </div>
    </div>
@endsection
@section('back')
    {{route('income.report.page')}}
@endsection
