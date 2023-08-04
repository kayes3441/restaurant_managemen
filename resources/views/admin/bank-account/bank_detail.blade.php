@extends('master.admin.master')
@section('add-css')
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('document-title')
    Bank Account Details
@endsection
@section('head-title')
    Bank Account Details
@endsection
@section('head-title-1')
    <li class="breadcrumb-item"><a href="{{route('manage.bank-account')}}">Bank Account</a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="#"> Bank Account Details</a></li>
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
                            <th class="text-center">Name:{{$account->account_name}}</th>
                            <th class="text-center">Mobile:{{$account->account_number}}</th>
                            <th class="text-center">Branch Address: {{$account->branch_address}}</th>
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
                                <th>Balance</th>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-center">Initial Balance</td>
                                <td>{{$account->initial_balance}}</td>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach($details as $detail)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$detail['type']}}</td>
                                    <td>{{$detail['date']}}</td>
                                    <td>{{$detail['amount']}}</td>
                                    <td>
                                        @if($detail['category'] =='Withdrawal')
                                            {{$account->initial_balance-=$detail['amount']}}
                                        @elseif($detail['category'] =='Deposit')
                                            {{$account->initial_balance+=$detail['amount']}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="4" class="text-center">Total</td>
                                <td>{{$balance=$account->initial_balance}}</td>
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







