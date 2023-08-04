@extends('master.admin.master')
@section('add-css')
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('document-title')
    Credit Sale Report
@endsection
@section('head-title')
    Credit Sale Report
@endsection
@section('head-title-1')
    <li class="breadcrumb-item" xmlns="http://www.w3.org/1999/html"><a href="{{route('dashboard')}}">Dashboard</a></li>
@endsection
@section('head-title-2')
    <li class="breadcrumb-item"><a href="{{route('credit.sale.page')}}">Credit Sale Report</a></li>
@endsection
@section('body')
    <div class="card-header">
        <div class="row">
            <div class="col-lg-10" id="dateSubmit">
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-5 pr-lg-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">From</span>
                                </div>
                                <input type="date" name="from" id="startDate" class="form-control" value="{{date('Y-m-d')}}">
                            </div>
                        </div>

                        <div class="col-lg-5 pr-lg-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">To</span>
                                </div>
                                <input type="date" name="to" id="endDate" class="form-control" value="{{date('Y-m-d')}}">
                            </div>
                        </div>

                        <input type="hidden" name="view" value="view">

                        <div class="col-lg-2 pr-lg-1">
                            <button type="submit" class="btn btn-block btn-secondary"><i class="fa fa-eye"></i> View</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-2">
                <form target="_blank" action="{{route('get.credit.sale.info.by.date')}}" method="POST">
                    @csrf
                    <input class="d-none" type="date" id="printStartDate" name="start" value="{{date('Y-m-d')}}">
                    <input class="d-none" type="date" id="printEndDate" name="end" value="{{date('Y-m-d')}}">
                    <input type="hidden" name="type" value="print">
                    <button type="submit" class="btn btn-block btn-primary"><i class="bx bx-printer"></i> Print</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" id="table">
                    @include('admin.report.credit_sale.table')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('admin.report.credit_sale.script')
@endsection
