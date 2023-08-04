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
    <li class="breadcrumb-item"><a href="{{route('food.recipe')}}">Food Recipe</a></li>
@endsection
@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Food Recipe Form</h4>
                <h6 class="text-success text-center">{{Session::get('message')}}</h6>
                <form action="{{route('create.food-recipe')}}" method="POST" id="addForm">
                    @csrf
                    <div class="product mb-2 row "  >
                        <div class="col-sm-5">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="option-offset">Food Name</span>
                                </div>
                                <input type="text" class="form-control" name="food_name"  placeholder="Name">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="option-offset">Food Code</span>
                                </div>
                                <input type="text" class="form-control" name="code"  placeholder="Code">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="option-offset">Food Price</span>
                                </div>
                                <input type="text" class="form-control" name="price" placeholder="Price" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1 ">
                                <button  type="button" class="btn btn-primary" style="width:40px;" id="addProduct" onclick="add()">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="product mb-4 row " id="addRecipe"></div>
                    <div class="form-group row justify-content-end" id="createBtn">
                        <div class="col-sm-8">
                            <div>
                                <button type="submit" class="btn btn-primary w-md">Create Recipe</button>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group mb-3" style="width: 300px">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="option-offset">Total Cost</span>
                                </div>
                                <input type="text" class="form-control" name="total_cost" id="totalCostId" onkeyup="totalCost()" readonly placeholder="Total Cost">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('admin.food-recipe.script')
@endsection
