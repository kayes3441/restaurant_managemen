@extends('master.print.master')

@section('invoice')
    Credit Purchase Invoice
@endsection
@section('date')
    {{date('Y-m-d')}}
@endsection
@section('table')
    <table class="invoice-table">
        <thead>
        <tr>
            <th>Date</th>
            <th>Supplier Name</th>
            <th>Mobile</th>
            <th>Product</th>
            <th>Bill</th>
            <th>Paid Amount</th>
        </tr>
        </thead>
        <tbody>
        @php($total_credit_purchase=0)
        @php($total_pay_amount=0)
        @foreach($credit_purchases as $credit_purchase)
            <tr>
                <td>{{dateFormat($credit_purchase->created_at,'Y-m-d')}}</td>
                <td>{{$credit_purchase->supplier->name}}</td>
                <td>{{$credit_purchase->supplier->mobile}}</td>
                <td>
                    @foreach($credit_purchase->details as $detail)
                        {{$detail->product->name}}&nbsp;({{$detail->quantity}}{{$detail->unit_id}}) </br>
                    @endforeach
                </td>
                <td>TK.{{$credit_purchase->total_amount}}</td>
                <td>TK.{{$credit_purchase->pay_amount}}</td>
            </tr>
            @php($total_credit_purchase+=$credit_purchase->total_amount)
            @php($total_pay_amount+=$credit_purchase->pay_amount)
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
                    <td>{{$total_credit_purchase}}</td>
                </tr>
                <tr>
                    <th>Pay Amount</th>
                    <td>{{$total_pay_amount}}</td>
                </tr>

                <tr>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th>Payable Amount</th>
                    <td>{{$total_credit_purchase-$total_pay_amount}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
@section('back')
    {{route('purchase.report.page')}}
@endsection
