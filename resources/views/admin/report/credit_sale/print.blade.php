@extends('master.print.master')

@section('invoice')
    Credit Sale
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
        @php($total_paid=0)
        @php($total_discount=0)
        @foreach($credit_sales as $credit_sale)
            <tr>
                <td>{{dateFormat($credit_sale->created_at,'Y-m-d')}}</td>
                <td>{{$credit_sale->customer->name}}</td>
                <td>{{$credit_sale->customer->mobile}}</td>
                <td>TK.{{$credit_sale->totalPayable}}</td>
                <td>TK.{{$credit_sale->discount}}</td>
            </tr>
            @php($total_paid+=$credit_sale->totalPayable)
            @php($total_discount+=$credit_sale->discount)
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
                    <td>{{$total_paid}}</td>
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
                    <th>Receivable Amount</th>
                    <td>{{$total_paid-$total_discount}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
@section('back')
    {{route('credit.sale.page')}}
@endsection
