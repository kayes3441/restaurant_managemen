@extends('master.admin.master')
@section('add-css')
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
@endsection
@section('document-title')
    Receive And Pay
@endsection
@section('head-title')
    Receive And Pay
@endsection
@section('head-title-1')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="{{route('receiveAndPay.page')}}">Receive And Pay</a></li>
@endsection
@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header font-weight-bold text-info f-s-small"><i class="bx bx-money"></i> Receive And Pay</div>
            <div class="card-body p-0">
                <table class="table table-bordered mb-0" id="receiveAndPayId">
                    <form action="{{route('create.receive.and.pay')}}" method="post" id="addForm">
                        @csrf
                    <tbody>
                    <tr>
                        <th class="text-right low-height pt-2 pb-2" style="width: 150px">Client Type</th>
                        <td class="p-1">
                            <select class="form-control p-1 low-height" id="clientType" onchange="getClient()" name="client_type" style="width: 100%" >
                                <option value="">--Select--</option>
                                <option value="Customer">Customer</option>
                                <option value="Supplier">Supplier</option>
                            </select>
                            <span class="text-danger" id="client_type_error"></span>
                        </td>

                    </tr>
                    <tr id="client">
                        <th class="text-right low-height pt-2 pb-2">Client</th>
                        <td class="p-1">
                            <select class="form-control select2 p-1 low-height" onchange="getClientId(this.value)" name="client_id" style="width: 100%">
                                <option value="">--Select--</option>
                            </select>
                            <span class="text-danger" id="client_id_error"></span>
                        </td>

                    </tr>
                    <tr id="pastBalance">
                        <th class="pt-2 pb-2 text-right">Balance</th>
                        <td class="p-1">
                            <div class="input-group">
                                <input type="text" name="past_balance" value="0" min="0" class="form-control low-height" readonly/>
                                <div class="input-group-append low-height">
                                    <input  type="text" class="input-group-text past-balance-title" id="balanceTitle" style="width: 120px" name="balance_title" value="Credit" readonly>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="pt-2 pb-2 text-right" id="amountTitle">Receive</th>
                        <td class="p-1">
                            <div class="input-group">
                                <input type="number" name="amount" onblur="dueCalculate()" onkeyup="dueCalculate()" value="0" min="0"  class="form-control low-height" >
                            </div>
                            <span class="text-danger" id="amount_error"></span>
                        </td>
                    </tr>

                    <tr>
                        <th class="pt-2 pb-2 text-right">Media</th>
                        <td class="p-1">
                            <select name="payment_media" onchange="paymentMedia()" id="mediaId" class="form-control low-height p-1">
                                <option  value="Cash" >Cash</option>
                                <option value="Bank">Bank</option>
                            </select>
                        </td>
                    </tr>

                    <tr id="account">
                        <th class="pt-2 pb-2 text-right">Account</th>
                        <td class="p-1">
                            <select class="form-control p-1 low-height" name="bank_account_id">
                                <option value="">--Select--</option>
                            </select>
                            <span class="text-danger" id="bank_account_id_error"></span>
                        </td>
                    </tr>
                    <tr>
                        <th class="pt-2 pb-2 text-right">Discount</th>
                        <td class="p-1">
                            <div class="input-group">
                                <input type="number" name="discount"  onblur="dueCalculate()" onkeyup="dueCalculate()" value="0" min="0"  class="form-control low-height" required="">
                            </div>
                        </td>
                    </tr>
                    <tr id="newBalance">
                        <th class="pt-2 pb-2 text-right">New Balance</th>
                        <td class="p-1">
                            <div class="input-group">
                                <input type="number" name="new_balance" value="0" min="0" class="form-control low-height" readonly="">
                                <div class="input-group-append low-height">
                                    <input  type="text" class="input-group-text new-balance-title" style="width: 120px" name="new_balance_title" value="Credit" readonly>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th class="p-1">
                            <div class="row">
                                <div class="col pr-1">
                                    <button type="submit"  class="btn btn-sm btn-primary mr-2" style="font-size: 13px"><i class="fa fa-save"></i> Complete Payment</button>
                                </div>
                            </div>
                        </th>
                    </tr>
                    </tfoot>
                    </form>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('admin.receiveAndPay.script')
@endsection

