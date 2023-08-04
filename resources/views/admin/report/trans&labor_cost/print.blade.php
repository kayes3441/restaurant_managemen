@extends('master.print.master')
@section('invoice')
    Transport &Labor Cost
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
            <th>Transport Cost</th>
            <th>Labor Cost</th>
        </tr>
        </thead>
        <tbody>
        @php($total_trans_cost=0)
        @php($total_labor_cost=0)
        @foreach($all_cost as $cost)
            <tr>
                <td>{{dateFormat($cost->created_at,'Y-m-d')}}</td>
                <td>{{dateFormat($cost->created_at,'Y-m-d')}}</td>
                <td>{{'Purchase'}}</td>

                <td>{{$cost->transport_cost}}</td>
                <td>{{$cost->labor_cost}}</td>

            </tr>
            @php($total_trans_cost+=$cost->transport_cost)
            @php($total_labor_cost+=$cost->labor_cost)
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
                    <th>Transport Cost</th>
                    <td>{{$total_trans_cost}}</td>
                </tr>
                <tr>
                    <th>Labor Cost</th>
                    <td>{{$total_labor_cost}}</td>
                </tr>

                <tr>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th>Total Cost</th>
                    <td>{{$total_trans_cost+$total_labor_cost}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
@section('back')
    {{route('trans.and.labor.cost.page')}}
@endsection
