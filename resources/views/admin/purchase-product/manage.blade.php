@extends('master.admin.master')
@section('add-css')
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('document-title')
    Manage Purchase Product
@endsection
@section('head-title')
    Purchase Product
@endsection
@section('head-title-1')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="{{route('manage.purchase-product')}}">Manage Purchase Product </a></li>
@endsection
@section('body')
    {{--    Add Unit Form--}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mx-1">
                        <button type="button" class="btn btn-primary waves-effect waves-light"  data-toggle="modal" data-target="#addModal">Create Purchase Product</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--End Unit Form--}}

    {{--Manage  Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage Purchase Product  Datatable</h4>
                    <h6 class="text-success text-center">{{Session::get('message')}}</h6>
                    <table class="table table-nowrap dataTable no-footer" id="datatable" role="grid" aria-describedby="DataTables_Table_0_info" style="position: relative;">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Purchase Product Type Name</th>
                            <th>Purchase Product Name</th>
                            <th>Unit</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($purchase_products as $purchase_product)
                            @php($sl= $loop->iteration)
                            <tr>
                                <td>{{$sl}}</td>
                                <td>{{$purchase_product->purchase_product_type->name}}</td>
                                <td>{{$purchase_product->name}}</td>
                                <td>{{$purchase_product->unit->name}}</td>
                                <td>{{$purchase_product->status ==1 ?'Published':'Unpublished'}}</td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm " id="editFormBtn{{$purchase_product->id}}" onclick="editModal({{$purchase_product}},{{$sl}})">
                                        <i class="fa fa-edit"></i> edit
                                    </button>
                                    <button type="submit" class="btn btn-danger btn-sm"  id="deleteUnitBtn{{$purchase_product->id}}" onclick="deletePProduct({{$purchase_product->id}},{{$sl}})">
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
    {{--    End Manage Unit Table--}}
    @include('admin.purchase-product.add')
    @include('admin.purchase-product.edit')
    @include('admin.purchase-product.detail')


@endsection
@section('js')
    @include('admin.purchase-product.script')
@endsection
