@extends('master.admin.master')
@section('add-css')
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link href="{{asset('/')}}admin/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link href="{{asset('/')}}admin/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
@endsection
@section('document-title')
    Add Sale
@endsection
@section('head-title')
    Sale
@endsection
@section('head-title-1')
    <li class="breadcrumb-item" xmlns="http://www.w3.org/1999/html"><a href="{{route('dashboard')}}">Dashboard</a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="{{route('add.sale')}}">sale</a></li>
@endsection
@section('body')
        <div class="row" >

            <div class="col-xl-8">
                <h6>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </h6>
                <div class="card" style="height: 80px;">
                    <div class="card-body">
                        <div class="form-group row" >
                            <div class="col-sm-7" id="foodIdByCode">
                                <form action="{{ url('add-to-cart-by-code') }}" method="GET" id="foodByCodeForm">
                                    @csrf
                                    <div class="input-group mb-3" >
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="option-offset">Food Code</span>
                                        </div>
                                        <input type="number" class="form-control" name="code" id="Code">
                                        <input type="number" class="form-control qty" name="qty"   placeholder="Quantity">
                                        <button type="submit"  class="btn btn-primary mx-2" > Enter</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-5" >
                                <div class="input-group mb-3 ">
                                    <div class="input-group-prepend ">
                                        <span class="input-group-text" id="option-offset">Food Name</span>
                                    </div>
                                    <select class="form-control select2" name="food_id"  onblur="allSubTotal()">
                                        <option  value="">--Select Food Type--</option>
                                        @foreach($foods as $food)
                                            <option value="{{$food->id}}">{{$food->food_name}}(Code:{{$food->code}})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive" id="cartFood">
                            @include('admin.sale.cart-collection')
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Sale Summary</h4>
                        {{--                    <div class="table-responsive" style="height: 550px;">--}}
                        <table class=" mb-0 text-right table-bordered " id="saleForm">
                            <tbody style="font-size: .6125rem;" id="tableForm">
                            <form action="{{route('create.sale')}}" method="post" id="addForm">
                                @csrf
                            <tr>
                                <th style="width:45% ;" >Sale Type</th>
                                <td >
                                    <select class="form-control form-control-sm " name="sale_type" id="sale" onchange="saleType()">
                                        <option  disabled>--Select Sale--</option>
                                        <option selected value="Cash">Cash</option>
                                        <option value="Credit">Credit</option>
                                    </select>
                                </td>
                            </tr>
                            <tr id="name">
                                <th>Name</th>
                                <td><input class="form-control form-control-sm" id="name" name="customer_name" placeholder="Name"></td>
                            </tr>
                            <tr id="mobile">
                                <th>Mobile</th>
                                <td><input class="form-control form-control-sm" id="mobile" name="customer_mobile" placeholder="Mobile"></td>
                            </tr>
                            <tr id="customer">
                                <th>Customer</th>
                                <td>
                                    <select class="form-control form-control-sm" name="customer_id" onchange="getCustomerId(this.value)">
                                        <option value="" selected>--Select Customer--</option>
                                        @foreach($customers as $customer)
                                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr id="balance">
                                <th>Balance</th>
                                <td>
                                    <div class="input-group " >
                                        <input class="form-control form-control-sm" name="customer_balance" placeholder="Balance" readonly>
                                        <input class="form-control form-control-sm" style="background-color:azure" name="balance_type" placeholder="Type" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Amount : </th>
                                <th><input type="number" class="form-control form-control-sm" readonly name="amount"></th>
                            </tr>
                            <tr>
                                <th>Vat(%) : </th>
                                <th><input type="number" class="form-control form-control-sm" name="vat" value="15" onblur="VatPercentage()" onkeyup="VatPercentage()"></th>
                            </tr>
                            <tr>
                                <th>Vat Amount : </th>
                                <th><input type="number" class="form-control form-control-sm" readonly name="vatAmount"></th>
                            </tr>
                            <tr>
                                <th>Sub Total : </th>
                                <th> <input type="number" class="form-control form-control-sm" readonly name="subtotal"></th>
                            </tr>
                            <tr>
                                <th>Discount : </th>
                                <td>
                                    <input type="number" class="form-control form-control-sm" name="discount" value="0" onblur="VatPercentage()" onkeyup="VatPercentage()"/>
                                </td>
                            </tr>
                            <tr>
                                <th>Total Payable:</th>
                                <th><input type="number" class="form-control form-control-sm" readonly name="totalPayable"></th>
                            </tr>
                            <tr>
                                <th>Cash Paid : </th>
                                <td>
                                    <input type="text" class="form-control form-control-sm" id="cashPaid" name="cashPaid" onblur="cashPayable()" onkeyup="cashPayable()"/>
                                </td>
                            </tr>
                            <tr>
                                <th>Change Amount:</th>
                                <th><input type="number" class="form-control form-control-sm" readonly name="changeAmount"></th>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <button type="submit" class="btn btn-success" >Sale</button>
                                    <button type="reset" class="btn btn-danger">Cancel</button>
                                </td>
                            </tr>
                            </form>
{{--                            <tr>--}}
{{--                                <th></th>--}}
{{--                                <td>--}}
{{--                                    <button class="btn btn-danger" onclick="printInvoice('print')">Print</button>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
                            </tbody>
                        </table>
                        {{--                    </div>--}}
                    </div>
                </div>
            </div>
        </div>
{{--        <div class="modal">--}}
{{--            <div id="print">--}}
{{--                @include('admin.sale.invoice.invoice')--}}
{{--            </div>--}}
{{--        </div>--}}

@endsection
@section('js')
    <script src="{{asset('/')}}admin/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="{{asset('/')}}admin/assets/js/pages/ecommerce-cart.init.js"></script>
    @include('admin.sale.script')

@endsection
