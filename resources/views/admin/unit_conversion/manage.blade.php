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
    <li class="breadcrumb-item" xmlns="http://www.w3.org/1999/html"><a href="#">Food</a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="{{route('add.purchase')}}">CashBook</a></li>
@endsection
@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body" id="addForm">
                <h5 class="card-title text-primary mb-3">Unit Conversion Rule Add Form</h5>
                <form class="" action="http://inventory.techintelligencebd.com/unit-conversion-save" method="POST">
                    <input type="hidden" name="_token" value="RKEnB8VeWobchFAZXIE5s1RWZv2gSVjZ1ntMysjY">        <div class="row mb-2">
                        <div class="col-lg-8 pr-md-0">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 60px;">From </span>
                                </div>
                                <select name="from" id="from" class="form-control" required="">
                                    <option value="">--Select--</option>
                                    <option value="1">Cartoon</option>
                                    <option value="2">Piece</option>
                                    <option value="3">Box</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2 pr-md-0">
                            <button type="button" id="add" class="btn btn-block btn-secondary"><i class="fa fa-plus"></i> Add Item</button>
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>

                    <div id="items"></div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-12">
                        <table class="table mb-0 text-right table-bordered" >
                            <tbody style="font-size: .8125rem;">
                            <tr>
                                <th colspan="4" class="text-center">Received Amount</th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-left">Previous Cash</th>
                                <td>tk. 000</td>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-center">Customer Receive</th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-center"><a href="#">Customer Name</a></th>
                                <th>Amount</th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-center">Total</th>
                                <td>TK.<input type="text" readonly name="customer_amount" style="border: none;width: 45px" value="0"></td>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-center">Total Sales</th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-center">Memo No</th>
                                <th>Amount</th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-center">Total</th>
                                <td>TK.<input type="text" readonly name="total_sale_cash" style="border: none;width: 45px" value="0"></td>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-center">Bank Withdraw</th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-center">Bank Name</th>
                                <th>Amount</th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-center">Total</th>
                                <td>TK.<input type="text" readonly name="total_bank_withdraw" style="border: none;width: 45px" value="0"></td>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-center">Other Income</th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-center">Name</th>
                                <th>Amount</th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-center">Total</th>
                                <td>TK.<input type="text" readonly name="total_other_income" style="border: none;width: 45px" value="0"></td>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-left text-success">Net Total</th>
                                <td>TK.<input type="text" readonly name="" style="border: none;width: 45px" value="0"></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('admin.unit_conversion.script')
@endsection
