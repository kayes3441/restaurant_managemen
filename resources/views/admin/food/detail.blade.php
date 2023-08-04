@extends('master.admin.master')
@section('add-css')
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('document-title')
    Food Details
@endsection
@section('head-title')
    Food Details
@endsection
@section('head-title-1')
    <li class="breadcrumb-item"><a href="{{route('manage.food')}}">Food List</a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="#">Supplier Details</a></li>
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
                            <th>Food Name:{{$food->food_name}}</th>
                            <th>Food Code:{{$food->code}}</th>
                            <th>Price: {{$food->price}}</th>
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
                                <th>Raw Materials</th>
                                <th>Quantity</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item['name']}}</td>
                                    <td>{{$item['quantity']}}&nbsp{{$item['unit']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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







