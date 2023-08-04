@extends('master.print.master')

@section('invoice')
    Supplier Payment
@endsection
@section('date')
    {{date('Y-m-d')}}
@endsection
@section('table')
    <table class="invoice-table">
        <thead>
        <tr>
            <th>Date</th>
            <th>Customer Name</th>
            <th>Mobile</th>
            <th>Bill</th>
            <th>Discount</th>
        </tr>
        </thead>
        <tbody>
        @php($total_amount=0)
        @php($total_discount=0)
        @foreach($amounts as $amount)
            <tr>
                <td>{{dateFormat($amount->created_at,'Y-m-d')}}</td>
                <td>{{$amount->supplier->name}}</td>
                <td>{{$amount->supplier->mobile}}</td>
                <td>TK.{{$amount->amount}}</td>
                <td>TK.{{$amount->discount}}</td>
            </tr>
            @php($total_amount+=$amount->amount)
            @php($total_discount+=$amount->discount)
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
                    <th>Total Amount</th>
                    <td>{{$total_amount}}</td>
                </tr>
                <tr>
                    <th>Discount</th>
                    <td>{{$total_discount}}</td>
                </tr>

                <tr>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th>Payable Amount</th>
                    <td>{{$total_amount-$total_discount}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
@section('back')
    {{route('supplier_pay.report.page')}}
@endsection
