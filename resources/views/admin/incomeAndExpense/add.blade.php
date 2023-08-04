@extends('master.admin.master')
@section('add-css')
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
@endsection
@section('document-title')
    Income-Expense
@endsection
@section('head-title')
    Income-Expense
@endsection
@section('head-title-1')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="{{route('income.and.expanse')}}">Income-Expense</a></li>
@endsection
@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body" id="addForm">
                <h5 class="card-title text-primary mb-3">Other Income-Expense</h5>
                <form  action="{{route('create.income.or.expanse')}}" method="POST" id="formSubmit">
                    @csrf
{{--                    <input type="hidden" name="_token" value="">--}}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="width: 110px"> Type</span>
                                    </div>
                                    <select class="custom-select select2" name="transaction_type"  >
                                        <option value="">--Select--</option>
                                        <option value="Income">Income</option>
                                        <option value="Expense">Expense</option>
                                    </select>
                                </div>
                                <span class="text-danger" id="transaction_type_error"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group" id="sectorId">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="width: 110px">Sector</span>
                                    </div>
                                    <select class="custom-select select2"  name="sector_id" onchange="sectorToAccount(this.value)" >
                                        <option value="">--Select--</option>
                                    </select>
                                </div>
                                <span class="text-danger" id="sector_id_error"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"style="width: 110px">Account</span>
                                    </div>
                                    <select class="custom-select select2" name="account_chart_id" >
                                        <option value="">--Select--</option>
                                    </select>
                                </div>
                                <span class="text-danger" id="account_chart_id_error"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"style="width: 110px">Amount</span>
                                    </div>
                                    <input type="number" name="amount"  min="0" class="form-control" >
                                    <div class="input-group-append">
                                        <span class="input-group-text">Taka</span>
                                    </div>
                                </div>
                                <span class="text-danger" id="amount_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"style="width: 110px">Note</span>
                                    </div>
                                    <input type="text" name="note" class="form-control" placeholder="If any  . . .">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"style="width: 110px">Via</span>
                                    </div>
                                    <input type="text" name="via" value="{{Auth::user()->name}}" class="form-control" readonly="">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Submit</button>
{{--                                <button type="reset" class="btn btn-warning"><i class="fa fa-times-circle"></i> Reset</button>--}}
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('admin.incomeAndExpense.script')
@endsection

