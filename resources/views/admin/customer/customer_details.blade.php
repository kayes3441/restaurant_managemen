@extends('master.admin.master')
@section('add-css')
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('document-title')
    Customer Details
@endsection
@section('head-title')
    Customer Details
@endsection
@section('head-title-1')
    <li class="breadcrumb-item"><a href="{{route('manage.customer')}}">Manage Customer</a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="#"> Customer Details</a></li>
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
                            <th>Name:{{$customer->name}}</th>
                            <th>Mobile:{{$customer->mobile}}</th>
                            <th>Address: {{$customer->address}}</th>
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
                                <th>Receivable</th>
                                <th>Receive</th>
                                <th>Discount</th>
                                <th>Balance</th>
                                <th>Media</th>
                                <th>Bank</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <th class="text-center" colspan="6">Initial Balance</th>
                                <td class="" colspan="4">{{$customer->initial_balance}}</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($details as $detail)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$detail['type']}}</td>
                                    <td>{{$detail['date']}}</td>
                                    <td>{{$detail['receivable']}}</td>
                                    <td>{{$detail['received']}}</td>
                                    <td>{{$detail['discount']}}</td>
                                    <td>
                                        @if($detail['type'] =='Sale')
                                            {{abs($customer->initial_balance-=$detail['receivable']-$detail['received']-$detail['discount'])}}
                                        @elseif($detail['type'] =='Receive')
                                            {{abs($customer->initial_balance+=$detail['received']+$detail['discount'])}}
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
                                <td class="" colspan="4">{{abs($customer->initial_balance)}}({{$customer->initial_balance>0?'Payable':'Receivable'}})</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
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







