@extends('master.print.master')

@section('invoice')
    Expanse
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

        @php($total_expanses=0)
        @foreach($expanses as $expanse)
            <tr>
                <td>{{dateFormat($expanse->created_at,'Y-m-d')}}</td>
                <td>{{$expanse->sector->sector_name}}</td>
                <td>{{$expanse->accountChart->account_name}}</td>
                <td>TK.{{$expanse->amount}}</td>
            </tr>
            @php($total_expanses+=$expanse->amount)
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
                    <th>Total Expanse</th>
                    <td>{{$total_expanses}}</td>
                </tr>
                <tr>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td>{{$total_expanses}}</td>
                </tr>

            </table>
        </div>
    </div>
@endsection
@section('back')
    {{route('expanse.page')}}
@endsection
