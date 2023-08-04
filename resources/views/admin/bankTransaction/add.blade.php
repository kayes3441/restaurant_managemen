@extends('master.admin.master')
@section('document-title')
    Receive And Pay
@endsection
@section('add-css')
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
@endsection
@section('head-title')
    Bank Deposit/Withdrawal
@endsection
@section('head-title-1')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="{{route('bank.transaction.page')}}">Bank Deposit And Withdrawal</a></li>
@endsection
@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body" id="addForm">
                <h5 class="card-title text-primary mb-3">Bank Deposit/Withdrawal</h5>
                <form  action="{{route('create')}}" method="POST" id="formSubmit">
                    @csrf
{{--                    <input type="hidden" name="_token" value="whtz5mWU3le61W85hINtW8LGwnre9QleSYMY8Pmr">        --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"style="width: 120px">Account </span>
                                    </div>
                                    <select class="form-control" name="account_id" >
                                        <option value="">--Select--</option>
                                    </select>
                                </div>
                                <span class="text-danger" id="account_id_error"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="width: 120px">Trans. Type</span>
                                    </div>
                                    <select class="form-control" name="type">
                                        <option value="">--Select--</option>
                                        <option value="Deposit">Deposit</option>
                                        <option value="Withdrawal">Withdrawal</option>
                                    </select>
                                </div>
                                <span class="text-danger" id="type_error"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="width: 120px">Amount</span>
                                    </div>
                                    <input type="number" min="0" step="0.01" name="amount" value="" class="form-control" placeholder="Amount" >
                                </div>
                                <span class="text-danger" id="amount_error"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="width: 120px">Note</span>
                                    </div>
                                    <input type="text" name="note" value="" class="form-control" placeholder="If any. . .">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="width: 120px">Input Date</span>
                                    </div>
                                    <input type="date" name="input_date" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 text-right">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Save</button>
{{--                            <button type="reset" class="btn btn-warning"><i class="fa fa-times-circle"></i> Reset</button>--}}
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection

@section('js')
    @include('admin.bankTransaction.script')
@endsection

