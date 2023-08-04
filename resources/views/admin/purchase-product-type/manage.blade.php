@extends('master.admin.master')

@section('add-css')
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('document-title')
    Manage Purchase Product Type
@endsection
@section('head-title')
    Purchase Product Type
@endsection
@section('head-title-1')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="{{route('manage')}}">Manage Purchase Product Type</a></li>
@endsection
@section('body')
    <div class="row" id="addModalPPType">
        <form action="{{route('create.product.type')}}" method="POST" id="addForm">
            @csrf
            <input type="hidden" name="id">
            <input type="hidden" name="sl">
            <div class="col-md-12 " >
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="option-offset">Purchase Product Type Name</span>
                    </div>
                    <input type="text" class="form-control" name="name" id="name" style="width: 745px" placeholder="Name">
                    <button type="submit" class="btn btn-primary mx-2"><i class="fa fa-save">Save</i></button>
                    <button type="reset" class="btn btn-warning "  ><i class="fa fa-times-circle">Reset</i></button>
                </div>
            </div>
        </form>
        {{--                        <button type="button" class="btn btn-primary waves-effect waves-light"  onclick="addModalPPType()">Create Purchase Product Type</button>--}}
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div id="manage_table">
                    @include('admin.purchase-product-type.data_table')
                </div>
            </div>
        </div>
    </div>
{{--    @include('admin.purchase-product-type.edit')--}}
@endsection
@section('js')
    @include('admin.purchase-product-type.script')
@endsection
