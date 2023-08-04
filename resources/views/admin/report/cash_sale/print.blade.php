@extends('master.print.master')

@section('invoice')
    Cash Sale
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
        @foreach($cash_sales as $cash_sale)
            <tr>
                <td>{{dateFormat($cash_sale->created_at,'Y-m-d')}}</td>
                <td>{{$cash_sale->customer_name}}</td>
                <td>{{$cash_sale->customer_mobile}}</td>
                <td>TK.{{$cash_sale->totalPayable}}</td>
                <td>TK.{{$cash_sale->discount}}</td>
            </tr>
            @php($total_paid+=$cash_sale->totalPayable)
            @php($total_discount+=$cash_sale->discount)
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
                    <th>Received Amount</th>
                    <td>{{$total_paid-$total_discount}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
@section('back')
    {{route('cash.sale.page')}}
@endsection
