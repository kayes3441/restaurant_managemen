@extends('master.admin.master')
@section('document-title')
    Add Purchase
@endsection
@section('add-css')
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
@endsection
@section('head-title')
    Purchase
@endsection
@section('head-title-1')
    <li class="breadcrumb-item" xmlns="http://www.w3.org/1999/html"><a href="{{route('dashboard')}}">Dashboard</a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="{{route('add.purchase')}}">Add Purchase</a></li>
@endsection
@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body" id="purchaseForm">
                <h4 class="card-title mb-4">Purchase Add Form</h4>
                <h6 class="text-success text-center">{{Session::get('message')}}</h6>
                <form action="{{route('create.purchase',)}}"  method="POST" id="addForm">
                    @csrf
                    <div class="input-group mb-3" >
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="width: 140px" id="option-offset">Purchase Type</span>
                        </div>
                        <select class="form-control" name="purchase_type" id="balanceTitle" onchange="balanceT()">
                            <option value="" >--Select Purchase Type--</option>
                            <option selected value="Debit">Cash</option>
                            <option value="Credit">Credit</option>
                        </select>
                    </div>

{{--                    if purchase Type Cash--}}

                    <div class="form-group row" id="cashPayment">
                        <div class="col-sm-6" >
                            <div class="input-group " >
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 140px" id="option-offset">Name</span>
                                </div>
                                <input type="text" class="form-control"  name="name" placeholder=" Name">

                            </div>
                        </div>
                        <div class="col-sm-6" >
                            <div class="input-group " >
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 140px" id="option-offset">Mobile Number</span>
                                </div>
                                <input type="text" class="form-control" name="mobile" placeholder="Supplier Mobile Number">
                            </div>
                        </div>
                    </div>
{{--                    if purchase Type Credit--}}
                    <div class="form-group row" id="supplierId">
                        <div class="col-sm-8" >
                            <div class="input-group " >
                                <div class="input-group-prepend">
                                    <span class="input-group-text"style="width: 140px" id="option-offset">Supplier</span>
                                </div>
                                <select class="form-control" name="supplier_id"  onchange="getSupplierId(this.value)">
                                    <option selected value="">--Select Supplier Name--</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <span class="text-danger">{{$errors->has('supplier_id') ? $errors->first('supplier_id') : ''}}</span>
                        </div>
                        <div class="col-sm-4" id="foodIdByCode">
                            <div class="input-group " >
                                <div class="input-group-prepend">
                                    <span class="input-group-text"style="width: 140px" id="option-offset">Balance</span>
                                </div>
                                <output class="form-control"  name="show_amount"></output>
                                <output  class="form-control" name="show_balance_title"></output>
                            </div>
                        </div>
                    </div>
{{--                    reperter Product --}}
                    <div class="product" id="productId" >
                        <div class="col-sm-1 align-self-end" style="right:10px">
                            <button  type="button" class="btn btn-primary"  style="width:120px;" id="addProduct" onclick="addMore()">Add Product</button>
                        </div>
                        <div class="row" id="inputProduct" style="padding-right: 13px;padding-left: 13px;padding-top: 13px"></div>
                    </div>

                    <div class="form-group row" >
                        <div class="col-sm-6" >
                            <div class="input-group " >
                                <div class="input-group-prepend">
                                    <span class="input-group-text"style="width: 140px" id="option-offset">Payment</span>
                                </div>
                                <input type="text" class="form-control" id="payableAmount" name="pay_amount" placeholder="Amount" >

                            </div>
                            <span class="text-danger">{{$errors->has('pay_amount') ? $errors->first('pay_amount') : ''}}</span>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group " >
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 140px"id="option-offset">Total Amount</span>
                                </div>
                                <input type="text" class="form-control" name="total_amount" readonly onkeyup="allSubTotal()" placeholder="Total Amount ">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row" >
                        <div class="col-sm-6" id="payableAmount">
                            <div class="input-group " >
                                <div class="input-group-prepend">
                                    <span class="input-group-text"style="width: 140px" id="option-offset">Payment Media</span>
                                </div>
                                <select class="form-control" name="payment_media" id="paymentMediaId" onchange="paymentMedia()">
                                    <option value="">--Select Payment Media--</option>
                                    <option selected value="Debit">Cash</option>
                                    <option value="Bank">Bank</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-sm-6" >
                            <div class="input-group " >
                                <div class="input-group-prepend">
                                    <span class="input-group-text"style="width: 140px" id="option-offset">Invoice Number</span>
                                </div>
                                <input type="text" class="form-control" name="invoice_number" placeholder="Invoice Number">
                            </div>
                            <span class="text-danger">{{$errors->has('invoice_number') ? $errors->first('invoice_number') : ''}}</span>
                        </div>
                    </div>
                    <div class="form-group row" id="bankAccount">
                        <div class="col-sm-6" >
                            <div class="input-group " >
                                <div class="input-group-prepend">
                                    <span class="input-group-text"style="width: 140px" id="option-offset">Bank Account</span>
                                </div>
                                <select class="form-control" name="bank_account_id">
                                    <option disabled selected>--Select Bank Account--</option>
                                    @foreach($bank_accounts as $bank_account)
                                        <option value="{{$bank_account->id}}">{{$bank_account->account_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="text-danger">{{$errors->has('bank_account_id') ? $errors->first('bank_account_id') : ''}}</span>
                        </div>
                        <div class="col-sm-6" >
                            <div class="input-group " >
                                <div class="input-group-prepend">
                                    <span class="input-group-text"style="width: 140px" id="option-offset">Bank Payment Id</span>
                                </div>
                                <input type="text" class="form-control" name="bank_payment_id" placeholder="Bank Payment Id">
                            </div>
                            <span class="text-danger">{{$errors->has('bank_payment_id') ? $errors->first('bank_payment_id') : ''}}</span>
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-sm-6" >
                            <div class="input-group " >
                                <div class="input-group-prepend">
                                    <span class="input-group-text"style="width: 140px" id="option-offset">Labor Cost</span>
                                </div>
                                <input type="text" class="form-control" name="labor_cost" placeholder="Labor Cost">
                            </div>
                            <span class="text-danger">{{$errors->has('labor_cost') ? $errors->first('labor_cost') : ''}}</span>
                        </div>
                        <div class="col-sm-6" >
                            <div class="input-group " >
                                <div class="input-group-prepend">
                                    <span class="input-group-text"style="width: 140px" id="option-offset">Transport Cost</span>
                                </div>
                                <input type="text" class="form-control" name="transport_cost" placeholder="Transport Cost">
                            </div>
                            <span class="text-danger">{{$errors->has('transport_cost') ? $errors->first('transport_cost') : ''}}</span>
                        </div>

                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-12">
                            <div>
                                <button type="submit" class="btn btn-success w-md"><i class="bx bx-cart">Complete Purchase</i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('js')
    @include('admin.purchase.script')
@endsection
