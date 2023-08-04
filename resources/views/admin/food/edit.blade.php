@extends('master.admin.master')
@section('add-css')
    <link href="{{asset('/')}}admin/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
@endsection
@section('document-title')
    Food Recipe
@endsection
@section('head-title')
    Food Recipe
@endsection
@section('head-title-1')
    <li class="breadcrumb-item" xmlns="http://www.w3.org/1999/html"><a href="{{route('dashboard')}}">Dashboard</a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="{{route('manage.food')}}">Food List</a></li>
@endsection
@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Food Recipe Form</h4>
                <h6 class="text-success text-center">{{Session::get('message')}}</h6>
                <form action="{{route('update-recipe',['id'=>$food->id])}}" method="POST" >
                    @csrf
                    <div class="product mb-2 row "  >
                        <div class="col-sm-5">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="option-offset">Food Name</span>
                                </div>
                                <input type="text" class="form-control" name="food_name"  value="{{$food->food_name}}" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="option-offset">Food Code</span>
                                </div>
                                <input type="text" class="form-control" name="code"  value="{{$food->code}}" placeholder="Code">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="option-offset">Food Price</span>
                                </div>
                                <input type="text" class="form-control" name="price" value="{{$food->price}}" placeholder="Price" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1 ">
                                <button  type="button" class="btn btn-primary" style="width:40px;" id="addProduct" onclick="add()">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="product mb-4 row " id="addRecipe">
                        @php($totalCost=0)
                        @foreach($recipes as $recipe)
                            @php($index=$loop->iteration)
                            <div class="product row mx-1"  id="inputProduct{{$index}}">
                                <div class="col-sm-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="option-offset">Product Type</span>
                                        </div>
                                        <select class="form-control" name="product_type_id[]" id="productTypeId{{$index}}" onchange="getProductId({{$index}})">
                                            <option  selected>--Product Type--</option>
                                            @foreach($product_types as $product_type)
                                                <option value="{{$product_type->id}}"{{$product_type->id==$recipe->purchase_product_type_id ? 'selected':''}}>{{$product_type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="option-offset">Product Name</span>
                                        </div>
                                        <select class="form-control" name="product_id[]" id="purchaseProductId{{$index}}" onchange="getProductInfo({{$index}})">
                                            <option >--Product Name--</option>
                                            @foreach($products as $product)
                                                @if($product->purchase_product_type_id==$recipe->purchase_product_type_id)
                                                <option value="{{$product->id}}"{{$product->id==$recipe->rawMaterial->id ?'Selected':''}}>{{$product->name}}</option>
                                                @endif
                                            @endforeach
                                            {{--                                        <option value="{{$recipe->rawMaterial->id}}">{{$recipe->rawMaterial->name}}</option>--}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <input type="text" class="form-control"  id="avgPrice{{$index}}"  value="{{productAvgPrice($recipe->rawMaterial->id)}}" onkeyup="multiply({{$index}})" readonly placeholder="Avg Price"/>
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="option-offset">Quantity</span>
                                        </div>
                                        <input type="text" name="quantity[]" id="qty{{$index}}" value="{{$recipe->quantity}}" onblur="totalCost({{$index}})" onkeyup="multiply({{$index}})" class="form-control" />
                                        <input type="text" class="form-control" name="unit_name[]" id="unit{{$index}}" value="{{$recipe->unit_name}}" readonly placeholder="Unit"/>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <input type="text" class="form-control"  value="{{productAvgPrice($recipe->rawMaterial->id)*$recipe->quantity}}" id="costId{{$index}}" placeholder="Cost" readonly>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 ">
                                        <button  type="button" class="btn btn-danger" style="width:40px;" id="removeRecipe()" onclick="remove({{$index}})">-</button>
                                    </div>
                                </div>
                            </div>
                            @php($totalCost+=(productAvgPrice($recipe->rawMaterial->id)*$recipe->quantity))
                        @endforeach
                    </div>
                    <div class="form-group row justify-content-end" id="createBtn">
                        <div class="col-sm-8">
                            <div>
                                <button type="submit" class="btn btn-primary w-md">Update Recipe</button>
                            </div>
                        </div>
                            <div class="col-sm-4">
                                <div class="input-group mb-3" style="width: 300px">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="option-offset">Total Cost</span>
                                    </div>
                                    <input type="text" class="form-control" name="total_cost" id="totalCostId" value="{{$totalCost}}" onkeyup="totalCost()" readonly placeholder="Total Cost">
                                </div>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('admin.food.edit_script')
@endsection
