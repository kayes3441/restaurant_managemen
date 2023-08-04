@extends('master.admin.master')
@section('add-css')
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('document-title')
    Supplier Details
@endsection
@section('head-title')
    Supplier Details
@endsection
@section('head-title-1')
    <li class="breadcrumb-item"><a href="{{route('manage.supplier')}}">Manage Supplier</a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="#">Supplier Details</a></li>
@endsection
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-centered table-nowrap dt-responsive mb-0 dataTable no-footer"
                           style="border-collapse: collapse; border-spacing: 0px; width: 1094px; margin-left: 0px;"role="grid">
                        <tbody>
                        <tr>
                            <th>Name:{{$supplier->name}}</th>
                            <th>Mobile:{{$supplier->mobile}}</th>
                            <th>Address: {{$supplier->address}}</th>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-body">
                    <div id="table" class="table-responsive p-1">
                        <table id="datatable" class="table table-bordered table-centered table-nowrap dt-responsive mb-0 dataTable no-footer"
                               role="grid">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Paid</th>
                                <th>Discount</th>
                                <th>Balance</th>
                                <th>Media</th>
                                <th>Bank</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <th class="text-center" colspan="6">Initial Balance</th>
                                <td class="" colspan="4">{{$supplier->initial_balance}}</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($details as $detail)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$detail['type']}}</td>
                                    <td>{{$detail['date']}}</td>
                                    <td>{{$detail['amount']}}</td>
                                    <td>{{$detail['Paid']}}</td>
                                    <td>{{$detail['discount']}}</td>
                                    <td>
{{--                                        @php($balance=$detail['amount']-$detail['Paid']-$detail['discount'])--}}
                                        @if($detail['type'] =='Purchase')
                                            {{$supplier->initial_balance+=$detail['amount']-$detail['Paid']-$detail['discount']}}
                                        @elseif($detail['type'] =='Payment')
                                            {{$supplier->initial_balance-=$detail['Paid']+$detail['discount']}}
                                        @endif
                                    </td>
                                    <td>{{$detail['payment_media']}}</td>
                                    <td>{{$detail['payment_media']=='Bank'?$detail['bank']:''}}</td>
                                    <td>
                                        <a class="btn btn-secondary btn-sm" ><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th class="text-center" colspan="6">Total Balance</th>
                                <td class="" colspan="4">{{$supplier->initial_balance}}({{$supplier->initial_balance>0?'Payable':'Receivable'}})</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable();
        } );
    </script>
@endsection







