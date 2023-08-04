@extends('master.admin.master')
@section('add-css')
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('document-title')
    Account Chart
@endsection
@section('head-title')
    Account Chart
@endsection
@section('head-title-1')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="{{route('account-chart.page')}}">Account Chart</a></li>
@endsection
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" id="addForm">
                    <h5 class="card-title text-primary mb-3">Add New Account</h5>
                    <form action="{{route('create.account-chart')}}" method="POST" id="formSubmit">
                        @csrf
                        <input type="hidden" name="" value="">
                        <div class="row">
                            <input type="hidden" name="id">
                            <div class="col-lg-3 pr-lg-0">
                                <div class="input-group">
                                    <label class="sr-only">Sector</label>
                                    <select class="form-control" name="sector_id" id="sector_id" style="border-radius:4px" required>
                                        <option value="">--Select Sector--</option>
                                        @foreach($sectors as $sector)
                                        <option value="{{$sector->id}}">{{$sector->sector_name}}</option>
                                        @endforeach
                                        <option value="new">New Sector</option>
                                    </select>
                                    <input type="text" name="sector_name" class="form-control" style="display: none" id="newSectorName" placeholder="Sector Name" aria-label="Sector Name">
                                </div>
                            </div>
                            <div class="col-lg-3 pr-lg-0">
                                <div class="form-group">
                                    <label class="sr-only">Account Name</label>
                                    <input type="text" name="account_name" class="form-control" value="" placeholder="Account Name">
                                    <span class="text-danger" id="account_name_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-2 pr-lg-0">
                                <div class="form-group">
                                    <label class="sr-only">Account Type</label>
                                    <select class="form-control" name="account_type" required="">
                                        <option value="">--Select Account Type--</option>
                                        <option value="Debit">Type: Debit</option>
                                        <option value="Credit">Type: Credit</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 pr-lg-0">
                                <div class="form-group">
                                    <label class="sr-only">Mobile Number</label>
                                    <input type="text" name="mobile" class="form-control" value="" placeholder="Mobile Number">
                                    <span class="text-danger" id="mobile_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-2 pr-lg-0">
                                <div class="form-group">
                                    <label class="sr-only">Address</label>
                                    <input type="text" name="address" class="form-control" value="" placeholder="Address">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-book">Save</i></button>
                                <button type="reset" class="btn btn-warning "  ><i class="fa fa-times-circle">Reset</i></button>
{{--                                <button type="submit" class="btn btn-warning"><i class="fa fa-trash-alt"></i> Reset</button>--}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mx-2">Manage Account Chart</h4>
                    <div class="table-responsive" id="table">
                        @include('admin.accountChart.table')
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('js')
    @include('admin.accountChart.script')
@endsection











