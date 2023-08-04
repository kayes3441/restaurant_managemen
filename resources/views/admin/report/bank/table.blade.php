<table class="table table-editable table-nowrap dataTable no-footer" id="datatable" role="grid" aria-describedby="DataTables_Table_0_info" style="position: relative;">
    <thead>
    <tr>
        <th>sl</th>
        <th>Date</th>
        <th>Type</th>
        <th>Withdrawal</th>
        <th>Deposit</th>
        <th>Balance</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody >
    @php($totalWithdrawal=0)
    @php($totalDeposit=0)
{{--    @php($totalBalance=0)--}}
    <tr>
        <td colspan="5" class="text-center">Previous Bank Balance </td>
        <td>{{$previous_bank_balance}}</td>
    </tr>
    @foreach($bank_reports as $key=> $bank_report)
        @php($sl=$loop->iteration)
        <tr>
            <td>{{$sl}}</td>
            <td>{{$bank_report['date']}}</td>
            <td>{{$bank_report['type']}}</td>
            <td>{{$bank_report['type'] =='Withdrawal'?$bank_report['amount'] :''}}</td>
            <td>{{$bank_report['type'] =='Deposit'?$bank_report['amount'] :''}}</td>
            <td>
                @if($bank_report['type'] =='Withdrawal')
                    {{$previous_bank_balance-=$bank_report['amount']}}
                @elseif($bank_report['type'] =='Deposit')
                    {{$previous_bank_balance+=$bank_report['amount']}}
                @endif
            </td>
            <td>
{{--                href="{{route('bank.report.invoice')}}"--}}
                <a class="btn btn-secondary btn-sm" ><i class="fa fa-eye"></i> </a>
            </td>
        </tr>
        @if($bank_report['type'] =='Withdrawal')
           @php($totalWithdrawal+=$bank_report['amount'])
        @elseif($bank_report['type'] =='Deposit')
            @php($totalDeposit+=$bank_report['amount'])
        @endif
    @endforeach
    </tbody>
    <tfoot>
    <th colspan="3" class="text-center" rowspan="1">Total:</th>
    <th  rowspan="1" colspan="1" style="width: 78.8125px;">{{$totalWithdrawal}}</th>
    <th  rowspan="1" colspan="1" style="width: 92.796875px;">{{$totalDeposit}}</th>
    <th  rowspan="1" colspan="2" style="width: 92.796875px;">{{$previous_bank_balance}}</th>
    </tfoot>
</table>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    } );

</script>
