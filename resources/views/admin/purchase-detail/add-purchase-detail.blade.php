@extends('master.admin.master')
@section('document-title')
    Add Purchase Detail
@endsection
@section('head-title')
    Purchase Detail
@endsection
@section('head-title-1')
    <li class="breadcrumb-item"><a href="#">Purchase Detail </a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="{{route('add.purchase-detail')}}">Add Purchase Detail</a></li>
@endsection
@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Purchase Detail Add Form</h4>
                <h6 class="text-success text-center">{{Session::get('message')}}</h6>
                <form action="#" method="POST" >
                    @csrf
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Purchase Product Type Name</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="purchase_product_type_id" >
                                <option disabled selected>--Select Purchase Product Type--</option>
                                <option>1</option>
                                <option>2</option>
{{--                                @foreach($purchases as $purchase)--}}
{{--                                    <option value="{{$purchase_product_type->id}}">{{$purchase_product_type->name}}</option>--}}
{{--                                @endforeach--}}
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Purchase Product Type Name</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="purchase_product_type_id" >
                                <option disabled selected>--Select Product --</option>
                                @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Quantity</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="quantity" placeholder=" Product Quantity Name">
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" name="purchase_product_type_id" >
                                <option disabled selected>--Select Unit --</option>
                                @foreach($units as $unit)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Rate</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="rate" placeholder="Purchase Product Name">
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Taka</label>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <button type="submit" class="btn btn-primary w-md">Create Purchase Detail Info</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
