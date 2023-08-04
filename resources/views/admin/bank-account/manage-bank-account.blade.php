


@extends('master.admin.master')

@section('add-css')
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('document-title')
    Manage Bank Account
@endsection
@section('head-title')
    Bank Account
@endsection
@section('head-title-1')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="{{route('manage.bank-account')}}">Manage Bank Account</a></li>
@endsection
@section('body')
    {{--    Add Unit Form--}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mx-1">
                        <button type="button" class="btn btn-primary waves-effect waves-light"  data-toggle="modal" data-target="#addModal">Create Bank Account</button>
                        {{--                        <button type="button" class="btn btn-primary waves-effect waves-light"  onclick="addModal()">Create Unit</button>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--End Unit Form--}}

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage Bank Account Datatable</h4>
                    <h6 class="text-success text-center">{{Session::get('message')}}</h6>
                    <table class="table table-nowrap dataTable no-footer" id="datatable" role="grid" aria-describedby="DataTables_Table_0_info" style="position: relative;">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Bank Name</th>
                            <th>Account Name</th>
                            <th>Account Number</th>
                            <th>Contact Number</th>
                            <th>Balance</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($bank_accounts as $bank_account)
                            @php($sl=$loop->iteration)
                            <tr>
                                <td>{{$sl}}</td>
                                <td>{{$bank_account->bank->name}}</td>
                                <td>{{$bank_account->account_name}}</td>
                                <td>{{$bank_account->account_number}}</td>
                                <td>{{$bank_account->contact_number}}</td>
                                <td>{{bank_balance_cal($bank_account->id)}}</td>
                                <td>{{$bank_account->status ==1 ?'Published':'Unpublished'}}</td>
                                <td>
                                    <a class="btn btn-secondary btn-sm" href="{{route('bank.details',['id'=>$bank_account->id])}}"><i class="fa fa-eye"></i></a>
                                    <button type="button" class="btn btn-success btn-sm " id="editFormBtn{{$bank_account->id}}"  onclick="editModal({{$bank_account}},{{$sl}})">
                                        <i class="fa fa-edit"></i> edit
                                    </button>
                                    <button type="submit" class="btn btn-danger btn-sm"  id="deleteUnitBtn{{$bank_account->id}}" onclick="deleteBankAccount({{$bank_account->id}},{{$sl}})">
                                        <i class="fa fa-trash"></i>delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

    @include('admin.bank-account.add-bank-account')
    @include('admin.bank-account.edit-bank-account')

@endsection
@section('js')
    @include('admin.bank-account.script')
@endsection

