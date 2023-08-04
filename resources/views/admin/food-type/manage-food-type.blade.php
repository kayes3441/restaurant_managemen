@extends('master.admin.master')

@section('data-table-style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
@endsection
@section('document-title')
    Food Type
@endsection
@section('head-title')
    Manage Food Type
@endsection
@section('head-title-1')
    <li class="breadcrumb-item"><a href="#">Food Type</a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="#">Manage Food Type</a></li>
@endsection

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mx-1">
                        <button type="button" class="btn btn-primary waves-effect waves-light"  data-toggle="modal" data-target="#addModal">Create Food Type</button>
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
                    <h4 class="card-title">Manage Food Type Datatable</h4>
                    <h6 class="text-success text-center">{{Session::get('message')}}</h6>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($food_types as $food_type)
                            <tr id="row_unit" >
                                <td>{{$loop->iteration}}</td>
                                <td>{{$food_type->name}}</td>
                                <td>{{$food_type->status ==1 ?'Published':'Unpublished'}}</td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm " id="editFormBtn{{$food_type->id}}" onclick="editModal({{ $food_type }})">
                                        <i class="fa fa-edit"></i> edit
                                    </button>
                                    <button type="submit" class="btn btn-danger btn-sm"  id="deleteUnitBtn{{$food_type->id}}" onclick="deleteFoodType({{$food_type}})">
                                        <i class="fa fa-trash"></i>delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('admin.food-type.add')
    @include('admin.food-type.edit')
@endsection
@section('js')
    @include('admin.food-type.script')
@endsection
