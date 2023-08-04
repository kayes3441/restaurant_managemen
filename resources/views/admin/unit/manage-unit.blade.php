@extends('master.admin.master')
@section('add-css')
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('document-title')
    Manage Unit
@endsection
@section('head-title')
    Unit
@endsection
@section('head-title-1')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashbaord</a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="{{route('manage.unit')}}">Manage Unit</a></li>
@endsection
@section('body')
    {{--    Add Unit Form--}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mx-1">
                        <button type="button" class="btn btn-primary waves-effect waves-light"  data-toggle="modal" data-target="#addModal">Create Unit</button>
{{--                        <button type="button" class="btn btn-primary waves-effect waves-light"  onclick="addModal()">Create Unit</button>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--End Unit Form--}}
    {{--Manage Unit Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage Unit Datatable</h4>
                    <h6 class="text-success text-center">{{Session::get('message')}}</h6>
                    <table class="table table-nowrap dataTable no-footer" id="datatable" role="grid" aria-describedby="DataTables_Table_0_info" style="position: relative;">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($units as $unit)
                            @php($sl= $loop->iteration)
                            <tr id="row_unit" >
                                <td>{{$sl}}</td>
                                <td>{{$unit->name}}</td>
                                <td>{{$unit->code}}</td>
                                <td>{{$unit->description}}</td>
                                <td>{{$unit->status ==1 ?'Published':'Unpublished'}}</td>
                                <td>
{{--                                    <button type="button" class="btn btn-success btn-sm " id="detailBtn{{$unit->id}}"  onclick="detailModal({{$unit->id}})">--}}
{{--                                        <i class="fa fa-book-open"></i> details--}}
{{--                                    </button>--}}
                                    <button type="button" class="btn btn-success btn-sm " id="editFormBtn{{$unit->id}}" onclick="editModal('{{$unit }}',{{$sl}})">
                                        <i class="fa fa-edit"></i>edit
                                    </button>
                                    <button type="submit" class="btn btn-danger btn-sm"  id="deleteUnitBtn{{$unit->id}}" onclick="deleteUnit('{{$unit->id}}','{{$sl}}')">
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
    {{--    End Manage Unit Table--}}
    @include('admin.unit.add-unit')
    @include('admin.unit.detail-unit')
    @include('admin.unit.edit-unit')

@endsection
@section('js')
    @include('admin.unit.script')
@endsection
