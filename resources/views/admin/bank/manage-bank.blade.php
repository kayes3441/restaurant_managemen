@extends('master.admin.master')
@section('add-css')
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('document-title')
    Manage Bank
@endsection
@section('head-title')
    Bank
@endsection
@section('head-title-1')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="{{route('manage.bank')}}">Manage Bank</a></li>
@endsection
@section('body')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mx-1">
                        <button type="button" class="btn btn-primary waves-effect waves-light"  data-toggle="modal" data-target="#addModal">Create Bank</button>
                        {{--                        <button type="button" class="btn btn-primary waves-effect waves-light"  onclick="addModalPPType()">Create Purchase Product Type</button>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage Bank Datatable</h4>
                    <h6 class="text-success text-center">{{Session::get('message')}}</h6>
                    <table class="table table-nowrap dataTable no-footer" id="datatable" role="grid" aria-describedby="DataTables_Table_0_info" style="position: relative;">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($banks as $bank)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$bank->name}}</td>
                                <td>{{$bank->code}}</td>
                                <td>{{$bank->status ==1 ?'Published':'Unpublished'}}</td>
                                <td>
{{--                                    <button type="button" class="btn btn-success btn-sm " id="detailBtn{{$bank->id}}"  onclick="detailModal({{$bank}})">--}}
{{--                                        <i class="fa fa-book-open"></i> details--}}
{{--                                    </button>--}}
                                    <button type="button" class="btn btn-success btn-sm " id="editFormBtn{{$bank->id}}" onclick="editModal({{$bank}})">
                                        <i class="fa fa-edit"></i> edit
                                    </button>
                                    <button type="submit" class="btn btn-danger btn-sm"  id="deleteUnitBtn{{$bank->id}}" onclick="deleteBank({{$bank}})">
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
    @include('admin.bank.add-bank')
    @include('admin.bank.edit-bank')

@endsection
@section('js')
    @include('admin.bank.script')
@endsection


