@extends('master.admin.master')
@section('document-title')
    Detail Supplier
@endsection
@section('head-title')
    Supplier
@endsection
@section('head-title-1')
    <li class="breadcrumb-item"><a href="{{route('manage.supplier')}}">Manage Supplier</a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="{{route('detail.supplier',['id'=>$supplier->id])}}">Detail Supplier</a></li>
@endsection
@section('body')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Supplier Detail Info</h4>
                <h6 class="text-success text-center">{{Session::get('message')}}</h6>
                <table class="table table-bordered">
                    <tr>
                        <th>Supplier Name</th>
                        <td>{{$supplier->name}}</td>
                    </tr>
                    <tr>
                        <th>Supplier Mobile Number</th>
                        <td>{{$supplier->mobile}}</td>
                    </tr>
                    <tr>
                        <th>Supplier Address</th>
                        <td>{{$supplier->address}}</td>
                    </tr>
                    <tr>
                        <th>Initial Balance</th>
                        <td>{{$supplier->initial_balance}}</td>
                    </tr>
                    <tr>
                        <th>Balance Title</th>
                        <td>{{$supplier->balance_title}}</td>
                    </tr>
                    <tr>
                        <th>Supplier Status</th>
                        <td>{{$supplier->status == 1 ? 'Published' : 'Unpublished'}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
