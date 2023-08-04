@extends('master.admin.master')
@section('add-css')
    <!-- DataTables -->
    <link href="{{asset('/')}}admin/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}admin/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{asset('/')}}admin/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('document-title')
    Manage Stock
@endsection
@section('head-title')
    Stock
@endsection
@section('head-title-1')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="{{route('manage.stock')}}">Manage Stock</a></li>
@endsection
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage Stock Datatable</h4>
                    <h6 class="text-success text-center">{{Session::get('message')}}</h6>
                    <table class="table  table-nowrap dataTable no-footer" id="datatable" role="grid" aria-describedby="DataTables_Table_0_info" style="position: relative;">
                        <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Average Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($total=0)
                        @foreach($products as $product)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{presentRawMaterialQuantity($product->id)}}{{$product->unit->name}}</td>
{{--                                <td>{{$product->details->sum('quantity')}}{{count($product->details)>0 ? $product->details[0]->name :''}}</td>--}}
                                @php($productTotalQuantity=0)
                                @php($productTotalCost=0)
                                @php($rate=0)
                                @foreach($product->details as $detail)
                                    @php($productTotalQuantity +=$detail->quantity)
                                    @php($productTotalCost +=$detail->quantity*$detail->price)
                                @endforeach
                                @if(count($product->details)>0)
                                    @php($rate=$productTotalCost/$productTotalQuantity)
                                @endif
                                <td>TK.{{$rate}}</td>
                            </tr>
                            @php($total+=presentRawMaterialQuantity($product->id)*$rate)
                        @endforeach
                        </tbody>
                        <tfoot>
                        <th colspan="3" class="text-center" rowspan="1">Total:</th>
                        <th rowspan="1" colspan="1">TK.{{$total}}</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('admin.report.stock.script')
@endsection

