@extends('master.admin.master')
@section('add-css')
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('document-title')
    Manage Supplier
@endsection
@section('head-title')
    Supplier
@endsection
@section('head-title-1')
    <li class="breadcrumb-item"><a href="#">Supplier</a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="#">Manage Supplier</a></li>
@endsection
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mx-1">
                        <button type="button" class="btn btn-primary waves-effect waves-light"  data-toggle="modal" data-target="#addModal">Create Supplier</button>
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
                    <h4 class="card-title">Manage Supplier Datatable</h4>
                    <h6 class="text-success text-center">{{Session::get('message')}}</h6>
                    <table class="table table-nowrap dataTable no-footer" id="datatable" role="grid" aria-describedby="DataTables_Table_0_info" style="position: relative;">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Payable</th>
                            <th>Receivable</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($suppliers as $supplier)
                            @php($balance = supplierBalanceCal($supplier->id))
                            @php($sl= $loop->iteration)
                            <tr>
                                <td>{{$sl}}</td>
                                <td>{{$supplier->name}}</td>
                                <td>{{$supplier->mobile}}</td>
                                <td>{{$supplier->address}}</td>

                                <td>{{ $balance['title'] =='Debit'? $balance['balance']: ''}}</td>
                                <td>{{ $balance['title'] =='Credit'? $balance['balance']: ''}}</td>
{{--                                <td>{{ $supplier->balance_title =='Credit'? supplierBalanceCal($supplier->id->balance): ''}}</td>--}}
                                <td>{{$supplier->status ==1 ?'Published':'Unpublished'}}</td>
                                <td>
                                    <a class="btn btn-sm btn-secondary" target="_blank" href="{{route('supplier.detail',['id'=>$supplier->id])}}"><i class="fa fa-eye"></i></a>
                                    <button type="button" class="btn btn-success btn-sm " id="editFormBtn{{$supplier->id}}" onclick="editModal({{$supplier}},{{$sl}})">
                                        <i class="fa fa-edit"></i> edit
                                    </button>
                                    <button type="submit" class="btn btn-danger btn-sm"  id="deleteUnitBtn{{$supplier->id}}" onclick="deleteSupplier({{$supplier->id}},{{$sl}})">
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
    @include('admin.supplier.add-supplier')
    @include('admin.supplier.edit-supplier')
@endsection
@section('js')
    @include('admin.supplier.script')
@endsection

