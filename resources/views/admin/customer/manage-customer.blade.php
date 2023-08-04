@extends('master.admin.master')
@section('add-css')
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('document-title')
    Manage Customer
@endsection
@section('head-title')
    Customer
@endsection
@section('head-title-1')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="{{route('manage.customer')}}">Manage Customer</a></li>
@endsection
@section('body')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mx-1">
                        <button type="button" class="btn btn-primary waves-effect waves-light"  data-toggle="modal" data-target="#addModal">Create Customer</button>
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
                    <h4 class="card-title">Manage Customer Datatable</h4>
                    <h6 class="text-success text-center">{{Session::get('message')}}</h6>
                    <table class="table table-nowrap dataTable no-footer" id="datatable" role="grid" aria-describedby="DataTables_Table_0_info" style="position: relative;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Receivable</th>
                            <th>Payable</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $customer)
                            @php($balance=customerBalanceCal($customer->id))
                            @php($sl= $loop->iteration)
                            <tr>
                                <td>{{$sl}}</td>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->mobile}}</td>
                                <td>{{$customer->address}}</td>
                                <td>{{ $balance['title'] =='Credit'? $balance['balance']: ''}}</td>
                                <td>{{ $balance['title'] =='Debit'? $balance['balance']: ''}}</td>

                                <td>{{$customer->status ==1 ?'Published':'Unpublished'}}</td>
                                <td>
                                   <a class="btn btn-secondary btn-sm" href="{{route('customer.details',['id'=>$customer->id])}}"><i class="fa fa-eye"></i></a>
                                    <button type="button" class="btn btn-success btn-sm " id="editFormBtn{{$customer->id}}" onclick="editModal({{$customer}},{{$sl}})">
                                        <i class="fa fa-edit"></i> edit
                                    </button>
                                    <button type="submit" class="btn btn-danger btn-sm"  id="deleteBtn{{$customer->id}}" onclick="deleteCustomer({{$customer->id}},{{$sl}})">
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
    @include('admin.customer.add-customer')
    @include('admin.customer.edit-customer')


@endsection
@section('js')
    @include('admin.customer.script')
@endsection

