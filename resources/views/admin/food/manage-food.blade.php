@extends('master.admin.master')
@section('add-css')
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('document-title')
    Manage Food
@endsection
@section('head-title')
    Food
@endsection
@section('head-title-1')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Food</a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="{{route('manage.food')}}">Manage Food</a></li>
@endsection
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage Food List</h4>
                    <h6 class="text-success text-center">{{Session::get('message')}}</h6>
                   <div id="table">
                       @include('admin.food.table')
                   </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('admin.food.script')
@endsection

